<?php

namespace App\Http\Controllers;

use App\PostCategory;
use Illuminate\Http\Request;
use Session;

class PostCategoryController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request)
    {
        //
            echo $request->deleteId;
            if(!empty($request->deleteId))
            {
                
            }
            else
            {
                $postCat = PostCategory::find($request->catId);
                $postCat->post = $request->postName;
                $postCat->category = $request->sub_category;
                $postCat->main_category = $request->category;
                $postCat->save();

                Session::flash('success', 'Post Category Updated Successfully');
                return redirect()->back();
            }
            
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $postCat = new PostCategory();
            $postCat->post = $request->postName;
            $postCat->category = $request->sub_category;
            $postCat->main_category = $request->category;
            $postCat->save();

            Session::flash('success', 'Post Category Created Successfully');
            return redirect()->back();
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PostCategory  $postCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(PostCategory $postCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PostCategory  $postCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PostCategory $postCat)
    {
            $postCat->post = $request->post;
            $postCat->category = $request->category;
            $postCat->save();

            Session::flash('success', 'Post Category Updated Successfully');
            return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PostCategory  $postCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostCategory $postCategory)
    {
        $postCategory->delete();
        Session::flash('success', 'Post Category Created Deleted');
        return redirect()->back();

    }

    public function show($id)
    {
        //
        $postCategory = PostCategory::find($id);
        $postCategory->delete();
        Session::flash('success', 'Post Category Created Deleted');
        return back();
    }
}
