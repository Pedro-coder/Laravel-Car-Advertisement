<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Buyer;
use App\Seller;
use App\Article;
use App\Order;
use Session;
use DB;
use Auth;

class OrderController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index()
  {
    $buyers = DB::table('buyers')->where('buyer_status', '=', 1)->get();
    $sellers = DB::table('sellers')->where('seller_status', '=', 1)->get();
    return view('pages.order.index')->withBuyers($buyers)->withSellers($sellers);
  }

  public function buyerOrder(Request $request, $id)
  {
      // validate the data
      $this->validate($request, array(
          'buyer_item_code'                => 'required|string|max:255|unique:buyers',
          'buyer_pro_weight'               => 'nullable|integer',
          'buyer_hidden_info'              => 'nullable|max:255',
          'buyer_hidden_price'             => 'nullable|max:255',
          'buyer_hidden_description'       => 'nullable|min:5|max:255',
        ));

        $order = new Order;
        // When orders table empty it's getting error trying to get non object type id something
        $order->user_id = Auth()->id();
        $latestOrder                        = Order::orderBy('created_at','DESC')->first();
        $order->order_number                = '#'.str_pad($latestOrder->id + 1, 8, "0", STR_PAD_LEFT);
        $order->save();

        // save data to the database.
        $buyer = Buyer::find($id);

        $buyer->buyer_item_code             = $request->input('buyer_item_code');
        $buyer->buyer_status                = $request->input('buyer_status');
        $buyer->buyer_pro_weight            = $request->input('buyer_pro_weight');
        $buyer->buyer_hidden_info           = $request->input('buyer_hidden_info');
        $buyer->buyer_hidden_price          = $request->input('buyer_hidden_price');
        $buyer->buyer_hidden_description    = $request->input('buyer_hidden_description');

        $buyer->save();


        Session::flash('success', 'Your order has been placed, Buyer will notified shortly!');
         // return redirect()->route('buyer.show', $buyer->id);
        return redirect()->back();

  }

  public function buyerStatus(Request $request, $id)
  {

    $order = Order::find($id);
    $order->buyer_status = $request->input('buyer_status');
    $order->save();

    Session::flash('success', 'Your order Status Changed, Buyer will notified shortly!');
    return redirect()->back();

  }

  public function buyerShow($buyer_item_code)
  {
      $orders = Order::all();
      $buyers = Buyer::all();
      // $buyer = Buyer::where('buyer_item_code', '=', $buyer_item_code)->first();
      $sellers = Seller::all();
      return view('pages.order.showInRaw')
      ->withBuyers($buyers)
      ->withSellers($sellers)
      ->withOrders($orders);
  }

  public function buyerSingle($id)
  {
       $orders = Order::all();
      // $order = DB::table('orders')->where('order_status', '=', $order_status)->first();
      $buyer = Buyer::where('id', '=', $id)->first();
      return view('pages.order.buyer_single', array('user' => Auth::User()))
      ->withBuyer($buyer)->withOrders($orders);
      // ->withOrders($orders);
  }


  public function sellerOrder(Request $request, $id)
  {
        $order = new Order;
        // When orders table empty it's getting error trying to get non object type id something
        $order->user_id = Auth()->id();
        $latestOrder                        = Order::orderBy('created_at','DESC')->first();
        $order->order_number                = '#'.str_pad($latestOrder->id + 1, 8, "0", STR_PAD_LEFT);
        $order->save();

        // save data to the database.
        $seller = Seller::find($id);
        // Seller boolean set 1
        $seller->seller_status   = $request->input('seller_status');
        $seller->save();


        Session::flash('success', 'Your order has been placed, Seller will notified shortly!');
        return redirect()->route('sellerSingle', $seller->id);
        //return redirect()->back();

  }
  // public function sellerShow($id)
  // {
  //     $orders = Order::all();
  //     $buyers = Buyer::all();
  //     $seller = Seller::find($id);
  //     // $sellers = Seller::all();
  //     return view('pages.order.seller_single', array('user' => Auth::User()))
  //     ->withBuyers($buyers)
  //     ->withSeller($seller)
  //     ->withOrders($orders);
  // }
  public function sellerStatus(Request $request, $id)
  {
    $order = Order::findOrFail($id);
    $order->seller_order_status             = $request->input('seller_order_status');
    $order->save();

    Session::flash('success', 'Your order Status Changed, Seller will notified shortly!');
    return redirect()->back();
  }

  public function sellerSingle($id)
  {
       $orders = Order::all();
       $buyer = Buyer::find($id);
      // $order = DB::table('orders')->where('order_status', '=', $order_status)->first();
      $seller = Seller::where('id', '=', $id)->first();
      return view('pages.order.seller_single', array('user' => Auth::User()))
      ->withSeller($seller)->withOrders($orders)->withBuyer($buyer);
      // ->withOrders($orders);
  }

}
