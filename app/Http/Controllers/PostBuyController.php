<?php

namespace App\Http\Controllers;

use App\Balance;
use App\Bid;
use App\Buyer;
use App\PostBid;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Image;

class PostBuyController extends Controller
{
    private $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    public function storeBuy(Request $request)
    {
        $address = $request->address;
        $lat = $request->lat;
        $lng = $request->lng;
        $category = $request->buytype;
        $categoryOption = $request->service;
        $rate = $request->bidrate;
        $serviceOption = $request->serviceoption;
        $hours = $request->bidhours;
        $title = $request->buysubject;
        $description = $request->buydetails;
        $referral = $request->referral;

        if ($request->buy_id) {
            $buyer = Buyer::find($request->buy_id);
        } else {
            $buyer = new Buyer();
        }
        //Saving Buy Image
        if ($request->hasFile('postphoto')) {
            $image = $request->file('postphoto');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('uploads/buyer/' . $filename);
            // Image::make($image)->resize(640, 480)->save($location);
            compress($image,$location); 
            $buyer->buyer_featured_image = $filename;
        }
        $buyer->user_id = auth()->user()->id;
        $buyer->buyer_category = $category;
        $buyer->buyer_sale_price = ' ';
        $buyer->buyer_website = ' ';
        $buyer->buyer_pro_title = $title;
        $buyer->buyer_pro_description = $description;
        $buyer->buyer_location = $address;
        $buyer->buyer_commission_percentage = $referral;
        $buyer->buyer_category_option = $categoryOption;
        $buyer->longitude = $lng;
        $buyer->latitude = $lat;
        $buyer->hour = $hours;
        $buyer->rate = $rate;
        $buyer->service_option = $serviceOption;
        $buyer->save();
        return response()->json(['status' => 'success']);
    }

    public function deleteBuy(Request $request)
    {
        $id = $request->buyId;
        $buy = Buyer::find($id);
        if (!$buy) {
            return response()->json(['status' => 'fail', 'message' => "Buy not found"]);
        }
        $buy->delete();
        return response()->json(['status' => 'success', 'message' => 'Deleted successfully']);

    }

    public function getBuyInfo(Request $request)
    {
        $buy = Buyer::where(['id' => $request->id, 'user_id' => $request->userId])->first();
        if (!$buy) {
            return response()->json(['status' => 'fail', 'message' => "Buy not found"]);
        }
        return response()->json(['status' => 'success', 'data' => $buy]);
    }

    public function buyBidStore(Request $request)
    {
        $buy = Buyer::find($request->id);
        if (!$request->bid_amount) {
            return response()->json(['status' => 'fail', 'message' => "Amount not found"]);
        }
        if (!$buy) {
            return response()->json(['status' => 'fail', 'message' => "Buy not found"]);
        }
        $preBid = $buy->bids()->where('user_id', auth()->id())->first();
        if ($preBid) {
            $bid = $preBid;
        } else {
            $bid = new PostBid();
        }
        if ($request->check == 'yes') {
            $preUser = User::where('email', $request->email)->first();
            if (!$preUser) {
                return response()->json(['status' => 'fail', 'message' => "User not found with this email"]);
            }
        }

        $bid->bid_type = 'buy';
        $bid->user_id = auth()->id();
        $bid->reference_id = $buy->id;
        $bid->amount = $request->bid_amount;
        $bid->reference_email = $request->email;
        $bid->save();

        return response()->json(['status' => 'success', 'message' => "Bid successful"]);
    }

    public function buyBidget(Request $request)
    {
        $buy = Buyer::where(['id' => $request->id])->first();
        if (!$buy) {
            return response()->json(['status' => 'fail', 'message' => "Buy not found"]);
        }
        $bids = $buy->bids()->count();
        $orders = $buy->bids()->where('status', '!=', 'pending')->count();
        $html = '<div class="row">
                            <div class="col-md-12">
                                <hr>
                            </div>
                        </div>';
        if ($request->type == 'bids') {
            foreach ($buy->bids as $bid) {
                $buttons = '';
                if ($bid->status != 'ordered') {
                    $buttons = '<a href="#" onclick="buyAcceptUser(' . $bid->id . ',' . $bid->user_id . ')"> <i class="fa fa-check-circle fa-2x" aria-hidden="true" style="color: green"></i></a>
                <a href="#" onclick="orderRejectUser(' . $bid->id . ',' . $bid->user_id . ')"> <i class="fa fa-times-circle-o fa-2x" aria-hidden="true" style="color: red"></i></a>';
                }
                $href = auth()->id() != $bid->user_id ? 'href="/privateChat/' . $bid->user_id . ',' . auth()->id() . '"' : '#';

                $actionButtons = "";
                $reviewButton = '';
                if ($bid->status == 'pending') {
                    $actionButtons = "<button data-id='" . $bid->id . "' class='place-order'>Order<button/><button data-type='buyer' data-id='" . $bid->id . "' class='normal-dispute'>Dispute<button/>";
                } else if ($bid->status == 'ordered') {
                    $actionButtons = "<button data-type='buyer' data-id='" . $bid->id . "' class='normal-dispute'>Dispute<button/>";
                } else if ($bid->status == 'in_process') {
                    $actionButtons = "<button data-type='buyer' data-id='" . $bid->id . "' class='normal-dispute'>Dispute<button/>";
                } else if ($bid->status == 'delivered') {
                    $actionButtons = "<button data-user-id='" . $bid->user_id . "' data-id='" . $bid->id . "' class='place-received'>Received<button/><button data-type='buyer' data-id='" . $bid->id . "' class='normal-dispute'>Dispute<button/>";
                } else if ($bid->status == 'paid') {
                    $actionButtons = "";
                    $reviewButton = '<input data-bid-user="' . $bid->user_id . '" data-bid-id="' . $bid->id . '"  class="ownRating bid-rating rating-loading own-rating" value="' . userReview(auth()->id(), $bid->user_id, $bid->id) . '" style="padding-top: 5px;">';

                } else if ($bid->status == 'closed') {
                    $actionButtons = "";
                    $reviewButton = '<input class="ownRating bid-close-rating rating-loading own-rating" value="' . userReview(auth()->id(), $bid->user_id, $bid->id) . '" style="padding-top:5px">';
                    $reviewButton .= '<input class="ownRating bid-close-rating rating-loading own-rating" value="' . userReview($bid->user_id, auth()->id(), $bid->id) . '" style="padding-top:5px">';
                } else if ($bid->status == 'got_dispute') {
                    $actionButtons = "<button data-type='buyer' data-id='" . $bid->id . "' class='normal-accept' >Accept<button/><button data-type='buyer' data-id='" . $bid->id . "' class='normal-dispute'>Dispute<button/>";
                } else if ($bid->status == 'send_dispute') {
                    $actionButtons = "<button data-type='buyer' data-id='" . $bid->id . "' class='normal-withdraw' >Withdraw<button/><button data-type='buyer' data-id='" . $bid->id . "' class='normal-dispute'>Dispute<button/>";
                }
                $bidStatus = str_replace('send', '', str_replace('got', '', $bid->status));

                $html .= '<div class="row">
                  <div class="col-md-1">
                  <a href="/userprofile/' . $bid->user_id . '">
                    <img src="/uploads/avatars/' . $bid->user->avatar . '" style="height: 30px; width: 30px"/>
                  <span>' . $bid->user->name . '</span>
                  </a>
                  </div>
                  <div class="col-md-2">
                    <input class="ownRating rating rating-loading own-rating"
                                       value="' . averageReview($bid->user_id) . '"
                                       style="padding-top: 8px;">
                  </div>
                  <div class="col-md-2">
                   <span style="margin-left: 5px;margin-right: 5px;">$' . $bid->amount . '</span> <span style="margin-left: 5px;margin-right: 5px;"><a ' . $href . '><i class="fa fa-comment"></i></a></span><span style="margin-left: 5px;margin-right: 5px;">' . $bid->due_date . '</span>
                  </div>
                  <div class="col-md-2"><div class="actionButtons">' . $actionButtons . '</div></div>
                  <div class="col-md-1"><div class="bid-status_' . $bid->id . '">' . ucfirst(str_replace('_', ' ', $bidStatus)) . '</div></div>
                  <div class="col-md-3" style="padding: 0;"><div style="display: flex" class="rate-profile rate_profile_' . $bid->id . '" >' . $reviewButton . '</div></div>
                  <div class="col-md-1"><i class="fa fa-file"></i></div>
                </div>';
            }
        } else if ($request->type == 'orders') {
            foreach ($buy->bids()->where('status', '!=', 'pending')->get() as $bid) {
                $buttons = '';
                if ($bid->status != 'ordered') {
                    $buttons = '<a href="#" onclick="buyAcceptUser(' . $bid->id . ',' . $bid->user_id . ')"> <i class="fa fa-check-circle fa-2x" aria-hidden="true" style="color: green"></i></a>
                <a href="#" onclick="orderRejectUser(' . $bid->id . ',' . $bid->user_id . ')"> <i class="fa fa-times-circle-o fa-2x" aria-hidden="true" style="color: red"></i></a>';
                }
                $href = auth()->id() != $bid->user_id ? 'href="/privateChat/' . $bid->user_id . ',' . auth()->id() . '"' : '#';

                $actionButtons = "";
                $reviewButton = '';
                if ($bid->status == 'pending') {
                    $actionButtons = "<button data-id='" . $bid->id . "' class='place-order'>Order<button/><button data-type='buyer' data-id='" . $bid->id . "' class='normal-dispute'>Dispute<button/>";
                } else if ($bid->status == 'ordered') {
                    $actionButtons = "<button data-type='buyer' data-id='" . $bid->id . "' class='normal-dispute'>Dispute<button/>";
                } else if ($bid->status == 'in_process') {
                    $actionButtons = "<button data-type='buyer' data-id='" . $bid->id . "' class='normal-dispute'>Dispute<button/>";
                } else if ($bid->status == 'delivered') {
                    $actionButtons = "<button data-user-id='" . $bid->user_id . "' data-id='" . $bid->id . "' class='place-received'>Received<button/><button data-type='buyer' data-id='" . $bid->id . "' class='normal-dispute'>Dispute<button/>";
                } else if ($bid->status == 'paid') {
                    $actionButtons = "";
                    $reviewButton = '<input data-bid-user="' . $bid->user_id . '" data-bid-id="' . $bid->id . '"  class="ownRating bid-rating rating-loading own-rating" value="' . userReview(auth()->id(), $bid->user_id, $bid->id) . '" style="padding-top: 5px;">';

                } else if ($bid->status == 'closed') {
                    $actionButtons = "";
                    $reviewButton = '<input class="ownRating bid-close-rating rating-loading own-rating" value="' . userReview(auth()->id(), $bid->user_id, $bid->id) . '" style="padding-top:5px">';
                    $reviewButton .= '<input class="ownRating bid-close-rating rating-loading own-rating" value="' . userReview($bid->user_id, auth()->id(), $bid->id) . '" style="padding-top:5px">';
                } else if ($bid->status == 'got_dispute') {
                    $actionButtons = "<button data-type='buyer' data-id='" . $bid->id . "' class='normal-accept' >Accept<button/><button data-type='buyer' data-id='" . $bid->id . "' class='normal-dispute'>Dispute<button/>";
                } else if ($bid->status == 'send_dispute') {
                    $actionButtons = "<button data-type='buyer' data-id='" . $bid->id . "' class='normal-withdraw' >Withdraw<button/><button data-type='buyer' data-id='" . $bid->id . "' class='normal-dispute'>Dispute<button/>";
                }
                $bidStatus = str_replace('send', '', str_replace('got', '', $bid->status));

                $html .= '<div class="row">
                  <div class="col-md-1">
                  <a href="/userprofile/' . $bid->user_id . '">
                    <img src="/uploads/avatars/' . $bid->user->avatar . '" style="height: 30px; width: 30px"/>
                  <span>' . $bid->user->name . '</span>
                  </a>
                  </div>
                  <div class="col-md-2">
                    <input class="ownRating rating rating-loading own-rating"
                                       value="' . averageReview($bid->user_id) . '"
                                       style="padding-top: 8px;">
                  </div>
                  <div class="col-md-2">
                   <span style="margin-left: 5px;margin-right: 5px;">$' . $bid->amount . '</span> <span style="margin-left: 5px;margin-right: 5px;"><a ' . $href . '><i class="fa fa-comment"></i></a></span><span style="margin-left: 5px;margin-right: 5px;">' . $bid->due_date . '</span>
                  </div>
                  <div class="col-md-2"><div class="actionButtons">' . $actionButtons . '</div></div>
                  <div class="col-md-1"><div class="bid-status_' . $bid->id . '">' . ucfirst(str_replace('_', ' ', $bidStatus)) . '</div></div>
                  <div class="col-md-3" style="padding: 0;"><div style="display: flex" class="rate-profile rate_profile_' . $bid->id . '" >' . $reviewButton . '</div></div>
                  <div class="col-md-1"><i class="fa fa-file"></i></div>
                </div>';
            }
        }
        return response()->json(['status' => 'success', 'data' => $html, 'bids' => $bids, 'orders' => $orders]);
    }

    public function orderCreate(Request $request)
    {
        $bid = PostBid::find($request->id);
        if (!$bid) {
            return response()->json(['status' => 'fail', 'message' => "Bid not found"]);
        }
        if ($bid->status != 'pending' || $bid->status == 'ordered') {
            return response()->json(['status' => 'fail', 'message' => "Already ordered"]);
        }
        $auth = auth()->user();
        $balance = calculateTotalAvailableBalance($auth->id);
        $requireBalance = $bid->amount + ($bid->amount * $bid::buyer()->buyer_commission_percentage / 100);
        if ($balance < $requireBalance) {
            return response()->json(['status' => 'fail', 'message' => "Balance not available. Please deposit."]);
        }
        $escrow = User::where('email', 'escrow@hi5.com')->first();
        $data2['user_id'] = $escrow->id;
        $data2['transaction_by'] = $auth->id;
        $data2['posted_by'] = $auth->id;
        $data2['amount'] = $requireBalance;
        $pageController = (new PageController());
        $transaction_id = $pageController->generateUniqueString($pageController->permitted_chars, 16);
        $data2['transaction_id'] = $transaction_id;
        $data2['type'] = "cr";
        $data2['datwise'] = date("Y-m-d");
        Balance::insert($data2);


        $data3['user_id']       = $auth->id;
        $data3['description']   = 'Escrow Amount';
        $data3['details']       = nl2br(htmlentities('Escrow Amount', ENT_QUOTES, 'UTF-8'));
        $data3['type']          = "db";
        $data3['datwise']       = date("Y-m-d");
        $data3['withdraw']      = $requireBalance;
        $data3['transfer_to_user_id'] = $escrow->id;
        $data3['transaction_id']= $transaction_id;
        $data3['transaction_by'] = $auth->id;
        $data3['posted_by'] = $auth->id;
        Balance::insert($data3);

        $bid->status = 'ordered';
        $bid->due_date = $request->date;
        $bid->save();
        return response()->json(['status' => 'success',]);
    }

    public function orderInprocessCreate(Request $request)
    {

        $bid = PostBid::find($request->id);
        if (!$bid) {
            return response()->json(['status' => 'fail', 'message' => "Bid not found"]);
        }
        if ($bid->status != 'ordered' || $bid->status == 'in_process') {
            return response()->json(['status' => 'fail', 'message' => "Already ordered"]);
        }
        $bid->status = 'in_process';
        $bid->save();
        return response()->json(['status' => 'success',]);
    }

    public function orderDeliverCreate(Request $request)
    {

        $bid = PostBid::find($request->id);
        if (!$bid) {
            return response()->json(['status' => 'fail', 'message' => "Bid not found"]);
        }
        if ($bid->status != 'in_process' || $bid->status == 'delivered') {
            return response()->json(['status' => 'fail', 'message' => "Already Delivered"]);
        }
        $bid->status = 'delivered';
        $bid->save();
        return response()->json(['status' => 'success',]);
    }

    public function orderReceiveCreate(Request $request)
    {

        $bid = PostBid::where(['id' => $request->id])->first();
        if (!$bid) {
            return response()->json(['status' => 'fail', 'message' => "Bid not found"]);
        }
        if ($bid->status != 'delivered' || $bid->status == 'paid') {
            return response()->json(['status' => 'fail', 'message' => "Already Received"]);
        }
        $auth = auth()->user();
        $escrow = User::where('email', 'escrow@hi5.com')->first();
        $hi5bid = User::where('email', 'hi5@hi5.com')->first();
        $system = User::where('email', 'system@hi5.com')->first();
        $reffuser=User::where('email', $bid->reference_email)->first();



        $buyer=$bid::buyer();

        $sellerAmount=$bid->amount;
        $refAmount=$bid->amount*$buyer->buyer_commission_percentage/100;
        $refereeAmount=$refAmount*50/100;
        $hi5Amount=$refAmount*25/100;
        $bidderAmount=$refAmount*25/100;

        //seller
        $data1['transaction_by'] = $system->id;
        $data1['user_id'] = $bid->user_id;
        $data1['posted_by'] = $bid->user_id;
        $data1['amount'] = $sellerAmount;
        $data1['description']   = 'Escrow Amount';
        $pageController = (new PageController());
        $transaction_id = $pageController->generateUniqueString($pageController->permitted_chars, 16);
        $data1['transaction_id'] = $transaction_id;
        $data1['type'] = "cr";
        $data1['datwise'] = date("Y-m-d");
        Balance::insert($data1);

        //Referee

        if($reffuser){
            $data2['user_id'] = $reffuser->id;
            $data2['posted_by'] = $reffuser->id;
            $data2['transaction_by'] = $system->id;
        }else{
            $data2['user_id']=$hi5bid->id;
            $data2['posted_by'] = $hi5bid->id;
            $data2['transaction_by'] = $system->id;
        }
        $data2['description']   = 'Escrow Amount';

        $data2['amount'] = $refereeAmount;
        $data2['transaction_id'] = $transaction_id;
        $data2['type'] = "cr";
        $data2['datwise'] = date("Y-m-d");
        Balance::insert($data2);

        //hi5
        $data3['transaction_by'] = $system->id;
        $data3['user_id']=$hi5bid->id;
        $data3['description']   = 'Escrow Amount';
        $data3['posted_by'] = $hi5bid->id;
        $data3['amount'] = $hi5Amount;
        $data3['transaction_id'] = $transaction_id;
        $data3['type'] = "cr";
        $data3['datwise'] = date("Y-m-d");
        Balance::insert($data3);

        //bidder
        $data4['transaction_by'] = $system->id;
        $data4['user_id']=$bid->user_id;
        $data4['description']   = 'Escrow Amount for bidding';
        $data4['posted_by'] = $bid->user_id;
        $data4['amount'] = $bidderAmount;
        $data4['transaction_id'] = $transaction_id;
        $data4['type'] = "cr";
        $data4['datwise'] = date("Y-m-d");
        Balance::insert($data4);


        $data5['user_id']       = $escrow->id;
        $data5['description']   = 'Distributed Escrow Amount';
        $data5['details']       = nl2br(htmlentities('Distributed Escrow Amount', ENT_QUOTES, 'UTF-8'));
        $data5['type']          = "db";
        $data5['datwise']       = date("Y-m-d");
        $data5['withdraw']      = $hi5Amount+$bidderAmount+$refereeAmount+$sellerAmount;
        $data5['transfer_to_user_id'] = $escrow->id;
        $data5['transaction_id']= $transaction_id;
        $data5['transaction_by'] = $system->id;
        $data5['posted_by'] = $escrow->id;
        Balance::insert($data5);


        $bid->status = 'paid';
        $bid->save();
        return response()->json(['status' => 'success',]);
    }

    public function postBidDelete(Request $request)
    {
        $bid = PostBid::where(['reference_id' => $request->id, 'user_id' => auth()->id(), 'bid_type' => $request->post_type])->first();
        if (!$bid) {
            return response()->json(['status' => 'fail', 'message' => "Bid not found"]);
        }
        $bid->delete();
        return response()->json(['status' => 'success']);
    }

    public function oldPost()
    {
        $data['buyers'] = Buyer::orderBy('id', 'desc')->where(function ($q) {
            $q->where(DB::raw("DATE_ADD(created_at,INTERVAL hour HOUR)"), '<', now());
        })->paginate(10);

        return view('pages.profile.oldPost', $data);
    }

    public function postBids()
    {
        $data['buyers'] = Buyer::orderBy('id', 'desc')->whereHas('bids', function ($q) {
            $q->where('user_id', auth()->id());
        })->get();

        return view('pages.profile.postBids', $data);
    }

    public function orderDisputeCreate(Request $request)
    {
        $bid = PostBid::find($request->id);
        if (!$bid) {
            return response()->json(['status' => 'fail', 'message' => "Bid not found"]);
        }
        if ($bid->status == 'got_dispute' || $bid->status == 'send_dispute') {
            return response()->json(['status' => 'fail', 'message' => "Already Disputed"]);
        }
        if ($request->type == 'buyer') {
            $bid->status = 'send_dispute';
        } else {
            $bid->status = 'got_dispute';
        }
        $bid->save();
        return response()->json(['status' => 'success',]);
    }

    public function orderDisputeChange(Request $request)
    {
        $bid = PostBid::find($request->id);
        if (!$bid) {
            return response()->json(['status' => 'fail', 'message' => "Bid not found"]);
        }
        if ($bid->status == 'got_dispute_accept' || $bid->status == 'send_dispute_accept' || $bid->status == 'got_dispute_decline' || $bid->status == 'send_dispute_decline') {
            return response()->json(['status' => 'fail', 'message' => "Already Disputed accepted or withdraw"]);
        }
        if ($request->type == 'buyer') {
            if ($request->change == 'withdraw')
                $bid->status = 'pending';
            else if ($request->change == 'accept')
                $bid->status = 'got_dispute_accept';
        } else {
            if ($request->change == 'withdraw')
                $bid->status = 'pending';
            else if ($request->change == 'accept')
                $bid->status = 'send_dispute_accept';
        }
        $bid->save();
        return response()->json(['status' => 'success',]);
    }
}
