<?php

namespace App\Http\Controllers;

use App\About;
use App\Chatroom;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Illuminate\Support\Facades\Log;
use Image;
use Session;
use App\HomePageSetup;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\verifymail;
use Illuminate\Support\Facades\Redirect;
use PDF;
use Carbon\Carbon;
use DB;

class UserController extends Controller
{
    public function __construct(){
        ini_set('max_execution_time', 600);
    }
    public function registeruser(Request $request){
        $user=new User;
        $user->name=$request->name;
        $user->email=$request->email;
        $user->avatar=$request->email;
        $user->location=$request->location;
        $user->phone_no=$request->phone;
        $user->paypal_email=$request->paypal_email;
        $user->password=bcrypt($request->password);
        $user->verify_tokekn=Str::random(40);
        $user->verify_status=0;
        $user->save();
        $thisuser=User::find($user->id);
        // return $thisuser['email'];
        $this->sendverifyemail($thisuser);
        return $user;

    }
    public function sendverifyemail($thisuser){
        Mail::to($thisuser['email'])->send(new verifymail($thisuser));
    }

    public function verified_email($email,$verify_tokekn){
        $user=User::where(['email'=>$email,'verify_tokekn'=>$verify_tokekn])->first();
        if($user){
            User::where(['email'=>$email,'verify_tokekn'=>$verify_tokekn])->update(['verify_status'=>1,'verify_tokekn'=>NULL]);
            Session::flush();
            return Redirect::to('/home');
        }else{
            return 'user NOT found';
        }
    }
    public function registeruserwithout(Request $request){
        $user=new User;
        $user->name=$request->name;
        $user->email=$request->email;
        $user->avatar=$request->email;
        $user->location=$request->location;
        $user->phone_no=$request->phone;
        $user->paypal_email=$request->paypal_email;
        $user->password=bcrypt($request->password);
        $user->verify_tokekn=Str::random(40);
        $user->verify_status=0;
        $user->save();
    }
    public function showProfile()
    {
        return view('pages.profile.index', array('user' => Auth::User()) );
    }
    public function showProfilewithid($id){
        $user=User::find($id);
        return view('pages.profile.index', array('user' => $user) );
    }
    public function userProfile()
    {
        $chatRoute =  route('chatdashboard');
        return view('pages.showprofile.index')->with(['user' => Auth::User(), 'canUpdate' => true, 'chatRoute' => $chatRoute] );
    }
    public function about(){
        $chatRoute =  route('chatdashboard');
        $timestamp = Carbon::now();
        $date = Carbon::createFromFormat('Y-m-d H:i:s', $timestamp, 'America/Los_Angeles');
        $date = Carbon::parse($date, 'UTC');
        $date_final = $date->format('M d H:i');

        return view('pages.showprofile.about')->with(['user' => Auth::user(), 'canUpdate' => true, 'chatRoute' => $chatRoute, 'date' => $date_final]);
    }
    public function otherUserProfile($userId)
    {
        $user = User::find($userId);
        $flag = false;

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
        $user_id = '';
        $helpDeskUser = 0;
        $chatRoomId = route('privateChat', ['chatRoomId'=>$chatRoomId,'user_id'=>$user_id,'helpDeskUser'=>$helpDeskUser]);
        if (Auth()->user()->id == $userId)
        {
            $flag = true;
            $chatRoomId =  route('chatdashboard');
        }
        return view('pages.showprofile.user_profile')->with(['user' => $user, 'canUpdate' => $flag, 'chatRoute'=>$chatRoomId] );
    }
    public function updatePic(Request $request)
    {
        // Handle the user upload of avatar
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/' . $filename ) );

            // save data to the database.
            $user = Auth::user();
            $user->avatar = $filename;

            $user->save();
        }
        //Rizwan Changes Start Here
        if($request->hasFile('photo_id')){
            $photo_id = $request->file('photo_id');
            $filename = time() . '.' . $photo_id->getClientOriginalExtension();
            Image::make($photo_id)->resize(300, 300)->save( public_path('/uploads/photoId/' . $filename ) );

            // save data to the database.
            $user = Auth::user();
            $user->photo_id = $filename;

            $user->save();
        }


        if($request->has('webcam_image')){
            $png_url = time().".png";
            $path = public_path('uploads/webcam/').$png_url;

            Image::make(file_get_contents($request->webcam_image))->save($path);

            // save data to the database.
            $user = Auth::user();
            $user->webcam_image = $png_url;
            $user->save();
        }
        //Rizwan Changes End Here

        Session::flash('success', 'Profile Image Updated');
        return redirect()->route('profile')->with(array('user' => Auth::User()));
    }

    public function updateUser(Request $request)
    {
        $this->validate($request, [
            // 'location' => 'required|string|max:255',
            // 'phone_no' => 'required|numeric',
            // 'paypal_email' => 'required|string|email|max:255',
        ]);

        $user = Auth::user();

        $user->location          = $request->input('location');
        $user->phone_no          = $request->input('phone_no');
        $user->paypal_email      = $request->input('paypal_email');

        $user->save();
        Session::flash('success', 'Profile Updated');
        return redirect()->route('profile')->with(array('user' => Auth::User()));
    }
    //Waqas Changes
    public function emailVerification()
    {
        return view('pages.profile.email-verification');
    }
    public function homepageSetup(){

        $user = Auth::user();
        return view('pages.admin.homepage_setup',compact('user'));

    }

    public function setHomepageSetup(Request $request){

        $user = Auth::user();

        if (stripos(strtolower($request->homepage_link), 'www.hi5.center') !== false) {

            $link = $request->homepage_link;
            $data['user_id'] = $user->id;
            $data['homepage_link'] = $link;

            $page = HomePageSetup::create($data);

            Session::flash('success', 'Home Page URL Updated');
            return back();

        }else{
            Session::flash('failure', 'You are not Allowed to enter outside URL.');
            return back();
        }


    }

    public function updateCoverPic(Request $request)
    {
        $request->validate([
            'cover' => 'image|max:10000',
            'profile' => 'image|max:10000',
        ]);
        $user = User::find($request->input('user_id'));

        if ($request->has('cover'))
        {
            $image = $request->file('cover');
            $name = time().'.'.$image->getClientOriginalExtension();
            // $image->move($destinationPath, $name);
            $destinationPath = public_path('/uploads/covers/'.$name);
            compress($image,$destinationPath);
            $user->cover_img = $name;
            $user->save();
        }
        if ($request->has('profile'))
        {
            $image = $request->file('profile');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/avatars/'.$name);
            // $image->move($destinationPath, $name);
            compress($image,$destinationPath);
            $user->avatar = $name;
            $user->save();
        }

        return redirect()->back();
    }

    public function search(Request $request)
    {



        if ($request->ajax()) {

            $users = User::where('name', 'LIKE', '%' . $request->search . "%")->orWhere('email', 'LIKE', '%' . $request->search . "%")->take(5)->get();
            $output = "";
            $user_screen_type = $request->user_screen_type;



            //Check Search which page user search in wallet ore accountant

            if($request->checkSearch=="1"){

                foreach ($users as $user) {


                    $url = url('accountant/user', $user->id);
                    $src = url('/uploads/avatars/' . $user->avatar);
                    $output .= '<tr class="user_link" data-id="' . $user->id . '" data-name = "'. $user->name .'">' .
                                    '<td>' . 
                                        '<a class="alink" href="'. $url .'">' . 
                                            '<img  src="' . $src . '" height="35px" width="35px" style="border-radius:50%;float:left">' . 
                                            '<h1 class="chtbxusername" style="display:inline;">' . $user->name . '</h1>' . 
                                        '</a>' . 
                                    '</td>' .
                                '</tr>';
                }

            }else{

                foreach ($users as $user) {


                    $url = route('otherUserProfile', $user->id);
                    $src = url('/uploads/avatars/' . $user->avatar);

                    if ($user_screen_type == 'events'){
                        $url = route('events.profile.index', $user->id);
                    }

                    $output .= '<tr data-id="' . $user->id . '" data-name = "'. $user->name .'">' .

                        '<td data-id="' . $user->id . '" data-name = "'. $user->name .'">' . '<a class="alink " href="' . $url . ' ">' . '<img  src="' . $src . '" height="35px" width="35px" style="border-radius:50%;float:left">' . '<h1 class="chtbxusername" style="display:inline;">' . $user->name . '</h1>' . '</a>' . '</td>' .

                        '</tr>';
                }



            }


            $output = '<div>' . '<i id="crossbutton" onClick="closeall()" class="fas fa-times" >' . '</i>' . $output . '</div>';
            return Response($output);
        }

    }

    public function aboutUserProfile(Request $request){

        $a = User::where('id',$request->userIdAbout)->update(['about'=>$request->about]);
        return Redirect::back();
    }

    public function aboutotherUserProfile(Request $request,$userId){

        $user = User::find($userId);
        $flag = false;

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
        $chatRoomId = route('privateChat', $chatRoomId);
        if (Auth()->user()->id == $userId)
        {
            $flag = true;
            $chatRoomId =  route('chatdashboard');
        }
        return view('pages.showprofile.other_user_profile_about')->with(['user' => $user, 'canUpdate' => $flag, 'chatRoute'=>$chatRoomId] );

        
    }

    
    // public function generatePDF(Request $request){
    //     $d = User::where('id',Auth::user()->id)->first();
    //     $chatRoute =  route('chatdashboard');
    //     $timestamp = Carbon::now();
    //     $date = Carbon::createFromFormat('Y-m-d H:i:s', $timestamp, 'America/Los_Angeles');
    //     $date = Carbon::parse($date, 'UTC');
    //     $date_final = $date->format('M d H:i');
    //     $data = ['user'=>$d, 'canUpdate' => true, 'chatRoute' => $chatRoute, 'date' => $date_final];
    //     $user = PDF::loadView('pages/showprofile/about', $data);
    //     return $user->download('UserProfile.pdf');
    // }
    public function generatePDF()
    {
        $d = User::where('id',Auth::user()->id)->first();
        $data = ['title' => 'Welcome to HDTuto.com', 'user' => $d];
        $pdf = PDF::loadView('pages.showprofile.pdf', $data);

        return $pdf->stream('about.pdf');
    }

    public function searchforfilter(Request $request)
    {


        if ($request->ajax()) {

            $users = User::where('name', 'LIKE', '%' . $request->search . "%")->orWhere('email', 'LIKE', '%' . $request->search . "%")->take(5)->get();
            $output = "";

            //Check Search which page user search in wallet ore accountant

            if($request->checkSearch=="1"){

                foreach ($users as $user) {


                    $url = url('accountant/user', $user->id);
                    $src = url('/uploads/avatars/' . $user->avatar);
                    $output .= '<tr data-id="' . $user->id . '" data-name = "'. $user->name .'">' .


                        '<td>' . '' . '<img  src="' . $src . '" height="35px" width="35px" style="border-radius:50%;float:left">' . '<h1 class="chtbxusername" style="display:inline;">' . $user->name . '</h1>' . '' . '</td>' .


                        '</tr>';
                }

            }else{

                foreach ($users as $user) {

                    $url = route('otherUserProfile', $user->id);
                    $src = url('/uploads/avatars/' . $user->avatar);

                    $output .= '<tr data-id="' . $user->id . '" data-name = "'. $user->name .'">' .

                        '<td data-id="' . $user->id . '" data-name = "'. $user->name .'">' . '' . '<img  src="' . $src . '" height="35px" width="35px" style="border-radius:50%;float:left">' . '<h1 class="chtbxusername" style="display:inline;">' . $user->name . '</h1>' . '' . '</td>' .

                        '</tr>';
                }



            }


            $output = '<div>' . '<i id="crossbutton" onClick="closeall()" class="fas fa-times" >' . '</i>' . $output . '</div>';
            return Response($output);
        }

    }

}
