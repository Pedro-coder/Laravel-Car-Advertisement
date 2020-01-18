<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Blog;
use App\BlogComment;
use App\User;
use Session;
use DB;

class PublicBlogContoller extends Controller
{
    public function index(){

        $posts = Blog::latest()->paginate(5);
        
        return view('pages.blog.public_posts',compact('posts'));
       

    }

    public function visitorDetails($id){

        $post = Blog::where('id',$id)->first();
        $comments = BlogComment::where('post_id',$id)->get();
        $users = User::all();
        $menu_options = DB::table('menu_options')->get();
        $user_menu = DB::table('user_menu')->get();

        return view('pages.blog.visitor_posts_details',compact('post','comments','users','user_menu','menu_options'));

    }
    
}
