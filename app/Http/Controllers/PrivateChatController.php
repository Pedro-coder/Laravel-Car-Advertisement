<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\unreadchatmessage;
use App\Chatroom;
use Session;
use App\User;
use App\Message;
use App\Events\ChatEvent;
use App\Events\Messagesent;

class PrivateChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function rtnChatBox($id,$user_id,$helpDeskUser)
    {
        $roomId = Chatroom::where('chatRoomId', $id)->first();
        if(empty($roomId)){
            $chat = new Chatroom;
            $chat->chatRoomId = $id;
            $chat->save();
            $roomId = Chatroom::where('chatRoomId', $id)->first();
        }
        
        $HelpDeskCheck = $roomId;

        $roomId = $roomId->id;

        $message = Message::where('roomId', $roomId)->get();
        $arr = explode(',', $id);
        $senderid = Auth::id();
        if(!in_array($senderid, $arr)){
            $senderid = 55;
            $original = Auth::id();
            $receiver = $arr[0];
        } else {
            for ($i = 0; $i < sizeof($arr); $i++) {
                if ($arr[$i] != Auth::id()) {
                    $receiver = $arr[$i];
                } else{
                    $senderid = 55;
                    $receiver = $arr[$i];
                }
            }
        }
        // if(in_array(Auth::id(), $arr)){
        //     $senderid = Auth::id();
        //     $original_sender = 0;
        // }
        // else{
        //     $senderid = 55;   
        //     $original_sender = Auth::id();
        // }
        // if(!in_array($senderid, $arr)){
        //     $senderid = 54;
        // }
        //$userob = User::find($senderid);
        $receivers = $this->receivers($senderid);
        

        // for ($i = 0; $i < sizeof($arr); $i++) {
        //     if ($arr[$i] != $senderid)
        //         $receiver = $arr[$i];

        // }
        // $requestmaker=Auth::user()->id;
        // event(new OnlineEvent($userob,$roomId));

        return view('chats.chatBox')->with('messages', $message)
            ->with('receiverid', $receiver)
            ->with('chatroomUser', $id)
            ->with('receivers', $receivers)
            ->with('requestmaker', $senderid)
            ->with('roomId', $roomId)
            ->with('helpDeskUser', $helpDeskUser)
            ->with('HelpDeskCheck',$HelpDeskCheck);
    }
    public function receivers($id)
    {
        $receiver = array();
        $chatroom = Chatroom::where('chatRoomId', 'Like', '%' . $id . '%')->orderBy('updated_at')->get();
        /*$message = Message::where('chatRoomId','Like','%'.$id.'%')->first();
        dd($message);*/

        foreach ($chatroom as $chat) {
            $arr = explode(',', $chat->chatRoomId);
            
            if ($arr[0] == $id) {
                array_push($receiver, User::find($arr[1]));
            } elseif ($arr[1] == $id) {
                array_push($receiver, User::find($arr[0]));
            } else {
                continue;
            }
        }
        return $receiver;
    }
    public function store(Request $request,$id,$helpDeskUser)
    {

        $senderId = auth()->user()->id;
        $original = 0;
        $chatroom = Chatroom::where('id', $id)->first();

        $chatRoomId = $chatroom->chatRoomId;
        
        $arr = explode(',', $chatRoomId);
        
        if(!in_array($senderId, $arr)){
            $senderId = 55;
            $original = Auth::id();
            $receiver = $arr[0];
        } else {
            for ($i = 0; $i < sizeof($arr); $i++) {
                if ($arr[$i] != Auth::user()->id) {
                    $receiver = $arr[$i];
                }
            }
        }
        if($helpDeskUser == 1){
            $senderId = 55;
            $original = Auth::id();
            $receiver = 55;
        }
        $message = new Message;
        $message->roomId = $chatroom->id;
        $message->sender = $senderId;
        $message->receiver = $receiver;
        $message->readWriteStatus = 0;
        $message->original_sender = $original;
        $sender_user = User::where('id', $senderId)->first();
        $original_user_id = '';
        $original_user_name = '';
        $original_user_avatar = '';
        if($message->original_sender > 0) {
            $original_user_data = User::where('id',  $message->original_sender)->first();
            $original_user_id = $original_user_data->id;
            $original_user_name = $original_user_data->name;
            $original_user_avatar = $original_user_data->avatar;
        }
        $image = $sender_user->avatar;
        $user = $sender_user->name;

        $message->activationStatus = 1;
        $message->message = $request->message;
        $message->selftime = $request->time;
        $message->UTC = $request->utc;

        $message->save();
        $wasactive = 'true';
        event(new ChatEvent($message, $chatroom->id, $image, $user));
        event(new Messagesent($receiver, $senderId, $message->id));
        return [
            'id' => $message->id,
            'image' => $image,
            'wasactive' => $wasactive,
            'original_user_id' =>  $original_user_id,
            'original_user_name' => $original_user_name,
            'original_user_avatar' => $original_user_avatar
        ];
    }
    public function timeformate(Request $request)
    {
        $unformatted = $request->untime;
        $unformatted = explode('   ', $unformatted);
        $time = explode(':', $unformatted[0]);
        $date = explode('/', $unformatted[1]);
        $month = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

        $m = $date[1];
        $m = $month[$m];
        $d = $date[0];
        $s = $time[2];
        $min = $time[1];
        $h = $time[0];
        $datestring = $m . ' ' . $d . ',' . ' ' . $h . ':' . $min;
        return ['time' => $datestring, ];

    }
    public function setuserlocalutc(Request $request)
    {
        $user = auth()->user()->id;
        $user = User::find($user);
        $user->utc = $request->utcdiff;
        $user->save();
       // return ['utc'=>$request->utcdiff];
    }
    public function getlogedinusertime(Request $request)
    {
        $roomId = $request->roomid;
        $chatroom = Chatroom::where('id', $roomId)->first();
        $chatRoomId = $chatroom->chatRoomId;

        $arr = explode(',', $chatRoomId);
        $senderId = Auth::user()->id;
        $otheruser;

        if ($arr[0] == $senderId) {
            $otheruser = $arr[1];
        } else {
            $otheruser = $arr[0];
        }
//return $otheruser;
        $otheruser = User::find($otheruser);
        $otheruserutc = $otheruser->utc;
        if ($otheruserutc == null) {
            return 'didnt with ' . $otheruser->name . ' before';
        }
        $arr = gmdate('h:i:s');

        $arr = explode(':', $arr);

        $otheruserutc = (-1) * ($otheruserutc);
        $mm = ($arr[0] * 60) + $arr[1];
        $m = $mm + $otheruserutc;
       // return $mm;
        if ($mm < 0) {
            $m = 1440 - $m;
        }
        if ($mm > 1440) {
            $m = 0 + ($mm - 1440);
        }


        $h = (int)($m / 60);
        $m = $m % 60;
        $s = $arr[2];
        return $h . ':' . $m . ':' . $s;


    }
    public function sendemailforunread()
    {
        return view('chats.sendemail');
    }
    public function sendmail(Request $request)
    {
        // Mail::to('hasan@gmail.com')->send(new unreadchatmessage());
        // exit();
        $allunreadmessage = Message::where('readWriteStatus', 0)
            ->orderBy('sender', 'DESC')->get();
        $messagearray = array();
        $allmailreceiver = array();
        for ($i = 0; $i < sizeof($allunreadmessage); $i++) {
            if ($i == 0) {
                $receivertem = $allunreadmessage[$i]->receiver;
                array_push($messagearray, $allunreadmessage[$i]);
                continue;
            }
            if ($allunreadmessage[$i]->receiver != $receivertem) {
                array_push($messagearray, $allunreadmessage[$i]);
                $receivertem = $allunreadmessage[$i]->receiver;
            } else {
                $receivertem = $allunreadmessage[$i]->receiver;
            }

        }
        $allmail = array();
      //  $allmail=['saleh.matul@gmail.com', 'shamsulhasansiam@gmail.com'];
       // Mail::to($allmail)->send(new unreadchatmessage());


        $j = 0;
        for ($i = 0; $i < sizeof($messagearray); $i++) {
            $user = User::find($messagearray[$i]->receiver);
            $useremail = $user->email;
            array_push($allmail, $user->email);
            if ($j == 0)
                $j = 1;
            else
                $j = 0;

            Mail::to($useremail)->send(new unreadchatmessage($messagearray[$i]));

        }
       // return $allmail;   
        // Mail::to($allmail)->send(new unreadchatmessage());
        Session::put('sendemail', 'All the emails are send to the corresponding users');
        return redirect()->back();


    }
    public function test()
    {
      //  echo gmdate('h:i:s');
        $arr = gmdate('h:i:s');
        $arr = explode(':', $arr);
       // print_r($arr);
        $r = 24 * 60;
        echo $r;
    }

}
