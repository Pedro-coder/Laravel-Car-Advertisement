<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Auth;
use App\Chatroom;
use App\Level;
use App\User;
use App\Message;

class LevelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $roomid = $request->roomid;
        $level = $request->level;
       // return $level;
        $sender = auth()->user()->id;
        $chatroom = Chatroom::where('id', $roomid)->first();
        $chatroomusers = $chatroom->chatRoomId;
        $chatroomusers = explode(',', $chatroomusers);
        $receiver;
        if ($chatroomusers[0] == $sender) {
            $receiver = $chatroomusers[1];
        } else {
            $receiver = $chatroomusers[0];
        }
       
       
        // if($request->levels == 'Nudge' && $previousnudge == 0){
        //     $newlevel = new Level;
        //     $newlevel->userleveler = $sender;
        //     $newlevel->userbeenleveled = $receiver;
        //     $newlevel->value = $request->levels;
        //     $newlevel->save(); 
        //     return ['level'=>'Nudge'];
        // }
        $levelcont = Level::where('userleveler', $sender)
            ->where('value', $level)
            ->where('userbeenleveled', $receiver)->count();
                         // return $levelcont;
        if ($levelcont == 0) {
            $newlevel = new Level;
            $newlevel->userleveler = $sender;
            $newlevel->userbeenleveled = $receiver;
            $newlevel->value = $request->level;
            $newlevel->save();
            $allevels = Level::where('userleveler', '=', $sender)
                ->where('userbeenleveled', '=', $receiver)->get();

            $output = '';
            foreach ($allevels as $allevel) {
                $leveldelsrc = route('leveldel', $allevel->id);
                $output .= '<h6 class="well-sm level_font" style="display:inline;">' . $allevel->value . '<a class="alink"  href="' . $leveldelsrc . '">' . '<i id="crossbutton" class="fas fa-times"></i>' . '</a>' . '</h6>';
            }
           // $output = 'Level: ' . $output;
            return Response($output);
        } else {
            return 'reload';
        }






    }
    public function getOldLevel(Request $request)
    {
        $roomid = $request->roomid;
        $sender = auth()->user()->id;
        $chatroom = Chatroom::where('id', $roomid)->first();
        $chatroomusers = $chatroom->chatRoomId;
        $chatroomusers = explode(',', $chatroomusers);
        $receiver;
        if ($chatroomusers[0] == $sender) {
            $receiver = $chatroomusers[1];
        } else {
            $receiver = $chatroomusers[0];
        }
        $allevels = Level::where('userleveler', '=', $sender)
            ->where('userbeenleveled', '=', $receiver)->get();

        $output = '';
        foreach ($allevels as $allevel) {
            $leveldelsrc = route('leveldel', $allevel->id);
            $output .= '<h6 class="well-sm level_font" style="display:inline;">' . $allevel->value . '<a class="alink" href="' . $leveldelsrc . '">' . '<i id="crossbutton" class="fas fa-times"></i>' . '</a>' . '</h6>';
        }
        $output = '<h6 style="margin:0;color:#ffffff">level</h6>' . $output;
        return Response($output);
    }
    public function custom(Request $request)
    {
        $roomid = $request->roomid;
        $sender = auth()->user()->id;
        $chatroom = Chatroom::where('id', $roomid)->first();
        $chatroomusers = $chatroom->chatRoomId;
        $chatroomusers = explode(',', $chatroomusers);
        $receiver;
        if ($chatroomusers[0] == $sender) {
            $receiver = $chatroomusers[1];
        } else {
            $receiver = $chatroomusers[0];
        }
        $newlevel = new Level;
        $newlevel->userleveler = $sender;
        $newlevel->userbeenleveled = $receiver;
        $newlevel->value = $request->customlevel;
        $newlevel->save();
        return Redirect::to('privateChat/' . (implode(",", $chatroomusers)));


    }
    public function starchat($id)
    {

        $chatroom = Chatroom::find($id);
        $chatroomusers = $chatroom->chatRoomId;
        $star_setter = Auth::user()->id;
        $chatroomusers = explode(',', $chatroomusers);
        $receiver;
        if ($chatroomusers[0] == $star_setter) {
            $receiver = $chatroomusers[1];
        } else {
            $receiver = $chatroomusers[0];
        }
        $level = Level::where('userleveler', $star_setter)
            ->where('userbeenleveled', $receiver)
            ->where('value', 'Star')->first();
        $levelcont = Level::where('userleveler', $star_setter)
            ->where('userbeenleveled', $receiver)
            ->where('value', 'Star')->count();
        if ($levelcont == 0) {
            $newlevel = new Level;
            $newlevel->userleveler = $star_setter;
            $newlevel->userbeenleveled = $receiver;
            $newlevel->value = 'Star';
            $newlevel->save();
            return redirect()->back();
        } else {
            $level->delete();
            return redirect()->back();
        }
    }
    public function delallchat($id)
    {
        $messages = Message::where('RoomId', $id)->get();
        foreach ($messages as $message) {
            $message->delete();
        }
        return redirect()->back();
    }
    public function delete($id)
    {
        $level = Level::find($id);
        $level->delete();
        return redirect()->back();
    }
}
