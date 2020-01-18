<?php

namespace App\Http\Controllers;

use App\Bid;
use App\Blog;
use Illuminate\Http\Request;
use App\Buyer;
use App\Seller;
use App\Article;
use App\Event;
use App\EventModal;
use App\HomePageSetup;
use App\SavedPost;
use App\Balance;
use App\EventVisitors;
use Auth;
use App\User;
use App\Taxi;
use App\ReferralPost;
use Illuminate\Support\Facades\DB;
use Nexmo\Response;
use App\Setting;
use App\Chatroom;

class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {


        $user = Auth::user();

        $checkPage = HomePageSetup::where('user_id', $user->id)->first();

        if ($checkPage) {
//echo $checkPage->homepage_link;exit;
            return redirect()->to($checkPage->homepage_link);
        }
        $allBuyers = Buyer::all();
        $newArray = [];
        foreach ($allBuyers as $buyer) {
            $newArray[$buyer->id] = ['created_at' => $buyer->created_at, 'hours' => $buyer->hour];
        }
        $id = $request->user()->id;
        $user = User::find($id);
        $user->onlineStatus = 1;
        $user->save();
        $buyers = Buyer::orderBy('id', 'desc')->where(function($q) {
                    $q->where(DB::raw("DATE_ADD(created_at,INTERVAL hour HOUR)"), '>', now());
                })->paginate(10);
        //$sellers = Seller::orderBy('id', 'desc')->paginate(10);
        $sellers = Seller::orderBy('id', 'desc')->where(function($q) {
                    $q->where(DB::raw("DATE_ADD(created_at,INTERVAL hour HOUR)"), '>', now());
                })->paginate(10);
        $articles = Article::orderBy('id', 'desc')->paginate(10);
        //get all published events 
        $events = Event::where('is_published', '=', 'yes')->orderBy('id', 'desc')->get();
        $posts = Blog::latest()->paginate(5);
       $setting = Setting::first();
       $homeList = true;
        return view('home')
                        ->withHomeList($homeList)
                        ->withBuyers($buyers)
                        ->withSellers($sellers)
                        ->withArticles($articles)
                        ->withEvents($events)
                        ->withPosts($posts)
                        ->withSetting($setting)
                        ->withId($id);
    }

    public function timeline(Request $request, $id = 0) {
        $user = Auth::user();
        $checkPage = HomePageSetup::where('user_id', $user->id)->first();
        if ($checkPage) {
            return redirect()->to($checkPage->homepage_link);
        }
        $allBuyers = Buyer::all();
        $newArray = [];
        foreach ($allBuyers as $buyer) {
            $newArray[$buyer->id] = ['created_at' => $buyer->created_at, 'hours' => $buyer->hour];
        }

        $flag = false;

        if ($id > 0) {
            $view = 'pages.profile.other_user_timeline';
            $flag = true;
        } else {
            $id = $request->user()->id;
            $view = 'pages.profile.timeline';
        }

        $senderId = Auth::user()->id;
        $chatRoomId = null;

        $receiverId = $user->id;

        if ($senderId > $receiverId) {
            $chatRoomId = $receiverId . ',' . $senderId;
        } else {
            $chatRoomId = $senderId . ',' . $receiverId;
        }
        $chatroom = Chatroom::where('chatRoomId', $chatRoomId)->first();
        if (empty($chatroom)) {
            $chatroom = new Chatroom;
            $chatroom->chatRoomId = $chatRoomId;
            $chatroom->save();
        }
        $chatRoute = route('privateChat', $chatRoomId);

        $buyers = Buyer::orderBy('id', 'desc')->where(function($q) {
                    $q->where(DB::raw("DATE_ADD(created_at,INTERVAL hour HOUR)"), '>', now());
                })->where('user_id', $id)->paginate(10);

        $sellers = Seller::orderBy('id', 'desc')->where(function($q) {
                    $q->where(DB::raw("DATE_ADD(created_at,INTERVAL hour HOUR)"), '>', now());
                })->where('user_id', $id)->paginate(10);

        $articles = Article::orderBy('id', 'desc')
                        ->where('user_id', $id)->paginate(10);

        $events = Event::where('is_published', '=', 'yes')
                        ->where('user_id', $id)->orderBy('id', 'desc')->get();

        $posts = Blog::latest()
                        ->where('user_id', $id)->paginate(5);

        return view($view)
                        ->withBuyers($buyers)
                        ->withSellers($sellers)
                        ->withArticles($articles)
                        ->withEvents($events)
                        ->withPosts($posts)
                        ->withId($id)
                        ->withUser($flag ? User::find($id) : '')
                        ->withChatRoute($chatRoute);
    }

    public function filter(Request $request) {
        $keywords = $request->get('input_search');
        $type = $request->get('post_for');
        $sort = $request->get('sort');
        $min = $request->get('min');
        $max = $request->get('max');
        $user = $request->get('user');
        $online = $request->get('online');
        $mypost = $request->get('mypost');
        $lat = $request->get('lat');
        $lng = $request->get('lng');
        $miles = $request->get('miles');
        $result = array();
        $result_type = 0;
        if ($type == "posts" or $type == "0") {
            $result_type = 0;
            $query = Blog::with('user')->leftJoin('users', "blog_posts.user_id", "=", "users.id");


            if ($user != null) {

                $query->where('user_id', "=", intval($user));
            }
            if ($online != null) {
                $query
                        ->where("users.onlineStatus", "=", 1)
                ;
            }
            if ($lat != null) {
//                $lat = 41.31;
//                $lng = -72.92;
                $query->whereRaw("
                       ST_Distance(
                            point(users.lng, users.alt),
                            point(?, ?)
                        ) * .000621371192 < ?
                    ", [
                    $lng,
                    $lat,
                    $miles
                ]);
            }
            if ($mypost) {
                $query->where('user_id', "=", Auth()->user()->id);
            }
//            if(floatval($max)> 0){
//                $query->where('read_amount', "=<" , $max);
//            }
//
            if ($keywords != null) {
                $query->where('content', 'LIKE', '%' . $keywords . '%')
                        ->orWhere('heading', 'LIKE', '%' . $keywords . '%');
            }

            if ($sort == "oldest") {
                $query->orderBy("blog_posts.created_at", "asc");
            } elseif ($sort == "newest") {
                $query->orderBy("blog_posts.created_at", "desc");
            } elseif ($sort == "high") {
                $query->orderBy("blog_posts.read_amount", "desc");
            } else {
                $query->orderBy("blog_posts.read_amount", "asc");
            }

            $blogPosts = $query
                    ->select([
                        'blog_posts.*',
                        'users.name',
                        'users.email'
                    ])
                    ->get();
            foreach ($blogPosts as $post) {
                $btn = null;
                if ($post->read_amount == 0) {
                    $btn = '<a href="/blod-details/' . $post->id . '" class="btn btn-primary">Details</a>';
                } else {
                    $btn = '<button type="button" onclick="showMsg(' . "'" . $post->heading . "'" . ',' . $post->read_amount . ',' . $post->user_id . ',' . $post->id . ')" class="btn btn-primary">Details</button>';
                }
                $p = [
                    "post_id" => $post->id,
                    'btn' => $btn,
                    'url' => '/blod-details/' . $post->id,
                    "user_name" => $post->user->name,
                    "user_pic" => $post->user->avatar,
                    "user_id" => $post->user_id,
                    "heading" => $post->heading,
                    "image" => "/blog/" . $post->image,
                    'created_at' => $post->created_at,
                    "amount" => $post->read_amount
                ];
                if (floatval($min) > 0 and $max == null) {
                    if ($post->read_amount > floatval($min))
                        array_push($result, $p);
                }elseif (floatval($max) > 0 and $min == null) {
                    if ($post->read_amount < floatval($max))
                        array_push($result, $p);
                }elseif (floatval($min) > 0 and floatval($max) > 0) {
                    if ($post->read_amount < floatval($max) and $post->read_amount > floatval($min)) {
                        array_push($result, $p);
                    }
                } else {
                    array_push($result, $p);
                }
            }
        }

        if ($type == "bids" or $type == "0") {
            $result_type = 0;
            $query = Bid::with('user', 'product')
                    ->leftJoin('users', "bids.user_id", "=", "users.id")
                    ->leftJoin('products', "bids.product_id", "=", "products.id");

            if ($user != null) {

                $query->where('user_id', "=", intval($user));
            }
            if ($online != null) {
                $query
                        ->where("users.onlineStatus", "=", 1)
                ;
            }
            if ($lat != null) {
//                $lat = 41.31;
//                $lng = -72.92;
                $query->whereRaw("
                       ST_Distance(
                            point(users.lng, users.alt),
                            point(?, ?)
                        ) * .000621371192 < ?
                    ", [
                    $lng,
                    $lat,
                    $miles
                ]);
            }
            if ($mypost) {
                $query->where('user_id', "=", Auth()->user()->id);
            }
            if ($keywords != null) {
                $query
                        ->where('description', 'LIKE', '%' . $keywords . '%')
                        ->orWhere('address', 'LIKE', '%' . $keywords . '%')
                        ->orWhere('phone', 'LIKE', '%' . $keywords . '%')
                        ->orWhere('country', 'LIKE', '%' . $keywords . '%')
                        ->orWhere('city', 'LIKE', '%' . $keywords . '%')
                        ->orWhere('products.name', 'LIKE', '%' . $keywords . '%');
            }
            if ($sort == "oldest") {
                $query->orderBy("bids.created_at", "asc");
            } elseif ($sort == "newest") {
                $query->orderBy("bids.created_at", "desc");
            } elseif ($sort == "high") {
                $query->orderBy("bids.current_bid", "desc");
            } else {
                $query->orderBy("bids.current_bid", "asc");
            }

            $bids = $query->get();
            foreach ($bids as $bid) {
                $btn = '<a href="/bids/buyers" class="btn btn-primary">Details</a>';
                $p = [
                    "post_id" => $bid->id,
                    'btn' => $btn,
                    'url' => '/bids/buyers',
                    "user_name" => $bid->user->name,
                    "user_pic" => $bid->user->avatar,
                    "user_id" => $bid->user_id,
                    "heading" => $bid->product->name,
                    "image" => "/buyer/" . $bid->product->image,
                    'created_at' => $bid->created_at,
                    "amount" => $bid->current_bid
                ];

                if (floatval($min) >= 0 and $max == null) {
                    if ($bid->current_bid >= floatval($min))
                        array_push($result, $p);
                }elseif (floatval($max) >= 0 and $min == null) {
                    if ($bid->current_bid <= floatval($max))
                        array_push($result, $p);
                }elseif (floatval($min) >= 0 and floatval($max) >= 0) {
                    if ($bid->current_bid <= floatval($max) and $bid->current_bid >= floatval($min)) {
                        array_push($result, $p);
                    }
                }
            }
        }
        $m = $result_type;
        if ($sort == "oldest") {
            $this->array_sort_by_column($result, 'created_at');
        } elseif ($sort == "newest") {
            $this->array_sort_by_column($result, 'created_at', SORT_DESC);
        } elseif ($sort == "high") {
            $this->array_sort_by_column($result, 'amount', SORT_DESC);
        } else {
            $this->array_sort_by_column($result, 'amount');
        }


        return view('home', compact('result', $result_type));
    }

    function array_sort_by_column(&$array, $column, $direction = SORT_ASC) {
        $reference_array = array();

        foreach ($array as $key => $row) {
            $reference_array[$key] = $row[$column];
        }

        array_multisort($reference_array, $direction, $array);
    }

    //user saved event post
    public function eventModelSaved(Request $request) {
        $checkExist = SavedPost::where('user_id', '=', $request->userId)->where('post_id', '=', $request->eventId)->where('post_type', '=', 'event')->first();
        if ($checkExist == null) {
            $data = new SavedPost();
            $data->user_id = $request->userId;
            $data->post_id = $request->eventId;
            $data->post_type = 'event';
            $data->save();
            return response()->json($data);
        } else {
            //echo 'exist';
            return response()->json('exist');
        }
    }

    //user unsaved event post
    public function eventModelUnsaved(Request $request) {
        $deleteTemp = SavedPost::where('user_id', $request->userId)
                ->where('post_id', $request->eventId)
                ->where('post_type', '=', 'event')
                ->delete();
        if ($deleteTemp) {
            return response()->json('success');
        } else {
            echo 'else';
        }
    }

    //unsave post
    public function savePostUnSave(Request $request) {
        $deleteTemp = SavedPost::where('user_id', $request->user_id)
                ->where('post_id', $request->post_id)
                ->where('post_type', '=', $request->post_type)
                ->delete();
        if ($deleteTemp) {
            return response()->json('success');
        } else {
            echo 'else';
        }
    }

    //save post
    public function savePost(Request $request) {
        $checkExist = SavedPost::where('user_id', '=', $request->user_id)->where('post_id', '=', $request->post_id)->where('post_type', '=', $request->post_type)->first();
        if ($checkExist == null) {
            $data = new SavedPost();
            $data->user_id = $request->user_id;
            $data->post_id = $request->post_id;
            $data->post_type = $request->post_type;
            $data->save();
            return response()->json($data);
        } else {
            //echo 'exist';
            return response()->json('exist');
        }
    }

    //event fee pay function
    public function payToJoin($amount, $owner_id, $eventId, $modelId, $needApprove) {

        $user = \Auth::user();

        $existBalance = DB::table('balances')->where('user_id', $user->id)->where('type', 'cr')->sum('amount');
        $eventD = Event::where('id', $eventId)->first();
        $transaction_id = $this->generateUniqueString($this->permitted_chars, 16);
        if ($existBalance >= $amount) {
            if ($needApprove == 1) {
                $jStatus = 'pending';
                // $getStoreComm = User::where('email','hi5@hi5.com')->first();
                // $storId = $getStoreComm->id;
                // $data['user_id'] = $user->id;
                // $data['type'] = "db";
                // $data['description'] = $eventD->event_title." Event Fee";
                // $data['amount'] = $amount;
                // $date = date("Y-m-d");
                // $data['datwise'] = $date;
                // $withdraw = Balance::create($data);
                // $data1['user_id'] = $storId;
                // $data1['type'] = "cr";
                // $data1['description'] = $eventD->event_title." Event Fee Collected!";
                // $data1['amount'] = $amount;
                // $date = date("Y-m-d");
                // $data1['datwise'] = $date;
                // $withdraw = Balance::create($data1);
            } else {

                $getStoreComm = DB::table('users')->where('email', 'hi5@hi5.com')->get()->first();
                $storId = $getStoreComm->id;

                $getFees = DB::table('events')->where('id', $eventId)->first();
                $eventCommission = $getFees->event_fee * $getFees->event_referral_commission / 100;

                $checkReferal = DB::table('referral_post')->where('user_id', $user->id)->where('event_id', $eventId)->first();
                if ($checkReferal) {
                    $eventData = Event::where('id', $checkReferal->event_id)->first();
                    $eventFee = $eventData->event_fee;
                    $eventCommission = $eventData->event_referral_commission / 2;
                    $finalComm = $eventFee * $eventCommission / 100;
                    $adminCommission = $finalComm / 2;

                    $referelPer = $checkReferal->referral_per;
                    $data['user_id'] = $checkReferal->referred_id;
                    $data['type'] = "cr";
                    $data['description'] = "Event Refered Payment";
                    $data['amount'] = $finalComm;
                    $date = date("Y-m-d");
                    $data['datwise'] = $date;
                    $withdraw = Balance::create($data);


                    $data['user_id'] = $storId;
                    $data['type'] = "cr";
                    $data['description'] = "Event Refered Payment";
                    $data['amount'] = $adminCommission;
                    $date = date("Y-m-d");
                    $data['datwise'] = $date;
                    $withdraw = Balance::create($data);


                    $data['user_id'] = $owner_id;
                    $data['type'] = "cr";
                    $data['description'] = "Event Refered Payment";
                    $data['amount'] = $adminCommission;
                    $date = date("Y-m-d");
                    $data['datwise'] = $date;
                    $withdraw = Balance::create($data);
                } else {
                    $ownerAmount = $amount - $eventCommission;


                    $data['user_id'] = $user->id;
                    $data['type'] = "db";
                    $data['description'] = "Event Fee";
                    $data['amount'] = $ownerAmount;
                    $date = date("Y-m-d");
                    $data['datwise'] = $date;
                    $withdraw = Balance::create($data);
                    $data1['user_id'] = $owner_id;
                    $data1['type'] = "cr";
                    $data1['description'] = "Event Fee Collected!";
                    $data1['amount'] = $ownerAmount;
                    $date = date("Y-m-d");
                    $data1['datwise'] = $date;
                    $withdraw = Balance::create($data1);

                    $data['user_id'] = $user->id;
                    $data['type'] = "db";
                    $data['description'] = "Event Fee";
                    $data['amount'] = $eventCommission;
                    $date = date("Y-m-d");
                    $data['datwise'] = $date;
                    $withdraw = Balance::create($data);
                    $data1['user_id'] = $storId;
                    $data1['type'] = "cr";
                    $data1['description'] = "Event Fee Collected!";
                    $data1['amount'] = $eventCommission;
                    $date = date("Y-m-d");
                    $data1['datwise'] = $date;
                    $withdraw = Balance::create($data1);
                }




                $jStatus = 'approved';
            }
            $eventJoin = new EventVisitors();
            $eventJoin->user_id = $user->id;
            $eventJoin->owner_id = $owner_id;
            $eventJoin->event_id = $eventId;
            $eventJoin->event_modal_id = $modelId;
            $eventJoin->going_status = $jStatus;
            $eventJoin->book_tickets     = $ticketBook;
            $eventJoin->save();

            // return "Done";
            return response()->json("Done");
        } else {
            // return "exit";
            return response()->json("exit");
        }
    }

    //free join event function
    public function freeJoinToPay($owner_id, $eventId, $modelId, $needApprove) {
        if ($needApprove == 1) {
            $jStatus = 'pending';
        } else {
            $jStatus = 'approved';
        }
        $user = \Auth::user();
        $eventJoin = new EventVisitors();
        $eventJoin->user_id = $user->id;
        $eventJoin->owner_id = $owner_id;
        $eventJoin->event_id = $eventId;
        $eventJoin->event_modal_id = $modelId;
        $eventJoin->going_status = $jStatus;
        $eventJoin->save();

        return "Done";
    }

    //event cancel request
    public function cancelToJoin($userId, $eventId, $eventModelId, $amount) {

        if (empty($amount) || $amount == null) {
            $user = \Auth::user();
            $deleteEventVisitor = EventVisitors::where('user_id', $user->id)
                    ->where('event_id', $eventId)
                    ->where('event_modal_id', $eventModelId)
                    ->delete();
            if ($deleteEventVisitor) {
                return "Done";
            }
        } else {
            $getStoreComm = User::where('email', 'hi5@hi5.com')->first();
            $storId = $getStoreComm->id;

            $user = \Auth::user();
            $data['user_id'] = $user->id;
            $data['type'] = "cr";
            $data['description'] = "Event Cancel Request, Refund Payment";
            $data['amount'] = $amount;
            $date = date("Y-m-d");
            $data['datwise'] = $date;
            $withdraw = Balance::create($data);
            $data1['user_id'] = $storId;
            $data1['type'] = "db";
            $data1['description'] = "Join cancel, Return Fee";
            $data1['amount'] = $amount;
            $date = date("Y-m-d");
            $data1['datwise'] = $date;
            $withdraw = Balance::create($data1);

            $deleteEventVisitor = EventVisitors::where('user_id', $user->id)
                    ->where('event_id', $eventId)
                    ->where('event_modal_id', $eventModelId)
                    ->delete();
            if ($deleteEventVisitor) {
                return "Done";
            }
        }
    }

    public function insertReferral($owner_id, $eventId, $referralEmail) {
        if ($referralEmail != 0 || !empty($referralEmail)) {
            $user = \Auth::user();
            $userData = User::where('email', $referralEmail)->first();
            $reffedId = $userData->id;
            $userId = $user->id;
            $checkExist = ReferralPost::where('event_id', $eventId)->where('user_id', $userId)->first();
            if (!empty($checkExist)) {
                $referral = ReferralPost::find($checkExist->id);
                $referral->user_id = $userId;
                $referral->referred_id = $reffedId;
                $referral->event_id = $eventId;
                $referral->save();
            } else {
                ReferralPost::create([
                    'user_id' => $userId,
                    'referred_id' => $reffedId,
                    'event_id' => $eventId,
                    'post_type' => 'event',
                ]);
            }
        }
        return response()->json("Done");
    }

    public function generateUniqueString($input, $strength = 16) {
        $input_length = strlen($input);
        $random_string = '';
        for ($i = 0; $i < $strength; $i++) {
            $random_character = $input[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }

        return $random_string;
    }
     public function displayCategory(Request $request)
    {
        if($request->category == 'Buy')
        {
             $postCat = DB::table('post_categories')->where('main_category',$request->category)->groupBy('category')->get();

          $count = 1;
          $html = '<select class="form-control col-md-6 iwantbuy" id="iwantbuy" name="iwantbuy">';
          foreach($postCat as $cat)
          {
              $html .= '<option value="'.$cat->category.'">'.$cat->category.'</option>';
              $count++;
          }
          $html .= '</select>';

          echo $html;
        }
        if($request->category == 'Sell')
        {
             $postCat = DB::table('post_categories')->where('main_category',$request->category)->groupBy('category')->get();

          $count = 1;
          $html = '<select class="form-control col-md-6 iwantsell" id="iwantsell" name="iwantsell">';
          foreach($postCat as $cat)
          {
              $html .= '<option value="'.$cat->category.'">'.$cat->category.'</option>';
              $count++;
          }
          $html .= '</select>';

          echo $html;
        }
        if($request->category == 'Blog')
        {
             $postCat = DB::table('post_categories')->where('main_category',$request->category)->get();

          $count = 1;
          $html = '<h5 style="font-weight: bold;">I want to do a blog post for </h5><select class="form-control col-md-6" id="blog_post_category" name="blog_post_category">';
          foreach($postCat as $cat)
          {
              $html .= '<option value="'.$cat->post.'">'.$cat->post.'</option>';
              $count++;
          }
          $html .= '</select>';

          echo $html;
        }
        if($request->category == 'Event')
        {
             $postCat = DB::table('post_categories')->where('main_category',$request->category)->get();

          $count = 1;
          $html = '<h5 style="font-weight: bold;">I want to do a event post for </h5><select class="form-control col-md-6" id="post_category" name="post_category">';
          foreach($postCat as $cat)
          {
              $html .= '<option value="'.$cat->post.'">'.$cat->post.'</option>';
              $count++;
          }
          $html .= '</select>';

          echo $html;
        }
    } 

}
