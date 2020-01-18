<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Chatroom;
use App\User;
use App\Message;
use App\Events\OnlineEvent;
use App\Balance;

class ChatDashboardController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $id = Auth::user()->id;

        $receiver = $this->receivers($id);
        
        $user=User::find($id);

        $helpDeskUser = 0; 

        return view('chats.chatHome')->with('receivers', $receiver)
                                     ->with('requestmaker', $id)
                                     ->with('helpDeskUser', $helpDeskUser)
                                     ->with('roomId',0);
                                   
    }

    /* add by mirza_47 */
    public function helpChat()
    {

        //$id = Auth::user()->id;
        
        $id = 55;
            # code...
        $helpDeskUser = 1;

        $receiver = $this->receivers($id);
        
        //$user=User::find($id);

        return view('chats.helpChatHome')->with('receivers', $receiver)
                                        ->with('requestmaker', $id)
                                        ->with('helpDeskUser', $helpDeskUser)
                                        ->with('roomId',0);
        
                                   
    }

    public function receivers($id)
    {
        
        $receiver = array();
        $is_admin = Auth::user()->name;

        //$chatroom = Chatroom::where('chatRoomId', 'Like', '%' . $id . '%')->orderBy('updated_at')->get();

        // if (is_null($chatroom)) 
        // { 
        //     $chatRoomId = $id . ',' . 55;
        //     $chatroom = new Chatroom();
        //     $chatroom->chatRoomId = $chatRoomId;
        //     $chatroom->save();

        // }
       
        // print_r($chatroom);
        $chatroom = Chatroom::where('chatRoomId', 'Like', '%' . $id . '%')->orderBy('updated_at')->get();
        //aa($chatroom);
        foreach ($chatroom as $chat) {
            $arr = explode(',', $chat->chatRoomId);
            // print_r($arr);
            if($arr[0] == $id){ 
               array_push($receiver, User::find($arr[1]));
            }/*elseif($arr[0] != $id && $is_admin == 'admin') {
                array_push($receiver, User::find($id));
            }*/
            /*elseif($arr[0] != $id && $helpDeskUser == 1) {
                array_push($receiver, User::find($id));
            }*/
            elseif($arr[1] == $id){
                array_push($receiver, User::find($arr[0]));
            }
            else{continue;}
        
        } 
        return $receiver;
    }
   
 
}
