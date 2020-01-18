<?php

namespace App\Http\Controllers;

use App\Chatroom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use Nexmo\Network\Number\Request;
use App\Blog;
use App\BlogComment;
use App\User;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Balance;
use App\ReferralPost;
use App\CommentReaction;
use Image;
use DB;

class BlogController extends Controller
{

    public function __construct()
    {
         $this -> middleware('auth');
        
    }
    public $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';


    public function myBlog(){

        $user = \Auth::user();

        $posts = Blog::where('user_id',$user->id)->latest()->paginate(5);
        
        return view('pages.blog.my_blog',compact('posts'));

    }

    public function userProfileBlog($userId)
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
        $chatRoute = route('privateChat', $chatRoomId);


        $posts = Blog::where('user_id',$userId)->latest()->paginate(5);

        return view('pages.blog.user_profile_blog', compact('user', 'posts', 'chatRoute'));
    }

    public function addBlog(){

        return view('pages.blog.add_blog');


    }

    public function storeBlog(Request $request){

//return $request;
        $data=$request->all();
      
        if($request->has('checkbox')){

            $user = \Auth::user();

            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $image_uploaded = $request->image->move(public_path('/uploads/blog'), $imageName);
            if ($image_uploaded) {
               
                $data['image'] = $imageName;
              
            }
            $data['user_id'] = $user->id;
    
            $add=Blog::create($data);
    
            return redirect()->to('/my-blog');

        }
        elseif($request->read_amount != null){
            $user = \Auth::user();

            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $image_uploaded = $request->image->move(public_path('/uploads/blog'), $imageName);
            if ($image_uploaded) {
               
                $data['image'] = $imageName;
              
            }
            $data['user_id'] = $user->id;
    
            $add=Blog::create($data);
    
            return redirect()->to('/my-blog');
        }
        else{

            Session::flash('failure', 'Please Select Payment Criteria!');
            return back();

        }

        

    }

    public function publicBlog(){

        $posts = Blog::latest()->paginate(5);

       $users = User::all();

        return view('pages.blog.public-blog',compact('posts','users'));

    }

    public function blogDetails($id){

        $post = Blog::where('id',$id)->first();
        $comments = BlogComment::where('post_id',$id)->latest()->get();
        $users = User::all();
        $menu_options = DB::table('menu_options')->get();
        $user_menu = DB::table('user_menu')->get();

        return view('pages.blog.blog_detail',compact('post','comments','users','user_menu','menu_options'));

    }

    
//
    public function addComment(Request $request,$post_id,$user_id){

       
       $data = $request->all();
       $data['user_id'] = $user_id;
       $data['post_id'] = $post_id;

       $comment = BlogComment::create($data);

       return back();

    }

    public function deletePost($post_id){

        $deleteBlog = Blog::where('id',$post_id)->delete();
        $deleteBlogComments = BlogComment::where('post_id',$post_id)->delete();

        Session::flash('success', 'Blog Post Deleted Succcessfully!');

        return redirect()->to('/public-blog');


    }

    public function deleteComment($comment_id){

        $deleteBlogComments = BlogComment::where('id',$comment_id)->delete();

        Session::flash('success', 'Comment Deleted Succcessfully');

        return back();

    }
 
    public function updateBlogReaction(Request $request){

        $array = array();
        $post = Blog::find($request->post_id);

        $user = \Auth::user();

        $check = CommentReaction::where('user_id',$user->id)->where('post_id',$request->post_id)->first();

        if(!empty($check)){

            $prev_reaction = $check->comment_reaction;
            //return $prev_reaction;
            if($prev_reaction == 'like'){
                
                if($request->reaction_type == 'like' ){

                }
                elseif($request->reaction_type == 'dislike'){
                    $post->total_likes = $post->total_likes - 1; 
                    $post->total_dislikes = $post->total_dislikes + 1; 
                    $post->save();

                    $check->comment_reaction =  $request->reaction_type;
                    $check->update();
                    //return $post->total_likes;
                    $array['like'] = $post->total_likes;
                    $array['dislike'] = $post->total_dislikes;
                    $array['love'] = $post->total_loves;
                    $array['angry'] = $post->total_angry;
                    $array['sad'] = $post->total_sad;
                    $array['happy'] = $post->total_happy;
                    return $array;

                }
                elseif($request->reaction_type == 'love'){

                    $post->total_loves = $post->total_loves + 1; 
                    $post->total_likes = $post->total_likes - 1; 
                    $post->save();
                    $check->comment_reaction =  $request->reaction_type;
                    $check->update();
                    //return $post->total_likes;
                    $array['like'] = $post->total_likes;
                    $array['dislike'] = $post->total_dislikes;
                    $array['love'] = $post->total_loves;
                    $array['angry'] = $post->total_angry;
                    $array['sad'] = $post->total_sad;
                    $array['happy'] = $post->total_happy;
                    return $array;

                }
                elseif($request->reaction_type == 'happy'){

                    $post->total_happy = $post->total_happy + 1; 
                    $post->total_likes = $post->total_likes - 1; 
                    $post->save();
                    $check->comment_reaction =  $request->reaction_type;
                    $check->update();
                    //return $post->total_likes;
                    $array['like'] = $post->total_likes;
                    $array['dislike'] = $post->total_dislikes;
                    $array['love'] = $post->total_loves;
                    $array['angry'] = $post->total_angry;
                    $array['sad'] = $post->total_sad;
                    $array['happy'] = $post->total_happy;
                    return $array;

                }
                elseif($request->reaction_type == 'sad'){

                    $post->total_sad = $post->total_sad + 1; 
                    $post->total_likes = $post->total_likes - 1; 
                    $post->save();
                    $check->comment_reaction =  $request->reaction_type;
                    $check->update();
                    //return $post->total_likes;
                    $array['like'] = $post->total_likes;
                    $array['dislike'] = $post->total_dislikes;
                    $array['love'] = $post->total_loves;
                    $array['angry'] = $post->total_angry;
                    $array['sad'] = $post->total_sad;
                    $array['happy'] = $post->total_happy;
                    return $array;

                }
                elseif($request->reaction_type == 'angry'){

                    $post->total_angry = $post->total_angry + 1; 
                    $post->total_likes = $post->total_likes - 1; 
                    $post->save();
                    $check->comment_reaction =  $request->reaction_type;
                    $check->update();
                    //return $post->total_likes;
                    $array['like'] = $post->total_likes;
                    $array['dislike'] = $post->total_dislikes;
                    $array['love'] = $post->total_loves;
                    $array['angry'] = $post->total_angry;
                    $array['sad'] = $post->total_sad;
                    $array['happy'] = $post->total_happy;
                    return $array;

                }
            }
            elseif($prev_reaction == "dislike"){
                if($request->reaction_type == 'like' ){

                    $post->total_likes = $post->total_likes + 1; 
                    $post->total_dislikes = $post->total_dislikes - 1; 
                    $post->save();
                    $check->comment_reaction =  $request->reaction_type;
                    $check->update();
                    //return $post->total_likes;
                    $array['like'] = $post->total_likes;
                    $array['dislike'] = $post->total_dislikes;
                    $array['love'] = $post->total_loves;
                    $array['angry'] = $post->total_angry;
                    $array['sad'] = $post->total_sad;
                    $array['happy'] = $post->total_happy;
                    return $array;

                }
                elseif($request->reaction_type == 'love'){

                    $post->total_loves = $post->total_loves + 1; 
                    $post->total_dislikes = $post->total_dislikes - 1; 
                    $post->save();
                    $check->comment_reaction =  $request->reaction_type;
                    $check->update();
                    //return $post->total_likes;
                    $array['like'] = $post->total_likes;
                    $array['dislike'] = $post->total_dislikes;
                    $array['love'] = $post->total_loves;
                    $array['angry'] = $post->total_angry;
                    $array['sad'] = $post->total_sad;
                    $array['happy'] = $post->total_happy;
                    return $array;

                }
                elseif($request->reaction_type == 'happy'){

                    $post->total_dislikes = $post->total_dislikes - 1; 
                    $post->total_happy = $post->total_happy + 1; 
                    $post->save();
                    $check->comment_reaction =  $request->reaction_type;
                    $check->update();
                    //return $post->total_likes;
                    $array['like'] = $post->total_likes;
                    $array['dislike'] = $post->total_dislikes;
                    $array['love'] = $post->total_loves;
                    $array['angry'] = $post->total_angry;
                    $array['sad'] = $post->total_sad;
                    $array['happy'] = $post->total_happy;
                    return $array;

                }
                elseif($request->reaction_type == 'sad'){

                    $post->total_sad = $post->total_sad + 1; 
                    $post->total_dislikes = $post->total_dislikes - 1; 
                    $post->save();
                    $check->comment_reaction =  $request->reaction_type;
                    $check->update();
                    //return $post->total_likes;
                    $array['like'] = $post->total_likes;
                    $array['dislike'] = $post->total_dislikes;
                    $array['love'] = $post->total_loves;
                    $array['angry'] = $post->total_angry;
                    $array['sad'] = $post->total_sad;
                    $array['happy'] = $post->total_happy;
                    return $array;

                }
                elseif($request->reaction_type == 'angry'){

                    $post->total_angry = $post->total_angry + 1; 
                    $post->total_dislikes = $post->total_dislikes - 1; 
                    $post->save();
                    $check->comment_reaction =  $request->reaction_type;
                    $check->update();
                    //return $post->total_likes;
                    $array['like'] = $post->total_likes;
                    $array['dislike'] = $post->total_dislikes;
                    $array['love'] = $post->total_loves;
                    $array['angry'] = $post->total_angry;
                    $array['sad'] = $post->total_sad;
                    $array['happy'] = $post->total_happy;
                    return $array;

                }

            }
            elseif($prev_reaction == "love"){

                if($request->reaction_type == 'like' ){

                    $post->total_likes = $post->total_likes + 1; 
                    $post->total_loves = $post->total_loves - 1; 
                    $post->save();
                    $check->comment_reaction =  $request->reaction_type;
                    $check->update();
                    //return $post->total_likes;
                    $array['like'] = $post->total_likes;
                    $array['dislike'] = $post->total_dislikes;
                    $array['love'] = $post->total_loves;
                    $array['angry'] = $post->total_angry;
                    $array['sad'] = $post->total_sad;
                    $array['happy'] = $post->total_happy;
                    return $array;

                }
                elseif($request->reaction_type == 'dislike'){

                    $post->total_loves = $post->total_loves - 1; 
                    $post->total_dislikes = $post->total_dislikes + 1; 
                    $post->save();
                    $check->comment_reaction =  $request->reaction_type;
                    $check->update();
                    //return $post->total_likes;
                    $array['like'] = $post->total_likes;
                    $array['dislike'] = $post->total_dislikes;
                    $array['love'] = $post->total_loves;
                    $array['angry'] = $post->total_angry;
                    $array['sad'] = $post->total_sad;
                    $array['happy'] = $post->total_happy;
                    return $array;

                }
                elseif($request->reaction_type == 'happy'){

                    $post->total_loves = $post->total_loves - 1; 
                    $post->total_happy = $post->total_happy + 1; 
                    $post->save();
                    $check->comment_reaction =  $request->reaction_type;
                    $check->update();
                    //return $post->total_likes;
                    $array['like'] = $post->total_likes;
                    $array['dislike'] = $post->total_dislikes;
                    $array['love'] = $post->total_loves;
                    $array['angry'] = $post->total_angry;
                    $array['sad'] = $post->total_sad;
                    $array['happy'] = $post->total_happy;
                    return $array;

                }
                elseif($request->reaction_type == 'sad'){

                    $post->total_sad = $post->total_sad + 1; 
                    $post->total_loves = $post->total_loves - 1; 
                    $post->save();
                    $check->comment_reaction =  $request->reaction_type;
                    $check->update();
                    //return $post->total_likes;
                    $array['like'] = $post->total_likes;
                    $array['dislike'] = $post->total_dislikes;
                    $array['love'] = $post->total_loves;
                    $array['angry'] = $post->total_angry;
                    $array['sad'] = $post->total_sad;
                    $array['happy'] = $post->total_happy;
                    return $array;

                }
                elseif($request->reaction_type == 'angry'){

                    $post->total_angry = $post->total_angry + 1; 
                    $post->total_loves = $post->total_loves - 1; 
                    $post->save();
                    $check->comment_reaction =  $request->reaction_type;
                    $check->update();
                    //return $post->total_likes;
                    $array['like'] = $post->total_likes;
                    $array['dislike'] = $post->total_dislikes;
                    $array['love'] = $post->total_loves;
                    $array['angry'] = $post->total_angry;
                    $array['sad'] = $post->total_sad;
                    $array['happy'] = $post->total_happy;
                    return $array;

                }

            }
            elseif($prev_reaction == "happy"){
                if($request->reaction_type == 'like' ){

                    $post->total_likes = $post->total_likes + 1; 
                    $post->total_happy = $post->total_happy - 1; 
                    $post->save();
                    $check->comment_reaction =  $request->reaction_type;
                    $check->update();
                    //return $post->total_likes;
                    $array['like'] = $post->total_likes;
                    $array['dislike'] = $post->total_dislikes;
                    $array['love'] = $post->total_loves;
                    $array['angry'] = $post->total_angry;
                    $array['sad'] = $post->total_sad;
                    $array['happy'] = $post->total_happy;
                    return $array;

                }
                elseif($request->reaction_type == 'dislike'){

                    $post->total_happy = $post->total_happy - 1; 
                    $post->total_dislikes = $post->total_dislikes + 1; 
                    $post->save();
                    $check->comment_reaction =  $request->reaction_type;
                    $check->update();
                    //return $post->total_likes;
                    $array['like'] = $post->total_likes;
                    $array['dislike'] = $post->total_dislikes;
                    $array['love'] = $post->total_loves;
                    $array['angry'] = $post->total_angry;
                    $array['sad'] = $post->total_sad;
                    $array['happy'] = $post->total_happy;
                    return $array;

                }
                elseif($request->reaction_type == 'love'){

                    $post->total_loves = $post->total_loves + 1; 
                    $post->total_happy = $post->total_happy - 1; 
                    $post->save();
                    $check->comment_reaction =  $request->reaction_type;
                    $check->update();
                    //return $post->total_likes;
                    $array['like'] = $post->total_likes;
                    $array['dislike'] = $post->total_dislikes;
                    $array['love'] = $post->total_loves;
                    $array['angry'] = $post->total_angry;
                    $array['sad'] = $post->total_sad;
                    $array['happy'] = $post->total_happy;
                    return $array;

                }
                elseif($request->reaction_type == 'sad'){

                    $post->total_sad = $post->total_sad + 1; 
                    $post->total_happy = $post->total_happy - 1; 
                    $post->save();
                    $check->comment_reaction =  $request->reaction_type;
                    $check->update();
                    //return $post->total_likes;
                    $array['like'] = $post->total_likes;
                    $array['dislike'] = $post->total_dislikes;
                    $array['love'] = $post->total_loves;
                    $array['angry'] = $post->total_angry;
                    $array['sad'] = $post->total_sad;
                    $array['happy'] = $post->total_happy;
                    return $array;

                }
                elseif($request->reaction_type == 'angry'){

                    $post->total_angry = $post->total_angry + 1; 
                    $post->total_happy = $post->total_happy - 1; 
                    $post->save();
                    $check->comment_reaction =  $request->reaction_type;
                    $check->update();
                    //return $post->total_likes;
                    $array['like'] = $post->total_likes;
                    $array['dislike'] = $post->total_dislikes;
                    $array['love'] = $post->total_loves;
                    $array['angry'] = $post->total_angry;
                    $array['sad'] = $post->total_sad;
                    $array['happy'] = $post->total_happy;
                    return $array;

                }
            }
            elseif($prev_reaction == "angry"){

                if($request->reaction_type == 'like' ){

                    $post->total_likes = $post->total_likes + 1; 
                    $post->total_angry = $post->total_angry - 1; 
                    $post->save();
                    $check->comment_reaction =  $request->reaction_type;
                    $check->update();
                    //return $post->total_likes;
                    $array['like'] = $post->total_likes;
                    $array['dislike'] = $post->total_dislikes;
                    $array['love'] = $post->total_loves;
                    $array['angry'] = $post->total_angry;
                    $array['sad'] = $post->total_sad;
                    $array['happy'] = $post->total_happy;
                    return $array;

                }
                elseif($request->reaction_type == 'dislike'){

                    $post->total_angry = $post->total_angry - 1; 
                    $post->total_dislikes = $post->total_dislikes + 1; 
                    $post->save();
                    $check->comment_reaction =  $request->reaction_type;
                    $check->update();
                    //return $post->total_likes;
                    $array['like'] = $post->total_likes;
                    $array['dislike'] = $post->total_dislikes;
                    $array['love'] = $post->total_loves;
                    $array['angry'] = $post->total_angry;
                    $array['sad'] = $post->total_sad;
                    $array['happy'] = $post->total_happy;
                    return $array;

                }
                elseif($request->reaction_type == 'love'){

                    $post->total_loves = $post->total_loves + 1; 
                    $post->total_angry = $post->total_angry - 1; 
                    $post->save();
                    $check->comment_reaction =  $request->reaction_type;
                    $check->update();
                    //return $post->total_likes;
                    $array['like'] = $post->total_likes;
                    $array['dislike'] = $post->total_dislikes;
                    $array['love'] = $post->total_loves;
                    $array['angry'] = $post->total_angry;
                    $array['sad'] = $post->total_sad;
                    $array['happy'] = $post->total_happy;
                    return $array;

                }
                elseif($request->reaction_type == 'happy'){

                    $post->total_angry = $post->total_angry - 1; 
                    $post->total_happy = $post->total_happy + 1; 
                    $post->save();
                    $check->comment_reaction =  $request->reaction_type;
                    $check->update();
                    //return $post->total_likes;
                    $array['like'] = $post->total_likes;
                    $array['dislike'] = $post->total_dislikes;
                    $array['love'] = $post->total_loves;
                    $array['angry'] = $post->total_angry;
                    $array['sad'] = $post->total_sad;
                    $array['happy'] = $post->total_happy;
                    return $array;

                }
                elseif($request->reaction_type == 'sad'){

                    $post->total_sad = $post->total_sad + 1; 
                    $post->total_angry = $post->total_angry - 1; 
                    $post->save();
                    $check->comment_reaction =  $request->reaction_type;
                    $check->update();
                    //return $post->total_likes;
                    $array['like'] = $post->total_likes;
                    $array['dislike'] = $post->total_dislikes;
                    $array['love'] = $post->total_loves;
                    $array['angry'] = $post->total_angry;
                    $array['sad'] = $post->total_sad;
                    $array['happy'] = $post->total_happy;
                    return $array;

                }

            }
            elseif($prev_reaction == "sad"){

                if($request->reaction_type == 'like' ){

                    $post->total_sad = $post->total_sad - 1; 
                    $post->total_likes = $post->total_likes + 1; 
                    $post->save();

                    $check->comment_reaction =  $request->reaction_type;
                    $check->update();
                    //return $post->total_likes;
                    $array['like'] = $post->total_likes;
                    $array['dislike'] = $post->total_dislikes;
                    $array['love'] = $post->total_loves;
                    $array['angry'] = $post->total_angry;
                    $array['sad'] = $post->total_sad;
                    $array['happy'] = $post->total_happy;
                    return $array;

                }
                elseif($request->reaction_type == 'dislike'){
                    $post->total_sad = $post->total_sad - 1; 
                    $post->total_dislikes = $post->total_dislikes + 1; 
                    $post->save();

                    $check->comment_reaction =  $request->reaction_type;
                    $check->update();
                    //return $post->total_likes;
                    $array['like'] = $post->total_likes;
                    $array['dislike'] = $post->total_dislikes;
                    $array['love'] = $post->total_loves;
                    $array['angry'] = $post->total_angry;
                    $array['sad'] = $post->total_sad;
                    $array['happy'] = $post->total_happy;
                    return $array;

                }
                elseif($request->reaction_type == 'love'){

                    $post->total_loves = $post->total_loves + 1; 
                    $post->total_sad = $post->total_sad - 1; 
                    $post->save();
                    $check->comment_reaction =  $request->reaction_type;
                    $check->update();
                    //return $post->total_likes;
                    $array['like'] = $post->total_likes;
                    $array['dislike'] = $post->total_dislikes;
                    $array['love'] = $post->total_loves;
                    $array['angry'] = $post->total_angry;
                    $array['sad'] = $post->total_sad;
                    $array['happy'] = $post->total_happy;
                    return $array;

                }
                elseif($request->reaction_type == 'happy'){

                    $post->total_happy = $post->total_happy + 1; 
                    $post->total_sad = $post->total_sad - 1; 
                    $post->save();
                    $check->comment_reaction =  $request->reaction_type;
                    $check->update();
                    //return $post->total_likes;
                    $array['like'] = $post->total_likes;
                    $array['dislike'] = $post->total_dislikes;
                    $array['love'] = $post->total_loves;
                    $array['angry'] = $post->total_angry;
                    $array['sad'] = $post->total_sad;
                    $array['happy'] = $post->total_happy;
                    return $array;

                }
                
                elseif($request->reaction_type == 'angry'){

                    $post->total_angry = $post->total_angry + 1; 
                    $post->total_sad = $post->total_sad - 1; 
                    $post->save();
                    $check->comment_reaction =  $request->reaction_type;
                    $check->update();
                    //return $post->total_likes;
                    $array['like'] = $post->total_likes;
                    $array['dislike'] = $post->total_dislikes;
                    $array['love'] = $post->total_loves;
                    $array['angry'] = $post->total_angry;
                    $array['sad'] = $post->total_sad;
                    $array['happy'] = $post->total_happy;
                    return $array;

                }

            }
        }
        else{
            if($request->reaction_type == 'like'){
                
                $data['user_id'] = $user->id;
                $data['post_id'] = $request->post_id;
                $data['comment_reaction'] = $request->reaction_type;

                $a = CommentReaction::create($data);
                $post->total_likes = $post->total_likes + 1; 
          
                $post->save();
                $array['like'] = $post->total_likes;
                $array['dislike'] = $post->total_dislikes;
                $array['love'] = $post->total_loves;
                $array['angry'] = $post->total_angry;
                $array['sad'] = $post->total_sad;
                $array['happy'] = $post->total_happy;
                return $array;
            
            }
            elseif($request->reaction_type == "dislike"){

                $data['user_id'] = $user->id;
                $data['post_id'] = $request->post_id;
                $data['comment_reaction'] = $request->reaction_type;

                $a = CommentReaction::create($data);
                $post->total_dislikes = $post->total_dislikes + 1; 
          
                $post->save();
                $array['like'] = $post->total_likes;
                $array['dislike'] = $post->total_dislikes;
                $array['love'] = $post->total_loves;
                $array['angry'] = $post->total_angry;
                $array['sad'] = $post->total_sad;
                $array['happy'] = $post->total_happy;
                return $array;

            }
            elseif($request->reaction_type == "love"){

                $data['user_id'] = $user->id;
                $data['post_id'] = $request->post_id;
                $data['comment_reaction'] = $request->reaction_type;

                $a = CommentReaction::create($data);
                $post->total_loves = $post->total_loves + 1; 
          
                $post->save();
                $array['like'] = $post->total_likes;
                $array['dislike'] = $post->total_dislikes;
                $array['love'] = $post->total_loves;
                $array['angry'] = $post->total_angry;
                $array['sad'] = $post->total_sad;
                $array['happy'] = $post->total_happy;
                return $array;
            }
            elseif($request->reaction_type == "happy"){

                $data['user_id'] = $user->id;
                $data['post_id'] = $request->post_id;
                $data['comment_reaction'] = $request->reaction_type;

                $a = CommentReaction::create($data);
                $post->total_happy = $post->total_happy + 1; 
          
                $post->save();
                $array['like'] = $post->total_likes;
                $array['dislike'] = $post->total_dislikes;
                $array['love'] = $post->total_loves;
                $array['angry'] = $post->total_angry;
                $array['sad'] = $post->total_sad;
                $array['happy'] = $post->total_happy;
                return $array;

            }
            elseif($request->reaction_type == "angry"){

                $data['user_id'] = $user->id;
                $data['post_id'] = $request->post_id;
                $data['comment_reaction'] = $request->reaction_type;

                $a = CommentReaction::create($data);
                $post->total_angry = $post->total_angry + 1; 
          
                $post->save();
                $array['like'] = $post->total_likes;
                $array['dislike'] = $post->total_dislikes;
                $array['love'] = $post->total_loves;
                $array['angry'] = $post->total_angry;
                $array['sad'] = $post->total_sad;
                $array['happy'] = $post->total_happy;
                return $array;

            }
            elseif($request->reaction_type == "sad"){

                $data['user_id'] = $user->id;
                $data['post_id'] = $request->post_id;
                $data['comment_reaction'] = $request->reaction_type;

                $a = CommentReaction::create($data);
                $post->total_sad = $post->total_sad + 1; 
          
                $post->save();
                $array['like'] = $post->total_likes;
                $array['dislike'] = $post->total_dislikes;
                $array['love'] = $post->total_loves;
                $array['angry'] = $post->total_angry;
                $array['sad'] = $post->total_sad;
                $array['happy'] = $post->total_happy;
                return $array;

            }
        }


    }

     public function payToRead($amount,$owner_id,$id){

        $user = \Auth::user();
        //return $user;
        // $data['user_id'] = $user->id;
        // $data['type'] = "db";
        // $data['description'] = "Blog Read Fee";
        // $data['amount'] = $amount;
        // $date = date("Y-m-d");
        // $data['datwise'] = $date;
        // $withdraw = Balance::create($data);
        // //return $withdraw;
        // $data1['user_id'] = $owner_id;
        // $data1['type'] = "cr";
        // $data1['description'] = "Blog Read Fee Collected!";
        // $data1['amount'] = $amount;
        // $date = date("Y-m-d");
        // $data1['datwise'] = $date;
        // $withdraw = Balance::create($data1);

        // return "Done";


        if($amount != 0)
        {   
            $transaction_id = $this->generateUniqueString($this->permitted_chars, 16);
            $getStoreComm =  DB::table('users')->where('email','hi5@hi5.com')->get()->first();
            $storId = $getStoreComm->id;

            $getBlogData = DB::table('blog_posts')->where('id',$id)->first();
            $blogCommission = $getBlogData->read_amount * $getBlogData->referral_per / 100;

            $checkReferal = DB::table('referral_post')->where('user_id',$user->id)->where('event_id', $id)->where('post_type','blog')->first();
            if($checkReferal)
            {
              
                $bCommission = $getBlogData->referral_per/2;
                $finalComm = $getBlogData->read_amount * $bCommission / 100;
                $adminCommission = $finalComm / 2;
                $ownerAmount = $amount - $blogCommission;
                
                $data['user_id'] = $user->id;
                $data['type'] = "db";
                $data['description'] = "Give Blog Refered Payment";
                $data['amount'] = $finalComm;
                $date = date("Y-m-d");
                $data['datwise'] = $date;
                $data['transaction_id'] = $transaction_id;
                $data['transaction_by'] = Auth::user()->id;
                $data['posted_by']      = Auth::user()->id;
                $withdraw = Balance::create($data);
                $data['user_id'] = $checkReferal->referred_id;
                $data['type'] = "cr";
                $data['description'] = "Blog Refered Payment";
                $data['amount'] = $finalComm;
                $date = date("Y-m-d");
                $data['datwise'] = $date;
                $data['transaction_id'] = $transaction_id;
                $data['transaction_by'] = Auth::user()->id;
                $data['posted_by']      = Auth::user()->id;
                $withdraw = Balance::create($data);
                
                $data['user_id'] = $user->id;
                $data['type'] = "db";
                $data['description'] = "Give Blog Refered Payment";
                $data['amount'] = $adminCommission;
                $date = date("Y-m-d");
                $data['datwise'] = $date;
                $data['transaction_id'] = $transaction_id;
                $data['transaction_by'] = Auth::user()->id;
                $data['posted_by']      = Auth::user()->id;
                $withdraw = Balance::create($data);
                $data['user_id'] = $storId;
                $data['type'] = "cr";
                $data['description'] = "Blog Refered Payment";
                $data['amount'] = $adminCommission;
                $date = date("Y-m-d");
                $data['datwise'] = $date;
                $data['transaction_id'] = $transaction_id;
                $data['transaction_by'] = Auth::user()->id;
                $data['posted_by']      = Auth::user()->id;
                $withdraw = Balance::create($data);
                
                $data['user_id'] = $user->id;
                $data['type'] = "db";
                $data['description'] = "Give Blog Refered Payment";
                $data['amount'] = $adminCommission;
                $date = date("Y-m-d");
                $data['datwise'] = $date;
                $data['transaction_id'] = $transaction_id;
                $data['transaction_by'] = Auth::user()->id;
                $data['posted_by']      = Auth::user()->id;
                $withdraw = Balance::create($data);
                $data['user_id'] = $owner_id;
                $data['type'] = "cr";
                $data['description'] = "Blog Refered Payment";
                $data['amount'] = $adminCommission;
                $date = date("Y-m-d");
                $data['datwise'] = $date;
                $data['transaction_id'] = $transaction_id;
                $data['transaction_by'] = Auth::user()->id;
                $data['posted_by']      = Auth::user()->id;
                $withdraw = Balance::create($data);

                $data['user_id'] = $user->id;
                $data['type'] = "db";
                $data['description'] = "Blog Read Fee";
                $data['amount'] = $ownerAmount;
                $date = date("Y-m-d");
                $data['datwise'] = $date;
                $data['transaction_id'] = $transaction_id;
                $data['transaction_by'] = Auth::user()->id;
                $data['posted_by']      = Auth::user()->id;
                $withdraw = Balance::create($data);
                $data1['user_id'] = $owner_id;
                $data1['type'] = "cr";
                $data1['description'] = "Blog Read Fee Collected!";
                $data1['amount'] = $ownerAmount;
                $date = date("Y-m-d");
                $data1['datwise'] = $date;
                $data1['transaction_id'] = $transaction_id;
                $data1['transaction_by'] = Auth::user()->id;
                $data1['posted_by']      = Auth::user()->id;
                $withdraw = Balance::create($data1);
            }
            else
            {
                $ownerAmount = $amount - $blogCommission;


                $data['user_id'] = $user->id;
                $data['type'] = "db";
                $data['description'] = "Blog Read Fee";
                $data['amount'] = $ownerAmount;
                $date = date("Y-m-d");
                $data['datwise'] = $date;
                $data['transaction_id'] = $transaction_id;
                $data['transaction_by'] = Auth::user()->id;
                $data['posted_by']      = Auth::user()->id;
                $withdraw = Balance::create($data);
                $data1['user_id'] = $owner_id;
                $data1['type'] = "cr";
                $data1['description'] = "Blog Read Fee Collected!";
                $data1['amount'] = $ownerAmount;
                $date = date("Y-m-d");
                $data1['datwise'] = $date;
                $data1['transaction_id'] = $transaction_id;
                $data1['transaction_by'] = Auth::user()->id;
                $data1['posted_by']      = Auth::user()->id;
                $withdraw = Balance::create($data1);

                $data['user_id'] = $user->id;
                $data['type'] = "db";
                $data['description'] = "Blog Read Fee Commission";
                $data['amount'] = $blogCommission;
                $date = date("Y-m-d");
                $data['datwise'] = $date;
                $data['transaction_id'] = $transaction_id;
                $data['transaction_by'] = Auth::user()->id;
                $data['posted_by']      = Auth::user()->id;
                $withdraw = Balance::create($data);
                $data1['user_id'] = $storId;
                $data1['type'] = "cr";
                $data1['description'] = "Blog Read Fee Collected!";
                $data1['amount'] = $blogCommission;
                $date = date("Y-m-d");
                $data1['datwise'] = $date;
                $data1['transaction_id'] = $transaction_id;
                $data1['transaction_by'] = Auth::user()->id;
                $data1['posted_by']      = Auth::user()->id;
                $withdraw = Balance::create($data1);

            }
        }
        return "Done";


    }
         public function storeModelBlog(Request $request)
    {
        $blogSubject = $request->blogSubject;
        $bloginformation = $request->bloginformation;
        $blogfeetype = $request->blogfeetype;
        if($blogfeetype == 'Free')
        {
            $blogFee = 0;
        }
        else
        {
            $blogFee = $request->blogfee;
        }
        $referral = $request->referral;

        if ($request->blog_id) {
            $storeblog = Blog::find($request->blog_id);
        } else {
            $storeblog = new Blog();
        }
        //Saving Buy Image
        if ($request->hasFile('blogphoto')) {
            $image = $request->file('blogphoto');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('uploads/blog/' . $filename);
            // Image::make($image)->resize(640, 480)->save($location);
            compress($image,$location); 
            $storeblog->image = $filename;
        }
        $storeblog->user_id = auth()->user()->id;
        $storeblog->heading = $blogSubject;
        $storeblog->post_category = $request->blog_post_category;
        $storeblog->content = $bloginformation;
        $storeblog->read_amount = $blogFee;
        $storeblog->referral_per = $referral;
        $storeblog->save();
        return response()->json(['status' => 'success']);
    }
    public function deleteModelBlog(Request $request)
    {
        $id = $request->blogId;
        $eventDelete = Blog::where('id', $id)->delete();
        return response()->json('success');
    }

    public function editModelBlog(Request $request)
    {
        $id = $request->id;
        $userId = $request->userId;
        $user = \Auth::user();
        $modelEventEdit =  DB::table('blog_posts')->where('id',$id)->get();

        foreach ($modelEventEdit as  $value);

        $data['id'] = $value->id;
        $data['user_id'] = $value->user_id;
        $data['heading'] = $value->heading;
        $data['content'] = $value->content;
        $data['image'] = '/uploads/blog/'.$value->image;
        $data['created_at'] = $value->created_at;
        $data['read_amount'] = $value->read_amount;
        $data['referral_per'] = $value->referral_per;
        return response()->json($data);
    }
    public function generateUniqueString($input, $strength = 16) {
        $input_length = strlen($input);
        $random_string = '';
        for($i = 0; $i < $strength; $i++) {
            $random_character = $input[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }

        return $random_string;
    }

    public function insertReferralBlog($owner_id,$blogId,$referralEmail)
    {
         if($referralEmail != 0 || !empty($referralEmail))
        {
            $user = \Auth::user();
            $userData = User::where('email',$referralEmail)->first();
            $reffedId = $userData->id;
            $userId = $user->id;
            $checkExist = ReferralPost::where('event_id',$blogId)->where('user_id',$userId)->where('post_type','blog')->first();
            //echo $checkExist->id;
            if(!empty($checkExist))
            {
                $referral = ReferralPost::find($checkExist->id);
                $referral->user_id = $userId;
                $referral->referred_id = $reffedId;
                $referral->event_id = $blogId;
                $referral->save();
            }
            else
            {
                ReferralPost::create([
                    'user_id'=> $userId,
                    'referred_id'=> $reffedId,
                    'event_id'=> $blogId,
                    'post_type'=> 'blog',
                ]);
            }
            return response()->json("Done");
        }
    }

}
