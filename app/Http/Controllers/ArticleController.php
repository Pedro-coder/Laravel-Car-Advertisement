<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\User;
use Image;
use Session;
use Storage;
use Illuminate\Support\Facades\DB;
use Auth;

use App\Http\Controllers\HelperClass;
class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // //create a variable and store all the blog posts in it from the database
        // $articles = Article::orderBy('id', 'desc')->paginate(10);
        // //return a view and pass in the above variable
        // return view('pages.article.index')->withArticles($articles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $opacity_value = DB::table('site_info')->where('attr_name', 'form_opacity')->get()->toArray();
        return view('pages.article.create')->with('opacity', $opacity_value[0]->attr_value);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $settings = HelperClass::getSettings();
        if ($settings->file_size) {
            $fileSize = $settings->file_size;
        }else{
            $fileSize = '20000';
        }
        // validate the data
        $this->validate($request, array(
            'article_featured_image'          => 'mimes:jpeg,jpg,png,gif|required|max:'.$fileSize, // max 20000kb/2MB
            'article_category'                => 'required|max:255',
            'article_website'                 => "nullable", //"|regex:".$regex
            'article_title'                   => 'required|min:5|max:255',
            'article_description'             => 'required|min:5|max:255',
            'article_info_from'               => 'nullable|max:255',
            'article_info_description'        => 'nullable|min:5|max:255',
           ));
          // store in the database
            
            $article = new Article;

            $article->user()->associate($request->user());
            $article->article_category          = $request->article_category;
            $article->article_website           = $request->article_website;
            $article->article_title             = $request->article_title;
            $article->article_description       = $request->article_description;
            $article->article_info_from         = $request->article_info_from;
            $article->article_info_description  = $request->article_info_description;

            //Save our Image
            
            if ($request->hasFile('article_featured_image')) {
            $image = $request->file('article_featured_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('uploads/article/' . $filename);
            Image::make($image)->resize(280,320)->save($location);

            $article->article_featured_image = $filename;
            }

            $article->save();


            Session::flash('success', 'The post was successfully published!');
            // redirect to another page
             return redirect()->route('article.show', $article->id);
            // return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    
        $users = User::all();
        $article = Article::find($id);
        return view('pages.article.show',array('user' => Auth::User()))->withArticle($article)->withUsers($users);
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);
        return view('pages.article.edit')->withArticle($article);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
      // validate the data
      $this->validate($request, array(
          'article_featured_image'          => 'sometimes|image',
          'article_category'                => 'required|max:255',
          'article_website'                 => 'required',
          'article_title'                   => 'required|min:5|max:255',
          'article_description'             => 'required|min:5|max:255',
          'article_info_from'               => 'nullable|max:255',
          'article_info_description'        => 'nullable|min:5|max:255',
         ));

         // save data to the database.
         $article = Article::find($id);

         $article->article_category               = $request->input('article_category');
         $article->article_website                = $request->input('article_website');
         $article->article_title                  = $request->input('article_title');
         $article->article_description            = $request->input('article_description');
         $article->article_info_from              = $request->input('article_info_from');
         $article->article_info_description       = $request->input('article_info_description');


         if ($request->hasFile('article_featured_image')) {
           //add new photo
           $image = $request->file('article_featured_image');
           $filename = time() . '.' . $image->getClientOriginalExtension();
           $location = public_path('uploads/article/' . $filename);
           Image::make($image)->save($location);
           $oldfilename = $article->article_featured_image;
           //update the database
           $article->article_featured_image = $filename;
           //delete the olf photo
           Storage::delete($oldfilename);
         }

         $article->save();

         //set flash data with success message
         Session::flash('success', 'This post was successfully changed.');
         //redirect with flash data to posts.show
         return redirect()->route('article.show', $article->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $article = Article::find($id);
      Storage::delete($article->article_featured_image);

      $article->delete();

      Session::flash('success', 'The Article post was sucessfully deleted.');

      return redirect()->route('article.index');
    }
}
