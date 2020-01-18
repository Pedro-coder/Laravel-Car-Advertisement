<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\User;
use App\Buyer;
use App\Seller;
use App\Article;
use App\Order;
use App\Query;
use App\SavedPost;
use App\Profession;
use App\Membership;
use App\EventModal;
use App\EventVisitors;
use App\Chatroom;
use App\Balance as Balance;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Image;
use Storage;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class PageController extends Controller
{
    private $balance;
    public $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    public $data = [];

    public function __construct()
    {
        $this -> middleware('auth');
        $this -> balance = new balance();
    }

    /*public static function random(
        $length = 16
    );*/


    public function generateUniqueString($input, $strength = 16) {
        $input_length = strlen($input);
        $random_string = '';
        for($i = 0; $i < $strength; $i++) {
            $random_character = $input[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }

        return $random_string;
    }
    public function getIdNameList(Request $request)
    {
        $users_opts = "<option value = ''>Select user name</option>";
        foreach(User::all()->toArray() as $key => $value)
        {
            $users_opts .= "<option data-value='".$value['avatar']."' value='".$value['id']."'>".$value['name']."</option>";
        }
        $data['opts'] = $users_opts;
        echo json_encode($data);
    }

    public function getEmailBasedData(Request $request)
    {
        $data['res'] = User::where('email','=',$_POST['email'])->orWhere('name',$_POST['email'])->get()->toArray();
        echo json_encode($data);
    }

    public function wallet($userId =null,Request $request)
    {
        //echo $transaction_id = $this->generateUniqueString($this->permitted_chars, 16);
        if($userId == null)
        {
            $id = $request->user()->id;
        }
        else
        {
            $id = $userId; 
            $ouser = User::where('id',$id)->first();
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
            $chatRoomId = route('privateChat', $chatRoomId);
            if (Auth()->user()->id == $userId)
            {
                $flag = true;
                $chatRoomId =  route('chatdashboard');
            }
        }
        //------Paypal Request For Deposit-----------//
        //$paypal_info = $this->depositByPaypal($request);
        //-------------------------------------------//
        $orders          = Order::all();
        //$pending_transactions    = Balance::where('datwise',"<",date("Y-m-d"))->where('description',"!=","Withdraw Request")->where('user_id','=',$id)->orderBy('id', 'DESC')->get()->toArray();

        $posted_transactions = array();

        $group_by_date_transactions = DB::table('balances as w')
                ->select(array(
                    DB::Raw('sum(w.amount) as credit'), 
                    DB::Raw('sum(w.withdraw) as debit'),
                    DB::Raw('DATE(w.created_at) day')))
                ->where('description',"!=","Withdraw Request")
                ->where(function($query){
                    $query->where('is_pending',"!=",1);
                    $query->orWhereNull('is_pending');
                })
                ->where('user_id','=',$id)
                // ->where('datwise',"=",date("Y-m-d"))
                ->groupBy('day')
                ->orderBy('w.created_at', 'DESC')
                ->get()->toArray();
        
        // dd($group_by_date_transactions,$id);

        $total_balance_remained    = $this->calculateTotalBalance($id);
        // dd($total_balance_remained);

            // echo "<pre>"; print_r($group_by_date_transactions); echo "</pre>";

        if(sizeof($group_by_date_transactions) > 0){

            foreach ($group_by_date_transactions as $row) {

                 //echo "<pre>"; print_r($row->day); echo "</pre>"; exit();

                $daily_transactions_result    = Balance::where('description',"!=","Withdraw Request")
                                                ->where(function($query){
                                                    $query->where('is_pending',"!=",1);
                                                    $query->orWhereNull('is_pending');
                                                })
                                                ->where('user_id','=',$id)
                                                ->where('datwise',"=", $row->day)
                                                ->orderBy('created_at', 'DESC')
                                                ->get()
                                                ->toArray();
                // dd($group_by_date_transactions,$daily_transactions_result);
                if($daily_transactions_result){
                    $trans_loop_id = 1;
                    foreach ($daily_transactions_result as $transaction) {

                        $data_array = array();

                        $data_array['id']             = $transaction['id'];
                        $data_array['amount']         = $transaction['amount'];
                        $data_array['withdraw']       = $transaction['withdraw'];
                        $data_array['datwise']        = $transaction['datwise'];
                        $data_array['description']    = $transaction['description'];
                        $data_array['user_id']        = $transaction['user_id'];
                        $data_array['details']        = $transaction['details'];
                        $data_array['type']           = $transaction['type'];
                        $data_array['credit']         = $row->credit;
                        $data_array['debit']          = $row->debit;
                        $data_array['transaction_id'] = $transaction['transaction_id'];
                        $data_array['posted_by']      = $this->get_user_name($transaction['posted_by']);
                        $data_array['transaction_by'] = $this->get_user_name($transaction['transaction_by']);
                        $data_array['is_freeze_or_refund'] = $transaction['is_freeze_or_refund'];
 
                        if($trans_loop_id == 1){
                            $data_array['ending_daily_balance'] = $total_balance_remained;
                        }
                        else{
                            $data_array['ending_daily_balance'] = '';
                        }

                        $posted_transactions[] = $data_array;

                        $trans_loop_id++;
                    }
                }
            }
        }
        // dd($posted_transactions);
       //echo "<pre>"; print_r($posted_transactions); echo "</pre>"; exit();

        $withdraw_requests = Balance::
                            leftjoin('users','users.id','=','transaction_by')
                            // where('user_id','=',$id)
                            ->select('balances.*','users.name')
                            ->where(function($query) use ($id){
                                $query->where('user_id','=',$id);
                                $query->orWhere('transfer_to_user_id','=',$id);
                            })
                            ->where(function($query){
                                $query->where('description',"=","Withdraw Request");
                                $query->orWhere('is_pending',"=",1);
                            })
                            // ->where('datwise',"=",date("Y-m-d"))
                            ->orderBy('id', 'DESC')
                            ->get()
                            ->toArray();

        // dd($withdraw_requests);

        $transfer_to_me = Balance::Where('transfer_to_user_id','=',$id)
                            ->where(function($query){
                                $query->where('description',"=","Withdraw Request");
                                $query->orWhere('is_pending',"=",1);
                            })
                            // ->where('datwise',"=",date("Y-m-d"))
                            ->orderBy('id', 'DESC')
                            ->first();
        $ttm = 0;
        if ($transfer_to_me != NULL){
            $ttm = 1;
        }


        $total_available_balance    = $this->calculateTotalAvailableBalance($id);

        $user_role_as_accountant = DB::table('user_menu')->where('user_id', $id)->where('menu_options_id',9)->get();

        if(isset($user_role_as_accountant) && !empty($user_role_as_accountant) && sizeof($user_role_as_accountant)>0){
            $user_role_as_accountant = $user_role_as_accountant[0]->menu_options_id;
        }else{
            $user_role_as_accountant = 0;
        }
        //aa($posted_transactions);
        if(isset($ouser))
        {
            return view('pages.wallet.otherUserProfile', array(
                    'user' => $ouser,
                    'orders'=>$orders , 
                    'posted_transactions' => $posted_transactions ,
                    'total_balance_remained' => $total_balance_remained, 
                    'total_available_balance' => $total_available_balance, 
                    'user_id' => $id, 
                    'withdraw_requests' => $withdraw_requests, 
                    'user_role_as_accountant' => $user_role_as_accountant,
                    'ttm' => $ttm,
                    'chatRoute'=>$chatRoomId));
        }
            return view('pages.wallet.index', array(
                'user' => Auth::User(),
                'orders'=>$orders , 
                'posted_transactions' => $posted_transactions ,
                'total_balance_remained' => $total_balance_remained, 
                'total_available_balance' => $total_available_balance, 
                'user_id' => $id, 
                'withdraw_requests' => $withdraw_requests, 
                'user_role_as_accountant' => $user_role_as_accountant,
                'ttm' => $ttm));
    }

    public function get_user_name($id){
        if(!empty($id)){
            $user = User::find($id);
            return $user->name;
        }
        else{
            return NULL;
        }
    }

    public function calculateTotalBalance($id)
    {
        $credit_sum = 0;
        $debit_sum  = 0;

        $transactions    = Balance::where('user_id','=',$id)
                            ->where('description',"!=","Withdraw Request")
                            ->where(function($query){
                                $query->where('is_pending',"!=",1);
                                $query->orWhereNull('is_pending');
                            })
                            ->orderBy('id', 'DESC')
                            ->get()
                            ->toArray();
        // dd('transactions',$transactions);
        
        foreach($transactions as $key=>$value)
        {
            if($value['type'] == 'cr'){
                $credit_sum += $value['amount'];
            }
            else if($value['type'] == 'db'){
                if($value['withdraw']==""){
                    $debit_sum  += $value['amount'];
                }
                else{
                    $debit_sum  += $value['withdraw'];
                }
            }
        }
        $total_balance_remained  =  $credit_sum - $debit_sum;
        return $total_balance_remained;
    }

    public function calculateTotalAvailableBalance($id)
    {
        $credit_sum = 0;
        $debit_sum  = 0;
        $transactions    =  Balance::where('user_id','=',$id)->orderBy('id', 'DESC')->get()->toArray();

        foreach($transactions as $key=>$value)
        {
            if($value['type'] == 'cr'){
                $credit_sum += $value['amount'];
            }
            else if($value['type'] == 'db'){
                if($value['withdraw']==""){
                    $debit_sum  += $value['amount'];
                }
                else{
                    $debit_sum  += $value['withdraw'];
                }
            }

        }
        $total_balance_remained  =  $credit_sum - $debit_sum;
        return $total_balance_remained;
    }

    public static function getEndingDayBalance($current_balace, $date){
    }

    public function pendingDayBalanceCalculation($pending_transactions){

        //dd($transactions);
        $credit_sum = 0;
        $debit_sum  = 0;
        foreach($transactions as $key=>$value)
        {
            $credit_sum += $value['amount'];
            if($value['withdraw']==""){
                $debit_sum  += $value['amount'];
            }
            else{
                $debit_sum  += $value['withdraw'];
            }
           // $debit_sum  += $value['withdraw'];
        }
        $data['cr']     = $credit_sum;
        $data['db']     = $debit_sum;
        $data['date']   = date('d/m/Y');
        $data['description']            = 'testing';
        $data['ending_daily_balance']   =  $credit_sum - $debit_sum;
        return $data;
    }

    public function dailytransactionCalculator($transactions)
    {
        //dd($transactions);
        $credit_sum = 0;
        $debit_sum  = 0;
        foreach($transactions as $key=>$value)
        {
            $credit_sum += $value['amount'];
            if($value['withdraw']==""){
                $debit_sum  += $value['amount'];
            }
            else{
                $debit_sum  += $value['withdraw'];
            }
        }
        $data['cr']     = $credit_sum;
        $data['db']     = $debit_sum;
        $data['date']   = date('d/m/Y');
        $data['description']            = 'testing';
        $data['ending_daily_balance']   =  $credit_sum - $debit_sum;
        return $data;
    }


    public function userAccess()
    {
        $user = User::where('email', Input::get('email'))
            ->orWhere('name', 'like', '%' . Input::get('name') . '%')->get();
        return view('pages.admin.user_access')->withUser($user);
    }
    //  public function userAccess()
    // {
    //     $user = User::where('email', Input::get('email'))
    //         ->orWhere('name', 'like', '%' . Input::get('name') . '%')->get();
    //     return view('pages.admin.user_access')->withUser($user);
    // }

    public function accountant()
    {
        $user = Auth::User();
        $this->data['rows'] = $this->balance::where('user_id',$user->id)->get();
        $std = new \stdClass();
        $std->IsAdmin = $this->balance->isUserHasPermission($user->id)->count();
        $this->data['user'] = $std;
        if($std->IsAdmin == 1)
        {
            return view('pages.admin.accountant');
        }
        else
        {
            return abort(500, 'Access denied');
        }
    }

    public function accountantUser($id)
    {

        $user =User::where('id',$id)->first();
        $users = Auth::User();
        $this->data['rows'] = $this->balance::where('user_id',$users->id)->get();
        $std = new \stdClass();
        $std->IsAdmin = $this->balance->isUserHasPermission($users->id)->count();
        $this->data['user'] = $std;
        if($std->IsAdmin == 1)
        {
            return view('pages.admin.accountant_user')->with('user',$user);
        }
        else
        {
            return abort(500, 'Access denied');
        }
    }

    public function submitMembershipForm(Request $request)
    {
        $user = Auth::User();
        $data = $_POST;
        $data['user_id'] = $user->id;
        if ($request->hasFile('buyer_featured_image'))
        {

            $image_file         = $request->file('buyer_featured_image');
            $uniqueFileName     = rand().'.'.$image_file->getClientOriginalExtension();
            $image_file->move(public_path('/images'),  $uniqueFileName);
            $data['blah'] = $uniqueFileName;
        }
        else
        {
            $data['blah'] = "";
        }
        $this -> mapMembershipDbFields($data);
    }

    public function mapMembershipDbFields($data)
    {
        if(empty($data['join_date']))
        {
            $data2['join_date']  = date("Y-m-d");
        }
        else
        {
            $data2['join_date']  = date('Y-m-d', strtotime($data['join_date']));
        }
        $data2['membership_type'] = $data['membership_type'];
        $data2['membership_category'] = $data['membership_category'];

        $data['admin_code_concatenated'] = "";
        foreach($data['admin_code'] as $key=>$value)
        {
            $data['admin_code_concatenated'] .= $value.",";
        }
        $data2['admin_code'] =  $data['admin_code_concatenated'];
        $data2['user_id']    =  $data['user_id'];
        $data2['blah']       =  $data['blah'];
        $data2['status']       =  $data['status'];
        $data2['cell_num']       =  $data['cell_num'];
        $data2['email']       =  $data['email'];
        $data2['reference_id']       =  $data['reference_id'];
        $data2['reference_name']       =  $data['reference_name'];
        $data2['nid_no']       =  $data['nid_no'];
        $data2['instagram']       =  $data['instagram'];
        $data2['facebook']       =  $data['facebook'];
        $data2['linkedin']       =  $data['linkedin'];
        $data2['twitter']       =  $data['twitter'];
        $data2['gender']       =  $data['gender'];
        $data2['nationality']       =  $data['nationality'];
        $data2['nationality_2']       =  $data['nationality_2'];
        if(!empty($data['date_of_birth']))
        {
            $data2['date_of_birth']  =  date('Y-m-d', strtotime($data['date_of_birth']));
        }
        else
        {
            $data2['date_of_birth']  =  null;
        }
        $data2['yearly_income']       =  $data['yearly_income'];
        $data2['profession_name']       =  $data['profession_name'];
        $data2['profession_type']       =  $data['profession_type'];
        $data2['account_detail']       =  $data['account_detail'];

        $member_data_already_exists = Membership::where('user_id','=',$data['user_id'])->get()->count();
        if($member_data_already_exists == 0)
        {
            $res = Membership::create($data2);
        }
        else
        {
            $res = Membership::where('user_id','=',$data['user_id'])
            ->update($data2);
        }
        $data3['success'] =  $res;
        echo json_encode($data);
    }

    public function membership(Request $request)
    {
        $share = $request->session()->get('share');
        $user = Auth::User();
        $userId = $user->id;
        $professions = Profession::get()->toArray();
        $avatar = User::where('id','=',$userId)->get(['avatar'])->toArray();
        $isAdmin = DB::table('user_menu')->where('user_id',$userId)->where('menu_options_id',14)->get()->count();
        
        return view('pages.admin.premembership',['user'=>$userId,'share'=>$share,'isAdmin'=>$isAdmin,'professions'=>$professions,'avatar'=>$avatar[0]['avatar']]);
    }




    public function addProfession()
    {
        $data = array(
            "profession_name" => $_POST['profession_name'],
            "profession_type" => $_POST['profession_type']
        );
        $res = Profession::create($data);
        $data['success'] =  $res;
        echo json_encode($data);
    }

    public function updateProfession()
    {
        $data = array(
            "profession_name" => $_POST['profession_name'],
            "profession_type" => $_POST['profession_type']
        );
        $id=$_POST['id'];
        $res = Profession::where('id', $id)
                            ->update($data);
        $data['success'] =  $res;
        echo json_encode($data);
    }

    public function deleteProfession()
    {
        $id=$_POST['id'];
        $res = Profession::where('id', $id)->delete();
        $data['success'] =  $res;
        echo json_encode($data);
    }


    public function getProfession()
    {
        $id       = $_POST['profession_id'];
        $response = Profession::where('id',$id)->get()->toArray();
        $data['res'] = $response;
        echo json_encode($data);
    }

    public function updateShareRate()
    {
        session(['share' => $_POST['share']]);
    }

    public function userMembershipdetails($id)
    {
        

        $countries = array();

        $countries[] = array(
        "num_code" => "4",
        "alpha_2_code" => "AF",
        "alpha_3_code" => "AFG",
        "en_short_name" => "Afghanistan",
        "nationality" => "Afghan",
        );

        $countries[] = array(
        "num_code" => "248",
        "alpha_2_code" => "AX",
        "alpha_3_code" => "ALA",
        "en_short_name" => "Åland Islands",
        "nationality" => "Åland Island",
        );

        $countries[] = array(
        "num_code" => "8",
        "alpha_2_code" => "AL",
        "alpha_3_code" => "ALB",
        "en_short_name" => "Albania",
        "nationality" => "Albanian",
        );

        $countries[] = array(
        "num_code" => "12",
        "alpha_2_code" => "DZ",
        "alpha_3_code" => "DZA",
        "en_short_name" => "Algeria",
        "nationality" => "Algerian",
        );

        $countries[] = array(
        "num_code" => "16",
        "alpha_2_code" => "AS",
        "alpha_3_code" => "ASM",
        "en_short_name" => "American Samoa",
        "nationality" => "American Samoan",
        );

        $countries[] = array(
        "num_code" => "20",
        "alpha_2_code" => "AD",
        "alpha_3_code" => "AND",
        "en_short_name" => "Andorra",
        "nationality" => "Andorran",
        );

        $countries[] = array(
        "num_code" => "24",
        "alpha_2_code" => "AO",
        "alpha_3_code" => "AGO",
        "en_short_name" => "Angola",
        "nationality" => "Angolan",
        );

        $countries[] = array(
        "num_code" => "660",
        "alpha_2_code" => "AI",
        "alpha_3_code" => "AIA",
        "en_short_name" => "Anguilla",
        "nationality" => "Anguillan",
        );

        $countries[] = array(
        "num_code" => "10",
        "alpha_2_code" => "AQ",
        "alpha_3_code" => "ATA",
        "en_short_name" => "Antarctica",
        "nationality" => "Antarctic",
        );

        $countries[] = array(
        "num_code" => "28",
        "alpha_2_code" => "AG",
        "alpha_3_code" => "ATG",
        "en_short_name" => "Antigua and Barbuda",
        "nationality" => "Antiguan or Barbudan",
        );

        $countries[] = array(
        "num_code" => "32",
        "alpha_2_code" => "AR",
        "alpha_3_code" => "ARG",
        "en_short_name" => "Argentina",
        "nationality" => "Argentine",
        );

        $countries[] = array(
        "num_code" => "51",
        "alpha_2_code" => "AM",
        "alpha_3_code" => "ARM",
        "en_short_name" => "Armenia",
        "nationality" => "Armenian",
        );

        $countries[] = array(
        "num_code" => "533",
        "alpha_2_code" => "AW",
        "alpha_3_code" => "ABW",
        "en_short_name" => "Aruba",
        "nationality" => "Aruban",
        );

        $countries[] = array(
        "num_code" => "36",
        "alpha_2_code" => "AU",
        "alpha_3_code" => "AUS",
        "en_short_name" => "Australia",
        "nationality" => "Australian",
        );

        $countries[] = array(
        "num_code" => "40",
        "alpha_2_code" => "AT",
        "alpha_3_code" => "AUT",
        "en_short_name" => "Austria",
        "nationality" => "Austrian",
        );

        $countries[] = array(
        "num_code" => "31",
        "alpha_2_code" => "AZ",
        "alpha_3_code" => "AZE",
        "en_short_name" => "Azerbaijan",
        "nationality" => "Azerbaijani, Azeri",
        );

        $countries[] = array(
        "num_code" => "44",
        "alpha_2_code" => "BS",
        "alpha_3_code" => "BHS",
        "en_short_name" => "Bahamas",
        "nationality" => "Bahamian",
        );

        $countries[] = array(
        "num_code" => "48",
        "alpha_2_code" => "BH",
        "alpha_3_code" => "BHR",
        "en_short_name" => "Bahrain",
        "nationality" => "Bahraini",
        );

        $countries[] = array(
        "num_code" => "50",
        "alpha_2_code" => "BD",
        "alpha_3_code" => "BGD",
        "en_short_name" => "Bangladesh",
        "nationality" => "Bangladeshi",
        );

        $countries[] = array(
        "num_code" => "52",
        "alpha_2_code" => "BB",
        "alpha_3_code" => "BRB",
        "en_short_name" => "Barbados",
        "nationality" => "Barbadian",
        );

        $countries[] = array(
        "num_code" => "112",
        "alpha_2_code" => "BY",
        "alpha_3_code" => "BLR",
        "en_short_name" => "Belarus",
        "nationality" => "Belarusian",
        );

        $countries[] = array(
        "num_code" => "56",
        "alpha_2_code" => "BE",
        "alpha_3_code" => "BEL",
        "en_short_name" => "Belgium",
        "nationality" => "Belgian",
        );

        $countries[] = array(
        "num_code" => "84",
        "alpha_2_code" => "BZ",
        "alpha_3_code" => "BLZ",
        "en_short_name" => "Belize",
        "nationality" => "Belizean",
        );

        $countries[] = array(
        "num_code" => "204",
        "alpha_2_code" => "BJ",
        "alpha_3_code" => "BEN",
        "en_short_name" => "Benin",
        "nationality" => "Beninese, Beninois",
        );

        $countries[] = array(
        "num_code" => "60",
        "alpha_2_code" => "BM",
        "alpha_3_code" => "BMU",
        "en_short_name" => "Bermuda",
        "nationality" => "Bermudian, Bermudan",
        );

        $countries[] = array(
        "num_code" => "64",
        "alpha_2_code" => "BT",
        "alpha_3_code" => "BTN",
        "en_short_name" => "Bhutan",
        "nationality" => "Bhutanese",
        );

        $countries[] = array(
        "num_code" => "68",
        "alpha_2_code" => "BO",
        "alpha_3_code" => "BOL",
        "en_short_name" => "Bolivia (Plurinational State of)",
        "nationality" => "Bolivian",
        );

        $countries[] = array(
        "num_code" => "535",
        "alpha_2_code" => "BQ",
        "alpha_3_code" => "BES",
        "en_short_name" => "Bonaire, Sint Eustatius and Saba",
        "nationality" => "Bonaire",
        );

        $countries[] = array(
        "num_code" => "70",
        "alpha_2_code" => "BA",
        "alpha_3_code" => "BIH",
        "en_short_name" => "Bosnia and Herzegovina",
        "nationality" => "Bosnian or Herzegovinian",
        );

        $countries[] = array(
        "num_code" => "72",
        "alpha_2_code" => "BW",
        "alpha_3_code" => "BWA",
        "en_short_name" => "Botswana",
        "nationality" => "Motswana, Botswanan",
        );

        $countries[] = array(
        "num_code" => "74",
        "alpha_2_code" => "BV",
        "alpha_3_code" => "BVT",
        "en_short_name" => "Bouvet Island",
        "nationality" => "Bouvet Island",
        );

        $countries[] = array(
        "num_code" => "76",
        "alpha_2_code" => "BR",
        "alpha_3_code" => "BRA",
        "en_short_name" => "Brazil",
        "nationality" => "Brazilian",
        );

        $countries[] = array(
        "num_code" => "86",
        "alpha_2_code" => "IO",
        "alpha_3_code" => "IOT",
        "en_short_name" => "British Indian Ocean Territory",
        "nationality" => "BIOT",
        );

        $countries[] = array(
        "num_code" => "96",
        "alpha_2_code" => "BN",
        "alpha_3_code" => "BRN",
        "en_short_name" => "Brunei Darussalam",
        "nationality" => "Bruneian",
        );

        $countries[] = array(
        "num_code" => "100",
        "alpha_2_code" => "BG",
        "alpha_3_code" => "BGR",
        "en_short_name" => "Bulgaria",
        "nationality" => "Bulgarian",
        );

        $countries[] = array(
        "num_code" => "854",
        "alpha_2_code" => "BF",
        "alpha_3_code" => "BFA",
        "en_short_name" => "Burkina Faso",
        "nationality" => "Burkinabé",
        );

        $countries[] = array(
        "num_code" => "108",
        "alpha_2_code" => "BI",
        "alpha_3_code" => "BDI",
        "en_short_name" => "Burundi",
        "nationality" => "Burundian",
        );

        $countries[] = array(
        "num_code" => "132",
        "alpha_2_code" => "CV",
        "alpha_3_code" => "CPV",
        "en_short_name" => "Cabo Verde",
        "nationality" => "Cabo Verdean",
        );

        $countries[] = array(
        "num_code" => "116",
        "alpha_2_code" => "KH",
        "alpha_3_code" => "KHM",
        "en_short_name" => "Cambodia",
        "nationality" => "Cambodian",
        );

        $countries[] = array(
        "num_code" => "120",
        "alpha_2_code" => "CM",
        "alpha_3_code" => "CMR",
        "en_short_name" => "Cameroon",
        "nationality" => "Cameroonian",
        );

        $countries[] = array(
        "num_code" => "124",
        "alpha_2_code" => "CA",
        "alpha_3_code" => "CAN",
        "en_short_name" => "Canada",
        "nationality" => "Canadian",
        );

        $countries[] = array(
        "num_code" => "136",
        "alpha_2_code" => "KY",
        "alpha_3_code" => "CYM",
        "en_short_name" => "Cayman Islands",
        "nationality" => "Caymanian",
        );

        $countries[] = array(
        "num_code" => "140",
        "alpha_2_code" => "CF",
        "alpha_3_code" => "CAF",
        "en_short_name" => "Central African Republic",
        "nationality" => "Central African",
        );

        $countries[] = array(
        "num_code" => "148",
        "alpha_2_code" => "TD",
        "alpha_3_code" => "TCD",
        "en_short_name" => "Chad",
        "nationality" => "Chadian",
        );

        $countries[] = array(
        "num_code" => "152",
        "alpha_2_code" => "CL",
        "alpha_3_code" => "CHL",
        "en_short_name" => "Chile",
        "nationality" => "Chilean",
        );

        $countries[] = array(
        "num_code" => "156",
        "alpha_2_code" => "CN",
        "alpha_3_code" => "CHN",
        "en_short_name" => "China",
        "nationality" => "Chinese",
        );

        $countries[] = array(
        "num_code" => "162",
        "alpha_2_code" => "CX",
        "alpha_3_code" => "CXR",
        "en_short_name" => "Christmas Island",
        "nationality" => "Christmas Island",
        );

        $countries[] = array(
        "num_code" => "166",
        "alpha_2_code" => "CC",
        "alpha_3_code" => "CCK",
        "en_short_name" => "Cocos (Keeling) Islands",
        "nationality" => "Cocos Island",
        );

        $countries[] = array(
        "num_code" => "170",
        "alpha_2_code" => "CO",
        "alpha_3_code" => "COL",
        "en_short_name" => "Colombia",
        "nationality" => "Colombian",
        );

        $countries[] = array(
        "num_code" => "174",
        "alpha_2_code" => "KM",
        "alpha_3_code" => "COM",
        "en_short_name" => "Comoros",
        "nationality" => "Comoran, Comorian",
        );

        $countries[] = array(
        "num_code" => "178",
        "alpha_2_code" => "CG",
        "alpha_3_code" => "COG",
        "en_short_name" => "Congo (Republic of the)",
        "nationality" => "Congolese",
        );

        $countries[] = array(
        "num_code" => "180",
        "alpha_2_code" => "CD",
        "alpha_3_code" => "COD",
        "en_short_name" => "Congo (Democratic Republic of the)",
        "nationality" => "Congolese",
        );

        $countries[] = array(
        "num_code" => "184",
        "alpha_2_code" => "CK",
        "alpha_3_code" => "COK",
        "en_short_name" => "Cook Islands",
        "nationality" => "Cook Island",
        );

        $countries[] = array(
        "num_code" => "188",
        "alpha_2_code" => "CR",
        "alpha_3_code" => "CRI",
        "en_short_name" => "Costa Rica",
        "nationality" => "Costa Rican",
        );

        $countries[] = array(
        "num_code" => "384",
        "alpha_2_code" => "CI",
        "alpha_3_code" => "CIV",
        "en_short_name" => "Côte d'Ivoire",
        "nationality" => "Ivorian",
        );

        $countries[] = array(
        "num_code" => "191",
        "alpha_2_code" => "HR",
        "alpha_3_code" => "HRV",
        "en_short_name" => "Croatia",
        "nationality" => "Croatian",
        );

        $countries[] = array(
        "num_code" => "192",
        "alpha_2_code" => "CU",
        "alpha_3_code" => "CUB",
        "en_short_name" => "Cuba",
        "nationality" => "Cuban",
        );

        $countries[] = array(
        "num_code" => "531",
        "alpha_2_code" => "CW",
        "alpha_3_code" => "CUW",
        "en_short_name" => "Curaçao",
        "nationality" => "Curaçaoan",
        );

        $countries[] = array(
        "num_code" => "196",
        "alpha_2_code" => "CY",
        "alpha_3_code" => "CYP",
        "en_short_name" => "Cyprus",
        "nationality" => "Cypriot",
        );

        $countries[] = array(
        "num_code" => "203",
        "alpha_2_code" => "CZ",
        "alpha_3_code" => "CZE",
        "en_short_name" => "Czech Republic",
        "nationality" => "Czech",
        );

        $countries[] = array(
        "num_code" => "208",
        "alpha_2_code" => "DK",
        "alpha_3_code" => "DNK",
        "en_short_name" => "Denmark",
        "nationality" => "Danish",
        );

        $countries[] = array(
        "num_code" => "262",
        "alpha_2_code" => "DJ",
        "alpha_3_code" => "DJI",
        "en_short_name" => "Djibouti",
        "nationality" => "Djiboutian",
        );

        $countries[] = array(
        "num_code" => "212",
        "alpha_2_code" => "DM",
        "alpha_3_code" => "DMA",
        "en_short_name" => "Dominica",
        "nationality" => "Dominican",
        );

        $countries[] = array(
        "num_code" => "214",
        "alpha_2_code" => "DO",
        "alpha_3_code" => "DOM",
        "en_short_name" => "Dominican Republic",
        "nationality" => "Dominican",
        );

        $countries[] = array(
        "num_code" => "218",
        "alpha_2_code" => "EC",
        "alpha_3_code" => "ECU",
        "en_short_name" => "Ecuador",
        "nationality" => "Ecuadorian",
        );

        $countries[] = array(
        "num_code" => "818",
        "alpha_2_code" => "EG",
        "alpha_3_code" => "EGY",
        "en_short_name" => "Egypt",
        "nationality" => "Egyptian",
        );

        $countries[] = array(
        "num_code" => "222",
        "alpha_2_code" => "SV",
        "alpha_3_code" => "SLV",
        "en_short_name" => "El Salvador",
        "nationality" => "Salvadoran",
        );

        $countries[] = array(
        "num_code" => "226",
        "alpha_2_code" => "GQ",
        "alpha_3_code" => "GNQ",
        "en_short_name" => "Equatorial Guinea",
        "nationality" => "Equatorial Guinean, Equatoguinean",
        );

        $countries[] = array(
        "num_code" => "232",
        "alpha_2_code" => "ER",
        "alpha_3_code" => "ERI",
        "en_short_name" => "Eritrea",
        "nationality" => "Eritrean",
        );

        $countries[] = array(
        "num_code" => "233",
        "alpha_2_code" => "EE",
        "alpha_3_code" => "EST",
        "en_short_name" => "Estonia",
        "nationality" => "Estonian",
        );

        $countries[] = array(
        "num_code" => "231",
        "alpha_2_code" => "ET",
        "alpha_3_code" => "ETH",
        "en_short_name" => "Ethiopia",
        "nationality" => "Ethiopian",
        );

        $countries[] = array(
        "num_code" => "238",
        "alpha_2_code" => "FK",
        "alpha_3_code" => "FLK",
        "en_short_name" => "Falkland Islands (Malvinas)",
        "nationality" => "Falkland Island",
        );

        $countries[] = array(
        "num_code" => "234",
        "alpha_2_code" => "FO",
        "alpha_3_code" => "FRO",
        "en_short_name" => "Faroe Islands",
        "nationality" => "Faroese",
        );

        $countries[] = array(
        "num_code" => "242",
        "alpha_2_code" => "FJ",
        "alpha_3_code" => "FJI",
        "en_short_name" => "Fiji",
        "nationality" => "Fijian",
        );

        $countries[] = array(
        "num_code" => "246",
        "alpha_2_code" => "FI",
        "alpha_3_code" => "FIN",
        "en_short_name" => "Finland",
        "nationality" => "Finnish",
        );

        $countries[] = array(
        "num_code" => "250",
        "alpha_2_code" => "FR",
        "alpha_3_code" => "FRA",
        "en_short_name" => "France",
        "nationality" => "French",
        );

        $countries[] = array(
        "num_code" => "254",
        "alpha_2_code" => "GF",
        "alpha_3_code" => "GUF",
        "en_short_name" => "French Guiana",
        "nationality" => "French Guianese",
        );

        $countries[] = array(
        "num_code" => "258",
        "alpha_2_code" => "PF",
        "alpha_3_code" => "PYF",
        "en_short_name" => "French Polynesia",
        "nationality" => "French Polynesian",
        );

        $countries[] = array(
        "num_code" => "260",
        "alpha_2_code" => "TF",
        "alpha_3_code" => "ATF",
        "en_short_name" => "French Southern Territories",
        "nationality" => "French Southern Territories",
        );

        $countries[] = array(
        "num_code" => "266",
        "alpha_2_code" => "GA",
        "alpha_3_code" => "GAB",
        "en_short_name" => "Gabon",
        "nationality" => "Gabonese",
        );

        $countries[] = array(
        "num_code" => "270",
        "alpha_2_code" => "GM",
        "alpha_3_code" => "GMB",
        "en_short_name" => "Gambia",
        "nationality" => "Gambian",
        );

        $countries[] = array(
        "num_code" => "268",
        "alpha_2_code" => "GE",
        "alpha_3_code" => "GEO",
        "en_short_name" => "Georgia",
        "nationality" => "Georgian",
        );

        $countries[] = array(
        "num_code" => "276",
        "alpha_2_code" => "DE",
        "alpha_3_code" => "DEU",
        "en_short_name" => "Germany",
        "nationality" => "German",
        );

        $countries[] = array(
        "num_code" => "288",
        "alpha_2_code" => "GH",
        "alpha_3_code" => "GHA",
        "en_short_name" => "Ghana",
        "nationality" => "Ghanaian",
        );

        $countries[] = array(
        "num_code" => "292",
        "alpha_2_code" => "GI",
        "alpha_3_code" => "GIB",
        "en_short_name" => "Gibraltar",
        "nationality" => "Gibraltar",
        );

        $countries[] = array(
        "num_code" => "300",
        "alpha_2_code" => "GR",
        "alpha_3_code" => "GRC",
        "en_short_name" => "Greece",
        "nationality" => "Greek, Hellenic",
        );

        $countries[] = array(
        "num_code" => "304",
        "alpha_2_code" => "GL",
        "alpha_3_code" => "GRL",
        "en_short_name" => "Greenland",
        "nationality" => "Greenlandic",
        );

        $countries[] = array(
        "num_code" => "308",
        "alpha_2_code" => "GD",
        "alpha_3_code" => "GRD",
        "en_short_name" => "Grenada",
        "nationality" => "Grenadian",
        );

        $countries[] = array(
        "num_code" => "312",
        "alpha_2_code" => "GP",
        "alpha_3_code" => "GLP",
        "en_short_name" => "Guadeloupe",
        "nationality" => "Guadeloupe",
        );

        $countries[] = array(
        "num_code" => "316",
        "alpha_2_code" => "GU",
        "alpha_3_code" => "GUM",
        "en_short_name" => "Guam",
        "nationality" => "Guamanian, Guambat",
        );

        $countries[] = array(
        "num_code" => "320",
        "alpha_2_code" => "GT",
        "alpha_3_code" => "GTM",
        "en_short_name" => "Guatemala",
        "nationality" => "Guatemalan",
        );

        $countries[] = array(
        "num_code" => "831",
        "alpha_2_code" => "GG",
        "alpha_3_code" => "GGY",
        "en_short_name" => "Guernsey",
        "nationality" => "Channel Island",
        );

        $countries[] = array(
        "num_code" => "324",
        "alpha_2_code" => "GN",
        "alpha_3_code" => "GIN",
        "en_short_name" => "Guinea",
        "nationality" => "Guinean",
        );

        $countries[] = array(
        "num_code" => "624",
        "alpha_2_code" => "GW",
        "alpha_3_code" => "GNB",
        "en_short_name" => "Guinea-Bissau",
        "nationality" => "Bissau-Guinean",
        );

        $countries[] = array(
        "num_code" => "328",
        "alpha_2_code" => "GY",
        "alpha_3_code" => "GUY",
        "en_short_name" => "Guyana",
        "nationality" => "Guyanese",
        );

        $countries[] = array(
        "num_code" => "332",
        "alpha_2_code" => "HT",
        "alpha_3_code" => "HTI",
        "en_short_name" => "Haiti",
        "nationality" => "Haitian",
        );

        $countries[] = array(
        "num_code" => "334",
        "alpha_2_code" => "HM",
        "alpha_3_code" => "HMD",
        "en_short_name" => "Heard Island and McDonald Islands",
        "nationality" => "Heard Island or McDonald Islands",
        );

        $countries[] = array(
        "num_code" => "336",
        "alpha_2_code" => "VA",
        "alpha_3_code" => "VAT",
        "en_short_name" => "Vatican City State",
        "nationality" => "Vatican",
        );

        $countries[] = array(
        "num_code" => "340",
        "alpha_2_code" => "HN",
        "alpha_3_code" => "HND",
        "en_short_name" => "Honduras",
        "nationality" => "Honduran",
        );

        $countries[] = array(
        "num_code" => "344",
        "alpha_2_code" => "HK",
        "alpha_3_code" => "HKG",
        "en_short_name" => "Hong Kong",
        "nationality" => "Hong Kong, Hong Kongese",
        );

        $countries[] = array(
        "num_code" => "348",
        "alpha_2_code" => "HU",
        "alpha_3_code" => "HUN",
        "en_short_name" => "Hungary",
        "nationality" => "Hungarian, Magyar",
        );

        $countries[] = array(
        "num_code" => "352",
        "alpha_2_code" => "IS",
        "alpha_3_code" => "ISL",
        "en_short_name" => "Iceland",
        "nationality" => "Icelandic",
        );

        $countries[] = array(
        "num_code" => "356",
        "alpha_2_code" => "IN",
        "alpha_3_code" => "IND",
        "en_short_name" => "India",
        "nationality" => "Indian",
        );

        $countries[] = array(
        "num_code" => "360",
        "alpha_2_code" => "ID",
        "alpha_3_code" => "IDN",
        "en_short_name" => "Indonesia",
        "nationality" => "Indonesian",
        );

        $countries[] = array(
        "num_code" => "364",
        "alpha_2_code" => "IR",
        "alpha_3_code" => "IRN",
        "en_short_name" => "Iran",
        "nationality" => "Iranian, Persian",
        );

        $countries[] = array(
        "num_code" => "368",
        "alpha_2_code" => "IQ",
        "alpha_3_code" => "IRQ",
        "en_short_name" => "Iraq",
        "nationality" => "Iraqi",
        );

        $countries[] = array(
        "num_code" => "372",
        "alpha_2_code" => "IE",
        "alpha_3_code" => "IRL",
        "en_short_name" => "Ireland",
        "nationality" => "Irish",
        );

        $countries[] = array(
        "num_code" => "833",
        "alpha_2_code" => "IM",
        "alpha_3_code" => "IMN",
        "en_short_name" => "Isle of Man",
        "nationality" => "Manx",
        );

        $countries[] = array(
        "num_code" => "376",
        "alpha_2_code" => "IL",
        "alpha_3_code" => "ISR",
        "en_short_name" => "Israel",
        "nationality" => "Israeli",
        );

        $countries[] = array(
        "num_code" => "380",
        "alpha_2_code" => "IT",
        "alpha_3_code" => "ITA",
        "en_short_name" => "Italy",
        "nationality" => "Italian",
        );

        $countries[] = array(
        "num_code" => "388",
        "alpha_2_code" => "JM",
        "alpha_3_code" => "JAM",
        "en_short_name" => "Jamaica",
        "nationality" => "Jamaican",
        );

        $countries[] = array(
        "num_code" => "392",
        "alpha_2_code" => "JP",
        "alpha_3_code" => "JPN",
        "en_short_name" => "Japan",
        "nationality" => "Japanese",
        );

        $countries[] = array(
        "num_code" => "832",
        "alpha_2_code" => "JE",
        "alpha_3_code" => "JEY",
        "en_short_name" => "Jersey",
        "nationality" => "Channel Island",
        );

        $countries[] = array(
        "num_code" => "400",
        "alpha_2_code" => "JO",
        "alpha_3_code" => "JOR",
        "en_short_name" => "Jordan",
        "nationality" => "Jordanian",
        );

        $countries[] = array(
        "num_code" => "398",
        "alpha_2_code" => "KZ",
        "alpha_3_code" => "KAZ",
        "en_short_name" => "Kazakhstan",
        "nationality" => "Kazakhstani, Kazakh",
        );

        $countries[] = array(
        "num_code" => "404",
        "alpha_2_code" => "KE",
        "alpha_3_code" => "KEN",
        "en_short_name" => "Kenya",
        "nationality" => "Kenyan",
        );

        $countries[] = array(
        "num_code" => "296",
        "alpha_2_code" => "KI",
        "alpha_3_code" => "KIR",
        "en_short_name" => "Kiribati",
        "nationality" => "I-Kiribati",
        );

        $countries[] = array(
        "num_code" => "408",
        "alpha_2_code" => "KP",
        "alpha_3_code" => "PRK",
        "en_short_name" => "Korea (Democratic People's Republic of)",
        "nationality" => "North Korean",
        );

        $countries[] = array(
        "num_code" => "410",
        "alpha_2_code" => "KR",
        "alpha_3_code" => "KOR",
        "en_short_name" => "Korea (Republic of)",
        "nationality" => "South Korean",
        );

        $countries[] = array(
        "num_code" => "414",
        "alpha_2_code" => "KW",
        "alpha_3_code" => "KWT",
        "en_short_name" => "Kuwait",
        "nationality" => "Kuwaiti",
        );

        $countries[] = array(
        "num_code" => "417",
        "alpha_2_code" => "KG",
        "alpha_3_code" => "KGZ",
        "en_short_name" => "Kyrgyzstan",
        "nationality" => "Kyrgyzstani, Kyrgyz, Kirgiz, Kirghiz",
        );

        $countries[] = array(
        "num_code" => "418",
        "alpha_2_code" => "LA",
        "alpha_3_code" => "LAO",
        "en_short_name" => "Lao People's Democratic Republic",
        "nationality" => "Lao, Laotian",
        );

        $countries[] = array(
        "num_code" => "428",
        "alpha_2_code" => "LV",
        "alpha_3_code" => "LVA",
        "en_short_name" => "Latvia",
        "nationality" => "Latvian",
        );

        $countries[] = array(
        "num_code" => "422",
        "alpha_2_code" => "LB",
        "alpha_3_code" => "LBN",
        "en_short_name" => "Lebanon",
        "nationality" => "Lebanese",
        );

        $countries[] = array(
        "num_code" => "426",
        "alpha_2_code" => "LS",
        "alpha_3_code" => "LSO",
        "en_short_name" => "Lesotho",
        "nationality" => "Basotho",
        );

        $countries[] = array(
        "num_code" => "430",
        "alpha_2_code" => "LR",
        "alpha_3_code" => "LBR",
        "en_short_name" => "Liberia",
        "nationality" => "Liberian",
        );

        $countries[] = array(
        "num_code" => "434",
        "alpha_2_code" => "LY",
        "alpha_3_code" => "LBY",
        "en_short_name" => "Libya",
        "nationality" => "Libyan",
        );

        $countries[] = array(
        "num_code" => "438",
        "alpha_2_code" => "LI",
        "alpha_3_code" => "LIE",
        "en_short_name" => "Liechtenstein",
        "nationality" => "Liechtenstein",
        );

        $countries[] = array(
        "num_code" => "440",
        "alpha_2_code" => "LT",
        "alpha_3_code" => "LTU",
        "en_short_name" => "Lithuania",
        "nationality" => "Lithuanian",
        );

        $countries[] = array(
        "num_code" => "442",
        "alpha_2_code" => "LU",
        "alpha_3_code" => "LUX",
        "en_short_name" => "Luxembourg",
        "nationality" => "Luxembourg, Luxembourgish",
        );

        $countries[] = array(
        "num_code" => "446",
        "alpha_2_code" => "MO",
        "alpha_3_code" => "MAC",
        "en_short_name" => "Macao",
        "nationality" => "Macanese, Chinese",
        );

        $countries[] = array(
        "num_code" => "807",
        "alpha_2_code" => "MK",
        "alpha_3_code" => "MKD",
        "en_short_name" => "Macedonia (the former Yugoslav Republic of)",
        "nationality" => "Macedonian",
        );

        $countries[] = array(
        "num_code" => "450",
        "alpha_2_code" => "MG",
        "alpha_3_code" => "MDG",
        "en_short_name" => "Madagascar",
        "nationality" => "Malagasy",
        );

        $countries[] = array(
        "num_code" => "454",
        "alpha_2_code" => "MW",
        "alpha_3_code" => "MWI",
        "en_short_name" => "Malawi",
        "nationality" => "Malawian",
        );

        $countries[] = array(
        "num_code" => "458",
        "alpha_2_code" => "MY",
        "alpha_3_code" => "MYS",
        "en_short_name" => "Malaysia",
        "nationality" => "Malaysian",
        );

        $countries[] = array(
        "num_code" => "462",
        "alpha_2_code" => "MV",
        "alpha_3_code" => "MDV",
        "en_short_name" => "Maldives",
        "nationality" => "Maldivian",
        );

        $countries[] = array(
        "num_code" => "466",
        "alpha_2_code" => "ML",
        "alpha_3_code" => "MLI",
        "en_short_name" => "Mali",
        "nationality" => "Malian, Malinese",
        );

        $countries[] = array(
        "num_code" => "470",
        "alpha_2_code" => "MT",
        "alpha_3_code" => "MLT",
        "en_short_name" => "Malta",
        "nationality" => "Maltese",
        );

        $countries[] = array(
        "num_code" => "584",
        "alpha_2_code" => "MH",
        "alpha_3_code" => "MHL",
        "en_short_name" => "Marshall Islands",
        "nationality" => "Marshallese",
        );

        $countries[] = array(
        "num_code" => "474",
        "alpha_2_code" => "MQ",
        "alpha_3_code" => "MTQ",
        "en_short_name" => "Martinique",
        "nationality" => "Martiniquais, Martinican",
        );

        $countries[] = array(
        "num_code" => "478",
        "alpha_2_code" => "MR",
        "alpha_3_code" => "MRT",
        "en_short_name" => "Mauritania",
        "nationality" => "Mauritanian",
        );

        $countries[] = array(
        "num_code" => "480",
        "alpha_2_code" => "MU",
        "alpha_3_code" => "MUS",
        "en_short_name" => "Mauritius",
        "nationality" => "Mauritian",
        );

        $countries[] = array(
        "num_code" => "175",
        "alpha_2_code" => "YT",
        "alpha_3_code" => "MYT",
        "en_short_name" => "Mayotte",
        "nationality" => "Mahoran",
        );

        $countries[] = array(
        "num_code" => "484",
        "alpha_2_code" => "MX",
        "alpha_3_code" => "MEX",
        "en_short_name" => "Mexico",
        "nationality" => "Mexican",
        );

        $countries[] = array(
        "num_code" => "583",
        "alpha_2_code" => "FM",
        "alpha_3_code" => "FSM",
        "en_short_name" => "Micronesia (Federated States of)",
        "nationality" => "Micronesian",
        );

        $countries[] = array(
        "num_code" => "498",
        "alpha_2_code" => "MD",
        "alpha_3_code" => "MDA",
        "en_short_name" => "Moldova (Republic of)",
        "nationality" => "Moldovan",
        );

        $countries[] = array(
        "num_code" => "492",
        "alpha_2_code" => "MC",
        "alpha_3_code" => "MCO",
        "en_short_name" => "Monaco",
        "nationality" => "Monégasque, Monacan",
        );

        $countries[] = array(
        "num_code" => "496",
        "alpha_2_code" => "MN",
        "alpha_3_code" => "MNG",
        "en_short_name" => "Mongolia",
        "nationality" => "Mongolian",
        );

        $countries[] = array(
        "num_code" => "499",
        "alpha_2_code" => "ME",
        "alpha_3_code" => "MNE",
        "en_short_name" => "Montenegro",
        "nationality" => "Montenegrin",
        );

        $countries[] = array(
        "num_code" => "500",
        "alpha_2_code" => "MS",
        "alpha_3_code" => "MSR",
        "en_short_name" => "Montserrat",
        "nationality" => "Montserratian",
        );

        $countries[] = array(
        "num_code" => "504",
        "alpha_2_code" => "MA",
        "alpha_3_code" => "MAR",
        "en_short_name" => "Morocco",
        "nationality" => "Moroccan",
        );

        $countries[] = array(
        "num_code" => "508",
        "alpha_2_code" => "MZ",
        "alpha_3_code" => "MOZ",
        "en_short_name" => "Mozambique",
        "nationality" => "Mozambican",
        );

        $countries[] = array(
        "num_code" => "104",
        "alpha_2_code" => "MM",
        "alpha_3_code" => "MMR",
        "en_short_name" => "Myanmar",
        "nationality" => "Burmese",
        );

        $countries[] = array(
        "num_code" => "516",
        "alpha_2_code" => "NA",
        "alpha_3_code" => "NAM",
        "en_short_name" => "Namibia",
        "nationality" => "Namibian",
        );

        $countries[] = array(
        "num_code" => "520",
        "alpha_2_code" => "NR",
        "alpha_3_code" => "NRU",
        "en_short_name" => "Nauru",
        "nationality" => "Nauruan",
        );

        $countries[] = array(
        "num_code" => "524",
        "alpha_2_code" => "NP",
        "alpha_3_code" => "NPL",
        "en_short_name" => "Nepal",
        "nationality" => "Nepali, Nepalese",
        );

        $countries[] = array(
        "num_code" => "528",
        "alpha_2_code" => "NL",
        "alpha_3_code" => "NLD",
        "en_short_name" => "Netherlands",
        "nationality" => "Dutch, Netherlandic",
        );

        $countries[] = array(
        "num_code" => "540",
        "alpha_2_code" => "NC",
        "alpha_3_code" => "NCL",
        "en_short_name" => "New Caledonia",
        "nationality" => "New Caledonian",
        );

        $countries[] = array(
        "num_code" => "554",
        "alpha_2_code" => "NZ",
        "alpha_3_code" => "NZL",
        "en_short_name" => "New Zealand",
        "nationality" => "New Zealand, NZ",
        );

        $countries[] = array(
        "num_code" => "558",
        "alpha_2_code" => "NI",
        "alpha_3_code" => "NIC",
        "en_short_name" => "Nicaragua",
        "nationality" => "Nicaraguan",
        );

        $countries[] = array(
        "num_code" => "562",
        "alpha_2_code" => "NE",
        "alpha_3_code" => "NER",
        "en_short_name" => "Niger",
        "nationality" => "Nigerien",
        );

        $countries[] = array(
        "num_code" => "566",
        "alpha_2_code" => "NG",
        "alpha_3_code" => "NGA",
        "en_short_name" => "Nigeria",
        "nationality" => "Nigerian",
        );

        $countries[] = array(
        "num_code" => "570",
        "alpha_2_code" => "NU",
        "alpha_3_code" => "NIU",
        "en_short_name" => "Niue",
        "nationality" => "Niuean",
        );

        $countries[] = array(
        "num_code" => "574",
        "alpha_2_code" => "NF",
        "alpha_3_code" => "NFK",
        "en_short_name" => "Norfolk Island",
        "nationality" => "Norfolk Island",
        );

        $countries[] = array(
        "num_code" => "580",
        "alpha_2_code" => "MP",
        "alpha_3_code" => "MNP",
        "en_short_name" => "Northern Mariana Islands",
        "nationality" => "Northern Marianan",
        );

        $countries[] = array(
        "num_code" => "578",
        "alpha_2_code" => "NO",
        "alpha_3_code" => "NOR",
        "en_short_name" => "Norway",
        "nationality" => "Norwegian",
        );

        $countries[] = array(
        "num_code" => "512",
        "alpha_2_code" => "OM",
        "alpha_3_code" => "OMN",
        "en_short_name" => "Oman",
        "nationality" => "Omani",
        );

        $countries[] = array(
        "num_code" => "586",
        "alpha_2_code" => "PK",
        "alpha_3_code" => "PAK",
        "en_short_name" => "Pakistan",
        "nationality" => "Pakistani",
        );

        $countries[] = array(
        "num_code" => "585",
        "alpha_2_code" => "PW",
        "alpha_3_code" => "PLW",
        "en_short_name" => "Palau",
        "nationality" => "Palauan",
        );

        $countries[] = array(
        "num_code" => "275",
        "alpha_2_code" => "PS",
        "alpha_3_code" => "PSE",
        "en_short_name" => "Palestine, State of",
        "nationality" => "Palestinian",
        );

        $countries[] = array(
        "num_code" => "591",
        "alpha_2_code" => "PA",
        "alpha_3_code" => "PAN",
        "en_short_name" => "Panama",
        "nationality" => "Panamanian",
        );

        $countries[] = array(
        "num_code" => "598",
        "alpha_2_code" => "PG",
        "alpha_3_code" => "PNG",
        "en_short_name" => "Papua New Guinea",
        "nationality" => "Papua New Guinean, Papuan",
        );

        $countries[] = array(
        "num_code" => "600",
        "alpha_2_code" => "PY",
        "alpha_3_code" => "PRY",
        "en_short_name" => "Paraguay",
        "nationality" => "Paraguayan",
        );

        $countries[] = array(
        "num_code" => "604",
        "alpha_2_code" => "PE",
        "alpha_3_code" => "PER",
        "en_short_name" => "Peru",
        "nationality" => "Peruvian",
        );

        $countries[] = array(
        "num_code" => "608",
        "alpha_2_code" => "PH",
        "alpha_3_code" => "PHL",
        "en_short_name" => "Philippines",
        "nationality" => "Philippine, Filipino",
        );

        $countries[] = array(
        "num_code" => "612",
        "alpha_2_code" => "PN",
        "alpha_3_code" => "PCN",
        "en_short_name" => "Pitcairn",
        "nationality" => "Pitcairn Island",
        );

        $countries[] = array(
        "num_code" => "616",
        "alpha_2_code" => "PL",
        "alpha_3_code" => "POL",
        "en_short_name" => "Poland",
        "nationality" => "Polish",
        );

        $countries[] = array(
        "num_code" => "620",
        "alpha_2_code" => "PT",
        "alpha_3_code" => "PRT",
        "en_short_name" => "Portugal",
        "nationality" => "Portuguese",
        );

        $countries[] = array(
        "num_code" => "630",
        "alpha_2_code" => "PR",
        "alpha_3_code" => "PRI",
        "en_short_name" => "Puerto Rico",
        "nationality" => "Puerto Rican",
        );

        $countries[] = array(
        "num_code" => "634",
        "alpha_2_code" => "QA",
        "alpha_3_code" => "QAT",
        "en_short_name" => "Qatar",
        "nationality" => "Qatari",
        );

        $countries[] = array(
        "num_code" => "638",
        "alpha_2_code" => "RE",
        "alpha_3_code" => "REU",
        "en_short_name" => "Réunion",
        "nationality" => "Réunionese, Réunionnais",
        );

        $countries[] = array(
        "num_code" => "642",
        "alpha_2_code" => "RO",
        "alpha_3_code" => "ROU",
        "en_short_name" => "Romania",
        "nationality" => "Romanian",
        );

        $countries[] = array(
        "num_code" => "643",
        "alpha_2_code" => "RU",
        "alpha_3_code" => "RUS",
        "en_short_name" => "Russian Federation",
        "nationality" => "Russian",
        );

        $countries[] = array(
        "num_code" => "646",
        "alpha_2_code" => "RW",
        "alpha_3_code" => "RWA",
        "en_short_name" => "Rwanda",
        "nationality" => "Rwandan",
        );

        $countries[] = array(
        "num_code" => "652",
        "alpha_2_code" => "BL",
        "alpha_3_code" => "BLM",
        "en_short_name" => "Saint Barthélemy",
        "nationality" => "Barthélemois",
        );

        $countries[] = array(
        "num_code" => "654",
        "alpha_2_code" => "SH",
        "alpha_3_code" => "SHN",
        "en_short_name" => "Saint Helena, Ascension and Tristan da Cunha",
        "nationality" => "Saint Helenian",
        );

        $countries[] = array(
        "num_code" => "659",
        "alpha_2_code" => "KN",
        "alpha_3_code" => "KNA",
        "en_short_name" => "Saint Kitts and Nevis",
        "nationality" => "Kittitian or Nevisian",
        );

        $countries[] = array(
        "num_code" => "662",
        "alpha_2_code" => "LC",
        "alpha_3_code" => "LCA",
        "en_short_name" => "Saint Lucia",
        "nationality" => "Saint Lucian",
        );

        $countries[] = array(
        "num_code" => "663",
        "alpha_2_code" => "MF",
        "alpha_3_code" => "MAF",
        "en_short_name" => "Saint Martin (French part)",
        "nationality" => "Saint-Martinoise",
        );

        $countries[] = array(
        "num_code" => "666",
        "alpha_2_code" => "PM",
        "alpha_3_code" => "SPM",
        "en_short_name" => "Saint Pierre and Miquelon",
        "nationality" => "Saint-Pierrais or Miquelonnais",
        );

        $countries[] = array(
        "num_code" => "670",
        "alpha_2_code" => "VC",
        "alpha_3_code" => "VCT",
        "en_short_name" => "Saint Vincent and the Grenadines",
        "nationality" => "Saint Vincentian, Vincentian",
        );

        $countries[] = array(
        "num_code" => "882",
        "alpha_2_code" => "WS",
        "alpha_3_code" => "WSM",
        "en_short_name" => "Samoa",
        "nationality" => "Samoan",
        );

        $countries[] = array(
        "num_code" => "674",
        "alpha_2_code" => "SM",
        "alpha_3_code" => "SMR",
        "en_short_name" => "San Marino",
        "nationality" => "Sammarinese",
        );

        $countries[] = array(
        "num_code" => "678",
        "alpha_2_code" => "ST",
        "alpha_3_code" => "STP",
        "en_short_name" => "Sao Tome and Principe",
        "nationality" => "São Toméan",
        );

        $countries[] = array(
        "num_code" => "682",
        "alpha_2_code" => "SA",
        "alpha_3_code" => "SAU",
        "en_short_name" => "Saudi Arabia",
        "nationality" => "Saudi, Saudi Arabian",
        );

        $countries[] = array(
        "num_code" => "686",
        "alpha_2_code" => "SN",
        "alpha_3_code" => "SEN",
        "en_short_name" => "Senegal",
        "nationality" => "Senegalese",
        );

        $countries[] = array(
        "num_code" => "688",
        "alpha_2_code" => "RS",
        "alpha_3_code" => "SRB",
        "en_short_name" => "Serbia",
        "nationality" => "Serbian",
        );

        $countries[] = array(
        "num_code" => "690",
        "alpha_2_code" => "SC",
        "alpha_3_code" => "SYC",
        "en_short_name" => "Seychelles",
        "nationality" => "Seychellois",
        );

        $countries[] = array(
        "num_code" => "694",
        "alpha_2_code" => "SL",
        "alpha_3_code" => "SLE",
        "en_short_name" => "Sierra Leone",
        "nationality" => "Sierra Leonean",
        );

        $countries[] = array(
        "num_code" => "702",
        "alpha_2_code" => "SG",
        "alpha_3_code" => "SGP",
        "en_short_name" => "Singapore",
        "nationality" => "Singaporean",
        );

        $countries[] = array(
        "num_code" => "534",
        "alpha_2_code" => "SX",
        "alpha_3_code" => "SXM",
        "en_short_name" => "Sint Maarten (Dutch part)",
        "nationality" => "Sint Maarten",
        );

        $countries[] = array(
        "num_code" => "703",
        "alpha_2_code" => "SK",
        "alpha_3_code" => "SVK",
        "en_short_name" => "Slovakia",
        "nationality" => "Slovak",
        );

        $countries[] = array(
        "num_code" => "705",
        "alpha_2_code" => "SI",
        "alpha_3_code" => "SVN",
        "en_short_name" => "Slovenia",
        "nationality" => "Slovenian, Slovene",
        );

        $countries[] = array(
        "num_code" => "90",
        "alpha_2_code" => "SB",
        "alpha_3_code" => "SLB",
        "en_short_name" => "Solomon Islands",
        "nationality" => "Solomon Island",
        );

        $countries[] = array(
        "num_code" => "706",
        "alpha_2_code" => "SO",
        "alpha_3_code" => "SOM",
        "en_short_name" => "Somalia",
        "nationality" => "Somali, Somalian",
        );

        $countries[] = array(
        "num_code" => "710",
        "alpha_2_code" => "ZA",
        "alpha_3_code" => "ZAF",
        "en_short_name" => "South Africa",
        "nationality" => "South African",
        );

        $countries[] = array(
        "num_code" => "239",
        "alpha_2_code" => "GS",
        "alpha_3_code" => "SGS",
        "en_short_name" => "South Georgia and the South Sandwich Islands",
        "nationality" => "South Georgia or South Sandwich Islands",
        );

        $countries[] = array(
        "num_code" => "728",
        "alpha_2_code" => "SS",
        "alpha_3_code" => "SSD",
        "en_short_name" => "South Sudan",
        "nationality" => "South Sudanese",
        );

        $countries[] = array(
        "num_code" => "724",
        "alpha_2_code" => "ES",
        "alpha_3_code" => "ESP",
        "en_short_name" => "Spain",
        "nationality" => "Spanish",
        );

        $countries[] = array(
        "num_code" => "144",
        "alpha_2_code" => "LK",
        "alpha_3_code" => "LKA",
        "en_short_name" => "Sri Lanka",
        "nationality" => "Sri Lankan",
        );

        $countries[] = array(
        "num_code" => "729",
        "alpha_2_code" => "SD",
        "alpha_3_code" => "SDN",
        "en_short_name" => "Sudan",
        "nationality" => "Sudanese",
        );

        $countries[] = array(
        "num_code" => "740",
        "alpha_2_code" => "SR",
        "alpha_3_code" => "SUR",
        "en_short_name" => "Suriname",
        "nationality" => "Surinamese",
        );

        $countries[] = array(
        "num_code" => "744",
        "alpha_2_code" => "SJ",
        "alpha_3_code" => "SJM",
        "en_short_name" => "Svalbard and Jan Mayen",
        "nationality" => "Svalbard",
        );

        $countries[] = array(
        "num_code" => "748",
        "alpha_2_code" => "SZ",
        "alpha_3_code" => "SWZ",
        "en_short_name" => "Swaziland",
        "nationality" => "Swazi",
        );

        $countries[] = array(
        "num_code" => "752",
        "alpha_2_code" => "SE",
        "alpha_3_code" => "SWE",
        "en_short_name" => "Sweden",
        "nationality" => "Swedish",
        );

        $countries[] = array(
        "num_code" => "756",
        "alpha_2_code" => "CH",
        "alpha_3_code" => "CHE",
        "en_short_name" => "Switzerland",
        "nationality" => "Swiss",
        );

        $countries[] = array(
        "num_code" => "760",
        "alpha_2_code" => "SY",
        "alpha_3_code" => "SYR",
        "en_short_name" => "Syrian Arab Republic",
        "nationality" => "Syrian",
        );

        $countries[] = array(
        "num_code" => "158",
        "alpha_2_code" => "TW",
        "alpha_3_code" => "TWN",
        "en_short_name" => "Taiwan, Province of China",
        "nationality" => "Chinese, Taiwanese",
        );

        $countries[] = array(
        "num_code" => "762",
        "alpha_2_code" => "TJ",
        "alpha_3_code" => "TJK",
        "en_short_name" => "Tajikistan",
        "nationality" => "Tajikistani",
        );

        $countries[] = array(
        "num_code" => "834",
        "alpha_2_code" => "TZ",
        "alpha_3_code" => "TZA",
        "en_short_name" => "Tanzania, United Republic of",
        "nationality" => "Tanzanian",
        );

        $countries[] = array(
        "num_code" => "764",
        "alpha_2_code" => "TH",
        "alpha_3_code" => "THA",
        "en_short_name" => "Thailand",
        "nationality" => "Thai",
        );

        $countries[] = array(
        "num_code" => "626",
        "alpha_2_code" => "TL",
        "alpha_3_code" => "TLS",
        "en_short_name" => "Timor-Leste",
        "nationality" => "Timorese",
        );

        $countries[] = array(
        "num_code" => "768",
        "alpha_2_code" => "TG",
        "alpha_3_code" => "TGO",
        "en_short_name" => "Togo",
        "nationality" => "Togolese",
        );

        $countries[] = array(
        "num_code" => "772",
        "alpha_2_code" => "TK",
        "alpha_3_code" => "TKL",
        "en_short_name" => "Tokelau",
        "nationality" => "Tokelauan",
        );

        $countries[] = array(
        "num_code" => "776",
        "alpha_2_code" => "TO",
        "alpha_3_code" => "TON",
        "en_short_name" => "Tonga",
        "nationality" => "Tongan",
        );

        $countries[] = array(
        "num_code" => "780",
        "alpha_2_code" => "TT",
        "alpha_3_code" => "TTO",
        "en_short_name" => "Trinidad and Tobago",
        "nationality" => "Trinidadian or Tobagonian",
        );

        $countries[] = array(
        "num_code" => "788",
        "alpha_2_code" => "TN",
        "alpha_3_code" => "TUN",
        "en_short_name" => "Tunisia",
        "nationality" => "Tunisian",
        );

        $countries[] = array(
        "num_code" => "792",
        "alpha_2_code" => "TR",
        "alpha_3_code" => "TUR",
        "en_short_name" => "Turkey",
        "nationality" => "Turkish",
        );

        $countries[] = array(
        "num_code" => "795",
        "alpha_2_code" => "TM",
        "alpha_3_code" => "TKM",
        "en_short_name" => "Turkmenistan",
        "nationality" => "Turkmen",
        );

        $countries[] = array(
        "num_code" => "796",
        "alpha_2_code" => "TC",
        "alpha_3_code" => "TCA",
        "en_short_name" => "Turks and Caicos Islands",
        "nationality" => "Turks and Caicos Island",
        );

        $countries[] = array(
        "num_code" => "798",
        "alpha_2_code" => "TV",
        "alpha_3_code" => "TUV",
        "en_short_name" => "Tuvalu",
        "nationality" => "Tuvaluan",
        );

        $countries[] = array(
        "num_code" => "800",
        "alpha_2_code" => "UG",
        "alpha_3_code" => "UGA",
        "en_short_name" => "Uganda",
        "nationality" => "Ugandan",
        );

        $countries[] = array(
        "num_code" => "804",
        "alpha_2_code" => "UA",
        "alpha_3_code" => "UKR",
        "en_short_name" => "Ukraine",
        "nationality" => "Ukrainian",
        );

        $countries[] = array(
        "num_code" => "784",
        "alpha_2_code" => "AE",
        "alpha_3_code" => "ARE",
        "en_short_name" => "United Arab Emirates",
        "nationality" => "Emirati, Emirian, Emiri",
        );

        $countries[] = array(
        "num_code" => "826",
        "alpha_2_code" => "GB",
        "alpha_3_code" => "GBR",
        "en_short_name" => "United Kingdom of Great Britain and Northern Ireland",
        "nationality" => "British, UK",
        );

        $countries[] = array(
        "num_code" => "581",
        "alpha_2_code" => "UM",
        "alpha_3_code" => "UMI",
        "en_short_name" => "United States Minor Outlying Islands",
        "nationality" => "American",
        );

        $countries[] = array(
        "num_code" => "840",
        "alpha_2_code" => "US",
        "alpha_3_code" => "USA",
        "en_short_name" => "United States of America",
        "nationality" => "American",
        );

        $countries[] = array(
        "num_code" => "858",
        "alpha_2_code" => "UY",
        "alpha_3_code" => "URY",
        "en_short_name" => "Uruguay",
        "nationality" => "Uruguayan",
        );

        $countries[] = array(
        "num_code" => "860",
        "alpha_2_code" => "UZ",
        "alpha_3_code" => "UZB",
        "en_short_name" => "Uzbekistan",
        "nationality" => "Uzbekistani, Uzbek",
        );

        $countries[] = array(
        "num_code" => "548",
        "alpha_2_code" => "VU",
        "alpha_3_code" => "VUT",
        "en_short_name" => "Vanuatu",
        "nationality" => "Ni-Vanuatu, Vanuatuan",
        );

        $countries[] = array(
        "num_code" => "862",
        "alpha_2_code" => "VE",
        "alpha_3_code" => "VEN",
        "en_short_name" => "Venezuela (Bolivarian Republic of)",
        "nationality" => "Venezuelan",
        );

        $countries[] = array(
        "num_code" => "704",
        "alpha_2_code" => "VN",
        "alpha_3_code" => "VNM",
        "en_short_name" => "Vietnam",
        "nationality" => "Vietnamese",
        );

        $countries[] = array(
        "num_code" => "92",
        "alpha_2_code" => "VG",
        "alpha_3_code" => "VGB",
        "en_short_name" => "Virgin Islands (British)",
        "nationality" => "British Virgin Island",
        );

        $countries[] = array(
        "num_code" => "850",
        "alpha_2_code" => "VI",
        "alpha_3_code" => "VIR",
        "en_short_name" => "Virgin Islands (U.S.)",
        "nationality" => "U.S. Virgin Island",
        );

        $countries[] = array(
        "num_code" => "876",
        "alpha_2_code" => "WF",
        "alpha_3_code" => "WLF",
        "en_short_name" => "Wallis and Futuna",
        "nationality" => "Wallis and Futuna, Wallisian or Futunan",
        );

        $countries[] = array(
        "num_code" => "732",
        "alpha_2_code" => "EH",
        "alpha_3_code" => "ESH",
        "en_short_name" => "Western Sahara",
        "nationality" => "Sahrawi, Sahrawian, Sahraouian",
        );

        $countries[] = array(
        "num_code" => "887",
        "alpha_2_code" => "YE",
        "alpha_3_code" => "YEM",
        "en_short_name" => "Yemen",
        "nationality" => "Yemeni",
        );

        $countries[] = array(
        "num_code" => "894",
        "alpha_2_code" => "ZM",
        "alpha_3_code" => "ZMB",
        "en_short_name" => "Zambia",
        "nationality" => "Zambian",
        );

        $countries[] = array(
        "num_code" => "716",
        "alpha_2_code" => "ZW",
        "alpha_3_code" => "ZWE",
        "en_short_name" => "Zimbabwe",
        "nationality" => "Zimbabwean",
        );

        $user = Auth::User();
        $userId = $user->id;
        $professions = Profession::get(['profession_name']);
        $professions_names = $professions->unique('profession_name')->toArray();
        $professions_types = Profession::where('profession_name','=','Doctor')->get(['profession_type'])->toArray();
        $avatar = User::where('id','=',$userId)->get(['avatar','name'])->toArray();
        $isAdmin = DB::table('user_menu')->where('user_id',$userId)->where('menu_options_id',14)->get()->count();
        $member_data = Membership::where('user_id','=',$userId)->get()->toArray();
        if(!empty($member_data)){
            $member_data = $member_data[0];
        }
        else
        {
            $member_data['join_date'] = "";
            $member_data['membership_type'] = "";
            $member_data['membership_category'] = "";
            $member_data['status'] = "";
            $member_data['cell_num'] = "";
            $member_data['email'] = "";
            $member_data['reference_id'] = "";
            $member_data['reference_name'] = "";
            $member_data['nid_no'] = "";
            $member_data['instagram'] = "";
            $member_data['facebook'] = "";
            $member_data['linkedin'] = "";
            $member_data['twitter'] = "";
            $member_data['gender'] = "";
            $member_data['nationality'] = "";
            $member_data['date_of_birth'] = "";
            $member_data['yearly_income'] = "";
            $member_data['profession_name'] = "";
            $member_data['profession_type'] = "";
            $member_data['blah'] = "";
            $member_data['account_detail'] = "";
            $member_data['nationality_2'] = "";
        }
        return view('pages.admin.membership',['countries'=>$countries,'isAdmin'=>$isAdmin,'professions_types'=>$professions_types,'professions_name'=>$professions_names,'avatar'=>$avatar[0]['avatar'],'name'=>$avatar[0]['name'],'details'=>$member_data]);
    }

    public function getMemberDetailsUsingEmail()
    {

        $countries = array();

        $countries[] = array(
        "num_code" => "4",
        "alpha_2_code" => "AF",
        "alpha_3_code" => "AFG",
        "en_short_name" => "Afghanistan",
        "nationality" => "Afghan",
        );

        $countries[] = array(
        "num_code" => "248",
        "alpha_2_code" => "AX",
        "alpha_3_code" => "ALA",
        "en_short_name" => "Åland Islands",
        "nationality" => "Åland Island",
        );

        $countries[] = array(
        "num_code" => "8",
        "alpha_2_code" => "AL",
        "alpha_3_code" => "ALB",
        "en_short_name" => "Albania",
        "nationality" => "Albanian",
        );

        $countries[] = array(
        "num_code" => "12",
        "alpha_2_code" => "DZ",
        "alpha_3_code" => "DZA",
        "en_short_name" => "Algeria",
        "nationality" => "Algerian",
        );

        $countries[] = array(
        "num_code" => "16",
        "alpha_2_code" => "AS",
        "alpha_3_code" => "ASM",
        "en_short_name" => "American Samoa",
        "nationality" => "American Samoan",
        );

        $countries[] = array(
        "num_code" => "20",
        "alpha_2_code" => "AD",
        "alpha_3_code" => "AND",
        "en_short_name" => "Andorra",
        "nationality" => "Andorran",
        );

        $countries[] = array(
        "num_code" => "24",
        "alpha_2_code" => "AO",
        "alpha_3_code" => "AGO",
        "en_short_name" => "Angola",
        "nationality" => "Angolan",
        );

        $countries[] = array(
        "num_code" => "660",
        "alpha_2_code" => "AI",
        "alpha_3_code" => "AIA",
        "en_short_name" => "Anguilla",
        "nationality" => "Anguillan",
        );

        $countries[] = array(
        "num_code" => "10",
        "alpha_2_code" => "AQ",
        "alpha_3_code" => "ATA",
        "en_short_name" => "Antarctica",
        "nationality" => "Antarctic",
        );

        $countries[] = array(
        "num_code" => "28",
        "alpha_2_code" => "AG",
        "alpha_3_code" => "ATG",
        "en_short_name" => "Antigua and Barbuda",
        "nationality" => "Antiguan or Barbudan",
        );

        $countries[] = array(
        "num_code" => "32",
        "alpha_2_code" => "AR",
        "alpha_3_code" => "ARG",
        "en_short_name" => "Argentina",
        "nationality" => "Argentine",
        );

        $countries[] = array(
        "num_code" => "51",
        "alpha_2_code" => "AM",
        "alpha_3_code" => "ARM",
        "en_short_name" => "Armenia",
        "nationality" => "Armenian",
        );

        $countries[] = array(
        "num_code" => "533",
        "alpha_2_code" => "AW",
        "alpha_3_code" => "ABW",
        "en_short_name" => "Aruba",
        "nationality" => "Aruban",
        );

        $countries[] = array(
        "num_code" => "36",
        "alpha_2_code" => "AU",
        "alpha_3_code" => "AUS",
        "en_short_name" => "Australia",
        "nationality" => "Australian",
        );

        $countries[] = array(
        "num_code" => "40",
        "alpha_2_code" => "AT",
        "alpha_3_code" => "AUT",
        "en_short_name" => "Austria",
        "nationality" => "Austrian",
        );

        $countries[] = array(
        "num_code" => "31",
        "alpha_2_code" => "AZ",
        "alpha_3_code" => "AZE",
        "en_short_name" => "Azerbaijan",
        "nationality" => "Azerbaijani, Azeri",
        );

        $countries[] = array(
        "num_code" => "44",
        "alpha_2_code" => "BS",
        "alpha_3_code" => "BHS",
        "en_short_name" => "Bahamas",
        "nationality" => "Bahamian",
        );

        $countries[] = array(
        "num_code" => "48",
        "alpha_2_code" => "BH",
        "alpha_3_code" => "BHR",
        "en_short_name" => "Bahrain",
        "nationality" => "Bahraini",
        );

        $countries[] = array(
        "num_code" => "50",
        "alpha_2_code" => "BD",
        "alpha_3_code" => "BGD",
        "en_short_name" => "Bangladesh",
        "nationality" => "Bangladeshi",
        );

        $countries[] = array(
        "num_code" => "52",
        "alpha_2_code" => "BB",
        "alpha_3_code" => "BRB",
        "en_short_name" => "Barbados",
        "nationality" => "Barbadian",
        );

        $countries[] = array(
        "num_code" => "112",
        "alpha_2_code" => "BY",
        "alpha_3_code" => "BLR",
        "en_short_name" => "Belarus",
        "nationality" => "Belarusian",
        );

        $countries[] = array(
        "num_code" => "56",
        "alpha_2_code" => "BE",
        "alpha_3_code" => "BEL",
        "en_short_name" => "Belgium",
        "nationality" => "Belgian",
        );

        $countries[] = array(
        "num_code" => "84",
        "alpha_2_code" => "BZ",
        "alpha_3_code" => "BLZ",
        "en_short_name" => "Belize",
        "nationality" => "Belizean",
        );

        $countries[] = array(
        "num_code" => "204",
        "alpha_2_code" => "BJ",
        "alpha_3_code" => "BEN",
        "en_short_name" => "Benin",
        "nationality" => "Beninese, Beninois",
        );

        $countries[] = array(
        "num_code" => "60",
        "alpha_2_code" => "BM",
        "alpha_3_code" => "BMU",
        "en_short_name" => "Bermuda",
        "nationality" => "Bermudian, Bermudan",
        );

        $countries[] = array(
        "num_code" => "64",
        "alpha_2_code" => "BT",
        "alpha_3_code" => "BTN",
        "en_short_name" => "Bhutan",
        "nationality" => "Bhutanese",
        );

        $countries[] = array(
        "num_code" => "68",
        "alpha_2_code" => "BO",
        "alpha_3_code" => "BOL",
        "en_short_name" => "Bolivia (Plurinational State of)",
        "nationality" => "Bolivian",
        );

        $countries[] = array(
        "num_code" => "535",
        "alpha_2_code" => "BQ",
        "alpha_3_code" => "BES",
        "en_short_name" => "Bonaire, Sint Eustatius and Saba",
        "nationality" => "Bonaire",
        );

        $countries[] = array(
        "num_code" => "70",
        "alpha_2_code" => "BA",
        "alpha_3_code" => "BIH",
        "en_short_name" => "Bosnia and Herzegovina",
        "nationality" => "Bosnian or Herzegovinian",
        );

        $countries[] = array(
        "num_code" => "72",
        "alpha_2_code" => "BW",
        "alpha_3_code" => "BWA",
        "en_short_name" => "Botswana",
        "nationality" => "Motswana, Botswanan",
        );

        $countries[] = array(
        "num_code" => "74",
        "alpha_2_code" => "BV",
        "alpha_3_code" => "BVT",
        "en_short_name" => "Bouvet Island",
        "nationality" => "Bouvet Island",
        );

        $countries[] = array(
        "num_code" => "76",
        "alpha_2_code" => "BR",
        "alpha_3_code" => "BRA",
        "en_short_name" => "Brazil",
        "nationality" => "Brazilian",
        );

        $countries[] = array(
        "num_code" => "86",
        "alpha_2_code" => "IO",
        "alpha_3_code" => "IOT",
        "en_short_name" => "British Indian Ocean Territory",
        "nationality" => "BIOT",
        );

        $countries[] = array(
        "num_code" => "96",
        "alpha_2_code" => "BN",
        "alpha_3_code" => "BRN",
        "en_short_name" => "Brunei Darussalam",
        "nationality" => "Bruneian",
        );

        $countries[] = array(
        "num_code" => "100",
        "alpha_2_code" => "BG",
        "alpha_3_code" => "BGR",
        "en_short_name" => "Bulgaria",
        "nationality" => "Bulgarian",
        );

        $countries[] = array(
        "num_code" => "854",
        "alpha_2_code" => "BF",
        "alpha_3_code" => "BFA",
        "en_short_name" => "Burkina Faso",
        "nationality" => "Burkinabé",
        );

        $countries[] = array(
        "num_code" => "108",
        "alpha_2_code" => "BI",
        "alpha_3_code" => "BDI",
        "en_short_name" => "Burundi",
        "nationality" => "Burundian",
        );

        $countries[] = array(
        "num_code" => "132",
        "alpha_2_code" => "CV",
        "alpha_3_code" => "CPV",
        "en_short_name" => "Cabo Verde",
        "nationality" => "Cabo Verdean",
        );

        $countries[] = array(
        "num_code" => "116",
        "alpha_2_code" => "KH",
        "alpha_3_code" => "KHM",
        "en_short_name" => "Cambodia",
        "nationality" => "Cambodian",
        );

        $countries[] = array(
        "num_code" => "120",
        "alpha_2_code" => "CM",
        "alpha_3_code" => "CMR",
        "en_short_name" => "Cameroon",
        "nationality" => "Cameroonian",
        );

        $countries[] = array(
        "num_code" => "124",
        "alpha_2_code" => "CA",
        "alpha_3_code" => "CAN",
        "en_short_name" => "Canada",
        "nationality" => "Canadian",
        );

        $countries[] = array(
        "num_code" => "136",
        "alpha_2_code" => "KY",
        "alpha_3_code" => "CYM",
        "en_short_name" => "Cayman Islands",
        "nationality" => "Caymanian",
        );

        $countries[] = array(
        "num_code" => "140",
        "alpha_2_code" => "CF",
        "alpha_3_code" => "CAF",
        "en_short_name" => "Central African Republic",
        "nationality" => "Central African",
        );

        $countries[] = array(
        "num_code" => "148",
        "alpha_2_code" => "TD",
        "alpha_3_code" => "TCD",
        "en_short_name" => "Chad",
        "nationality" => "Chadian",
        );

        $countries[] = array(
        "num_code" => "152",
        "alpha_2_code" => "CL",
        "alpha_3_code" => "CHL",
        "en_short_name" => "Chile",
        "nationality" => "Chilean",
        );

        $countries[] = array(
        "num_code" => "156",
        "alpha_2_code" => "CN",
        "alpha_3_code" => "CHN",
        "en_short_name" => "China",
        "nationality" => "Chinese",
        );

        $countries[] = array(
        "num_code" => "162",
        "alpha_2_code" => "CX",
        "alpha_3_code" => "CXR",
        "en_short_name" => "Christmas Island",
        "nationality" => "Christmas Island",
        );

        $countries[] = array(
        "num_code" => "166",
        "alpha_2_code" => "CC",
        "alpha_3_code" => "CCK",
        "en_short_name" => "Cocos (Keeling) Islands",
        "nationality" => "Cocos Island",
        );

        $countries[] = array(
        "num_code" => "170",
        "alpha_2_code" => "CO",
        "alpha_3_code" => "COL",
        "en_short_name" => "Colombia",
        "nationality" => "Colombian",
        );

        $countries[] = array(
        "num_code" => "174",
        "alpha_2_code" => "KM",
        "alpha_3_code" => "COM",
        "en_short_name" => "Comoros",
        "nationality" => "Comoran, Comorian",
        );

        $countries[] = array(
        "num_code" => "178",
        "alpha_2_code" => "CG",
        "alpha_3_code" => "COG",
        "en_short_name" => "Congo (Republic of the)",
        "nationality" => "Congolese",
        );

        $countries[] = array(
        "num_code" => "180",
        "alpha_2_code" => "CD",
        "alpha_3_code" => "COD",
        "en_short_name" => "Congo (Democratic Republic of the)",
        "nationality" => "Congolese",
        );

        $countries[] = array(
        "num_code" => "184",
        "alpha_2_code" => "CK",
        "alpha_3_code" => "COK",
        "en_short_name" => "Cook Islands",
        "nationality" => "Cook Island",
        );

        $countries[] = array(
        "num_code" => "188",
        "alpha_2_code" => "CR",
        "alpha_3_code" => "CRI",
        "en_short_name" => "Costa Rica",
        "nationality" => "Costa Rican",
        );

        $countries[] = array(
        "num_code" => "384",
        "alpha_2_code" => "CI",
        "alpha_3_code" => "CIV",
        "en_short_name" => "Côte d'Ivoire",
        "nationality" => "Ivorian",
        );

        $countries[] = array(
        "num_code" => "191",
        "alpha_2_code" => "HR",
        "alpha_3_code" => "HRV",
        "en_short_name" => "Croatia",
        "nationality" => "Croatian",
        );

        $countries[] = array(
        "num_code" => "192",
        "alpha_2_code" => "CU",
        "alpha_3_code" => "CUB",
        "en_short_name" => "Cuba",
        "nationality" => "Cuban",
        );

        $countries[] = array(
        "num_code" => "531",
        "alpha_2_code" => "CW",
        "alpha_3_code" => "CUW",
        "en_short_name" => "Curaçao",
        "nationality" => "Curaçaoan",
        );

        $countries[] = array(
        "num_code" => "196",
        "alpha_2_code" => "CY",
        "alpha_3_code" => "CYP",
        "en_short_name" => "Cyprus",
        "nationality" => "Cypriot",
        );

        $countries[] = array(
        "num_code" => "203",
        "alpha_2_code" => "CZ",
        "alpha_3_code" => "CZE",
        "en_short_name" => "Czech Republic",
        "nationality" => "Czech",
        );

        $countries[] = array(
        "num_code" => "208",
        "alpha_2_code" => "DK",
        "alpha_3_code" => "DNK",
        "en_short_name" => "Denmark",
        "nationality" => "Danish",
        );

        $countries[] = array(
        "num_code" => "262",
        "alpha_2_code" => "DJ",
        "alpha_3_code" => "DJI",
        "en_short_name" => "Djibouti",
        "nationality" => "Djiboutian",
        );

        $countries[] = array(
        "num_code" => "212",
        "alpha_2_code" => "DM",
        "alpha_3_code" => "DMA",
        "en_short_name" => "Dominica",
        "nationality" => "Dominican",
        );

        $countries[] = array(
        "num_code" => "214",
        "alpha_2_code" => "DO",
        "alpha_3_code" => "DOM",
        "en_short_name" => "Dominican Republic",
        "nationality" => "Dominican",
        );

        $countries[] = array(
        "num_code" => "218",
        "alpha_2_code" => "EC",
        "alpha_3_code" => "ECU",
        "en_short_name" => "Ecuador",
        "nationality" => "Ecuadorian",
        );

        $countries[] = array(
        "num_code" => "818",
        "alpha_2_code" => "EG",
        "alpha_3_code" => "EGY",
        "en_short_name" => "Egypt",
        "nationality" => "Egyptian",
        );

        $countries[] = array(
        "num_code" => "222",
        "alpha_2_code" => "SV",
        "alpha_3_code" => "SLV",
        "en_short_name" => "El Salvador",
        "nationality" => "Salvadoran",
        );

        $countries[] = array(
        "num_code" => "226",
        "alpha_2_code" => "GQ",
        "alpha_3_code" => "GNQ",
        "en_short_name" => "Equatorial Guinea",
        "nationality" => "Equatorial Guinean, Equatoguinean",
        );

        $countries[] = array(
        "num_code" => "232",
        "alpha_2_code" => "ER",
        "alpha_3_code" => "ERI",
        "en_short_name" => "Eritrea",
        "nationality" => "Eritrean",
        );

        $countries[] = array(
        "num_code" => "233",
        "alpha_2_code" => "EE",
        "alpha_3_code" => "EST",
        "en_short_name" => "Estonia",
        "nationality" => "Estonian",
        );

        $countries[] = array(
        "num_code" => "231",
        "alpha_2_code" => "ET",
        "alpha_3_code" => "ETH",
        "en_short_name" => "Ethiopia",
        "nationality" => "Ethiopian",
        );

        $countries[] = array(
        "num_code" => "238",
        "alpha_2_code" => "FK",
        "alpha_3_code" => "FLK",
        "en_short_name" => "Falkland Islands (Malvinas)",
        "nationality" => "Falkland Island",
        );

        $countries[] = array(
        "num_code" => "234",
        "alpha_2_code" => "FO",
        "alpha_3_code" => "FRO",
        "en_short_name" => "Faroe Islands",
        "nationality" => "Faroese",
        );

        $countries[] = array(
        "num_code" => "242",
        "alpha_2_code" => "FJ",
        "alpha_3_code" => "FJI",
        "en_short_name" => "Fiji",
        "nationality" => "Fijian",
        );

        $countries[] = array(
        "num_code" => "246",
        "alpha_2_code" => "FI",
        "alpha_3_code" => "FIN",
        "en_short_name" => "Finland",
        "nationality" => "Finnish",
        );

        $countries[] = array(
        "num_code" => "250",
        "alpha_2_code" => "FR",
        "alpha_3_code" => "FRA",
        "en_short_name" => "France",
        "nationality" => "French",
        );

        $countries[] = array(
        "num_code" => "254",
        "alpha_2_code" => "GF",
        "alpha_3_code" => "GUF",
        "en_short_name" => "French Guiana",
        "nationality" => "French Guianese",
        );

        $countries[] = array(
        "num_code" => "258",
        "alpha_2_code" => "PF",
        "alpha_3_code" => "PYF",
        "en_short_name" => "French Polynesia",
        "nationality" => "French Polynesian",
        );

        $countries[] = array(
        "num_code" => "260",
        "alpha_2_code" => "TF",
        "alpha_3_code" => "ATF",
        "en_short_name" => "French Southern Territories",
        "nationality" => "French Southern Territories",
        );

        $countries[] = array(
        "num_code" => "266",
        "alpha_2_code" => "GA",
        "alpha_3_code" => "GAB",
        "en_short_name" => "Gabon",
        "nationality" => "Gabonese",
        );

        $countries[] = array(
        "num_code" => "270",
        "alpha_2_code" => "GM",
        "alpha_3_code" => "GMB",
        "en_short_name" => "Gambia",
        "nationality" => "Gambian",
        );

        $countries[] = array(
        "num_code" => "268",
        "alpha_2_code" => "GE",
        "alpha_3_code" => "GEO",
        "en_short_name" => "Georgia",
        "nationality" => "Georgian",
        );

        $countries[] = array(
        "num_code" => "276",
        "alpha_2_code" => "DE",
        "alpha_3_code" => "DEU",
        "en_short_name" => "Germany",
        "nationality" => "German",
        );

        $countries[] = array(
        "num_code" => "288",
        "alpha_2_code" => "GH",
        "alpha_3_code" => "GHA",
        "en_short_name" => "Ghana",
        "nationality" => "Ghanaian",
        );

        $countries[] = array(
        "num_code" => "292",
        "alpha_2_code" => "GI",
        "alpha_3_code" => "GIB",
        "en_short_name" => "Gibraltar",
        "nationality" => "Gibraltar",
        );

        $countries[] = array(
        "num_code" => "300",
        "alpha_2_code" => "GR",
        "alpha_3_code" => "GRC",
        "en_short_name" => "Greece",
        "nationality" => "Greek, Hellenic",
        );

        $countries[] = array(
        "num_code" => "304",
        "alpha_2_code" => "GL",
        "alpha_3_code" => "GRL",
        "en_short_name" => "Greenland",
        "nationality" => "Greenlandic",
        );

        $countries[] = array(
        "num_code" => "308",
        "alpha_2_code" => "GD",
        "alpha_3_code" => "GRD",
        "en_short_name" => "Grenada",
        "nationality" => "Grenadian",
        );

        $countries[] = array(
        "num_code" => "312",
        "alpha_2_code" => "GP",
        "alpha_3_code" => "GLP",
        "en_short_name" => "Guadeloupe",
        "nationality" => "Guadeloupe",
        );

        $countries[] = array(
        "num_code" => "316",
        "alpha_2_code" => "GU",
        "alpha_3_code" => "GUM",
        "en_short_name" => "Guam",
        "nationality" => "Guamanian, Guambat",
        );

        $countries[] = array(
        "num_code" => "320",
        "alpha_2_code" => "GT",
        "alpha_3_code" => "GTM",
        "en_short_name" => "Guatemala",
        "nationality" => "Guatemalan",
        );

        $countries[] = array(
        "num_code" => "831",
        "alpha_2_code" => "GG",
        "alpha_3_code" => "GGY",
        "en_short_name" => "Guernsey",
        "nationality" => "Channel Island",
        );

        $countries[] = array(
        "num_code" => "324",
        "alpha_2_code" => "GN",
        "alpha_3_code" => "GIN",
        "en_short_name" => "Guinea",
        "nationality" => "Guinean",
        );

        $countries[] = array(
        "num_code" => "624",
        "alpha_2_code" => "GW",
        "alpha_3_code" => "GNB",
        "en_short_name" => "Guinea-Bissau",
        "nationality" => "Bissau-Guinean",
        );

        $countries[] = array(
        "num_code" => "328",
        "alpha_2_code" => "GY",
        "alpha_3_code" => "GUY",
        "en_short_name" => "Guyana",
        "nationality" => "Guyanese",
        );

        $countries[] = array(
        "num_code" => "332",
        "alpha_2_code" => "HT",
        "alpha_3_code" => "HTI",
        "en_short_name" => "Haiti",
        "nationality" => "Haitian",
        );

        $countries[] = array(
        "num_code" => "334",
        "alpha_2_code" => "HM",
        "alpha_3_code" => "HMD",
        "en_short_name" => "Heard Island and McDonald Islands",
        "nationality" => "Heard Island or McDonald Islands",
        );

        $countries[] = array(
        "num_code" => "336",
        "alpha_2_code" => "VA",
        "alpha_3_code" => "VAT",
        "en_short_name" => "Vatican City State",
        "nationality" => "Vatican",
        );

        $countries[] = array(
        "num_code" => "340",
        "alpha_2_code" => "HN",
        "alpha_3_code" => "HND",
        "en_short_name" => "Honduras",
        "nationality" => "Honduran",
        );

        $countries[] = array(
        "num_code" => "344",
        "alpha_2_code" => "HK",
        "alpha_3_code" => "HKG",
        "en_short_name" => "Hong Kong",
        "nationality" => "Hong Kong, Hong Kongese",
        );

        $countries[] = array(
        "num_code" => "348",
        "alpha_2_code" => "HU",
        "alpha_3_code" => "HUN",
        "en_short_name" => "Hungary",
        "nationality" => "Hungarian, Magyar",
        );

        $countries[] = array(
        "num_code" => "352",
        "alpha_2_code" => "IS",
        "alpha_3_code" => "ISL",
        "en_short_name" => "Iceland",
        "nationality" => "Icelandic",
        );

        $countries[] = array(
        "num_code" => "356",
        "alpha_2_code" => "IN",
        "alpha_3_code" => "IND",
        "en_short_name" => "India",
        "nationality" => "Indian",
        );

        $countries[] = array(
        "num_code" => "360",
        "alpha_2_code" => "ID",
        "alpha_3_code" => "IDN",
        "en_short_name" => "Indonesia",
        "nationality" => "Indonesian",
        );

        $countries[] = array(
        "num_code" => "364",
        "alpha_2_code" => "IR",
        "alpha_3_code" => "IRN",
        "en_short_name" => "Iran",
        "nationality" => "Iranian, Persian",
        );

        $countries[] = array(
        "num_code" => "368",
        "alpha_2_code" => "IQ",
        "alpha_3_code" => "IRQ",
        "en_short_name" => "Iraq",
        "nationality" => "Iraqi",
        );

        $countries[] = array(
        "num_code" => "372",
        "alpha_2_code" => "IE",
        "alpha_3_code" => "IRL",
        "en_short_name" => "Ireland",
        "nationality" => "Irish",
        );

        $countries[] = array(
        "num_code" => "833",
        "alpha_2_code" => "IM",
        "alpha_3_code" => "IMN",
        "en_short_name" => "Isle of Man",
        "nationality" => "Manx",
        );

        $countries[] = array(
        "num_code" => "376",
        "alpha_2_code" => "IL",
        "alpha_3_code" => "ISR",
        "en_short_name" => "Israel",
        "nationality" => "Israeli",
        );

        $countries[] = array(
        "num_code" => "380",
        "alpha_2_code" => "IT",
        "alpha_3_code" => "ITA",
        "en_short_name" => "Italy",
        "nationality" => "Italian",
        );

        $countries[] = array(
        "num_code" => "388",
        "alpha_2_code" => "JM",
        "alpha_3_code" => "JAM",
        "en_short_name" => "Jamaica",
        "nationality" => "Jamaican",
        );

        $countries[] = array(
        "num_code" => "392",
        "alpha_2_code" => "JP",
        "alpha_3_code" => "JPN",
        "en_short_name" => "Japan",
        "nationality" => "Japanese",
        );

        $countries[] = array(
        "num_code" => "832",
        "alpha_2_code" => "JE",
        "alpha_3_code" => "JEY",
        "en_short_name" => "Jersey",
        "nationality" => "Channel Island",
        );

        $countries[] = array(
        "num_code" => "400",
        "alpha_2_code" => "JO",
        "alpha_3_code" => "JOR",
        "en_short_name" => "Jordan",
        "nationality" => "Jordanian",
        );

        $countries[] = array(
        "num_code" => "398",
        "alpha_2_code" => "KZ",
        "alpha_3_code" => "KAZ",
        "en_short_name" => "Kazakhstan",
        "nationality" => "Kazakhstani, Kazakh",
        );

        $countries[] = array(
        "num_code" => "404",
        "alpha_2_code" => "KE",
        "alpha_3_code" => "KEN",
        "en_short_name" => "Kenya",
        "nationality" => "Kenyan",
        );

        $countries[] = array(
        "num_code" => "296",
        "alpha_2_code" => "KI",
        "alpha_3_code" => "KIR",
        "en_short_name" => "Kiribati",
        "nationality" => "I-Kiribati",
        );

        $countries[] = array(
        "num_code" => "408",
        "alpha_2_code" => "KP",
        "alpha_3_code" => "PRK",
        "en_short_name" => "Korea (Democratic People's Republic of)",
        "nationality" => "North Korean",
        );

        $countries[] = array(
        "num_code" => "410",
        "alpha_2_code" => "KR",
        "alpha_3_code" => "KOR",
        "en_short_name" => "Korea (Republic of)",
        "nationality" => "South Korean",
        );

        $countries[] = array(
        "num_code" => "414",
        "alpha_2_code" => "KW",
        "alpha_3_code" => "KWT",
        "en_short_name" => "Kuwait",
        "nationality" => "Kuwaiti",
        );

        $countries[] = array(
        "num_code" => "417",
        "alpha_2_code" => "KG",
        "alpha_3_code" => "KGZ",
        "en_short_name" => "Kyrgyzstan",
        "nationality" => "Kyrgyzstani, Kyrgyz, Kirgiz, Kirghiz",
        );

        $countries[] = array(
        "num_code" => "418",
        "alpha_2_code" => "LA",
        "alpha_3_code" => "LAO",
        "en_short_name" => "Lao People's Democratic Republic",
        "nationality" => "Lao, Laotian",
        );

        $countries[] = array(
        "num_code" => "428",
        "alpha_2_code" => "LV",
        "alpha_3_code" => "LVA",
        "en_short_name" => "Latvia",
        "nationality" => "Latvian",
        );

        $countries[] = array(
        "num_code" => "422",
        "alpha_2_code" => "LB",
        "alpha_3_code" => "LBN",
        "en_short_name" => "Lebanon",
        "nationality" => "Lebanese",
        );

        $countries[] = array(
        "num_code" => "426",
        "alpha_2_code" => "LS",
        "alpha_3_code" => "LSO",
        "en_short_name" => "Lesotho",
        "nationality" => "Basotho",
        );

        $countries[] = array(
        "num_code" => "430",
        "alpha_2_code" => "LR",
        "alpha_3_code" => "LBR",
        "en_short_name" => "Liberia",
        "nationality" => "Liberian",
        );

        $countries[] = array(
        "num_code" => "434",
        "alpha_2_code" => "LY",
        "alpha_3_code" => "LBY",
        "en_short_name" => "Libya",
        "nationality" => "Libyan",
        );

        $countries[] = array(
        "num_code" => "438",
        "alpha_2_code" => "LI",
        "alpha_3_code" => "LIE",
        "en_short_name" => "Liechtenstein",
        "nationality" => "Liechtenstein",
        );

        $countries[] = array(
        "num_code" => "440",
        "alpha_2_code" => "LT",
        "alpha_3_code" => "LTU",
        "en_short_name" => "Lithuania",
        "nationality" => "Lithuanian",
        );

        $countries[] = array(
        "num_code" => "442",
        "alpha_2_code" => "LU",
        "alpha_3_code" => "LUX",
        "en_short_name" => "Luxembourg",
        "nationality" => "Luxembourg, Luxembourgish",
        );

        $countries[] = array(
        "num_code" => "446",
        "alpha_2_code" => "MO",
        "alpha_3_code" => "MAC",
        "en_short_name" => "Macao",
        "nationality" => "Macanese, Chinese",
        );

        $countries[] = array(
        "num_code" => "807",
        "alpha_2_code" => "MK",
        "alpha_3_code" => "MKD",
        "en_short_name" => "Macedonia (the former Yugoslav Republic of)",
        "nationality" => "Macedonian",
        );

        $countries[] = array(
        "num_code" => "450",
        "alpha_2_code" => "MG",
        "alpha_3_code" => "MDG",
        "en_short_name" => "Madagascar",
        "nationality" => "Malagasy",
        );

        $countries[] = array(
        "num_code" => "454",
        "alpha_2_code" => "MW",
        "alpha_3_code" => "MWI",
        "en_short_name" => "Malawi",
        "nationality" => "Malawian",
        );

        $countries[] = array(
        "num_code" => "458",
        "alpha_2_code" => "MY",
        "alpha_3_code" => "MYS",
        "en_short_name" => "Malaysia",
        "nationality" => "Malaysian",
        );

        $countries[] = array(
        "num_code" => "462",
        "alpha_2_code" => "MV",
        "alpha_3_code" => "MDV",
        "en_short_name" => "Maldives",
        "nationality" => "Maldivian",
        );

        $countries[] = array(
        "num_code" => "466",
        "alpha_2_code" => "ML",
        "alpha_3_code" => "MLI",
        "en_short_name" => "Mali",
        "nationality" => "Malian, Malinese",
        );

        $countries[] = array(
        "num_code" => "470",
        "alpha_2_code" => "MT",
        "alpha_3_code" => "MLT",
        "en_short_name" => "Malta",
        "nationality" => "Maltese",
        );

        $countries[] = array(
        "num_code" => "584",
        "alpha_2_code" => "MH",
        "alpha_3_code" => "MHL",
        "en_short_name" => "Marshall Islands",
        "nationality" => "Marshallese",
        );

        $countries[] = array(
        "num_code" => "474",
        "alpha_2_code" => "MQ",
        "alpha_3_code" => "MTQ",
        "en_short_name" => "Martinique",
        "nationality" => "Martiniquais, Martinican",
        );

        $countries[] = array(
        "num_code" => "478",
        "alpha_2_code" => "MR",
        "alpha_3_code" => "MRT",
        "en_short_name" => "Mauritania",
        "nationality" => "Mauritanian",
        );

        $countries[] = array(
        "num_code" => "480",
        "alpha_2_code" => "MU",
        "alpha_3_code" => "MUS",
        "en_short_name" => "Mauritius",
        "nationality" => "Mauritian",
        );

        $countries[] = array(
        "num_code" => "175",
        "alpha_2_code" => "YT",
        "alpha_3_code" => "MYT",
        "en_short_name" => "Mayotte",
        "nationality" => "Mahoran",
        );

        $countries[] = array(
        "num_code" => "484",
        "alpha_2_code" => "MX",
        "alpha_3_code" => "MEX",
        "en_short_name" => "Mexico",
        "nationality" => "Mexican",
        );

        $countries[] = array(
        "num_code" => "583",
        "alpha_2_code" => "FM",
        "alpha_3_code" => "FSM",
        "en_short_name" => "Micronesia (Federated States of)",
        "nationality" => "Micronesian",
        );

        $countries[] = array(
        "num_code" => "498",
        "alpha_2_code" => "MD",
        "alpha_3_code" => "MDA",
        "en_short_name" => "Moldova (Republic of)",
        "nationality" => "Moldovan",
        );

        $countries[] = array(
        "num_code" => "492",
        "alpha_2_code" => "MC",
        "alpha_3_code" => "MCO",
        "en_short_name" => "Monaco",
        "nationality" => "Monégasque, Monacan",
        );

        $countries[] = array(
        "num_code" => "496",
        "alpha_2_code" => "MN",
        "alpha_3_code" => "MNG",
        "en_short_name" => "Mongolia",
        "nationality" => "Mongolian",
        );

        $countries[] = array(
        "num_code" => "499",
        "alpha_2_code" => "ME",
        "alpha_3_code" => "MNE",
        "en_short_name" => "Montenegro",
        "nationality" => "Montenegrin",
        );

        $countries[] = array(
        "num_code" => "500",
        "alpha_2_code" => "MS",
        "alpha_3_code" => "MSR",
        "en_short_name" => "Montserrat",
        "nationality" => "Montserratian",
        );

        $countries[] = array(
        "num_code" => "504",
        "alpha_2_code" => "MA",
        "alpha_3_code" => "MAR",
        "en_short_name" => "Morocco",
        "nationality" => "Moroccan",
        );

        $countries[] = array(
        "num_code" => "508",
        "alpha_2_code" => "MZ",
        "alpha_3_code" => "MOZ",
        "en_short_name" => "Mozambique",
        "nationality" => "Mozambican",
        );

        $countries[] = array(
        "num_code" => "104",
        "alpha_2_code" => "MM",
        "alpha_3_code" => "MMR",
        "en_short_name" => "Myanmar",
        "nationality" => "Burmese",
        );

        $countries[] = array(
        "num_code" => "516",
        "alpha_2_code" => "NA",
        "alpha_3_code" => "NAM",
        "en_short_name" => "Namibia",
        "nationality" => "Namibian",
        );

        $countries[] = array(
        "num_code" => "520",
        "alpha_2_code" => "NR",
        "alpha_3_code" => "NRU",
        "en_short_name" => "Nauru",
        "nationality" => "Nauruan",
        );

        $countries[] = array(
        "num_code" => "524",
        "alpha_2_code" => "NP",
        "alpha_3_code" => "NPL",
        "en_short_name" => "Nepal",
        "nationality" => "Nepali, Nepalese",
        );

        $countries[] = array(
        "num_code" => "528",
        "alpha_2_code" => "NL",
        "alpha_3_code" => "NLD",
        "en_short_name" => "Netherlands",
        "nationality" => "Dutch, Netherlandic",
        );

        $countries[] = array(
        "num_code" => "540",
        "alpha_2_code" => "NC",
        "alpha_3_code" => "NCL",
        "en_short_name" => "New Caledonia",
        "nationality" => "New Caledonian",
        );

        $countries[] = array(
        "num_code" => "554",
        "alpha_2_code" => "NZ",
        "alpha_3_code" => "NZL",
        "en_short_name" => "New Zealand",
        "nationality" => "New Zealand, NZ",
        );

        $countries[] = array(
        "num_code" => "558",
        "alpha_2_code" => "NI",
        "alpha_3_code" => "NIC",
        "en_short_name" => "Nicaragua",
        "nationality" => "Nicaraguan",
        );

        $countries[] = array(
        "num_code" => "562",
        "alpha_2_code" => "NE",
        "alpha_3_code" => "NER",
        "en_short_name" => "Niger",
        "nationality" => "Nigerien",
        );

        $countries[] = array(
        "num_code" => "566",
        "alpha_2_code" => "NG",
        "alpha_3_code" => "NGA",
        "en_short_name" => "Nigeria",
        "nationality" => "Nigerian",
        );

        $countries[] = array(
        "num_code" => "570",
        "alpha_2_code" => "NU",
        "alpha_3_code" => "NIU",
        "en_short_name" => "Niue",
        "nationality" => "Niuean",
        );

        $countries[] = array(
        "num_code" => "574",
        "alpha_2_code" => "NF",
        "alpha_3_code" => "NFK",
        "en_short_name" => "Norfolk Island",
        "nationality" => "Norfolk Island",
        );

        $countries[] = array(
        "num_code" => "580",
        "alpha_2_code" => "MP",
        "alpha_3_code" => "MNP",
        "en_short_name" => "Northern Mariana Islands",
        "nationality" => "Northern Marianan",
        );

        $countries[] = array(
        "num_code" => "578",
        "alpha_2_code" => "NO",
        "alpha_3_code" => "NOR",
        "en_short_name" => "Norway",
        "nationality" => "Norwegian",
        );

        $countries[] = array(
        "num_code" => "512",
        "alpha_2_code" => "OM",
        "alpha_3_code" => "OMN",
        "en_short_name" => "Oman",
        "nationality" => "Omani",
        );

        $countries[] = array(
        "num_code" => "586",
        "alpha_2_code" => "PK",
        "alpha_3_code" => "PAK",
        "en_short_name" => "Pakistan",
        "nationality" => "Pakistani",
        );

        $countries[] = array(
        "num_code" => "585",
        "alpha_2_code" => "PW",
        "alpha_3_code" => "PLW",
        "en_short_name" => "Palau",
        "nationality" => "Palauan",
        );

        $countries[] = array(
        "num_code" => "275",
        "alpha_2_code" => "PS",
        "alpha_3_code" => "PSE",
        "en_short_name" => "Palestine, State of",
        "nationality" => "Palestinian",
        );

        $countries[] = array(
        "num_code" => "591",
        "alpha_2_code" => "PA",
        "alpha_3_code" => "PAN",
        "en_short_name" => "Panama",
        "nationality" => "Panamanian",
        );

        $countries[] = array(
        "num_code" => "598",
        "alpha_2_code" => "PG",
        "alpha_3_code" => "PNG",
        "en_short_name" => "Papua New Guinea",
        "nationality" => "Papua New Guinean, Papuan",
        );

        $countries[] = array(
        "num_code" => "600",
        "alpha_2_code" => "PY",
        "alpha_3_code" => "PRY",
        "en_short_name" => "Paraguay",
        "nationality" => "Paraguayan",
        );

        $countries[] = array(
        "num_code" => "604",
        "alpha_2_code" => "PE",
        "alpha_3_code" => "PER",
        "en_short_name" => "Peru",
        "nationality" => "Peruvian",
        );

        $countries[] = array(
        "num_code" => "608",
        "alpha_2_code" => "PH",
        "alpha_3_code" => "PHL",
        "en_short_name" => "Philippines",
        "nationality" => "Philippine, Filipino",
        );

        $countries[] = array(
        "num_code" => "612",
        "alpha_2_code" => "PN",
        "alpha_3_code" => "PCN",
        "en_short_name" => "Pitcairn",
        "nationality" => "Pitcairn Island",
        );

        $countries[] = array(
        "num_code" => "616",
        "alpha_2_code" => "PL",
        "alpha_3_code" => "POL",
        "en_short_name" => "Poland",
        "nationality" => "Polish",
        );

        $countries[] = array(
        "num_code" => "620",
        "alpha_2_code" => "PT",
        "alpha_3_code" => "PRT",
        "en_short_name" => "Portugal",
        "nationality" => "Portuguese",
        );

        $countries[] = array(
        "num_code" => "630",
        "alpha_2_code" => "PR",
        "alpha_3_code" => "PRI",
        "en_short_name" => "Puerto Rico",
        "nationality" => "Puerto Rican",
        );

        $countries[] = array(
        "num_code" => "634",
        "alpha_2_code" => "QA",
        "alpha_3_code" => "QAT",
        "en_short_name" => "Qatar",
        "nationality" => "Qatari",
        );

        $countries[] = array(
        "num_code" => "638",
        "alpha_2_code" => "RE",
        "alpha_3_code" => "REU",
        "en_short_name" => "Réunion",
        "nationality" => "Réunionese, Réunionnais",
        );

        $countries[] = array(
        "num_code" => "642",
        "alpha_2_code" => "RO",
        "alpha_3_code" => "ROU",
        "en_short_name" => "Romania",
        "nationality" => "Romanian",
        );

        $countries[] = array(
        "num_code" => "643",
        "alpha_2_code" => "RU",
        "alpha_3_code" => "RUS",
        "en_short_name" => "Russian Federation",
        "nationality" => "Russian",
        );

        $countries[] = array(
        "num_code" => "646",
        "alpha_2_code" => "RW",
        "alpha_3_code" => "RWA",
        "en_short_name" => "Rwanda",
        "nationality" => "Rwandan",
        );

        $countries[] = array(
        "num_code" => "652",
        "alpha_2_code" => "BL",
        "alpha_3_code" => "BLM",
        "en_short_name" => "Saint Barthélemy",
        "nationality" => "Barthélemois",
        );

        $countries[] = array(
        "num_code" => "654",
        "alpha_2_code" => "SH",
        "alpha_3_code" => "SHN",
        "en_short_name" => "Saint Helena, Ascension and Tristan da Cunha",
        "nationality" => "Saint Helenian",
        );

        $countries[] = array(
        "num_code" => "659",
        "alpha_2_code" => "KN",
        "alpha_3_code" => "KNA",
        "en_short_name" => "Saint Kitts and Nevis",
        "nationality" => "Kittitian or Nevisian",
        );

        $countries[] = array(
        "num_code" => "662",
        "alpha_2_code" => "LC",
        "alpha_3_code" => "LCA",
        "en_short_name" => "Saint Lucia",
        "nationality" => "Saint Lucian",
        );

        $countries[] = array(
        "num_code" => "663",
        "alpha_2_code" => "MF",
        "alpha_3_code" => "MAF",
        "en_short_name" => "Saint Martin (French part)",
        "nationality" => "Saint-Martinoise",
        );

        $countries[] = array(
        "num_code" => "666",
        "alpha_2_code" => "PM",
        "alpha_3_code" => "SPM",
        "en_short_name" => "Saint Pierre and Miquelon",
        "nationality" => "Saint-Pierrais or Miquelonnais",
        );

        $countries[] = array(
        "num_code" => "670",
        "alpha_2_code" => "VC",
        "alpha_3_code" => "VCT",
        "en_short_name" => "Saint Vincent and the Grenadines",
        "nationality" => "Saint Vincentian, Vincentian",
        );

        $countries[] = array(
        "num_code" => "882",
        "alpha_2_code" => "WS",
        "alpha_3_code" => "WSM",
        "en_short_name" => "Samoa",
        "nationality" => "Samoan",
        );

        $countries[] = array(
        "num_code" => "674",
        "alpha_2_code" => "SM",
        "alpha_3_code" => "SMR",
        "en_short_name" => "San Marino",
        "nationality" => "Sammarinese",
        );

        $countries[] = array(
        "num_code" => "678",
        "alpha_2_code" => "ST",
        "alpha_3_code" => "STP",
        "en_short_name" => "Sao Tome and Principe",
        "nationality" => "São Toméan",
        );

        $countries[] = array(
        "num_code" => "682",
        "alpha_2_code" => "SA",
        "alpha_3_code" => "SAU",
        "en_short_name" => "Saudi Arabia",
        "nationality" => "Saudi, Saudi Arabian",
        );

        $countries[] = array(
        "num_code" => "686",
        "alpha_2_code" => "SN",
        "alpha_3_code" => "SEN",
        "en_short_name" => "Senegal",
        "nationality" => "Senegalese",
        );

        $countries[] = array(
        "num_code" => "688",
        "alpha_2_code" => "RS",
        "alpha_3_code" => "SRB",
        "en_short_name" => "Serbia",
        "nationality" => "Serbian",
        );

        $countries[] = array(
        "num_code" => "690",
        "alpha_2_code" => "SC",
        "alpha_3_code" => "SYC",
        "en_short_name" => "Seychelles",
        "nationality" => "Seychellois",
        );

        $countries[] = array(
        "num_code" => "694",
        "alpha_2_code" => "SL",
        "alpha_3_code" => "SLE",
        "en_short_name" => "Sierra Leone",
        "nationality" => "Sierra Leonean",
        );

        $countries[] = array(
        "num_code" => "702",
        "alpha_2_code" => "SG",
        "alpha_3_code" => "SGP",
        "en_short_name" => "Singapore",
        "nationality" => "Singaporean",
        );

        $countries[] = array(
        "num_code" => "534",
        "alpha_2_code" => "SX",
        "alpha_3_code" => "SXM",
        "en_short_name" => "Sint Maarten (Dutch part)",
        "nationality" => "Sint Maarten",
        );

        $countries[] = array(
        "num_code" => "703",
        "alpha_2_code" => "SK",
        "alpha_3_code" => "SVK",
        "en_short_name" => "Slovakia",
        "nationality" => "Slovak",
        );

        $countries[] = array(
        "num_code" => "705",
        "alpha_2_code" => "SI",
        "alpha_3_code" => "SVN",
        "en_short_name" => "Slovenia",
        "nationality" => "Slovenian, Slovene",
        );

        $countries[] = array(
        "num_code" => "90",
        "alpha_2_code" => "SB",
        "alpha_3_code" => "SLB",
        "en_short_name" => "Solomon Islands",
        "nationality" => "Solomon Island",
        );

        $countries[] = array(
        "num_code" => "706",
        "alpha_2_code" => "SO",
        "alpha_3_code" => "SOM",
        "en_short_name" => "Somalia",
        "nationality" => "Somali, Somalian",
        );

        $countries[] = array(
        "num_code" => "710",
        "alpha_2_code" => "ZA",
        "alpha_3_code" => "ZAF",
        "en_short_name" => "South Africa",
        "nationality" => "South African",
        );

        $countries[] = array(
        "num_code" => "239",
        "alpha_2_code" => "GS",
        "alpha_3_code" => "SGS",
        "en_short_name" => "South Georgia and the South Sandwich Islands",
        "nationality" => "South Georgia or South Sandwich Islands",
        );

        $countries[] = array(
        "num_code" => "728",
        "alpha_2_code" => "SS",
        "alpha_3_code" => "SSD",
        "en_short_name" => "South Sudan",
        "nationality" => "South Sudanese",
        );

        $countries[] = array(
        "num_code" => "724",
        "alpha_2_code" => "ES",
        "alpha_3_code" => "ESP",
        "en_short_name" => "Spain",
        "nationality" => "Spanish",
        );

        $countries[] = array(
        "num_code" => "144",
        "alpha_2_code" => "LK",
        "alpha_3_code" => "LKA",
        "en_short_name" => "Sri Lanka",
        "nationality" => "Sri Lankan",
        );

        $countries[] = array(
        "num_code" => "729",
        "alpha_2_code" => "SD",
        "alpha_3_code" => "SDN",
        "en_short_name" => "Sudan",
        "nationality" => "Sudanese",
        );

        $countries[] = array(
        "num_code" => "740",
        "alpha_2_code" => "SR",
        "alpha_3_code" => "SUR",
        "en_short_name" => "Suriname",
        "nationality" => "Surinamese",
        );

        $countries[] = array(
        "num_code" => "744",
        "alpha_2_code" => "SJ",
        "alpha_3_code" => "SJM",
        "en_short_name" => "Svalbard and Jan Mayen",
        "nationality" => "Svalbard",
        );

        $countries[] = array(
        "num_code" => "748",
        "alpha_2_code" => "SZ",
        "alpha_3_code" => "SWZ",
        "en_short_name" => "Swaziland",
        "nationality" => "Swazi",
        );

        $countries[] = array(
        "num_code" => "752",
        "alpha_2_code" => "SE",
        "alpha_3_code" => "SWE",
        "en_short_name" => "Sweden",
        "nationality" => "Swedish",
        );

        $countries[] = array(
        "num_code" => "756",
        "alpha_2_code" => "CH",
        "alpha_3_code" => "CHE",
        "en_short_name" => "Switzerland",
        "nationality" => "Swiss",
        );

        $countries[] = array(
        "num_code" => "760",
        "alpha_2_code" => "SY",
        "alpha_3_code" => "SYR",
        "en_short_name" => "Syrian Arab Republic",
        "nationality" => "Syrian",
        );

        $countries[] = array(
        "num_code" => "158",
        "alpha_2_code" => "TW",
        "alpha_3_code" => "TWN",
        "en_short_name" => "Taiwan, Province of China",
        "nationality" => "Chinese, Taiwanese",
        );

        $countries[] = array(
        "num_code" => "762",
        "alpha_2_code" => "TJ",
        "alpha_3_code" => "TJK",
        "en_short_name" => "Tajikistan",
        "nationality" => "Tajikistani",
        );

        $countries[] = array(
        "num_code" => "834",
        "alpha_2_code" => "TZ",
        "alpha_3_code" => "TZA",
        "en_short_name" => "Tanzania, United Republic of",
        "nationality" => "Tanzanian",
        );

        $countries[] = array(
        "num_code" => "764",
        "alpha_2_code" => "TH",
        "alpha_3_code" => "THA",
        "en_short_name" => "Thailand",
        "nationality" => "Thai",
        );

        $countries[] = array(
        "num_code" => "626",
        "alpha_2_code" => "TL",
        "alpha_3_code" => "TLS",
        "en_short_name" => "Timor-Leste",
        "nationality" => "Timorese",
        );

        $countries[] = array(
        "num_code" => "768",
        "alpha_2_code" => "TG",
        "alpha_3_code" => "TGO",
        "en_short_name" => "Togo",
        "nationality" => "Togolese",
        );

        $countries[] = array(
        "num_code" => "772",
        "alpha_2_code" => "TK",
        "alpha_3_code" => "TKL",
        "en_short_name" => "Tokelau",
        "nationality" => "Tokelauan",
        );

        $countries[] = array(
        "num_code" => "776",
        "alpha_2_code" => "TO",
        "alpha_3_code" => "TON",
        "en_short_name" => "Tonga",
        "nationality" => "Tongan",
        );

        $countries[] = array(
        "num_code" => "780",
        "alpha_2_code" => "TT",
        "alpha_3_code" => "TTO",
        "en_short_name" => "Trinidad and Tobago",
        "nationality" => "Trinidadian or Tobagonian",
        );

        $countries[] = array(
        "num_code" => "788",
        "alpha_2_code" => "TN",
        "alpha_3_code" => "TUN",
        "en_short_name" => "Tunisia",
        "nationality" => "Tunisian",
        );

        $countries[] = array(
        "num_code" => "792",
        "alpha_2_code" => "TR",
        "alpha_3_code" => "TUR",
        "en_short_name" => "Turkey",
        "nationality" => "Turkish",
        );

        $countries[] = array(
        "num_code" => "795",
        "alpha_2_code" => "TM",
        "alpha_3_code" => "TKM",
        "en_short_name" => "Turkmenistan",
        "nationality" => "Turkmen",
        );

        $countries[] = array(
        "num_code" => "796",
        "alpha_2_code" => "TC",
        "alpha_3_code" => "TCA",
        "en_short_name" => "Turks and Caicos Islands",
        "nationality" => "Turks and Caicos Island",
        );

        $countries[] = array(
        "num_code" => "798",
        "alpha_2_code" => "TV",
        "alpha_3_code" => "TUV",
        "en_short_name" => "Tuvalu",
        "nationality" => "Tuvaluan",
        );

        $countries[] = array(
        "num_code" => "800",
        "alpha_2_code" => "UG",
        "alpha_3_code" => "UGA",
        "en_short_name" => "Uganda",
        "nationality" => "Ugandan",
        );

        $countries[] = array(
        "num_code" => "804",
        "alpha_2_code" => "UA",
        "alpha_3_code" => "UKR",
        "en_short_name" => "Ukraine",
        "nationality" => "Ukrainian",
        );

        $countries[] = array(
        "num_code" => "784",
        "alpha_2_code" => "AE",
        "alpha_3_code" => "ARE",
        "en_short_name" => "United Arab Emirates",
        "nationality" => "Emirati, Emirian, Emiri",
        );

        $countries[] = array(
        "num_code" => "826",
        "alpha_2_code" => "GB",
        "alpha_3_code" => "GBR",
        "en_short_name" => "United Kingdom of Great Britain and Northern Ireland",
        "nationality" => "British, UK",
        );

        $countries[] = array(
        "num_code" => "581",
        "alpha_2_code" => "UM",
        "alpha_3_code" => "UMI",
        "en_short_name" => "United States Minor Outlying Islands",
        "nationality" => "American",
        );

        $countries[] = array(
        "num_code" => "840",
        "alpha_2_code" => "US",
        "alpha_3_code" => "USA",
        "en_short_name" => "United States of America",
        "nationality" => "American",
        );

        $countries[] = array(
        "num_code" => "858",
        "alpha_2_code" => "UY",
        "alpha_3_code" => "URY",
        "en_short_name" => "Uruguay",
        "nationality" => "Uruguayan",
        );

        $countries[] = array(
        "num_code" => "860",
        "alpha_2_code" => "UZ",
        "alpha_3_code" => "UZB",
        "en_short_name" => "Uzbekistan",
        "nationality" => "Uzbekistani, Uzbek",
        );

        $countries[] = array(
        "num_code" => "548",
        "alpha_2_code" => "VU",
        "alpha_3_code" => "VUT",
        "en_short_name" => "Vanuatu",
        "nationality" => "Ni-Vanuatu, Vanuatuan",
        );

        $countries[] = array(
        "num_code" => "862",
        "alpha_2_code" => "VE",
        "alpha_3_code" => "VEN",
        "en_short_name" => "Venezuela (Bolivarian Republic of)",
        "nationality" => "Venezuelan",
        );

        $countries[] = array(
        "num_code" => "704",
        "alpha_2_code" => "VN",
        "alpha_3_code" => "VNM",
        "en_short_name" => "Vietnam",
        "nationality" => "Vietnamese",
        );

        $countries[] = array(
        "num_code" => "92",
        "alpha_2_code" => "VG",
        "alpha_3_code" => "VGB",
        "en_short_name" => "Virgin Islands (British)",
        "nationality" => "British Virgin Island",
        );

        $countries[] = array(
        "num_code" => "850",
        "alpha_2_code" => "VI",
        "alpha_3_code" => "VIR",
        "en_short_name" => "Virgin Islands (U.S.)",
        "nationality" => "U.S. Virgin Island",
        );

        $countries[] = array(
        "num_code" => "876",
        "alpha_2_code" => "WF",
        "alpha_3_code" => "WLF",
        "en_short_name" => "Wallis and Futuna",
        "nationality" => "Wallis and Futuna, Wallisian or Futunan",
        );

        $countries[] = array(
        "num_code" => "732",
        "alpha_2_code" => "EH",
        "alpha_3_code" => "ESH",
        "en_short_name" => "Western Sahara",
        "nationality" => "Sahrawi, Sahrawian, Sahraouian",
        );

        $countries[] = array(
        "num_code" => "887",
        "alpha_2_code" => "YE",
        "alpha_3_code" => "YEM",
        "en_short_name" => "Yemen",
        "nationality" => "Yemeni",
        );

        $countries[] = array(
        "num_code" => "894",
        "alpha_2_code" => "ZM",
        "alpha_3_code" => "ZMB",
        "en_short_name" => "Zambia",
        "nationality" => "Zambian",
        );

        $countries[] = array(
        "num_code" => "716",
        "alpha_2_code" => "ZW",
        "alpha_3_code" => "ZWE",
        "en_short_name" => "Zimbabwe",
        "nationality" => "Zimbabwean",
        );

        $email = $_GET['email'];

        $user = Auth::User();
        $userId = $user->id;
        $professions = Profession::get(['profession_name']);
        $professions_names = $professions->unique('profession_name')->toArray();
        $professions_types = Profession::where('profession_name','=','Doctor')->get(['profession_type'])->toArray();
        $avatar = User::where('email','=',$email)->get(['avatar','name'])->toArray();
        $isAdmin = DB::table('user_menu')->where('user_id',$userId)->where('menu_options_id',14)->get()->count();





        $member_data = Membership::where('email','=',$email)->get()->toArray();
        if(!empty($member_data)){
            $member_data = $member_data[0];
        }
        else
        {
            $member_data['join_date'] = "";
            $member_data['membership_type'] = "";
            $member_data['membership_category'] = "";
            $member_data['status'] = "";
            $member_data['cell_num'] = "";
            $member_data['email'] = "";
            $member_data['reference_id'] = "";
            $member_data['reference_name'] = "";
            $member_data['nid_no'] = "";
            $member_data['instagram'] = "";
            $member_data['facebook'] = "";
            $member_data['linkedin'] = "";
            $member_data['twitter'] = "";
            $member_data['gender'] = "";
            $member_data['nationality'] = "";
            $member_data['date_of_birth'] = "";
            $member_data['yearly_income'] = "";
            $member_data['profession_name'] = "";
            $member_data['profession_type'] = "";
            $member_data['blah'] = "";
            $member_data['account_detail'] = "";
            $member_data['nationality_2'] = "";
        }

        $get_date = DB::table('memberships')
                    ->where('user_id','=',$id)
                    ->first();


        return view('pages.admin.membership',['user_data'=>$get_date,'countries'=>$countries,'isAdmin'=>$isAdmin,'professions_types'=>$professions_types,'professions_name'=>$professions_names,'avatar'=>$avatar[0]['avatar'],'name'=>$avatar[0]['name'],'details'=>$member_data]);
    }


    public function  getAndMoveVerifyDetails()
    {

        $member_data = Membership::where('email','=',$_POST['email'])->get()->count();
        $data['success'] = $member_data;
        echo json_encode($data);



    }

    public function uploadMemberPdfFile(Request $request)
    {
        $image_file         = $request->file('upload_pdf_file');
        $uniqueFileName     = rand()."regform.".$image_file->getClientOriginalExtension();
        $request->session()->put('file_name', $uniqueFileName);
        $image_file->move(public_path('/images'),  $uniqueFileName);
        $data['success'] = "1";
        $data['file_name'] =  $uniqueFileName;
        echo json_encode($data);
    }

    public function downloadMemberPdfFile(Request $request)
    {
        //PDF file is stored under project/public/download/info.pdf

        $headers = [
            'Content-Type' => 'application/pdf',
         ];
        $value = $request->session()->get('file_name');
        $file= public_path(). "/"."images"."/".$value;
        return  response()->download($file, $value, $headers);


    }


    public function getProfessionOfType()
    {
        $profession_name = $_POST['profession_name'];
        $professions_type = Profession::where('profession_name','=',$profession_name)->get(['profession_type'])->toArray();
        $data['professions'] = $professions_type;
        echo json_encode($data);

    }

    public function credit(Request $request)
    {
        $id       = $request->user()->id;
        // $data     = $request->all();
        $desposit_data  = $request->all();
        //aa($desposit_data);
        foreach($desposit_data['deposit_form_data'] as $key=>$value)
        {
            $data[$value['name']] = $value['value'];
        }

        $transaction_id = $this->generateUniqueString($this->permitted_chars, 16);
        $data['user_id'] = $id;
        $data['transaction_id'] = $transaction_id;

        $data2 = $this -> mapDbFields($data);

        $data2['transaction_by'] = Auth::user()->id;
        $data2['posted_by'] = Auth::user()->id;

        $this -> balance -> credit($data2);
        
        //-----notification for deposit------------//
        $amount = $data2['amount'];
        $chatroomId = $id.','.'53';
        $message = "Amount deposited $".$amount."";
        store($chatroomId,$amount,$message);
        //-----notification for deposit------------//
        $data['success'] = 'success';
        echo json_encode($data);
    }

    public function transfer(Request $request)
    {
        $id             = $request->user()->id;
        $admin_email = $request->user()->email;
        // $data           = $request->all();
        $cr_acc_data = [];
        //debit from this userid
        
        $transfer_data  = $request->all();
        //aa($transfer_data);
        $transaction_id = $this->generateUniqueString($this->permitted_chars, 16);

        // $to_user = $request->$transfer_data['to_user'];
        // dd($to_user);
        // foreach($transfer_data['transfer_form_data'] as $key=>$value)
        // {
        //     $data[$value['name']] = $value['value'];
        // }


        // $to_user = $request->$transfer_data['to_user'];

        foreach($transfer_data['transfer_form_data'] as $key=>$value)
        {
            $data[$value['name']] = $value['value'];
        }
        // dd($data);
        if(!empty($data['transaction_type']) && $data['transaction_type'] == 'Refund'){
            $id = $data['debit_user_id'];
            $cr_acc_data['user_id']        = $data['credit_user_id'];
            $cr_acc_data['description']    = $data['transfer_description'];
            $cr_acc_data['details']        = nl2br(htmlentities($data['transfer_details'], ENT_QUOTES, 'UTF-8'));
            $cr_acc_data['type']           = "cr";
            $cr_acc_data['datwise']        = date("Y-m-d");
            $cr_acc_data['amount']         = $data['transfer_amount'];
            $cr_acc_data['transaction_id'] = $transaction_id;
            $cr_acc_data['is_freeze_or_refund'] = 1;
            $cr_acc_data['transaction_by'] = Auth::user()->id;
            $cr_acc_data['posted_by']      = Auth::user()->id;

        }
        
        if(!empty($data['transfer_description']) && $data['transfer_description'] == 'Withdraw'){
            //debit from this userid
            $id = $data['credit_user_id'];
            $cr_acc_data['user_id']        = $request->user()->id;
            $cr_acc_data['description']    = $data['transfer_description'];
            $cr_acc_data['details']        = nl2br(htmlentities($data['transfer_details'], ENT_QUOTES, 'UTF-8'));
            $cr_acc_data['type']           = "cr";
            $cr_acc_data['datwise']        = date("Y-m-d");
            $cr_acc_data['amount']         = $data['transfer_amount'];
            $cr_acc_data['transaction_id'] = $transaction_id;
            $cr_acc_data['transaction_by'] = Auth::user()->id;
            $cr_acc_data['posted_by']      = Auth::user()->id;
        }

        
        if(!empty($data['transfer_description']) && $data['transfer_description'] == 'Deposit Balance'){
            //debit from this userid
            $cr_acc_data['user_id']        = $data['credit_user_id'];
            $cr_acc_data['description']    = $data['transfer_description'];
            $cr_acc_data['details']        = nl2br(htmlentities($data['transfer_details'], ENT_QUOTES, 'UTF-8'));
            $cr_acc_data['type']           = "cr";
            $cr_acc_data['datwise']        = date("Y-m-d");
            $cr_acc_data['amount']         = $data['transfer_amount'];
            $cr_acc_data['transaction_id'] = $transaction_id;
            $cr_acc_data['transaction_by'] = Auth::user()->id;
            $cr_acc_data['posted_by']      = Auth::user()->id;
        }

        if(!empty($data['transaction_type']) && $data['transaction_type'] == 'Freeze'){
            $id = $data['debit_user_id'];
        }

        $check = $this->checkToTransfer($id,$data['transfer_amount']);
        
        if($check)
        {
          // dd($check);
            $data['user_id'] = $id;
            $data['transaction_id'] = $transaction_id;
            // $data['to_user'] = $_POST['to_user'];
            // $data['transfer_id'] = $_POST['transfer_id'];
            $data2 = $this -> mapDbTransferFields($data);

            // dd($data2);
            if(!empty($data['transaction_type']) && $data['transaction_type'] == 'Freeze'){
                $data2['transfer_to_user_id'] = $data['credit_user_id'];
                $data2['is_pending'] = 1;
                $data2['is_freeze_or_refund'] = 1;
                $data2['transaction_by'] = Auth::user()->id;

            }
            if(!empty($data['transaction_type']) && $data['transaction_type'] == 'Refund'){
                $data2['transaction_by'] = Auth::user()->id;
                $data2['posted_by']      = Auth::user()->id;
                $data2['is_freeze_or_refund'] = 1;
            }

            if(!empty($data['transfer_description']) && $data['transfer_description'] == 'Deposit Balance'){
                $data2['transaction_by'] = Auth::user()->id;
                $data2['posted_by']      = Auth::user()->id;

                $amount = $data['transfer_amount'];
                // $msg = "An amount of INR.".$amount." has been sent for withdraw request. Kindly check and review.";
                // $subject = "Withdraw Request";
                // sendEmail($admin_email,$msg,$subject);
                $chatroomId = $data['credit_user_id'].','.$data2['transaction_by'];
                $senderId = $data2['transaction_by'];
                $receiverId = $data['credit_user_id'];
                $msg = "Amount of $ ".$amount." has been transfered";

                store($chatroomId,$amount,$msg,$senderId,$receiverId);
                
            }
            if(!empty($data['transfer_description']) && $data['transfer_description'] == 'Withdraw'){
                $data2['transaction_by'] = Auth::user()->id;
                $data2['posted_by']      = Auth::user()->id;
            }
            if(!empty($data['transfer_description']) && $data['transfer_description'] == 'Withdraw Request'){
                $data2['transaction_by'] = Auth::user()->id;
                $data2['posted_by']      = Auth::user()->id;

                $amount = $data['transfer_amount'];
                // $msg = "An amount of INR.".$amount." has been sent for withdraw request. Kindly check and review.";
                // $subject = "Withdraw Request";
                // sendEmail($admin_email,$msg,$subject);
                $chatroomId = $id.','.'53';
                store($chatroomId,$amount);

            }

            $this->balance->transfer($data2);

            if(sizeof($cr_acc_data)){
                $this->balance->credit($cr_acc_data);
            }
            $data['success'] = 'success';
            $data['error'] = 0;
            echo json_encode($data);
        }
        else
        {
            $data['error'] = 'error';
            $data['success'] = 0;
            echo json_encode($data);
        }

    }

    public function cancelWithdrawRequest(Request $request){

         $data  = $request->all();


         $delete_status = Balance::find($data['id'])->delete($data['id']);

         if($delete_status){
            $data['success'] = 'success';
            $data['error'] = 0;
            echo json_encode($data);
         }
          else
        {
            $data['error'] = 'error';
            $data['success'] = 0;
            echo json_encode($data);
        }

        /*return response()->json([
            'success' => 'Record deleted successfully!'
        ]);*/



    }

    public function approveWithdrawRequest(Request $request){

        $data  = $request->all();

        $credit_user_id = 0;

        $WithdrawData               = Balance::find($data['id']);
        

        if($WithdrawData->description == 'Withdraw Request'){
            $WithdrawData->description  = 'Withdraw Request Approved';
        }
        
        // $WithdrawData->details      = 'Withdraw Request Approved';
        $WithdrawData->is_pending      = '0';
        $WithdrawData->datwise      = date('Y-m-d');
        $WithdrawData->created_at   = date("Y-m-d H:s:i");
        $WithdrawData->posted_by    = Auth::user()->id;
        $response = $WithdrawData->save();

        if(!empty($WithdrawData->transfer_to_user_id)){
            $credit_user_id = $WithdrawData->transfer_to_user_id;
            $data3['user_id']        = $credit_user_id;
            $data3['description']    = $WithdrawData->description;
            $data3['details']        = $WithdrawData->details;//'Credit against Freeze Transaction.';
            $data3['type']           = "cr";
            $data3['datwise']        = date("Y-m-d");
            $data3['created_at']     = date("Y-m-d H:s:i");
            $data3['amount']         = $WithdrawData->withdraw;
            $data3['transaction_id'] = $WithdrawData->transaction_id;//$this->generateUniqueString($this->permitted_chars, 16);
            $data3['transaction_by'] = $WithdrawData->transaction_by;
            $data3['posted_by']      = Auth::user()->id;
            $data3['is_freeze_or_refund'] = $WithdrawData->is_freeze_or_refund;
            $response = Balance::create($data3);
        }

        if($response){
            $data['success'] = 'success';
            $data['error'] = 0;
            echo json_encode($data);
        }
        else{
            $data['error'] = 'error';
            $data['success'] = 0;
            echo json_encode($data);
        }
    }



    public function checkToTransfer($id,$transfer_amount)
    {
        $total_balance = $this -> calculateTotalAvailableBalance($id,$transfer_amount);
        if($total_balance >= $transfer_amount)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function mapDbTransferFields($data)
    {
        $data2['id']            = $data['transfer_id'];
        $data2['user_id']       = $data['user_id'];
        $data2['description']   = $data['transfer_description'];
        $data2['details']       = nl2br(htmlentities($data['transfer_details'], ENT_QUOTES, 'UTF-8'));
        $data2['type']          = "db";
        $data2['datwise']       = date("Y-m-d");
        $data2['withdraw']      = $data['transfer_amount'];
        $data2['transaction_id']= $data['transaction_id'];
        return $data2;
    }

    public function mapDbFields($data)
    {
        $data2['user_id']     = $data['user_id'];
        $data2['description'] = $data['deposit_description'];
        $data2['details']     = nl2br(htmlentities($data['deposit_details'], ENT_QUOTES, 'UTF-8'));
        $data2['type']        = "cr";
        $data2['datwise']     = date("Y-m-d");
        $data2['amount']      = $data['deposit_amount'];
        $data2['transaction_id']= $data['transaction_id'];

        return $data2;
    }
    public function getTransByDateRange(Request $request)
    {
        $id           = $request->user()->id;
        $tranx_data   = $request->all();
        $start_date   = $tranx_data['start_date'];
        $end_date     = $tranx_data['end_date'];
        $sdate        = date_create($start_date);
        $start_date   = date_format($sdate,"Y-m-d");
        //var_dump($start_date);
        $edate        = date_create($end_date);
        $end_date     = date_format($edate,"Y-m-d");


        $posted_transactions   = array();

        $group_by_date_transactions = DB::table('balances as w')
                ->select(array(DB::Raw('sum(w.amount) as credit'), DB::Raw('sum(w.withdraw) as debit'),DB::Raw('DATE(w.created_at) day')))
                ->where('description',"!=","Withdraw Request")
                ->where('user_id','=',$id)
                ->where('datwise',"<=",$end_date)
                ->where('datwise',">=",$start_date)
                ->groupBy('day')
                ->orderBy('w.created_at', 'desc')
                ->get()->toArray();

            // echo "<pre>"; print_r($group_by_date_transactions); echo "</pre>";

        if(sizeof($group_by_date_transactions) > 0){

            $total_previous_day_ending_balance = 0 ;

            $loop_transaction = 0;

            $total_balance_remained    = $this->calculateTotalBalance($id);

            foreach ($group_by_date_transactions as $row) {

                if($loop_transaction == 0){
                    $total_previous_day_ending_balance = ($row->credit-$row->debit);
                }
                else{
                    $total_previous_day_ending_balance = $total_previous_day_ending_balance + ($row->credit-$row->debit);
                }

                $daily_transactions_result  = Balance::where('description',"!=","Withdraw Request")
                                                ->where(function($query){
                                                    $query->where('is_pending',"!=",1);
                                                    $query->orWhereNull('is_pending');
                                                })
                                                ->where('user_id','=',$id)
                                                ->where('datwise',"=", $row->day)
                                                ->orderBy('created_at', 'DESC')
                                                ->get()
                                                ->toArray();

                if($daily_transactions_result){

                    $trans_loop_id = 1;

                    foreach ($daily_transactions_result as $transaction) {

                        $data_array = array();

                        $data_array['id']           = $transaction['id'];
                        $data_array['amount']       = $transaction['amount'];
                        $data_array['withdraw']     = $transaction['withdraw'];
                        $data_array['datwise']      = $transaction['datwise'];
                        $data_array['description']  = $transaction['description'];
                        $data_array['user_id']      = $transaction['user_id'];
                        $data_array['details']      = $transaction['details'];
                        $data_array['type']         = $transaction['type'];
                        $data_array['credit']       = $row->credit;
                        $data_array['debit']        = $row->debit;
                        $data_array['transaction_id'] = $transaction['transaction_id'];
                        $data_array['created_at'] = $transaction['created_at'];
                        $data_array['posted_by']      = $this->get_user_name($transaction['posted_by']);
                        $data_array['transaction_by'] = $this->get_user_name($transaction['transaction_by']);
                        $data_array['is_freeze_or_refund'] = $transaction['is_freeze_or_refund'];



                        // if($trans_loop_id == sizeof($daily_transactions_result)){
                        //     $data_array['ending_daily_balance'] = $total_previous_day_ending_balance;
                        // }
                        // else{
                        //     $data_array['ending_daily_balance'] = '';
                        // }

                        if($trans_loop_id == 1){
                            $data_array['ending_daily_balance'] = $total_balance_remained;
                        }
                        else{
                            $data_array['ending_daily_balance'] = '';
                        }

                        $posted_transactions[] = $data_array;

                        $trans_loop_id++;
                    }
                }
                $loop_transaction++;
            }
        }

        // dd($posted_transactions);
        // echo "<pre>"; print_r($posted_transactions); echo "</pre>"; exit();

        $sortArray = array();

        foreach($posted_transactions as $transaction){
            foreach($transaction as $key=>$value){
                if(!isset($sortArray[$key])){
                    $sortArray[$key] = array();
                }
                $sortArray[$key][] = $value;
            }
        }

        $orderby = "created_at"; //change this to whatever key you want from the array

        if(sizeof($sortArray)){
            array_multisort($sortArray[$orderby],SORT_DESC,$posted_transactions);
        }

        //var_dump($posted_transactions);

        // array_multisort($posted_transactions, SORT_DESC, $posted_transactions);

       //echo "<pre>"; print_r($posted_transactions); echo "</pre>"; exit();

        $withdraw_requests = Balance::leftjoin('users','users.id','=','transaction_by')
                                    ->where('datwise',"<=",$end_date)
                                    ->where('datwise',">=",$start_date)
                                    ->where('user_id','=',$id)
                                    ->where('description',"=","Withdraw Request")
                                    ->where(function($query){
                                        $query->where('is_pending',"=",1);
                                        $query->orWhereNull('is_pending');
                                    })
                                    ->select('balances.*','users.name')
                                    ->orderBy('balances.id', 'DESC')
                                    ->get()
                                    ->toArray();

        $transfer_to_me = Balance::Where('transfer_to_user_id','=',$id)
                            ->where(function($query){
                                $query->where('description',"=","Withdraw Request");
                                $query->orWhere('is_pending',"=",1);
                            })
                            // ->where('datwise',"=",date("Y-m-d"))
                            ->orderBy('id', 'DESC')
                            ->first();
        $ttm = 0;
        if ($transfer_to_me != NULL){
            $ttm = 1;
        }




        $user_role_as_accountant = DB::table('user_menu')->where('user_id', $id)->where('menu_options_id',9)->get();

        if(isset($user_role_as_accountant) && !empty($user_role_as_accountant) && sizeof($user_role_as_accountant)>0){
            $user_role_as_accountant = $user_role_as_accountant[0]->menu_options_id;
        }else{
            $user_role_as_accountant = 0;
        }


        return view('partials.trans',array(
                        'posted_transactions' => $posted_transactions, 
                        'withdraw_requests' => $withdraw_requests, 
                        'user_role_as_accountant' => $user_role_as_accountant,
                        'ttm'=>$ttm))-> render();

    }
    public function moveToExcel(Request $request)
    {
        $id           = $request->user()->id;
        $tranx_data   = $request->all();
        $start_date   = $tranx_data['start_date'];
        $end_date     = $tranx_data['end_date'];
        $sdate        = date_create($start_date);
        $start_date   = date_format($sdate,"Y-m-d");
        $edate        = date_create($end_date);
        $end_date     = date_format($edate,"Y-m-d");
        $transactions = Balance::where('datwise',"<=",$end_date)
                        ->where('datwise',">=",$start_date)
                        ->where('user_id','=',$id)
                        ->get()->toArray();
        return view('partials.excel',array('posted_transactions' => $transactions)) -> render();

    }

    public function test()
    {
        return view('pages.admin.test');
    }

    public function queryscreen()
    {
        $data['query_list'] = Query::select("*")->get()->toArray();
        return view('pages.admin.query_screen')->with($data);
    }

    public function takeQuery(Request $request)
    {
        $query = $request -> input('query_command');
        $res = DB::select($query);
        $heading_keys = array_keys(get_object_vars($res['0']));
        $table_headings = "<tr>";
        foreach($heading_keys as $key=>$value)
        {
            $table_headings .= "<th>".$value."</th>";
        }
        $table_headings .= "</tr>";
        $table_to_embed = "";
        if(!empty($res))
        {
            foreach($res as $key => $value)
            {
                $table_to_embed .= "<tr>";
                foreach($heading_keys as $key2 => $value2)
                {
                    $table_to_embed .= "<td>".$value->$value2."</td>";
                }
                $table_to_embed .= "</tr>";
            }
           $data['err'] = "";
        }
        else
        {
            $data['err'] = "query not executed successfully";
        }
        $data['headings'] = $table_headings;
        $data['tabular_data'] = $table_to_embed;
        echo json_encode($data);
    }
    public function saveQuery(Request $request)
    {
        $query_description = $request -> input('query_text');
        $query_name = $request -> input('query_name');
        $data['name'] = $query_name;
        $data['description'] = $query_description;
        $response = Query::create($data);
        $data['success'] = 1;
        echo json_encode($data);
    }
    public function deleteQuery(Request $request)
    {
        $id = $request -> input('query_id');
        $deletedRows = Query::where('id', $id)->delete();
        $data['success'] = $deletedRows;
        echo json_encode($data);
    }
    public function viewAdmin()
    {
        $menu_options = DB::table('menu_options')->orderBy('show_order')->get();
        return view('pages.admin.admin', array('user' => Auth::User(), 'menu_options' => $menu_options) );
    }

    function upload_gif($file){
        $target_dir = "/uploads/avatars/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    }

    public function brandupdate(Request $request)
    {
        if($request->input('update')){
            if($request->hasFile('logo_pic')) {
                $avatar = $request->file('logo_pic');
                $logo_pic = time() . '.' . $avatar->getClientOriginalExtension();
                if($avatar->getClientOriginalExtension() == 'gif'){
                    compress($avatar,public_path('/uploads/avatars/'.$logo_pic));
                    // $avatar->move(public_path('/uploads/avatars/'), $logo_pic);
                }else {
                    compress($avatar,public_path('/uploads/avatars/'.$logo_pic));
                    // Image::make($avatar)->save(public_path('/uploads/avatars/' . $logo_pic));
                }
                DB::table('site_info')->where('attr_name', 'logo_pic')->update(['attr_value' => $logo_pic]);
            }
            if($request->hasFile('header_left_pic')) {
                $avatar = $request->file('header_left_pic');
                $header_left_pic = time() . '.' . $avatar->getClientOriginalExtension();
                if($avatar->getClientOriginalExtension() == 'gif'){
                    compress($avatar,public_path('/uploads/avatars/'.$header_left_pic));
                    // $avatar->move(public_path('/uploads/avatars/'), $header_left_pic);
                }else {
                    compress($avatar,public_path('/uploads/avatars/'.$header_left_pic));
                    // Image::make($avatar)->save(public_path('/uploads/avatars/' . $header_left_pic));
                }
                DB::table('site_info')->where('attr_name', 'header_left_pic')->update(['attr_value' => $header_left_pic]);
            }
            if($request->hasFile('header_right_pic')) {
                $avatar = $request->file('header_right_pic');
                $header_right_pic = time() . '.' . $avatar->getClientOriginalExtension();
                if($avatar->getClientOriginalExtension() == 'gif'){
                    compress($avatar,public_path('/uploads/avatars/'.$header_right_pic));
                    // $avatar->move(public_path('/uploads/avatars/'), $header_right_pic);
                }else {
                    compress($avatar,public_path('/uploads/avatars/'.$header_right_pic));
                    // Image::make($avatar)->save(public_path('/uploads/avatars/' . $header_right_pic));
                }
                DB::table('site_info')->where('attr_name', 'header_right_pic')->update(['attr_value' => $header_right_pic]);
            }
            if($request->hasFile('above_footer_pic')) {
                $avatar = $request->file('above_footer_pic');
                $above_footer_pic = time() . '.' . $avatar->getClientOriginalExtension();
                if($avatar->getClientOriginalExtension() == 'gif'){
                    compress($avatar,public_path('/uploads/avatars/'.$above_footer_pic));
                    // $avatar->move(public_path('/uploads/avatars/'), $above_footer_pic);
                }else{
                    compress($avatar,public_path('/uploads/avatars/'.$above_footer_pic));
                    // Image::make($avatar)->save(public_path('/uploads/avatars/' . $above_footer_pic));
                }
                DB::table('site_info')->where('attr_name', 'above_footer_pic')->update(['attr_value' => $above_footer_pic]);
            }
            if($request->hasFile('footer_pic')) {
                $avatar = $request->file('footer_pic');
                $footer_pic = time() . '.' . $avatar->getClientOriginalExtension();
                if($avatar->getClientOriginalExtension() == 'gif'){
                    // $avatar->move(public_path('/uploads/avatars/'), $footer_pic);
                    compress($avatar,public_path('/uploads/avatars/'.$footer_pic));

                }else {
                    compress($avatar,public_path('/uploads/avatars/'.$footer_pic));
                    // Image::make($avatar)->save(public_path('/uploads/avatars/' . $footer_pic));
                }
                DB::table('site_info')->where('attr_name', 'footer_pic')->update(['attr_value' => $footer_pic]);
            }
            if($request->input('test_next_to_logo')){
                DB::table('site_info')->where('attr_name', 'test_next_to_logo')->update(['attr_value' => $request->input('test_next_to_logo')]);
            }
            if($request->input('site_name')){
                DB::table('site_info')->where('attr_name', 'site_name')->update(['attr_value' => $request->input('site_name')]);
            }
            if($request->input('site_slogan')){
                DB::table('site_info')->where('attr_name', 'site_slogan')->update(['attr_value' => $request->input('site_slogan')]);
            }
        }
        $site_info = DB::table('site_info')->get();
        $info_element_array = array();
        foreach ($site_info as $info_element){
            $info_element_array[$info_element->attr_name] = $info_element->attr_value;
        }
        return view('pages.admin.brand_update', array('user' => Auth::User(), 'info_element_array' => $info_element_array));
    }


    public function opacityUpdate(Request $request)
    {
        $data = $request->all();
        DB::table('site_info')->where('attr_name', 'form_opacity')->update(['attr_value' => $request->input('data')]);
        $data['success'] = '1';
        echo json_encode($data);
    }



    public function userAccessAjax(Request $request){
        $data = $request->all();
        $user = User::where('email', $data['email'])->first();
        if($user->email == Auth::user()->email)
            return "my_email";
        if($user){
            return $user;
        }else{
            return "not_found";
        }
    }
    public function findmenu_options(){
        if(isset($_GET['email']) && trim($_GET['email']) != ""){
            $email = DB::table('users')->where('email', trim($_GET['email']))->get();
            if(isset($email[0])){
                $user_menus = DB::table('user_menu')->where('user_id', $email[0]->id)->get();
                $user_menu_element = array();
                foreach ($user_menus as $user_menu){
                    $user_menu_element[] = $user_menu->menu_options_id;
                }
                $response[0] = $email[0];
                $response[1] = $user_menu_element;
                echo json_encode($response);
            }else{
                echo json_encode(1);
            }
        }else{
            echo json_encode(1);
        }
    }

    public function add_user_menu(){
        if(isset($_POST['find_email']) && trim($_POST['find_email']) != ""){
            $email = DB::table('users')->where('email', trim($_POST['find_email']))->get();
            if(isset($email[0])){
                DB::table('user_menu')->where('user_id', $email[0]->id)->delete();
                if(isset($_POST['menu_options'])){
                    foreach ($_POST['menu_options'] as $menu_options){
                        DB::table('user_menu')->insert(
                            ['user_id' => $email[0]->id, 'menu_options_id' => $menu_options]
                        );
                    }
                    echo json_encode(1);
                }
            }
        }
    }

    public function saveExistingUser(Request $request){
        $data = $request->all();
        if($data['password'])
            $validator =  Validator::make($data, [
                'location' => 'required|string|max:255',
                'phone_no' => 'required|numeric',
                'paypal_email' => 'required|string|email|max:255',
                'password' => 'required|string|min:6|confirmed',
            ]);
        else
            $validator =  Validator::make($data, [
                'location' => 'required|string|max:255',
                'phone_no' => 'required|numeric',
                'paypal_email' => 'required|string|email|max:255',
            ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)
                ->withInput();
        }
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/' . $filename ) );
        }
        $user = User::where('email',$request->input('email'))->firstOrFail();
        if($user->email == Auth::user()->email){
            $request->session()->flash('success', 'This is Me!');
            return redirect()->back();
        }
        $user->name          = $request->input('name');
        $user->location          = $request->input('location');
        $user->phone_no          = $request->input('phone_no');
        $user->paypal_email      = $request->input('paypal_email');
        $user->status      = $request->input('status');
        if($data['password'])
            $user->password      = Hash::make($request->input('password'));
        if(isset($filename))
            $user->avatar =$filename;
        $user->save();
        $request->session()->flash('success', 'User created successfully');
        return redirect()->back();

    }
    public function CreateUserWith(Request $request,$flag){

        $user = User::where('email',$request->input('email'))->first();
        /* if($user->email == Auth::user()->email){
            $request->session()->flash('success', 'This is Me!');
            return redirect()->back();
        } */
        if($user){
            $request->session()->flash('success', 'Email already in use');
            return redirect()->back();
        }
        $data = $request->all();
        $validator =  Validator::make($data, [
            'email' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'phone_no' => 'required|numeric',
            'paypal_email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);


        if($validator->fails()){
            return redirect()->back()->withErrors($validator)
                ->withInput();
        }
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/' . $filename ) );
        }
        $user =new User;
        $user->email          = $request->input('email');
        $user->name          = $request->input('name');
        $user->location          = $request->input('location');
        $user->phone_no          = $request->input('phone_no');
        $user->paypal_email      = $request->input('paypal_email');
        $user->password      = Hash::make($request->input('password'));
        if($data['status'])
            $user->status      = $request->input('status');

        if($flag==1)
            $user->email_verified_at = Carbon::now();
        if(isset($filename))
            $user->avatar =$filename;
        $user->save();
        $request->session()->flash('success', 'User created successfully');
        return redirect()->back();
    }
    public function deleteProfile(Request $request){

        $user = User::where('email',$request->input('email'))->first();
        /* if($user->email == Auth::user()->email){
            $request->session()->flash('success', 'This is Me!');
            return redirect()->back();
        } */

        if(!$user){
            $request->session()->flash('success', 'User does not exist');
            return redirect()->back();
        }
        $user->delete();
        $request->session()->flash('success', 'User deleted successfully');
        return redirect()->back();
    }
    public function myPosts(Request $request)
    {
        $id = $request->user()->id;
        $buyers = Buyer::orderBy('id', 'desc')->paginate(10);
        $sellers = Seller::orderBy('id', 'desc')->paginate(10);
        $articles = Article::orderBy('id', 'desc')->paginate(10);
        return view('pages.myposts.index')
        ->withBuyers($buyers)
        ->withSellers($sellers)
        ->withArticles($articles)
        ->withId($id);
    }
    public function savePost()
    {
       $data = array();
       $data['user_id'] = $_POST['user_id'];
       $data['post_id'] = $_POST['post_id'];
       $data['post_type']  = $_POST['post_type'];
       if(SavedPost::where('post_id',$data['post_id'])->where('post_type',$data['post_type'])->where('user_id', $data['user_id'])->get()->count() == 0)
       {
          $res = SavedPost::create($data);
          if($data['post_type'] == "buyer")
          {
            $save['buyer_saved_status'] = $_POST['status'];
            Buyer::where('id', $data['post_id'])->update($save);
          }
          if($data['post_type'] == "seller")
          {
            $save['seller_saved_status'] = $_POST['status'];
            Seller::where('id', $data['post_id'])->update($save);
          }
          if($data['post_type'] == "article")
          {
            $save['article_saved_status'] = $_POST['status'];
            Article::where('id', $data['post_id'])->update($save);
          }
          $success = 1;
       }
       else{

            $res = SavedPost::where('post_id',$data['post_id'])->where('post_type',$data['post_type'])->where('user_id', $data['user_id'])->delete();
            if($data['post_type'] == "buyer")
            {
              $save['buyer_saved_status'] = $_POST['status'];
              Buyer::where('id', $data['post_id'])->update($save);
            }
            if($data['post_type'] == "seller")
            {
                $save['seller_saved_status'] = $_POST['status'];
                Seller::where('id', $data['post_id'])->update($save);
            }
            if($data['post_type'] == "article")
            {
                $save['article_saved_status'] = $_POST['status'];
                Article::where('id', $data['post_id'])->update($save);
            }
            $success = 0;

       }
       $data['success'] = $success ;
       echo json_encode( $res);
    }
    public function getSavePost(Request $request)
    {
        $user = Auth::user();
        $favoriteEvents = $user->favorite(Event::class);

        

        $id = $request->user()->id;

           //get all darfd events 
        $events = Event::where('is_published','=','no')->where('user_id',$id)->orderBy('id', 'desc')->get();

        //Event Date time get
        $paydate_raw = DB::raw("STR_TO_DATE(`event_date`, '%m/%d/%Y')");
        $currDate = date('m/d/Y');
        $getEventDate = EventModal::where('event_date', ">=",$currDate )->where('user_id',$id)->orderBy('event_date','asc')->get();

        $posts = SavedPost::orderBy('id', 'desc')->where('user_id',$id)->get();

          //get user join events
        $eventVisitor = EventVisitors::where('user_id','=',$user->id)->get();
        if(!empty($eventVisitor))
        {
            $eventVisitorList[] = '';
            $tempVisitorList[] = '';
            foreach ($eventVisitor as $getEventVisitor) {
                $tempVisitorList[] = $getEventVisitor->event_modal_id;
                 $tempVisitorList[]= $getEventVisitor->going_status;

            }
             // print_r($tempVisitorList);
             // exit();
            array_push($eventVisitorList, $tempVisitorList);
           // exit();
        }

        return view('pages.myposts.saved_posts', compact('favoriteEvents'))
                            ->withPosts($posts)
                            ->withEvents($events)
                            ->withGetEventDate($getEventDate)
                            ->withtempVisitorList($tempVisitorList)
                            ->withId($id);
    }
    public function upcomingServices(){
        return view('pages.upcoming_services.upcoming_services');
    }

    public function user_access_search(Request $request){
        $senderId = Auth::user()->id;


        if ($request->ajax()) {

            $output = "";

            $users = DB::table('users')->where('name', 'LIKE', '%' . $request->search . "%")->get();
            $userscont = DB::table('users')->where('name', 'LIKE', '%' . $request->search . "%")->count();
            //return $users;

            if ($userscont == 0) {
                $users = DB::table('users')->where('email', 'LIKE', '%' . $request->search . "%")->get();
            }
            if ($request->search == '') {
                $output = "";
                return Response($output);
            }

            if ($users) {

                foreach ($users as $key => $user) {
                    $receiverId = $user->id;
                    if ($senderId == $receiverId) {
                        continue;
                    }

                    $src = url('/uploads/avatars/' . $user->avatar);
                    $output .= '<ul style="cursor:pointer">' .

                        '<li onClick="setImageLink('.$user->id.')">' .
                           '<a class="alink " >' .
                             '<img  src="' . $src . '" height="30px" width="30px" style="border-radius:50%;float:left">' . '<h1 class="chtbxusername" style="display:inline;font-size:.80rem;">'
                                  . $user->name .
                                   '</h1>' .
                          '</a>' .

                       '</li>' .


                        '</ul>';


                }
                $output = '<div style="overflow-y:scroll;z-index:2;height:500px;" class="suggession_box">' . $output . '</div>';
                return Response($output);

            }


        }
    }
     public function get_user_image_and_link(Request $request){
        $id=$request->id;
        $user=User::find($id);
        $src=url('/uploads/avatars/' . $user->avatar);
       // $link=route('profile',$id);
        $link=url('profile/'.$id);
        return [
            'src'=>$src,
            'link'=>$link,
            'name'=>$user->name,
            'email'=>$user->email,
            'paypal_email'=>$user->paypal_email,
            'verify_status'=>$user->verify_status,

        ];
    }

    public function counter(Request $request) {

        $id=$request->user()->id;
        $query = Balance::select("is_pending")->where('is_pending',NULL)->where('user_id',41)->get()->toArray();
        echo count($query);
    }

    public function notificationList(Request $request) {
        $id=$request->user()->id;
        $getNotification = Balance::select('details','withdraw','datwise')->where('is_pending',NULL)->where('user_id',$id)->get();
        return view('chats.notificationList')->with('notification',$getNotification);
    }

    public function depositByPaypal(Request $request) {
        $email = $request->user()->paypal_email;
        $base_url = URL::to('/');
        $return_url = $base_url.'/payment-status';
        $cancel_url = $base_url.'/payment-cancel';

        $array = array('email'=>$email,'return_url'=>$return_url,'cancel_url'=>$cancel_url);
        return $array;
    }

    public function paymentInfo(Request $request){

        echo $request->tx;        
        // if($request->tx){
        //     if($payment=Payment::where('transaction_id',$request->tx)->first()){
        //         $payment_id=$payment->id;
        //     }else{
        //         $payment=new Payment;
        //         $payment->item_number=$request->item_number;
        //         $payment->transaction_id=$request->tx;
        //         $payment->currency_code=$request->cc;
        //         $payment->payment_status=$request->st;
        //         $payment->save();
        //         $payment_id=$payment->id;
        //     }
        // return 'Pyament has been done and your payment id is : '.$payment_id;
        
        // }else{
        //     return 'Payment has failed';
        // }
    }

}