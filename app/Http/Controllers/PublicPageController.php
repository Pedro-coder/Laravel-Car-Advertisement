<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Buyer;
use App\Seller;
use App\Article;
use App\Event;
use App\Blog;
use App\Setting;
use Illuminate\Support\Facades\DB;

class PublicPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function test()
    {
        return view('test');
    }

    public function welcome()
    {
        $buyers = Buyer::orderBy('id', 'desc')->where(function ($q) {
            $q->where(DB::raw("DATE_ADD(created_at,INTERVAL hour HOUR)"), '>', now());
        })->paginate(10);
        $sellers = Seller::orderBy('id', 'desc')->where(function ($q) {
            $q->where(DB::raw("DATE_ADD(created_at,INTERVAL hour HOUR)"), '>', now());
        })->paginate(10);
        $articles = Article::orderBy('id', 'desc')->paginate(10);
        $events = Event::orderBy('id', 'desc')->paginate(10);
        $posts = Blog::latest()->paginate(5);
         $setting = Setting::first();
       $homeList = true;
        return view('welcome')
            ->withHomeList($homeList)
            ->withBuyers($buyers)
            ->withSellers($sellers)
            ->withArticles($articles)
            ->withEvents($events)
            ->withSetting($setting)
            ->withPosts($posts);
  } 

    public function SellView($id)
    {
        //fetch from the DB based om slug
        $seller = Seller::where('id', '=', $id)->first();

        //return the view and pass the post object
        return view('pages.visitor.sell')->withSeller($seller);
    }

    public function BuyView($id)
    {
        //fetch from the DB based om slug
        $buyer = Buyer::where('id', '=', $id)->first();

        //return the view and pass the post object
        return view('pages.visitor.buy')->withBuyer($buyer);
    }

}
