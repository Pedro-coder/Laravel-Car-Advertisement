<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Dispute as Dispute;
use App\Reply;
use Auth;
use Illuminate\Support\Facades\DB;

class DisputeController extends Controller
{
    //
    private $dispute;

    public function __construct(){
        $this -> middleware('auth');
        $this -> dispute = new Dispute();
    }

    public function create()
    {

        //W
        $user_email     =  Auth::user()->email;
        $user_id        =  Auth::user()->id;

        $disputer_type_maker    = Dispute::where("dispute_maker","=",$user_email)->get()->count();
        $disputer_type_replier  = Dispute::where("open_with","=",$user_email)->get()->count();

        $IsDisputeAdmin = $this->dispute->isUserHasPermission($user_id)->count();
    


        //new
        $type="maker";

        if($disputer_type_maker > 0 && $disputer_type_replier == 0)
        {
            $type = "maker";
        }
        if($disputer_type_replier > 0 && $disputer_type_maker == 0)
        {
            $type = "replier";
        }

      //h2
       
        $response       =   Dispute:: whereRaw( "disputes.id IN ( SELECT MAX(id) FROM disputes GROUP BY dispute_no )")
        //  $response       =   Dispute::whereIn( "disputes.id" ,['17','24','23','19'])
        
                            ->where("disputes.dispute_maker","=",$user_email)
                            ->where("disputes.status","<>",'closed')
                            ->orWhere('open_with', '=', $user_email)
                            // ->leftJoin('replies', 'disputes.replyer_id', '=', 'replies.replyer_id')

                            ->leftJoin('replies', function($join)
                            {
                                $join->on('disputes.replyer_id', '=', 'replies.replyer_id');
                                $join->on('disputes.dispute_no', '=', 'replies.dispute_no');
                            })



                            ->leftJoin('users as u1', 'disputes.dispute_maker', '=', 'u1.email')
                            ->leftJoin('users as u2', 'disputes.open_with', '=', 'u2.email')
                            ->get([
                                'disputes.id as d_id',
                                'disputes.dispute_no as d_dispute_no',
                                'disputes.dispute_maker as d_dispute_maker',
                                'disputes.status as d_status',
                                'disputes.open_with as d_open_with',
                                'disputes.created_at as d_created_at',
                                'replies.notes as r_notes',
                                'u1.avatar as avatr1',
                                'u2.avatar as avatr2',
                                'disputes.dispute_subject as dispute_subject',
                            ])->toArray();

            // dd($response);


       
    

        $replies        =  Reply::where("note_id",Auth::user()->id)
                                    ->orWhere('replyer_id', '=', Auth::user()->id)
                                ->get()->toArray();
        $user_type      = "maker";
        
        $isAdmin = DB::table('user_menu')->where('user_id',Auth::user()->id)->where('menu_options_id',23)->get()->count();

        if(isset($response[0]['dispute_subject']))
        {
            $subject = $response[0]['dispute_subject'];
        }
        else
        {
            $subject = 0;
        }
        
        

        return view('pages.dispute.dispute',array('isDisputeAdmin'=>$IsDisputeAdmin,'type'=>$type,'dispute_subject'=>$subject,'isAdmin' => $isAdmin ,'user_id'=>Auth::user()->id,'dispute_maker_email' => $user_email,'disputes' => $response,'user' => Auth::User(),'replies'=>$replies,'user_type' =>  $user_type ));
    }


    public function getNoteOfRecord(){


        $response  =  Dispute::where("disputes.dispute_no","=",$_POST['record'])
                            ->join('replies', function($join)
                            {
                                $join->on('disputes.replyer_id', '=', 'replies.replyer_id');
                                $join->on('disputes.dispute_no', '=', 'replies.dispute_no');
                            })->get()->toArray();


        $data['response'] = $response;
        
        echo json_encode($data);

    }



    public function getallDispute(){

       

        $response       =   Dispute::where("disputes.dispute_no","=",$_POST['dispute_no_val'])
        // ->leftJoin('replies', 'disputes.dispute_no', '=', 'replies.dispute_no')
        ->leftJoin('replies', function($join)
        {
            $join->on('disputes.replyer_id', '=', 'replies.replyer_id');
            $join->on('disputes.dispute_no', '=', 'replies.dispute_no');
        })

        ->leftJoin('users as u1', 'disputes.dispute_maker', '=', 'u1.email')
        ->leftJoin('users as u2', 'disputes.open_with', '=', 'u2.email')
        ->get([
            'disputes.id as d_id',
            'disputes.dispute_no as d_dispute_no',
            'disputes.dispute_maker as d_dispute_maker',
            'disputes.status as d_status',
            'disputes.open_with as d_open_with',
            'disputes.created_at as d_created_at',
            'replies.notes as r_notes',
            'u1.avatar as avatr1',
            'u2.avatar as avatr2',
            'disputes.dispute_subject as dispute_subject',
        ])->toArray();
        


        $data['response'] = "";
        
        $user_id        =  Auth::user()->id;
        $email          =  Auth::user()->email;

        $IsDisputeAdmin = $this->dispute->isUserHasPermission($user_id)->count();
  
       
        if($IsDisputeAdmin == 0)
        {

            if($email == $response[0]['d_dispute_maker'] || $email == $response[0]['d_open_with'])
            {
                $data['response'] = $response; 
            }
        }
        else
        {
            $data['response'] = $response; 
        }

   
        echo json_encode($data);


    }

    public function addDispute()
    {
        
    

        $data['id'] = Auth::user()->id;
        foreach($_POST['dispute'] as $key => $value)
        { 
            $data[$value['name']] = $value['value'];
        }


        if(empty($data['replyer_id']))
        {
            $data['replyer_id'] = 0;
        }

        $data2 = $this->mapFields($data); 

        $data3  = $this->mapFieldsreplies($data);

    

        $count  = Dispute::where("dispute_no","=",$data['dispute_unique_no'])->count();
        if($count > 0)
        {
           // $res1    = Dispute::where("dispute_no","=",$data['dispute_unique_no'])->update($data2);
            //$res2    = Reply::where("dispute_no","=",$data['dispute_unique_no'])->update($data3);

            $res1    = Dispute::create($data2);
            $res2    = Reply::create($data3);

        }
        else
        {   
            $res1    = Dispute::create($data2);
            $res2    = Reply::create($data3);
            
          
        }
        
        
        $data4['res1'] = $res1;
        $data4['res2'] = $res2;
       
        $data4['date_to_show'] = date("F j, Y, H:i:s");

    

        echo json_encode($data4);
    }

    public function mapFields($data)
    {
        $data2['dispute_no']            = $data['dispute_unique_no'];
        $data2['dispute_maker']   = $data['dispute_maker_email'];
        $data2['status']                = $data['dispute_opts'];
        $data2['open_with']             = $data['dispute_onpen_with'];
        $data2['dispute_maker_id']      = $data['id'];
        $data2['note']                  = "";
        $data2['replyer_id']            = $data['replyer_id'];
        $data2['dispute_subject']            = (isset($data['dispute_subject']) && !empty($data['dispute_subject']) ? $data['dispute_subject'] : "");

        return $data2;
    }

    public function mapFieldsreplies($data)
    {
        $data3['dispute_no']            = $data['dispute_unique_no'];
        $data3['note_id']               = $data['id'];
        $data3['notes']                 = $data['notes'];
        $data3['replyer_id']            = $data['replyer_id'];
        return $data3;
    }

    public function getRecords(){
        
        $user_email     =  Auth::user()->email;
    
        if($_POST['record'] == "myrecord")
        {


            $response       =   Dispute::where("dispute_maker","=",$user_email)
            ->orWhere('open_with',"=",$user_email)
            ->where('disputes.status','<>','closed')
            // ->leftJoin('replies', 'disputes.dispute_no', '=', 'replies.dispute_no')
            ->leftJoin('replies', function($join)
            {
                $join->on('disputes.replyer_id', '=', 'replies.replyer_id');
                $join->on('disputes.dispute_no', '=', 'replies.dispute_no');
            })
            ->leftJoin('users as u1', 'disputes.dispute_maker', '=', 'u1.email')
            ->leftJoin('users as u2', 'disputes.open_with', '=', 'u1.email')
            ->get([
                'disputes.id as d_id',
                'disputes.dispute_no as d_dispute_no',
                'disputes.dispute_maker as d_dispute_maker',
                'disputes.status as d_status',
                'disputes.open_with as d_open_with',
                'disputes.created_at as d_created_at',
                'replies.notes as r_notes',
                'replies.notes as rep_notes',
                'replies.id as rep_id',
                'u1.avatar as avatr1',
                'u2.avatar as avatr2',
                'disputes.dispute_subject as dispute_subject',
            ])->toArray();

            $data['response'] = $response;

       
        }
        else if($_POST['record'] == "clodedrecord")
        {
   

            $response       =   Dispute::where("dispute_maker","=",$user_email)
            // ->orWhere('open_with',"=",$user_email)
            ->where("disputes.status","=","closed")
            // ->leftJoin('replies', 'disputes.dispute_no', '=', 'replies.dispute_no')
            ->leftJoin('replies', function($join)
            {
                $join->on('disputes.replyer_id', '=', 'replies.replyer_id');
                $join->on('disputes.dispute_no', '=', 'replies.dispute_no');
            })
            ->leftJoin('users as u1', 'disputes.dispute_maker', '=', 'u1.email')
            ->leftJoin('users as u2', 'disputes.open_with', '=', 'u1.email')
            ->get([
                'disputes.id as d_id',
                'disputes.dispute_no as d_dispute_no',
                'disputes.dispute_maker as d_dispute_maker',
                'disputes.status as d_status',
                'disputes.open_with as d_open_with',
                'disputes.created_at as d_created_at',
                'replies.notes as r_notes',
                'u1.avatar as avatr1',
                'u2.avatar as avatr2',
                'disputes.dispute_subject as dispute_subject',
            ])->toArray();

            $data['response'] = $response;
           

        
        }
        else if($_POST['record'] == "managerrecord")
        {

            $response       =   Dispute::where("dispute_maker","=",$user_email)
            ->where("disputes.status","=","to_dispute_manager")
            // ->leftJoin('replies', 'disputes.dispute_no', '=', 'replies.dispute_no')
            ->leftJoin('replies', function($join)
            {
                $join->on('disputes.replyer_id', '=', 'replies.replyer_id');
                $join->on('disputes.dispute_no', '=', 'replies.dispute_no');
            })
            ->leftJoin('users as u1', 'disputes.dispute_maker', '=', 'u1.email')
            ->leftJoin('users as u2', 'disputes.open_with', '=', 'u1.email')
            ->get([
                'disputes.id as d_id',
                'disputes.dispute_no as d_dispute_no',
                'disputes.dispute_maker as d_dispute_maker',
                'disputes.status as d_status',
                'disputes.open_with as d_open_with',
                'disputes.created_at as d_created_at',
                'replies.notes as r_notes',
                'u1.avatar as avatr1',
                'u2.avatar as avatr2',
                'disputes.dispute_subject as dispute_subject',
                'disputes.created_at as created'
            ])->toArray();

            $data['response'] = $response;

        }
        else if($_POST['record'] == "otherrecord")
        {
            $response = Dispute::Where('open_with',"=",$user_email)  
            // ->leftJoin('replies', 'disputes.dispute_no', '=', 'replies.dispute_no')
            ->leftJoin('replies', function($join)
            {
                $join->on('disputes.replyer_id', '=', 'replies.replyer_id');
                $join->on('disputes.dispute_no', '=', 'replies.dispute_no');
            })
            ->leftJoin('users as u1', 'disputes.dispute_maker', '=', 'u1.email')
            ->leftJoin('users as u2', 'disputes.open_with', '=', 'u1.email')
            ->get([
                'disputes.id as d_id',
                'disputes.dispute_no as d_dispute_no',
                'disputes.dispute_maker as d_dispute_maker',
                'disputes.status as d_status',
                'disputes.open_with as d_open_with',
                'disputes.created_at as d_created_at',
                'replies.notes as r_notes',
                'u1.avatar as avatr1',
                'u2.avatar as avatr2',
                'disputes.dispute_subject as dispute_subject',
                'disputes.created_at as created'
            ])->toArray();

            $data['response'] =  $response;

        }
        else{
            $data['response'] = "";
        }
    
        echo json_encode($data); 
      
        

    }

}
