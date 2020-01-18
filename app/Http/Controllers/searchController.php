<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Auth;
use App\User;
use App\Chatroom;
use App\Message;
use App\Level;

class searchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function search(Request $request)

    {
        $senderId = Auth::user()->id;
        $chatRoomId;

        if ($request->ajax()) {

            $output = "";

            $users = DB::table('users')->where('name', 'LIKE', '%' . $request->search . "%")->get();
            $userscont = DB::table('users')->where('name', 'LIKE', '%' . $request->search . "%")->count();
            //return $users;

            if ($userscont == 0) {
                $users = DB::table('users')->where('email', 'LIKE', '%' . $request->search . "%")->get();
            }
            if ($request->search == '') {
                $output = "";
                return Response($output);
            }

            if ($users) {

                foreach ($users as $key => $user) {
                    $receiverId = $user->id;
                    if ($senderId == $receiverId) {
                        continue;
                    }
                    if ($senderId > $receiverId) {
                        $chatRoomId = $receiverId . ',' . $senderId;
                    } else {
                        $chatRoomId = $senderId . ',' . $receiverId;

                    }
                    $chatroom = Chatroom::where('chatRoomId', $chatRoomId)->first();
                    if (is_null($chatroom)) {
                        $chatroom = new Chatroom;
                        $chatroom->chatRoomId = $chatRoomId;
                        $chatroom->save();

                    }
                    $user_id = Auth::user()->id;
                    $helpDeskUser = 0;
                    $chatRoomId = route('privateChat', ['chatRoomId'=>$chatRoomId,'user_id'=>$user_id,'helpDeskUser'=>$helpDeskUser]);
                    // echo $user->avatar;die;
                    
                    if(file_exists(public_path('/uploads/avatars/').$user->avatar)){
                        $src = url('/uploads/avatars/' . $user->avatar);
                    } else {
                        $src = url('/uploads/avatars/defaultpic.jpg');
                    }

                    $output .= '<tr>' .

                        '<td>' . '<a class="alink " href="' . $chatRoomId . ' ">' . '<img  src="' . $src . '" height="30px" width="30px" style="border-radius:50%;float:left">' . '<h1 class="chtbxusername" style="display:inline;font-size:.80rem;">' . $user->name . '</h1>' . '</a>' . '</td>' .


                        '</tr>';


                }
                $output = '<div style="overflow-y:scroll">' . '<i id="crossbutton" onClick="closeall()" class="fas fa-times" >' . '</i>' . $output . '</div>';
                return Response($output);

            }


        }

    }

    /* add by mirza_47 */
    public function agentSearch(Request $request)

    {
        $output = '';
        $users = array();
        $chatroom = Chatroom::where('chatRoomId', 'Like', '%' . 55 . '%')->get();
        //aa($chatroom);
       // print_r($chatroom);
        foreach ($chatroom as $chat) {
            
            $arr = explode(',', $chat->chatRoomId);
           
            if($arr[0] == 55){ 
                $u = User::find($arr[1]);
                $u->chat_room_id = $chat->chatRoomId;
                array_push($users, $u);
                
            }
            elseif($arr[1] == 55){
                $u = User::find($arr[0]);
                $u->chat_room_id = $chat->chatRoomId;
                array_push($users, $u);
                
            }
        
        }
        
                $rels = array();
                if (trim($request->search) != '') {
                    foreach ($users as $key => $value) {
                        if (strstr( $value->name, $request->search )) {
                            array_push($rels, $value);
                         } 
                    }
                } else {
                    $rels = $users;
                }
                
                
        
                if ($rels) {

                foreach ($rels as $key => $user) {

                    if(file_exists(public_path('/uploads/avatars/').$user->avatar)){
                        $src = url('/uploads/avatars/' . $user->avatar);
                    } else {
                        $src = url('/uploads/avatars/defaultpic.jpg');
                    }
                    $user_id = Auth::user()->id;
                    $helpDeskUser = 55;
                    $output .= '<tr>' .

                        '<td>' . '<a class="alink " href="' . url('privateChat/'.$user->chat_room_id.'/'.$user_id.'/'.$helpDeskUser) . ' ">' . '<img  src="' . $src . '" height="30px" width="30px" style="border-radius:50%;float:left">' . '<h1 class="chtbxusername" style="display:inline;font-size:.80rem;">' . $user->name . '</h1>' . '</a>' . '</td>' .


                        '</tr>';


                }
                $output = '<div style="overflow-y:scroll">' . '<i id="crossbutton" onClick="closeall()" class="fas fa-times" >' . '</i>' . $output . '</div>';
                return Response($output);

            } else {
                return Response($output);
            }
    }


    public function defaullevelsearch(Request $request)
    {

        $sender = auth()->user()->id;
        $value = $request->value;
      // return $value;
        $output = '';
        $allevels = Level::where('userleveler', '=', $sender)
            ->where('value', $value)
            ->get();

        foreach ($allevels as $allevel) {
            $receiver = $allevel->userbeenleveled;
            $chatRoomId;
            if ($sender > $receiver) {
                $chatRoomId = $receiver . ',' . $sender;
            } else {
                $chatRoomId = $sender . ',' . $receiver;
            }
            $user_id = '';
            $helpDeskUser = '';
            $chatboxroute = route('privateChat', ['chatRoomId'=>$chatRoomId,'user_id'=>$user_id,'helpDeskUser'=>$helpDeskUser]);
            $receiver = User::find($receiver);
            $message = Message::where('sender', $sender)
                ->where('receiver', $allevel->userbeenleveled)->orderBy('created_at', 'DESC')->first();

            if(file_exists(public_path('/uploads/avatars/').$receiver->avatar)){
                $imgsrc = url('/uploads/avatars/' . $receiver->avatar);
            } else {
                $imgsrc = url('/uploads/avatars/defaultpic.jpg');
            }
            //$imgsrc = url('/uploads/avatars/' . $receiver->avatar);

            $leveldelsrc = route('leveldel', $allevel->id);

            if ($message != null) {
                $output .= '<li style="list-style:none">' . '<a href="' . $chatboxroute . ' ">' . '<img src="' . $imgsrc . ' " class="receiver-profile-image float-left" >' . '<h4 class="alink float-left">' . $receiver->name . '</h4>' . '</a>' . '<a class="level_font alink float-right well-sm" href="' . $leveldelsrc . '">' . $value . '<i id="crossbutton" class="fas fa-times">' . '</i>' . '</a>' .
                    '<br>' . '<h5 class="message_font" style="text-align:left;overflow:hidden;">' . '<b>Last message : </b>' . $message->message . '</h5>' .
                    '</li>';
            } else {
                $output .= '<li style="list-style:none">' . '<a href="' . $chatboxroute . ' ">' . '<img src="' . $imgsrc . ' "  class="receiver-profile-image float-left" >' . '<h4 class="alink float-left">' . $receiver->name . '</h4>' . '</a>' . '<a class="level_font alink float-right well-sm" href="' . $leveldelsrc . '">' . $value . '<i id="crossbutton" class="fas fa-times">' . '</i>' . '</a>' .
                    '<h5>' . ' <b> Last message : </b> ' . '</h5>' .
                    '</li>';
            }
        }

        $output = '<div style="overflow-y:scroll">' . '<i id="crossbutton" onClick="closeall()" class="fas fa-times" >' . '</i>' . $output . '</div>';
        return $output;
    }
    public function levelsearch(Request $request)
    {
     //  $roomid=$request->authid;
        $sender = auth()->user()->id;

        $allevels = Level::where('userleveler', '=', $sender)
            ->where('value', '!=', 'Spam')
            ->where('value', '!=', 'Report')
            ->where('value', '!=', 'Archive')->orderBy('value')->get();
        $output = '';
        for ($i = 0; $i < sizeof($allevels); $i++) {
            if ($i == 0) {
                $output .= '<h5 class="level_font" onClick="indeviduallevelsearch(' . $allevels[$i]->id . ')">' . $allevels[$i]->value . '</h5>';
            } elseif ($allevels[$i]->value != $allevels[$i - 1]->value) {
                $output .= '<h5 class="level_font" onClick="indeviduallevelsearch(' . $allevels[$i]->id . ')">' . $allevels[$i]->value . '</h5>';
            }
        }
        return Response($output);

    }
    public function unreadsearch(Request $request)
    {
      //  $roomid=$request->authid;
        $senderid = auth()->user()->id;
        $output = "";
        $message = Message::where('receiver', '=', $senderid)
            ->where('readWriteStatus', '=', 0)
            ->where('activationStatus', '!=', 0)->orderBy('created_at', 'DSEC')->get();
        $messagecnt = Message::where('receiver', '=', $senderid)
            ->where('readWriteStatus', '=', 0)
            ->where('activationStatus', '!=', 0)->orderBy('created_at', 'DSEC')->count();
       // 
        if ($messagecnt == 0) {
            $output .= '<tr>' . '<td>' . '<h3 class="well-sm message_font">No unread message</h3>' . '</td>' . '</tr>';

        } else {
            foreach ($message as $message) {
                $sender = $message->sender;
                $sender = User::find($sender);
                $sendersrc = url('/uploads/avatars/' . $sender->avatar);
                $output .= '<tr >' .
                    '<td>' .
                    '<img src="' . $sendersrc . '" height="20px" width="20px" style="border-radius:50%;float:left">' .
                    '<h4 style="display:inline;font-size:.90rem;">' . $sender->name . '</h4>' .

                    '<h5 class="message_font">' . $message->message . '</h5>' . '<h5 class="time">' . $message->created_at . '</h5>' .
                    '</td>' .
                    '</tr>';
            }
        }
        $output = '<div style="overflow-y:scroll">' . '<i id="crossbutton" onClick="closeall()" class="fas fa-times" >' . '</i>' . $output . '</div>';
        return Response($output);
    }
    public function indeviduallevelsearch(Request $request)
    {
        $sender = auth()->user()->id;
        $levelid = $request->levelid;
        $level = Level::find($levelid);
        $value = $level->value;
        $allevels = Level::where('userleveler', '=', $sender)
            ->where('value', $value)
            ->get();
        $output = "";

        foreach ($allevels as $allevel) {
            $receiver = $allevel->userbeenleveled;
            $chatRoomId;
            if ($sender > $receiver) {
                $chatRoomId = $receiver . ',' . $sender;
            } else {
                $chatRoomId = $sender . ',' . $receiver;
            }
            $user_id = '';
            $helpDeskUser = '';
            $chatboxroute = route('privateChat', ['chatRoomId'=>$chatRoomId,'user_id'=>$user_id,'helpDeskUser'=>$helpDeskUser]);
            $message = Message::where('sender', $sender)
                ->where('receiver', $allevel->userbeenleveled)->orderBy('created_at', 'DESC')->first();
            $receiver = User::find($receiver);
            //$imgsrc = url('/uploads/avatars/' . $receiver->avatar);
            if(file_exists(public_path('/uploads/avatars/').$receiver->avatar)){
                $imgsrc = url('/uploads/avatars/' . $receiver->avatar);
            } else {
                $imgsrc = url('/uploads/avatars/defaultpic.jpg');
            }
            $leveldelsrc = route('leveldel', $allevel->id);
            if ($message != null) {
                $output .= '<li style="list-style:none">' . '<a class="alink" href="' . $chatboxroute . '">' . '<img src="' . $imgsrc . '" class="receiver-profile-image float-left" >' . '<h4 class="alink float-left">' . $receiver->name . '</h4>' . '</a>' . '<a class="level_font alink float-right well-sm" href="' . $leveldelsrc . '">' . $value . '<i id="crossbutton" class="fas fa-times">' . '</i>' . '</a>' .
                    '<br>' . '<h5 class="message_font" style="text-align:left;overflow:hidden;">' . '<b>Last message : </b>' . $message->message . '</h5>' .
                    '</li>';
            } else {
                $output .= '<li style="list-style:none">' . '<a class="alink" href="' . $chatboxroute . '">' . '<img src="' . $imgsrc . '" class="receiver-profile-image float-left" >' . '<h4 class="alink float-left">' . $receiver->name . '</h4>' . '</a>' . '<a class="level_font alink float-right well-sm"  href="' . $leveldelsrc . '">' . $value . '<i id="crossbutton" class="fas fa-times">' . '</i>' . '</a>' .
                    '<h5>' . ' <b> Last message : </b> ' . '</h5>' .
                    '</li>';
            }
        }
        $output = '<div style="overflow-y:scroll">' . '<i id="crossbutton" onClick="closeall()" class="fas fa-times" >' . '</i>' . $output . '</div>';
        return Response($output);
    }
    public function test()
    {
        $sender = auth()->user()->id;
        $levelid = 7;
        $level = Level::find($levelid);
        $value = $level->value;
        $allevels = Level::where('userleveler', '=', $sender)
            ->where('value', $value)
            ->get();
        $output = "";

        foreach ($allevels as $allevel) {
            $receiver = $allevel->userbeenleveled;
            $message = Message::where('sender', $sender)
                ->where('receiver', $allevel->userbeenleveled)->orderBy('created_at', 'DESC')->first();
            $receiver = User::find($receiver);
            //$imgsrc = url('/uploads/avatars/' . $receiver->avatar);
            if(file_exists(public_path('/uploads/avatars/').$receiver->avatar)){
                $imgsrc = url('/uploads/avatars/' . $receiver->avatar);
            } else {
                $imgsrc = url('/uploads/avatars/defaultpic.jpg');
            }
            $leveldelsrc = route('leveldel', $allevel->id);
            if ($message != null) {
                $output .= '<li style="list-style:none">' . '<a class="alink" href="#">' . '<img src="' . $imgsrc . '" class="receiver-profile-image float-left" >' . '<h4 class="alink float-left">' . $receiver->name . '</h4>' . '</a>' . '<a class="level_font alink float-right well-sm" href="' . $leveldelsrc . '">' . $value . '<i id="crossbutton" class="fas fa-times">' . '</i>' . '</a>' .
                    '<br>' . '<h5 class="message_font" style="text-align:left;overflow:hidden;">' . '<b>Last message : </b>' . $message->message . '</h5>' .
                    '</li>';
            } else {
                $output .= '<li style="list-style:none">' . '<a class="alink" href="#">' . '<img src="' . $imgsrc . '" class="receiver-profile-image float-left" >' . '<h4 class="alink float-left">' . $receiver->name . '</h4>' . '</a>' . '<a class="level_font alink float-right well-sm"  href="' . $leveldelsrc . '">' . $value . '<i id="crossbutton" class="fas fa-times">' . '</i>' . '</a>' .
                    '<h5>' . ' <b> Last message : </b> ' . '</h5>' .
                    '</li>';
            }

        }
        return Response($output);
    }
}
