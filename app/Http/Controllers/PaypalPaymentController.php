<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use Paypalpayment;
use Session;
use Config;
use App\Setting;
use Auth;

class PaypalPaymentController extends Controller
{
    public $getConfigClientId;
    public $getConfigClientSecret;

    public function __construct()
    {
        Session::forget('paypal_payment');
        $getConfig = Setting::first();
        $client_id = $getConfig->paypal_client_id;
        $secret_id = $getConfig->paypal_secret_id;
        $setConfigClientId = Config::set('paypal_payment.account[client_id]',$client_id);
        $this->getConfigClientId = Config::get('paypal_payment.account[client_id]');
        $setConfigClientSecret = Config::set('paypal_payment.account[client_secret]',$secret_id);
        $this->getConfigClientSecret = Config::get('paypal_payment.account[client_secret]');
    }
    /*
    * Process payment using credit card
    */

    public function paywithCreditCard(Request $request)
    {
        // ### Address
        // Base Address object used as shipping or billing
        // address in a payment. [Optional]
        $id = $request->user()->id;
        $shippingAddress = Paypalpayment::shippingAddress();
        $shippingAddress->setLine1("3909 Witmer Road")
            ->setLine2("Niagara Falls")
            ->setCity("Niagara Falls")
            ->setState("NY")
            ->setPostalCode("14305")
            ->setCountryCode("US")
            ->setPhone("716-298-1822")
            ->setRecipientName("Jhone");

        $dp_amount = $request->input('amount');
        $card_number = $request->input('card_number');
        $duration = $request->input('duration');
        $time = explode('/',$duration);
        $month =  $time[0];
        $year = $time[1];
        $security = $request->input('security');
        $holder_name = $request->input('holder_name');
        $name = explode(' ',$holder_name);
        $firstname = $name[0];
        $lastname = $name[1];

        // ### CreditCard
        $card = Paypalpayment::creditCard();
        $card->setType("visa")
            ->setNumber($card_number)
            ->setExpireMonth($month)
            ->setExpireYear($year)
            ->setCvv2($security)
            ->setFirstName($firstname)
            ->setLastName($lastname);

        // ### FundingInstrument
        // A resource representing a Payer's funding instrument.
        // Use a Payer ID (A unique identifier of the payer generated
        // and provided by the facilitator. This is required when
        // creating or using a tokenized funding instrument)
        // and the `CreditCardDetails`
        $fi = Paypalpayment::fundingInstrument();
        $fi->setCreditCard($card);

        // ### Payer
        // A resource representing a Payer that funds a payment
        // Use the List of `FundingInstrument` and the Payment Method
        // as 'credit_card'
        $payer = Paypalpayment::payer();
        $payer->setPaymentMethod("credit_card")
            ->setFundingInstruments([$fi]);

        $item1 = Paypalpayment::item();
        $item1->setName('Deposit')
                ->setDescription('Deposit')
                ->setCurrency('USD')
                ->setQuantity(1)
                ->setTax(0)
                ->setPrice($dp_amount);

        // $item2 = Paypalpayment::item();
        // $item2->setName('Granola bars')
        //         ->setDescription('Granola Bars with Peanuts')
        //         ->setCurrency('USD')
        //         ->setQuantity(5)
        //         ->setTax(0.2)
        //         ->setPrice(2);


        $itemList = Paypalpayment::itemList();
        $itemList->setItems([$item1])
            ->setShippingAddress($shippingAddress);


        $details = Paypalpayment::details();
        $details->setShipping("0")
                ->setTax("0")
                //total of items prices
                ->setSubtotal($dp_amount);

        //Payment Amount
        $amount = Paypalpayment::amount();
        $amount->setCurrency("USD")
                // the total is $17.8 = (16 + 0.6) * 1 ( of quantity) + 1.2 ( of Shipping).
                ->setTotal($dp_amount)
                ->setDetails($details);

        // ### Transaction
        // A transaction defines the contract of a
        // payment - what is the payment for and who
        // is fulfilling it. Transaction is created with
        // a `Payee` and `Amount` types

        $transaction = Paypalpayment::transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Payment description")
            ->setInvoiceNumber(uniqid());

        // ### Payment
        // A Payment Resource; create one using
        // the above types and intent as 'sale'

        $payment = Paypalpayment::payment();

        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setTransactions([$transaction]);

        try {
            // ### Create Payment
            // Create a payment by posting to the APIService
            // using a valid ApiContext
            // The return object contains the status;
            $payment->create(Paypalpayment::apiContext($this->getConfigClientId,$this->getConfigClientSecret));
        } catch (\PPConnectionException $ex) {
            return response()->json(["error" => $ex->getMessage()], 400);
        }
        $response = $payment->toArray();
        $pay_amount = $response['transactions'][0]['amount']['total'];
        if($response['transactions'][0]['related_resources'][0]['sale']['state'] == 'completed') {
            if (updateBalance($pay_amount,$id) == true) {
                Session::flash('success', 'Payment has been approved');
                return redirect()->back();
            }
        } else {
            Session::flash('warning', 'Please try again with valid card details');
            return redirect()->back();
        }
        
        //return response()->json([$payment->toArray()], 200);
    }



     /*
    * Process payment with express checkout
    */
    public function paywithPaypal(Request $request)
    {
        $dp_amount = $request->input('amount');
        // ### Address
        // Base Address object used as shipping or billing
        // address in a payment. [Optional]
        $shippingAddress= Paypalpayment::shippingAddress();
        $shippingAddress->setLine1("3909 Witmer Road")
            ->setLine2("Niagara Falls")
            ->setCity("Niagara Falls")
            ->setState("NY")
            ->setPostalCode("14305")
            ->setCountryCode("US")
            ->setPhone("716-298-1822")
            ->setRecipientName("Jhone");

        // ### Payer
        // A resource representing a Payer that funds a payment
        // Use the List of `FundingInstrument` and the Payment Method
        // as 'credit_card'
        $payer = Paypalpayment::payer();
        $payer->setPaymentMethod("paypal");

        $item1 = Paypalpayment::item();
        $item1->setName('Ground Coffee 40 oz')
                ->setDescription('Ground Coffee 40 oz')
                ->setCurrency('USD')
                ->setQuantity(1)
                ->setTax(0.0)
                ->setPrice($dp_amount);

        // $item2 = Paypalpayment::item();
        // $item2->setName('Granola bars')
        //         ->setDescription('Granola Bars with Peanuts')
        //         ->setCurrency('USD')
        //         ->setQuantity(5)
        //         ->setTax(0.2)
        //         ->setPrice(2);


        $itemList = Paypalpayment::itemList();
        $itemList->setItems([$item1])
            ->setShippingAddress($shippingAddress);


        $details = Paypalpayment::details();
        $details->setShipping("0")
                ->setTax("0")
                //total of items prices
                ->setSubtotal($dp_amount);

        //Payment Amount
        $amount = Paypalpayment::amount();
        $amount->setCurrency("USD")
                // the total is $17.8 = (16 + 0.6) * 1 ( of quantity) + 1.2 ( of Shipping).
                ->setTotal($dp_amount)
                ->setDetails($details);

        // ### Transaction
        // A transaction defines the contract of a
        // payment - what is the payment for and who
        // is fulfilling it. Transaction is created with
        // a `Payee` and `Amount` types

        $transaction = Paypalpayment::transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Payment description")
            ->setInvoiceNumber(uniqid());

        // ### Payment
        // A Payment Resource; create one using
        // the above types and intent as 'sale'

        $redirectUrls = Paypalpayment::redirectUrls();
        $redirectUrls->setReturnUrl(url("/payments/success"))
            ->setCancelUrl(url("/payments/fails"));

        $payment = Paypalpayment::payment();

        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions([$transaction]);

        try {
            // ### Create Payment
            // Create a payment by posting to the APIService
            // using a valid ApiContext
            // The return object contains the status;
            $payment->create(Paypalpayment::apiContext($this->getConfigClientId,$this->getConfigClientSecret));
        } catch (\PPConnectionException $ex) {
            return response()->json(["error" => $ex->getMessage()], 400);
        }
        $state = $payment->toArray();
        Session::put('paypal_payment',$state['transactions'][0]['amount']['total']);
        if($state['state'] == 'created') {
            return Redirect::to($state['links'][1]['href']);
        } else {

        }
        //return response()->json([$payment->toArray(), 'approval_url' => $payment->getApprovalLink()], 200);
    }
     
    public function paymentSuccess(){
        $id = Auth::user()->id;
        $paypal_amount = Session::get('paypal_payment');
        if (updateBalance($paypal_amount,$id) == true) {
            Session::flash('success', 'Payment has been approved');
            return redirect()->back();
        }
        
    }

    public function paymentFailure(){
        Session::flash('waring', 'Something went wrong.Try again');
        return redirect()->back();
    }

    /*
        Use this call to get a list of payments. 
        url:payment/
    */
    public function listOfTransaction()
    {

        $payments = Paypalpayment::getAll(['count' => 1, 'start_index' => 0], Paypalpayment::apiContext($this->getConfigClientId,$this->getConfigClientSecret));

        aa($payments->toArray());
        //return response()->json([$payments->toArray()], 200);

    }

        /*
        Use this call to get details about payments that have not completed, 
        such as payments that are created and approved, or if a payment has failed.
        url:payment/PAY-3B7201824D767003LKHZSVOA
    */

    public function show()
    {
        $payment_id = 'PAY-8GB56854CP0340458LXYPUGI';
        $payment = Paypalpayment::getById($payment_id, Paypalpayment::apiContext($this->getConfigClientId,$this->getConfigClientSecret));
        aa($payment->toArray());
        return response()->json([$payment->toArray()], 200);
    }

    public function paypal_amount_via_paypal($paypal_amount) {
        return $paypal_amount;
    }
}
?>
