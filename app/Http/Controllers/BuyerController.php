<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Buyer;
use App\User;
use Image;
use Session;
use Storage;
use Auth;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\HelperClass;

class BuyerController extends Controller
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
        //create a variable and store all the blog posts in it from the database
        $buyers = Buyer::orderBy('id', 'desc')->paginate(10);
        //return a view and pass in the above variable
        return view('pages.buyer.index')->withBuyers($buyers);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $opacity_value = DB::table('site_info')->where('attr_name', 'form_opacity')->get()->toArray();
        return view('pages.buyer.create')->with('opacity', $opacity_value[0]->attr_value);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate the data
          // $this->validate($request, array(
          //   'buyer_featured_image'           => 'mimes:jpeg,jpg,png,gif|required|max:20000', // max 20000kb/2MB
          //   // 'buyer_commission_percentage'    => 'required|max:255',
          //   'buyer_item_code'                => 'nullable|string|max:255|unique:buyers',
          //   'buyer_category'                 => 'required',
          //   'buyer_sale_price'               => 'required|integer',
          //   'buyer_website'                  => 'required|max:255',
          //   'buyer_pro_title'                => 'required|min:5|max:255',
          //   'buyer_pro_description'          => 'required|min:5|max:255',
          //   'buyer_location'                 => 'required'
          //  ));

          $settings = HelperClass::getSettings();
        if ($settings->file_size) {
            $fileSize = $settings->file_size;
        }else{
            $fileSize = '20000';
        }
           $validatedData = $request->validate([
            'buyer_featured_image'           => 'mimes:jpeg,jpg,png,gif|required|max:'.$fileSize, // max 20000kb/2MB
            // 'buyer_commission_percentage'    => 'required|max:255',
            'buyer_item_code'                => 'nullable|string|max:255|unique:buyers',
            'buyer_category'                 => 'required',
            'buyer_sale_price'               => 'required|integer',
            'buyer_website'                  => 'required|max:255',
            'buyer_pro_title'                => 'required|min:5|max:255',
            'buyer_pro_description'          => 'required|min:5|max:255',
            'buyer_location'                 => 'required'
          ]);


          // store in the database
            $buyer = new Buyer;

            $buyer->user()->associate($request->user());
            // $buyer->buyer_commission_percentage = $request->buyer_commission_percentage;
            $buyer->buyer_item_code             = $request->buyer_item_code;
            $buyer->buyer_category              = $request->buyer_category;
            $buyer->buyer_sale_price            = $request->buyer_sale_price;
            $buyer->buyer_website               = $request->buyer_website;
            $buyer->buyer_pro_title             = $request->buyer_pro_title;
            $buyer->buyer_pro_description       = $request->buyer_pro_description;
            $buyer->buyer_location              = $request->buyer_location;

            //Save our Image
            if ($request->hasFile('buyer_featured_image')) {
            $image = $request->file('buyer_featured_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('uploads/buyer/' . $filename);
            Image::make($image)->resize(280,320)->save($location);

            $buyer->buyer_featured_image = $filename;
            }

            $buyer->save();


            Session::flash('success', 'The post was successfully published!');
            // redirect to another page
             return redirect()->route('buyer.show', $buyer->id);
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
        $user_id = Auth::User()->id;
        $users = User::all();
        $buyer = Buyer::find($id);
        $post_user = $buyer->user_id;
        if($user_id == $post_user)
        {
          $edit_value = "true";
        }
        else
        {
          $edit_value = "false";
        }
        return view('pages.buyer.show', array('user' => Auth::User()), array('edit_val' =>  $edit_value))
        ->withBuyer($buyer)->withUsers($users);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $buyer = Buyer::find($id);
      if(auth()->user()->id !== $buyer->user_id) {
        return redirect('home')->with('error', 'You are not authorized');
      }
      return view('pages.buyer.edit')->withBuyer($buyer);
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
      //validate the data before use it
      $this->validate($request, array(
        'buyer_featured_image'           => 'sometimes|image',
        // 'buyer_commission_percentage'    => 'required|max:255',
        'buyer_item_code'                => 'required',
        'buyer_category'                 => 'required',
        'buyer_sale_price'               => 'required|integer',
        'buyer_website'                  => 'required|max:255',
        'buyer_pro_title'                => 'required|min:5|max:255',
        'buyer_pro_description'          => 'required',
        'buyer_location'                 => 'required'
      ));


      // save data to the database.
      $buyer = Buyer::find($id);

      // $buyer->buyer_commission_percentage = $request->input('buyer_commission_percentage');
      $buyer->buyer_item_code             = $request->input('buyer_item_code');
      $buyer->buyer_category              = $request->input('buyer_category');
      $buyer->buyer_sale_price            = $request->input('buyer_sale_price');
      $buyer->buyer_website               = $request->input('buyer_website');
      $buyer->buyer_pro_title             = $request->input('buyer_pro_title');
      $buyer->buyer_pro_description       = $request->input('buyer_pro_description');
      $buyer->buyer_location              = $request->input('buyer_location');



      if ($request->hasFile('buyer_featured_image')) {
        //add new photo
        $image = $request->file('buyer_featured_image');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $location = public_path('uploads/buyer/' . $filename);
        Image::make($image)->save($location);
        $oldfilename = $buyer->buyer_featured_image;
        //update the database
        $buyer->buyer_featured_image = $filename;
        //delete the olf photo
        Storage::delete($oldfilename);
      }

      $buyer->save();

      //set flash data with success message
      Session::flash('success', 'This post was successfully changed.');
      //redirect with flash data to posts.show
      return redirect()->route('buyer.show', $buyer->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $buyer = Buyer::find($id);
      Storage::delete($buyer->buyer_featured_image);

      $buyer->delete();

      Session::flash('success', 'The post was sucessfully deleted.');

      return redirect()->route('buyer.index');
    }
}
