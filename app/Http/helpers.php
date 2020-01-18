<?php

use App\Balance as Balance;
use App\SavedPost as SavedPost;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\HelperClass;
use App\Chatroom;
use App\User;
use App\Message;
use App\Events\ChatEvent;
use App\Events\Messagesent;
use Illuminate\Http\Request;
use App\Advertisement;
function isFollowing($userId, $followableId)
{
    $followStatus = false;
    $isFollowing = (new \App\Follow())->where('user_id', $userId)->where('followable_id', $followableId)->first();
    if ($isFollowing) {
        if ($isFollowing->status == 1) {
            $followStatus = true;
        }
    }

    return $followStatus;

}

function userReview($userId, $reviewable_id, $bidId = null)
{
    $reviewNumber = 0;
    if ($bidId) {
        $isReviewExist = (new \App\Review())->where('user_id', $userId)->where('reviewable_id', $reviewable_id)->where('bid_id', $bidId)->first();
    } else {
        $isReviewExist = (new \App\Review())->where('user_id', $userId)->where('reviewable_id', $reviewable_id)->first();
    }
    if ($isReviewExist) {
        $reviewNumber = $isReviewExist->review_number;
    }

    return $reviewNumber;
}

function averageReview($userId)
{

    $averageReview = (new \App\Review())->where('reviewable_id', $userId)->avg('review_number');

    return number_format($averageReview, 1);
}

function totalReview($userId)
{


    $totalReview = (new \App\Review())->where('reviewable_id', $userId)->count();

    return $totalReview;
}

function isEventFavorited($eventId)
{
    $event = \App\Event::find($eventId);


    return $event->isFavorited();
}

function getPostBidOrders($buyer, $type = 'buy')
{
    $orders = \App\PostBid::where(['reference_id' => $buyer->id, 'bid_type' => $type])->where('status', '!=', 'pending')->count();
    return $orders;
}

function getPostTotalBids($buyer, $type = 'buy')
{
    $orders = \App\PostBid::where(['reference_id' => $buyer->id, 'bid_type' => $type])->count();
    return $orders;
}

function bidAmountIfAlreadyBid($buyer, $type = 'buy')
{
    $amount = '';
    if (auth()->check()) {
        $bid = $buyer->bids()->where('user_id', auth()->id())->first();
        if ($bid) $amount = $bid->amount;
    }
    return $amount;
}

function isSavedPost($post_id, $type, $user_id)
{
    $checkExist = SavedPost::where('user_id', '=', $user_id)->where('post_id', '=', $post_id)->where('post_type', '=', $type)->first();
    if ($checkExist)
        return true;
    else
        return false;
}

function getCurrentRate($buyer, $type = 'buy')
{
    $bids = $buyer->bids;
    if ($bids->isNotEmpty()) {
        return $bids->min('amount');
    }
    return $buyer->rate;

}
function getSellCurrentRate($seller, $type = 'sell')
{
    $bids = $seller->bids;
    if ($bids->isNotEmpty()) {
        return $bids->min('amount');
    }
    return $seller->rate;

}
function calculateTotalAvailableBalance($id)
    {
        $credit_sum = 0;
        $debit_sum  = 0;
        $transactions    =  Balance::where('user_id','=',$id)->orderBy('id', 'DESC')->get()->toArray();

        foreach($transactions as $key=>$value)
        {
            if($value['type'] == 'cr'){
                $credit_sum += $value['amount'];
            }
            else if($value['type'] == 'db'){
                if($value['withdraw']==""){
                    $debit_sum  += $value['amount'];
                }
                else{
                    $debit_sum  += $value['withdraw'];
                }
            }

        }
        $total_balance_remained  =  $credit_sum - $debit_sum;
        return $total_balance_remained;
    }
function getSellPostTotalBids($seller, $type = 'sell')
{
    $orders = \App\PostBid::where(['reference_id' => $seller->id, 'bid_type' => 'sell'])->count();
    return $orders;
}
function getSellPostBidOrders($seller, $type = 'sell')
{
    $orders = \App\PostBid::where(['reference_id' => $seller->id, 'bid_type' => 'sell'])->where('status', '!=', 'pending')->count();
    return $orders;
}
function getLocationInfoWithIpAddress(){    
    $ipAddress = file_get_contents('https://bot.whatismyipaddress.com');
    $res = file_get_contents('https://www.iplocate.io/api/lookup/'.$ipAddress);
    return json_decode($res);
}
function getMoreMenuOptionActive($id){
    return DB::table('user_menu')->where('user_id',$id)->where('menu_options_id',58)->get()->count();
}
function compress($source, $destination) {

        $imageInfo =  getimagesize($source);
        if ($imageInfo) {
            $w = $imageInfo[0];
            $h = $imageInfo[1];
        }
        $settings = HelperClass::getSettings();
        if ($settings->file_size) {
            $fileSize = $settings->file_size;
        }else{
            $fileSize = '20000';
        }
        $file_s = filesize($source) / 1024;
        $q = floatval($fileSize) / floatval($file_s);
        // dd($imageInfo);
        if ($file_s <= $fileSize) {
            
            Image::make($source)->resize($w , $h)->save($destination);
        } else {
            
            if (($w*  0.10) > 10 && ($h * 0.10)  > 10 && ($w * 0.10) < $w && ($h * 0.10 ) < $h) {
                $q = (($q * 10) < 1) ? $q * 10 : $q ;
                Image::make($source)->resize($w * 0.10  , $h * 0.10)->save($destination);
                // sleep(3);
                compress($destination, $destination);
            }  
        }
		return $destination;
	}

function aa($array){
    echo '<pre>';
    print_r($array);
    echo '</pre>';
    die;
}

function sendEmail($email,$msg,$subject) {
    $data = [];
    $data['msg'] = $msg;
    Mail::send('email.mail', $data, function($message) use($email,$subject){
         $message->to($email)->subject($subject);
         $message->from($email,'Hi5 Team');
    });
}



function store($id,$amount,$msg=null,$sendID=null,$receivID=null) {
    
    $roomId = Chatroom::where('chatRoomId', $id)->first();
    if(empty($roomId)){
        $chat = new Chatroom;
        $chat->chatRoomId = $id;
        $chat->save();
        $roomId = Chatroom::where('id', $chat->id)->first();
    }

        //$senderId = auth()->user()->id;
        $original = 0;
        if($sendID == '') {
            $senderId = 53;
        } else {
            $senderId = $sendID;
        }
        if($receivID == '') {
            $receiver = auth()->user()->id;
        } else {
            $receiver = $receivID;
        }
        
        $message = new Message;
        $message->roomId = $roomId->id;
        $message->sender = $senderId;
        $message->receiver = $receiver;
        $message->readWriteStatus = 0;
        $message->original_sender = $original;
        $sender_user = User::where('id', $senderId)->first();
        $image = $sender_user->avatar;
        $user = $sender_user->name;

        $message->activationStatus = 1;
        
        if($msg == '') {
            $message->message = "you have a withdraw request of amount $.".$amount."";
        } else {
            $message->message = $msg;
        }
    
        $message->selftime = date("d-m-Y h:i:s");
        $message->UTC = -330;
        
        $message->save();
        $wasactive = 'true';
        event(new ChatEvent($message, $roomId->id, $image, $user));
        event(new Messagesent($receiver, $senderId, $message->id));
}

function updateBalance($amount,$id) {

    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    $data = array('user_id'=>$id,
                  'description'=>"Deposit",
                  'type'=>"cr",
                  'amount'=>$amount,
                  'created_at'=>date("Y-m-d h:i:s"),
                  'updated_at'=>date("Y-m-d h:i:s"),
                  'details'=>"Deposit",
                  'datwise'=>date("Y-m-d"),
                  'transaction_id'=>generateUniqueString($permitted_chars, 16),
                  'posted_by'=>$id,
                  'transaction_by'=>$id
                  );
    $query = Balance::insert($data);
    if($query ==  true) {
        return "true";
    } else {
        return "false";
    }
}

function generateUniqueString($input, $strength = 16) {
    $input_length = strlen($input);
    $random_string = '';
    for($i = 0; $i < $strength; $i++) {
        $random_character = $input[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }

    return $random_string;
}

function getAdvertisement()
{
    $Advertisement['top'] = Advertisement::where(['position' => 'top', 'style' =>  'scroll'])->get();
    // dd($Advertisement);
}
?>