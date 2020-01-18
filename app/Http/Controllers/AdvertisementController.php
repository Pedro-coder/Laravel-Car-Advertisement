<?php

namespace App\Http\Controllers;

use App\Advertisement;
use Illuminate\Http\Request;
use Auth;
use Image;
use Session;
use Storage;

class AdvertisementController extends Controller
{
    public $model;
    public $data = [];
    public function __construct()
    {
        $this->middleware('auth');
        $this->model = new Advertisement();

    }

    public function index(){

        $user = Auth::User();
        $std = new \stdClass();
        $std->IsAdmin = $this->model->isUserHasPermission($user->id)->count();
        if($std->IsAdmin == 1)
        {
            $this->data['rows'] = $this->model->all();
        }
        else
        {
            $this->data['rows'] = $this->model::where('user_id',$user->id)->get();
        }
        //$std->IsAdmin = 1;
        $this->data['user'] = $std;
        return view('pages.advertisement.index',$this->data);
    }

    public function deleteAdd(){
        $id = $_POST['id'];
        $res = $this->model::where('id',$id)->delete();
        $data["success"] = $res ;
        echo json_encode($data);
    }

    public function getAdsData(){
        $id = $_POST['id'];
        $res = $this->model::where('id',$id)->get()->toArray();
        $data['response'] = $res;
        echo json_encode($data);
    }


    public function saveAds($request)
    {
        $std = new \stdClass();
        $user = Auth::User();
        $std->IsAdmin = $this->model->isUserHasPermission($user->id)->count();
        $this->data['user'] = $std;
        $id = $request->input("serial", 0);

        $rowData = [
            'user_id' => $user->id,
            'email' => $user->email,
           'adds_name' => $request->input("ads_name"),
            'adds_type' => $request->input("ads_type"),
            'image_link' => $request->input("link"),
            'embed_code' => $request->input("ads_type_embed_code"),
            'referral_code' => $request->input("ads_type_referral_code"),
            'from_date' => date('Y-m-d',strtotime(trim($request->input("from_date")))),
            'to_date' => date('Y-m-d',strtotime(trim($request->input("to_date")))),
            'position' => $request->input("position"),
            'style' => $request->input("style"),
            'ads_post_on' => $request->input("ads_post_on"),
            'created_at' => date('Y-m-d H:i:s'),
        ];
        if($request->hasFile('file')) {
            $avatar = $request->file('file');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save(public_path('/uploads/adsImages/' . $filename));
            $rowData['image'] = $filename;
        }

            $this->model->saveAdsData($rowData);

            return redirect()->route('AdvertisementPage');
    }

    public function viewAds(Request $request)
    {
        $id = $request->input('id',0);
            $mode = $request->input('mode','next');
            $std = new \stdClass();
            $user = Auth::User();
            $std->IsAdmin = $this->model->isUserHasPermission($user->id)->count();
            $this->data['user'] = $std;
            $this->data['rows'] = $this->model::where('user_id',$user->id)->get();
            if($mode == 'next') {
                $this->data['rowData'] = $this->model::where('id', '>', $id)->orderBy('id', 'ASC')->limit(1)->first();

                if ($this->data['rowData']){
                    $this->data['next_id'] = $this->model->select('id')->where('id','>',$this->data['rowData']->id)->orderBy('id', 'ASC')->limit(1)->get()->pluck('id')->toArray();
                    $this->data['prev_id'] = $this->model->select('id')->where('id','<',$this->data['rowData']->id)->orderBy('id', 'DESC')->limit(1)->get()->pluck('id')->toArray();
                }

            }elseif($mode == 'prev'){
                $this->data['rowData'] = $this->model::where('id', '<', $id)->orderBy('id', 'DESC')->first();

                if ($this->data['rowData']){
                    $this->data['next_id'] = $this->model->select('id')->where('id','>',$this->data['rowData']->id)->orderBy('id','ASC')->limit(1)->get()->pluck('id')->toArray();
                    $this->data['prev_id'] = $this->model->select('id')->where('id','<',$this->data['rowData']->id)->orderBy('id', 'DESC')->limit(1)->get()->pluck('id')->toArray();
                }
            }

            $this->data['controller'] = 'advertisement';
            $contentData = view('pages.advertisement.view',$this->data)->render();
            $bottomContent = view('pages.advertisement.script',$this->data)->render();
            return response()->json([
                'contentData'=>$contentData,
                'bottomData'=>$bottomContent,
            ]);
           /* dd($contentData,$bottomContent);
            return view('pages.advertisement.index', $this->data);*/


    }

    public function updateAds($request)
    {
        $std = new \stdClass();
        $user = Auth::User();
        $std->IsAdmin = $this->model->isUserHasPermission($user->id)->count();
        $this->data['user'] = $std;
        $id = $request->input("serial", 0);
        if($id == 0) {
            Session::flash('error', 'Sorry.! unable to update detail.');
            return redirect()->route('AdvertisementPage');
        }
        $rowData = [
            'adds_name' => $request->input("ads_name"),
            'adds_type' => $request->input("ads_type"),
            'image_link' => $request->input("link"),
            'embed_code' => $request->input("ads_type_embed_code"),
            'referral_code' => $request->input("ads_type_referral_code"),
            'from_date' => date('Y-m-d',strtotime(trim($request->input("from_date")))),
            'to_date' => date('Y-m-d',strtotime(trim($request->input("to_date")))),
            'position' => $request->input("position"),
            'style' => $request->input("style"),
            'ads_post_on' => $request->input("ads_post_on"),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        if($request->hasFile('file')) {
            $avatar = $request->file('file');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save(public_path('/uploads/adsImages/' . $filename));
            $rowData['image'] = $filename;
        }

        $this->model->updateAdsData($rowData,$id);
        Session::flash('success', 'The advertisement has been updated successfully!');
        return redirect()->route('AdvertisementPage');
    }

    public function action(Request $request)
    {
        $std = new \stdClass();
        $user = Auth::User();
        $std->IsAdmin = $this->model->isUserHasPermission($user->id)->count();
        $this->data['user'] = $std;

        $adsAction = $request->input('adsActionBtn');
        if ($adsAction == 'ADD') {
            $result = $this->saveAds($request);
            Session::flash('success', 'The advertisement has been saved successfully!');
            return $result;


        } elseif ($adsAction == 'DELETE') {
            
            $id = $request->input("serial", 0);
            $this->model->where('id', $id)->delete();
            Session::flash('success', 'The advertisement has been deleted successfully!');
            return redirect()->route('AdvertisementPage');

        } elseif ($adsAction == 'EDIT') {
            $result = $this->updateAds($request);
            return $result;
        }
    }
}

