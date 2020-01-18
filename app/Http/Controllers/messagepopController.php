<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Message;
use App\Chatroom;
use Session; 

class messagepopController extends Controller
{
   
    public function index(Request $request){
        $roomidarr=[];
        $im=Auth::user()->id;
      //  return $request->echomessageid;
        $messageroomid =Message::where('receiver',$im)
                      ->where('readWriteStatus','!=',1)
                      ->orderBy('created_at','DESC')->distinct()->get(['RoomId']);
                   
        $unread=array();
        // $echomessage = Message::find($request->echomessageid);
        // return $echomessage->RoomId;
        $roomidarr = Session::get('roomidarr');
       // return $roomidarr;
    
       
        $tushar = $request->messagecrossid;

        if ($request->messagecrossid != null && !(Session::has('flag'))){
            Session::put('flag',1);
          //  return 'op1';
        }
        if ($request->messagecrossid != null) {
            $crossmessage = Message::find($request->messagecrossid);
            Session::push('roomidarr', $crossmessage->RoomId);
          //  return 'op2';
        }
        else if(!Session::has('flag')){
            Session::put('roomidarr', []);
            $a=Session::get('roomidarr');
          //  return $a;
           // return 'op3';
        }
        
        if(Session::has('flag') && $request->echomessageid != Null){
            $echomessage = Message::find($request->echomessageid);
           
            //return $roomidarr;
          //  return 'op4';
            $key = array_search($echomessage->RoomId, $roomidarr);
           // return $key;
            if (($key = array_search($echomessage->RoomId, $roomidarr)) !== false) {
              //  return 'atul';
               unset($roomidarr[$key]);
                Session::forget('roomidarr');
                Session::put('roomidarr', []);
                foreach($roomidarr as $room){
                    Session::push('roomidarr',$room);
                }
            }
            
        }
       
        if(Session::has('flag'))
        {
            $roomidarr = Session::get('roomidarr');
           // return $a;
        }
        if(is_array($roomidarr)==false){
           // return 'ami';
           $roomidarr=[];
         //  return $roomidarr;
        }
            
       // return 'abu';
        $brk=1;
      
        foreach($messageroomid as $messageroomid){
            // return $roomidarr;
            if(in_array($messageroomid->RoomId,$roomidarr)){
               // return 'op6';
                continue;
            }
           // return 'matul';
           // return $messageroomid->RoomId;
            $tm=Message::where('RoomId',$messageroomid->RoomId)
                        ->where('receiver',$im)
                         ->first();
                        // return $tm;
            array_push($unread,$tm);
            if ($brk == 5) {
                break;
            }
            $brk++;
        }
       // return 'saleh';
       // return $unread;
        $messagepopimg=0;
        $messagepop=0;
      
        $output='';
   
        foreach($unread as $unread){
           
            $senderid=$unread->sender;
         // return $senderid;
            if ($im > $senderid) {
                $chatroom = $senderid . ',' . $im;
            } else {
                $chatroom = $im . ',' . $senderid;
            }
            $chatRoomroute = route('privateChat', $chatroom);
            $chatroom = Chatroom::where('chatRoomId', $chatroom)->first();
            //aa($chatroom);
            $romid = $chatroom->id;
            // return $romid;
            $unreadmessagecont = Message::where('RoomId', $romid)
                ->where('readWriteStatus', '!=', 1)
                ->where('sender', '!=', $im)
                ->count();

            // return $unreadmessagecont;     
            $lastmessage= Message::where('RoomId', $romid)
                ->where('readWriteStatus', '!=', 1)
                ->where('sender', '!=', $im)
                ->orderBy('created_at','DESC')->first();

            $utc=$lastmessage->created_at;    
            $time=$this->local($utc);    
          //  return $lastmessage;    
            $sender=User::find($senderid);
           // return $sender;
            $avatar=$sender->avatar;
            //return $avatar;
            $imgsrc=url('/uploads/avatars/'.$avatar);
         //   Session::push('messagearr',$sender->id);
            $messagepop=$lastmessage->id;
            $messagepopimg=$lastmessage->id;
         //  return $imgsrc;
            $output.= 
            '<div class="" style="right:0px;" id="msgimg'. $messagepopimg .'" onmouseleave="messagepo2('.$messagepop.')">'.

                '<div class="messagepopCom " id="i'. $messagepop .'">'.
                    '<td  rowspan="2" >'.'<img src="'.$imgsrc. '"  style="border-radius:50%;padding:2px;" height="50px" width="50px" onmouseenter="messagepo('.$messagepop.');" >'. '<span class="badge badge-danger" style="position:relative ; left:-8px;top:10px">'.$unreadmessagecont.'</span>'.'</td>'.
                        
                    
                    
                       
                        '<table class="float-right ketamoti" style="padding-left:2px;" id="m'.$messagepop.'"  >' .
                            
                                '<tr>'.
                                
                                    '<td colspan="2">'. '<a href="'.$chatRoomroute.'">'. '<h3 style="margin:0px 0px 0px 0px;font-size:1.1rem;font-weight:600;color:black;">'.$sender->name.'</h3>'.'</a>'.'</td>'. 
                                    '<td colspan="2" width="10%">'.'</td>'.
                                    '<td>'. '<h4 style="margin:0px 0px 0px 0px;font-size:.80rem;color:#999999;padding-right:15px">'.$time.'</h4>'.'</td>'.
                                    '<td>'. '<i id="crossin'. $messagepop .'" onClick="messagecross('. $messagepop .')" class="fas fa-times" >' . '</i>' . '</td>'.
                                    '</tr>'.
                                    
                                '<tr>'.
                                    '<td colspan="3">'. '<h6 style="font-size:.80rem;color:#999999;">'.$lastmessage->message.'</h6>'.'</td>'.
                                ' </tr>'.
                            
                             '<i id="cross'.$messagepop .'" onClick="messagecross('. $messagepop .')" class="fas fa-times" >' . '</i>'. 
                               
                        '</table>' .
                       
     
                 '</div>' . 
                             
                       
             '</div>';

        }
       Session::put('messagepop', $messagepop); 
       return Response ($output) ; 
                
    }
    public function local( $utc)
    {
        $user=Auth::user();
        $utcDifference=$user->utc;
        $utcTimeAndDate = explode(' ', $utc);
        $utcDate = $utcTimeAndDate[0];
        $utcTime = $utcTimeAndDate[1];
        $utcTime = explode(':', $utcTime);
        $utcDate = explode('-', $utcDate);
        $utcDifference = (-1) * $utcDifference;
        $h = $utcDifference / 60;
        $m = $utcDifference % 60;
        $utcTime[1] = $utcTime[1] + $m;
        if ($utcTime[1] >= 60 || $utcTime[1] < 0) {
            if ($utcTime[1] >= 60) {
                $utcTime[1] = $utcTime[1] - 60;
                $h++;
            }
            if ($utcTime[1] < 0) {
                $utcTime[1] = $utcTime[1] + 60;
                $h--;
                $utcTime[1] = $utcTime[1] + $m;
            }

        }
        $utcTime[0] = $utcTime[0] + $h;
        if ($utcTime[0] >= 24 || $utcTime[0] < 0) {
            if ($utcTime[0] >= 24) {
                $utcTime[0] = $utcTime[0] - 24;
                $utcDate[2]++;
            }
            if ($utcTime[0] < 0) {
                $utcTime[0] = $utcTime[0] + 24;
                $utcTime[0] = $utcTime[0] + $h;
                $utcDate[2]--;
            }

        }
        if ($utcDate[2] > 30 || $utcDate[2] < 0) {
            if ($utcDate[2] > 30) {
                $utcDate[1]++;
            }
            if ($utcDate[2] < 0) {
                $utcDate[1]--;
            }

        }
        if ($utcDate[1] > 12 || $utcDate[1] < 0) {
            if ($utcDate[1] > 12) {
                $utcDate[0]++;
            }
            if ($utcDate[1] < 0) {
                $utcDate[0]--;
            }
        }
        $fmon;
       // $l= $utcDate[0]. '-'. $utcDate[1].'-'. $utcDate[2]. ' ' . $utcTime[0] .':' . $utcTime[1] . ':' . $utcTime[2];
        $month = ["kaka", "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        if ($utcDate[1] == '01') {
            $fmon = 'Jan';
        }
        if ($utcDate[1] == '02') {
            $fmon = 'Feb';
        }
        if ($utcDate[1] == '03') {
            $fmon = 'Mar';
        }
        if ($utcDate[1] == '04') {
            $fmon = 'April';
        }
        if ($utcDate[1] == '05') {
            $fmon = 'May';
        }
        if ($utcDate[1] == '06') {
            $fmon = 'Jun';
        }
        if ($utcDate[1] == '07') {
            $fmon = 'July';
        }
        if ($utcDate[1] == '08') {
            $fmon = 'Aug';
        }
        if ($utcDate[1] == '09') {
            $fmon = 'Sep';
        }
        if ($utcDate[1] == '10') {
            $fmon = 'Oct';
        }
        if ($utcDate[1] == '11') {
            $fmon = 'Nov';
        }
        if ($utcDate[1] == '12') {
            $fmon = 'Dec';
        }
        $l = $fmon . ' ' . $utcDate[2] . ',' . ' ' . $utcTime[0] . ':' . $utcTime[1] . ':' . $utcTime[2];
        return $l;



    }

}
