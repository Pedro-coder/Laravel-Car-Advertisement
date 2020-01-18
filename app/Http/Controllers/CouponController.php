<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;

class CouponController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->middleware('auth');
        $this->req = $request;
    }

    public function coupons() {
       	$coupons = \App\Coupon::orderBy('id','desc')->paginate(10);
        return view('pages.coupon.list', compact('coupons'));
    }

    public function action(){
         $coupons = \App\Coupon::select();
         return Datatables::of($coupons)
         ->addColumn('action', function($ord) {
            return '<input type="checkbox" />';
        })
        ->addColumn('coupon_code', function($ord) {
            return $ord->coupon_code;
        })
        ->addColumn('coupon_criteria', function($data) {
            
           $temp = '';
           if($data->coupon_type == '%'){
              $temp =  $data->coupon_amount .''. $data->coupon_type;
                if($data->criteria == 1){
                   $temp = $temp .' of all orders';
                }
                else if($data->criteria == 2){
                    $temp = $temp .' of a certian amount';
                }
                else{   
                    $temp = $temp .' of a specific products';
                }
           }
           else if($data->coupon_type == '$'){
                $temp =  $data->coupon_type .''. $data->coupon_amount;
                if($data->criteria == 1){
                   $temp = $temp . ' of all orders';
                }
                else if($data->criteria == 2){
                    $temp = $temp . ' of a certian amount';
                }
                else{   
                    $temp = $temp . ' of a specific products';
                }
           } else {
                if($data->criteria == 1){
                    $temp = "Free shipping of all orders";
                }
                else if($data->criteria == 2){
                    $temp = "Free shipping of a certian amount";
                }
                else{   
                    $temp = "Free shipping of a specific products";
                }
            }  
            return '<a href="'.route("coupon.edit", $data->id).'">'.$temp.'</a>';
             
        })->rawColumns(['coupon_criteria','action'])
        ->addColumn('availablity', function($data) {
            if(!empty($data->start_date) && !empty($data->expiration_date)){
                return date('d/m/Y', strtotime($data->start_date))  .' - '.  date('d/m/Y', strtotime($data->expiration_date));    
            }else{
                return "Never Expries";
            }
        })
        ->addColumn('used', function($ord) {
            return $ord->used;
        })
        ->make(true);
    }

    public function create() {
        $couponTypes = array('%' => '% Discount','$'=>'$ Discount','Free'=>'Free Shipping');
        $criteria = array('1' => 'All Order','2' => 'Order over a certian amount','3'=>'Specific Products'); 
        $formUrl = route('coupon.store');
        return view('pages.coupon.create', compact('formUrl','couponTypes','criteria'));
    }
    
    public function store() {
         $validator = \Validator::make($this->req->all(), [
            'coupon_code' => 'required',
            'number_available' => 'required',
            'coupon_type' => 'required',
            'coupon_amount' => 'required',
            'criteria' => 'required'
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $str='';
        if(!empty($this->req->get('ship'))){
          $str = implode (",", $this->req->get('ship'));
        }else{
           $str='';
        }

        $strprod='';
        if(!empty($this->req->get('prod'))){
          $strprod = implode (",", $this->req->get('prod'));
        }else{
           $strprod='';
        }

        $couponData = [    
            'coupon_code' => $this->req->get('coupon_code'),
            'number_available' => $this->req->get('number_available'),
            'coupon_type' => $this->req->get('coupon_type'),
            'coupon_amount' => $this->req->get('coupon_amount'),
            'criteria' => $this->req->get('criteria'),
            'used' => 1,
            'shipping_method' => $str,
            'selected_product' => $strprod
        ];

        if($this->req->get('start_date') !== null){
            $couponData['start_date'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->req->get('start_date'))));
        }
        if($this->req->get('expiration_date') !== null){
            $couponData['expiration_date'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->req->get('expiration_date'))));
        }

        $user = \App\Coupon::create($couponData);
        return redirect('/coupon')->with('success', 'Coupon save successfully');
    }

    public function editCoupon($id) {
        $couponTypes = array('%' => '% Discount','$'=>'$ Discount','Free'=>'Free Shipping');
        $criteria = array('1' => 'All Order','2' => 'Order over a certian amount','3'=>'Specific Products');
        $coupon = \App\Coupon::find($id);
        
        $shipping = [];
        if(!empty($coupon->shipping_method)){
            $shipping = explode(',', $coupon->shipping_method);  
        }
        $products = [];
        if(!empty($coupon->selected_product)){
            $products = explode(',', $coupon->selected_product);  
        }

        $formUrl = route('coupon.update', $id);
        return view('pages.coupon.create', compact('coupon','formUrl','couponTypes','criteria','shipping','products'));
    }

    public function updateCoupon($id) {  
        $validator = \Validator::make($this->req->all(), [
            'coupon_code' => 'required',
            'number_available' => 'required',
            'coupon_type' => 'required',
            'coupon_amount' => 'required',
            'criteria' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $str='';
        if(!empty($this->req->get('ship'))){
          $str = implode (",", $this->req->get('ship'));
        }else{
           $str='';
        }

        $strprod='';
        if(!empty($this->req->get('prod'))){
          $strprod = implode (",", $this->req->get('prod'));
        }else{
           $strprod='';
        }

        $couponData = [
            'coupon_code' => $this->req->get('coupon_code'),
            'number_available' => $this->req->get('number_available'),
            'coupon_type' => $this->req->get('coupon_type'),
            'coupon_amount' => $this->req->get('coupon_amount'),
            'criteria' => $this->req->get('criteria'),
            'shipping_method' => $str,
            'selected_product' => $strprod
        ];

        if($this->req->get('start_date') !== null){
            $couponData['start_date'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->req->get('start_date'))));
        }else{
            $couponData['start_date'] = null;
        }
        if($this->req->get('expiration_date') !== null){
            $couponData['expiration_date'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->req->get('expiration_date'))));
        }else{
            $couponData['expiration_date'] = null;
        }

        $user = \App\Coupon::where('id', $id)->update($couponData);
        return redirect('/coupon')->with('success', 'Coupon updated successfully.');
    }
    
    public function deleteCoupon($id) {
        $users = \App\Coupon::find($id)->delete();
        return redirect('/coupon')->with('success', 'Coupon deleted successfully.');
    }
}     