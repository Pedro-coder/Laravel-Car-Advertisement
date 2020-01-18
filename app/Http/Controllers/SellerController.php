<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Seller;
use App\User;
use App\PostBid;
use App\Balance;
use Image;
use Session;
use Storage;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\HelperClass;


class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //create a variable and store all the blog posts in it from the database
      $sellers = Seller::orderBy('id', 'desc')->paginate(10);
      //return a view and pass in the above variable
      return view('pages.seller.index')->withSellers($sellers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $opacity_value = DB::table('site_info')->where('attr_name', 'form_opacity')->get()->toArray();
        return view('pages.seller.create')->with('opacity', $opacity_value[0]->attr_value);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $settings = HelperClass::getSettings();
      if ($settings->file_size) {
          $fileSize = $settings->file_size;
      }else{
          $fileSize = '20000';
      }
      // validate the data
      $this->validate($request, array(
          'seller_featured_image'           => 'mimes:jpeg,jpg,png,gif|required|max:'.$fileSize, // max 20000kb/2MB
          // 'seller_commission_percentage'    => 'required|max:255',
          'seller_item_code'                => 'required|string|max:255|unique:sellers',
          'seller_pro_weight'                => '',
          'seller_category'                 => 'required',
          'seller_org_price'                => 'required|integer',
          'seller_sale_price'               => 'required|integer|max:'.$request->seller_org_price,
          'seller_website'                  => 'required|max:255',
          'seller_pro_title'                => 'required|min:5|max:255',
          'seller_pro_description'          => 'required',
          'seller_location'                 => 'required',
          'seller_info_from'                => '',
          'seller_info_price'               => 'nullable|integer',
          'seller_info_description'         => 'nullable|min:5|max:255',
         ));
        // store in the database
          $seller = new Seller;

          $seller->user()->associate($request->user());
          // $seller->seller_commission_percentage = $request->seller_commission_percentage;
          $seller->seller_item_code             = $request->seller_item_code;
          $seller->seller_pro_weight            = $request->seller_pro_weight;
          $seller->seller_category              = $request->seller_category;
          $seller->seller_org_price             = $request->seller_org_price;
          $seller->seller_sale_price            = $request->seller_sale_price;
          $seller->seller_website               = $request->seller_website;
          $seller->seller_pro_title             = $request->seller_pro_title;
          $seller->seller_pro_description       = $request->seller_pro_description;
          $seller->seller_location              = $request->seller_location;
          $seller->seller_info_from             = $request->seller_info_from;
          $seller->seller_info_price            = $request->seller_info_price;
          $seller->seller_info_description      = $request->seller_info_description;

          //Save our Image
          if ($request->hasFile('seller_featured_image')) {
          $image = $request->file('seller_featured_image');
          $filename = time() . '.' . $image->getClientOriginalExtension();
          $location = public_path('uploads/seller/' . $filename);
          Image::make($image)->resize(280,320)->save($location);

          $seller->seller_featured_image = $filename;
          }

          $seller->save();


          Session::flash('success', 'The post was successfully published!');
          // redirect to another page
           return redirect()->route('seller.show', $seller->id);
          // return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $user_id = Auth::User()->id;
      $users = User::all();
      $seller = Seller::find($id);
      $post_user = $seller->user_id;
      if($user_id == $post_user)
      {
        $edit_value = "true";
      }
      else
      {
        $edit_value = "false";
      }
      return view('pages.seller.show', array('user' => Auth::User()), array('edit_val' =>  $edit_value))
      ->withSeller($seller)->withUsers($users);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $seller = Seller::find($id);
      if(auth()->user()->id !== $seller->user_id) {
        return redirect('home')->with('error', 'You are not authorized');
      }
      return view('pages.seller.edit')->withSeller($seller);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

      //validate the data before use it
      $this->validate($request, array(
        'seller_featured_image'           => 'sometimes|image',
        // 'seller_commission_percentage'    => 'required|max:255',
        'seller_item_code'                => 'required',
        'seller_pro_weight'                => '',
        'seller_category'                 => 'required',
        'seller_org_price'                => 'required|integer',
        'seller_sale_price'               => 'required|integer|max:'.$request->seller_org_price,
        'seller_website'                  => 'required|max:255',
        'seller_pro_title'                => 'required|min:5|max:255',
        'seller_pro_description'          => 'required|min:5|max:255',
        'seller_location'                 => 'required',
        'seller_info_from'                => '',
        'seller_info_price'               => 'nullable|integer',
        'seller_info_description'         => 'nullable|min:5|max:255',
      ));


      // save data to the database.
      $seller = Seller::find($id);

      // $seller->seller_commission_percentage   = $request->input('seller_commission_percentage');
      $seller->seller_item_code               = $request->input('seller_item_code');
      $seller->seller_pro_weight              = $request->input('seller_pro_weight');
      $seller->seller_category                = $request->input('seller_category');
      $seller->seller_org_price               = $request->input('seller_org_price');
      $seller->seller_sale_price              = $request->input('seller_sale_price');
      $seller->seller_website                 = $request->input('seller_website');
      $seller->seller_pro_title               = $request->input('seller_pro_title');
      $seller->seller_pro_description         = $request->input('seller_pro_description');
      $seller->seller_location                = $request->input('seller_location');
      $seller->seller_info_from               = $request->input('seller_info_from');
      $seller->seller_info_price              = $request->input('seller_info_price');
      $seller->seller_info_description        = $request->input('seller_info_description');
      $seller->seller_pro_title               = $request->input('seller_pro_title');
      $seller->seller_pro_description         = $request->input('seller_pro_description');
      $seller->seller_location                = $request->input('seller_location');



      if ($request->hasFile('seller_featured_image')) {
        //add new photo
        $image = $request->file('seller_featured_image');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $location = public_path('uploads/seller/' . $filename);
        Image::make($image)->save($location);
        $oldfilename = $seller->seller_featured_image;
        //update the database
        $seller->seller_featured_image = $filename;
        //delete the olf photo
        Storage::delete($oldfilename);
      }

      $seller->save();

      //set flash data with success message
      Session::flash('success', 'This post was successfully changed.');
      //redirect with flash data to posts.show
      return redirect()->route('seller.show', $seller->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $seller = Seller::find($id);
      Storage::delete($seller->seller_featured_image);

      $seller->delete();

      Session::flash('success', 'The seller post was sucessfully deleted.');

      return redirect()->route('seller.index');
    }
    public function storeSell(Request $request)
    { 
        $address = $request->address;
        $lat = $request->lat;
        $lng = $request->lng;
        $category = $request->selltype;
        $categoryOption = $request->service;
        $rate = $request->bidrate;
        $serviceOption = $request->serviceoption;
        $hours = $request->bidhours;
        $title = $request->sellsubject;
        $description = $request->selldetails;
        $referral = $request->referral;

        if ($request->sell_id) {
            $seller = Seller::find($request->sell_id);
        } else {
            $seller = new Seller();
        }
        //Saving Buy Image
        if ($request->hasFile('postphoto')) {
            $image = $request->file('postphoto');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('uploads/seller/' . $filename);
            // Image::make($image)->resize(640, 480)->save($location);
            compress($image,$location); 
            $seller->seller_featured_image = $filename;
        }
        $seller->user_id = auth()->user()->id;
        $seller->seller_category = $category;
        $seller->seller_sale_price = ' ';
        $seller->seller_website = ' ';
        $seller->seller_pro_title = $title;
        $seller->seller_pro_description = $description;
        $seller->seller_location = $address;
        $seller->seller_commission_percentage = $referral;
        $seller->seller_category_option = $categoryOption;
        $seller->longitude = $lng;
        $seller->latitude = $lat;
        $seller->hour = $hours;
        $seller->rate = $rate;
        $seller->service_option = $serviceOption;
        $seller->save();
        return response()->json(['status' => 'success']);
    }

    public function sellBidStore(Request $request)
    {
        $sell = Seller::find($request->id);
        if (!$request->bid_amount || $request->bid_amount == 0) {
            return response()->json(['status' => 'fail', 'message' => "Amount not found"]);
        }
        if (!$sell) {
            return response()->json(['status' => 'fail', 'message' => "Sell not found"]);
        }
        $preBid = $sell->bids()->where('user_id', auth()->id())->first();
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

        $bid->bid_type = 'sell';
        $bid->user_id = auth()->id();
        $bid->reference_id = $sell->id;
        $bid->amount = $request->bid_amount;
        $bid->reference_email = $request->email;
        $bid->save();

        return response()->json(['status' => 'success', 'message' => "Bid successful"]);
    }

    public function sellBidget(Request $request)
    {
        $buy = Seller::where(['id' => $request->id])->first();
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
                    $actionButtons = "<button data-id='" . $bid->id . "' class='sellplace-order'>Order<button/><button data-type='buyer' data-id='" . $bid->id . "' class='normal-dispute'>Dispute<button/>";
                } else if ($bid->status == 'ordered') {
                    $actionButtons = "<button data-type='buyer' data-id='" . $bid->id . "' class='normal-dispute'>Dispute<button/>";
                } else if ($bid->status == 'in_process') {
                    $actionButtons = "<button data-type='buyer' data-id='" . $bid->id . "' class='normal-dispute'>Dispute<button/>";
                } else if ($bid->status == 'delivered') {
                    $actionButtons = "<button data-user-id='" . $bid->user_id . "' data-id='" . $bid->id . "' class='sell-place-received'>Received<button/><button data-type='buyer' data-id='" . $bid->id . "' class='normal-dispute'>Dispute<button/>";
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
        $requireBalance = $bid->amount;
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
        $data3['amount']      = $requireBalance;
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


        //$buyer=$bid::seller();
        // $buyer=DB::table('sellers')
        //         ->where('id',$bid->reference_id)
        //         ->first();
        $buyer = Seller::where(['id' => $bid->reference_id])->first();
       
        $comAmount = $bid->amount * $buyer->seller_commission_percentage/100;
        $sellerAmount=$bid->amount - $comAmount;
        $refAmount=$bid->amount*$buyer->seller_commission_percentage/100;
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
        $data5['amount']      = $hi5Amount+$bidderAmount+$refereeAmount+$sellerAmount;
        $data5['transfer_to_user_id'] = $escrow->id;
        $data5['transaction_id']= $transaction_id;
        $data5['transaction_by'] = $system->id;
        $data5['posted_by'] = $escrow->id;
        Balance::insert($data5);


        $bid->status = 'paid';
        $bid->save();
        return response()->json(['status' => 'success',]);
    }
    public function getPostCategory(request $request)
    {
        
          $postCat = DB::table('post_categories')->where('category' ,$request->category)->where('main_category',$request->main_cat)->get();

          $count = 1;
          $html = '<h5 style="font-weight: bold;">I want to '.$request->main_cat.' a '.$request->category.' for </h5><select class="form-control col-md-6 sellservice" id="service_id" name="sell_product">';
          foreach($postCat as $cat)
          {
              $html .= '<option value="'.$cat->post.'">'.$cat->post.'</option>';
              $count++;
          }
          $html .= '</select>';

          echo $html;
    }
    public function deleteSell(Request $request)
    {
        $id = $request->sellId;
        $buy = Seller::find($id);
        if (!$buy) {
            return response()->json(['status' => 'fail', 'message' => "Sell not found"]);
        }
        $buy->delete();
        return response()->json(['status' => 'success', 'message' => 'Deleted successfully']);

    }
}
