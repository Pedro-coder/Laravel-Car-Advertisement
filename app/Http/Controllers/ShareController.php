<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use Illuminate\Support\Facades\DB;
use Nexmo\Response;

class ShareController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }

 
    public function eventShareDesign(Request $request, $event_id,$user_id)
    {
        if(empty($request->fbclid))
        {
            $eventData = DB::table('events')->where('id',$event_id)->first();
            return view('share',['data_array'=>$eventData]);
        }
        else
        {
            $fbId = $request->fbclid;
            //$eventData = DB::table('events')->where('id',$userId)->first();
            //return view(route('register'));
            return redirect()->route('register', compact('event_id','user_id','fbId'));
        }
        
        //return response()->json('Success');
        
    }
    
}
