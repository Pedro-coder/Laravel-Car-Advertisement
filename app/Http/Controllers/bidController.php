<?php

namespace App\Http\Controllers;

use App\Buyer;
use App\Chatroom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Bid;
use Auth;
use App\User;
use App\product;
use Image;

class bidController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function index()
    {

        $u = Auth::user()->id;
        $ifany = 0;
        $ifany = Bid::where('user_id', $u)->count();
        $user = User::find($u);
        if ($user->IsAdmin == 1) {
            $ifany = 1;
        }
        return view('pages.buyer.index')->with('ifany', $ifany);
    }

    public function userBids()
    {
        $data['user']=$user=auth()->user();
        if(!$user){
            return redirect()->back();
        }
        $data['buyers'] = Buyer::orderBy('id', 'desc')->where(function($q){
            $q->where(DB::raw("DATE_ADD(created_at,INTERVAL hour HOUR)"),'>',now());
        })->where('user_id',$user->id)->get();

        return view('pages.buyer.user-bids-index',$data);
    }
    public function otherUsersBid($id)
    {
        $user=User::find($id);
        if(!$user){
            return redirect()->back();
        }
        $buyers= Buyer::orderBy('id', 'desc')->where(function($q){
            $q->where(DB::raw("DATE_ADD(created_at,INTERVAL hour HOUR)"),'>',now());
        })->where('user_id',$user->id)->get();

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
        if (Auth()->user()->id == $user->id)
        {
            $flag = true;
            $chatRoomId =  route('chatdashboard');
        }
        return view('pages.buyer.user-bids-other')->with(['buyers'=>$buyers,'user' => $user, 'canUpdate' => $flag, 'chatRoute'=>$chatRoomId] );
    }



    public function showform()
    {
        return view('pages.buyer.form');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'required',
            'product_name' => 'required',
            'current_bid' => 'required',
            'auto_order' => 'required',
            'referral' => 'required',
            'receiver' => 'required',
            'delivery_address' => 'required',
            'city' => 'required',
            'phone_number' => 'required',
            'delivery_time' => 'required',
            'content' => 'required',


        ]);
        //return $request;
        $bid = new Bid;
        $product = new product;
        $user = Auth::user();
        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $filename = time() . ',' . $image->getClientOriginalExtension();
            $location = public_path('/uploads/buyer/' . $filename);
            Image::make($image)->save($location);
            $product->image = $filename;
        } else {
            $product->image = 'defatult.png';
        }
        $product->name = $request->product_name;
        $product->save();
        $bid->product_id = $product->id;
        $bid->receiver = $request->receiver;
        $bid->user_id = $user->id;
        $bid->occupation = 1;
        $bid->phone = $request->phone_number;
        $bid->address = $request->delivery_address;
        $bid->city = $request->city;
        $bid->description = $request->content;
        $bid->auto_order = $request->auto_order;
        $bid->current_bid = $request->current_bid;
        $bid->referral = $request->referral;
        $bid->country = 'Bangladesh';
        $bid->delivery_date = $request->delivery_time;
        $bid->save();
        return Redirect::to('/bids/buyers');
    }

    public function edit($id)
    {
        $bid = Bid::where('id', $id)->first();

        return view('pages.buyer.edit')->with('bid', $bid);

    }

    public function editstore(Request $request, $id)
    {
        $validatedData = $request->validate([
            'image' => 'required',
            'product_name' => 'required',
            'current_bid' => 'required',
            'auto_order' => 'required',
            'referral' => 'required',
            'receiver' => 'required',
            'delivery_address' => 'required',
            'city' => 'required',
            'phone_number' => 'required',
            'delivery_time' => 'required',
            'content' => 'required',


        ]);
        $bid = Bid::where('id', $id)->first();
        $product = product::where('id', $bid->product_id)->first();
        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $filename = time() . ',' . $image->getClientOriginalExtension();
            $location = public_path('/uploads/buyer/' . $filename);
            Image::make($image)->save($location);
            $product->image = $filename;
        }
        $product->save();
        $bid->receiver = $request->receiver;
        //$bid->user_id=$user->id;
        $bid->occupation = 1;
        $bid->phone = $request->phone_number;
        $bid->address = $request->delivery_address;
        $bid->city = $request->city;
        $bid->description = $request->content;
        $bid->auto_order = $request->auto_order;
        $bid->current_bid = $request->current_bid;
        $bid->referral = $request->referral;
        $bid->country = 'Bangladesh';
        $bid->delivery_date = $request->delivery_time;
        $bid->save();
        return Redirect::to('/bids/buyers');
    }

    public function delete($id)
    {
        // return $id;
        $bid = Bid::destroy($id);

        return Redirect::to('/bids/buyers');

    }
}
