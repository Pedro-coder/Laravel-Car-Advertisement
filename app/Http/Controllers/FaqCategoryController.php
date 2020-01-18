<?php

namespace App\Http\Controllers;

use App\FaqCategory;
use App\FaqParent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FaqCategoryController extends Controller
{
    public function index(){
        $faqs = FaqCategory::with('parent')->get();
        $parents = FaqParent::with('categories')->get();
        $parent_arr = [];
        foreach ($parents as $parent){
            $temp_arr = [];
            $temp_arr['name'] = $parent->name;
            foreach ($parent->categories as $cat){
                $temp_arr['children'][] = $cat->name;
            }
            $parent_arr[] = $temp_arr;
        }
        //dd(json_encode($parent_arr));
        return view('pages.Faq-category.index', compact('faqs','parent_arr'));
    }

    public function store(Request $request){
        $this->validator($request->all())->validate();
        $imageName = null;
        if( $request->hasFile('parent_icon')){
            $parent_icon = $request->file('parent_icon')->getClientOriginalName();
            $parent_icon = time().'_'.$parent_icon;
            $path = Storage::disk('public')->putFileAs(
                'faq-category', $request->file('parent_icon'), $parent_icon
            );
        }else{
            $parent_icon = null;
        }

        if( $request->hasFile('category_icon')){
            $category_icon = $request->file('category_icon')->getClientOriginalName();
            $category_icon = time().'_'.$category_icon;
            $path = Storage::disk('public')->putFileAs(
                'faq-category', $request->file('category_icon'), $category_icon
            );
        }else{
            $category_icon = null;
        }

        $parent = FaqParent::updateOrCreate(
            [ 'name' => $request->parent ],
            [
              'name' => $request->parent,
              'icon' => $parent_icon
        ]);
        FaqCategory::create([
            'name' => $request->category,
            'icon' => $category_icon,
            'faq_parent_id' => $parent->id
        ]);
        return redirect()->route('faq.category.index')->with('success','Faq Category has been created.');
    }

    public function storeParent(Request $request){
        $imageName = null;
        if( $request->hasFile('parent_icon')){
            $parent_icon = $request->file('parent_icon')->getClientOriginalName();
            $parent_icon = time().'_'.$parent_icon;
            $path = Storage::disk('public')->putFileAs(
                'faq-category', $request->file('parent_icon'), $parent_icon
            );
        }else{
            $parent_icon = null;
        }

        $parent = FaqParent::updateOrCreate([
              'name' => $request->parent,
              'icon' => $parent_icon
        ]);

        return response()->json(['parent' => $parent]);
    }

    public function edit($id){
        $faq = FaqCategory::findOrFail($id);
        $faqs = FaqCategory::all();
        $parents = FaqParent::with('categories')->get();
        $parent_arr = [];
        foreach ($parents as $parent){
            $temp_arr = [];
            $temp_arr['name'] = $parent->name;
            foreach ($parent->categories as $cat){
                $temp_arr['children'][] = $cat->name;
            }
            $parent_arr[] = $temp_arr;
        }
        return view('pages.Faq-category.edit', compact('faq', 'faqs', 'parent_arr'));
    }

    public function update(Request $request, $id){
        $faq = FaqCategory::findOrFail($id);
        $this->validator($request->all())->validate();
        if( $request->hasFile('parent_icon')){
            $parent_icon = $request->file('parent_icon')->getClientOriginalName();
            $parent_icon = time().'_'.$parent_icon;
            $path = Storage::disk('public')->putFileAs(
                'faq-category', $request->file('parent_icon'), $parent_icon
            );
        }else{
            $parent_icon = $faq->parent->icon;
        }

        if( $request->hasFile('category_icon')){
            $category_icon = $request->file('category_icon')->getClientOriginalName();
            $category_icon = time().'_'.$category_icon;
            $path = Storage::disk('public')->putFileAs(
                'faq-category', $request->file('category_icon'), $category_icon
            );
        }else{
            $category_icon = $faq->icon;
        }
        $parent = FaqParent::updateOrCreate(
            [ 'name' => $request->parent ],
            [
                'name' => $request->parent,
                'icon' => $parent_icon
            ]);
        $faq->update([
            'name' => $request->category,
            'icon' => $category_icon,
            'faq_parent_id' => $parent->id
        ]);
        return redirect()->back()->with('success', 'Faq category has been edit successfully.');
    }

    public function moveCategory(Request $request){
        if ($request->parent == '') {
            $parent = FaqParent::create(['name' => $request->moved]);
            $move = FaqCategory::where('name', $request->moved)->first();
            $move->delete();
            return response()->json(['response' => $parent->id]);
        } else {
            $parent = FaqParent::where('name', $request->parent)->first();
            $move = FaqParent::where('name', $request->moved)->first();

            $moved = FaqCategory::create([
                'name' => $move->name,
                'faq_parent_id' => $parent->id
            ]);

            if ($moved) {
                $move->delete();
                return response()->json(['response' => $moved->id]);
            }

            return response()->json(['response' => fasle]);
        }
    }

    public function destroy($id){
        $faq = FaqCategory::findOrFail($id);
        $faq->delete();
        return back()->with('success', 'Faq category has been deleted successfully.');
    }

    public function destroyByName($name){
      $faq = FaqCategory::where('name', $name)->first();
      if (!$faq) {
          $faq = FaqParent::where('name', $name)->first();
      }
      $faq->delete();
      return response()->json(['result' => 'success']);
    }

    public function destroyParent($name){
      $faq = FaqParent::where('name', $name)->first();
      $faq->delete();
      return response()->json(['result' => 'success']);
    }

    public function validator(array $data){
        return validator::make( $data, [
            'parent' => 'required|string',
            'parent_icon' => 'mimes:png,svg,jpg,jpeg',
            'category' => 'required|string',
            'category_icon' => 'mimes:png,svg,jpg,jpeg',
        ]);
    }
}
