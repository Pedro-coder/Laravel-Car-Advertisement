<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EventModal;
use App\Event;
use App\TempEventDateTime;
use App\EventVisitors;
use App\Balance;
use App\SavedPost;
use Image;
use Session;
use Storage;
use DB;
use User;
use Auth;

class EventModalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    public $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request){

    }
    public function store(Request $request)
    {
      // validate the data

      $event = Event::where('id',$request->event)->first();
      
      $user = \Auth::user();
        if($request->event_modal_image){
            $imageName = time() . '.' . $request->event_modal_image->getClientOriginalExtension();
                $image_uploaded = $request->event_modal_image->move(public_path('/uploads/event'), $imageName);
                if ($image_uploaded) {
                
                    $data['image'] = $imageName;
                    //return $data['image'];
                    $event->event_modal_image = $data['image'];
                }
        }

        
        $event->is_published = 'yes';
        $event->save();
        //return $event->id;exit;
      $this->validate($request, array(
          'event_date'              => '',
          'event_start_time'        => '',
          'event_end_time'          => '',
          'event_ticket_price'      => '',
          'event_details'           => '',
        ));
        // store in the database
          $eventM = new EventModal;

          $eventM->user()->associate($request->user());

          $eventM->event_date             = $request->event_date;
          $eventM->event_start_time       = $request->event_start_time;
          $eventM->event_end_time         = $request->event_end_time;
          $eventM->event_ticket_price     = $request->event_ticket_price;
          $eventM->event_details          = $request->event_details;
          $eventM->event_id               = $event->id;


          //Save our Image
          // if ($request->hasFile('seller_featured_image')) {
          // $image = $request->file('seller_featured_image');
          // $filename = time() . '.' . $image->getClientOriginalExtension();
          // $location = public_path('uploads/seller/' . $filename);
          // Image::make($image)->resize(280,320)->save($location);
          //
          // $eventM->seller_featured_image = $filename;
          // }

          $eventM->save();


          Session::flash('success', 'Plan and Price added Successfully!');
          // redirect to another page
           //return redirect()->route('eventM.index');
           return redirect()->to('events');
            //return view('pages.events.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

      $eventM = EventModal::find($id);
      $eventM->delete();

      Session::flash('success', 'The post was sucessfully deleted.');

      return redirect()->back();
    }
    //insert start and end date time
    public function insertStartDateTime(Request $request)
    {
        //$startTime = $request->start_house.':'.$request->start_minit.' '.$request->startTimeType;
        //$endTime = $request->end_house.':'.$request->end_minit.' '.$request->end_time_type;
        $data = new TempEventDateTime();
        $data->temp_event_id = $request->tempEventId;
        $data->start_date = $request->eventStartDate;
        $data->start_hours = $request->start_house;
        $data->start_minit = $request->start_minit;
        $data->start_type = $request->startTimeType;
        $data->end_date = $request->eventEndDate;
        $data->end_hours = $request->end_house;
        $data->end_minit = $request->end_minit;
        $data->end_type = $request->end_time_type;
        $data->goingstatus = 'notgoing';
        $data->save();
        return response()->json($data);
    }
    //update going status update
    public function goingEventStatus(Request $request)
    {
        $id = $request->Id;;
        $updateStatus = TempEventDateTime::find($id);
        if($updateStatus->goingstatus == 'going')
        {
            $gStatus = 'notgoing';
        }
        else
        {
            $gStatus = 'going';
        }
        $updateStatus->goingstatus = $gStatus;
        $updateStatus->save();
        return response()->json($updateStatus);
    }
    //event model data insert 
   public function eventInsert(Request $request)
    {
       if($request->eventStatus == 'eventpublish')
       {
          $published = 'yes';
       }
       else
       {
          $published = 'no';
       }
       $explodAddress = explode(",", $request->address);
       $num = (count($explodAddress) - 1);
       $county = $explodAddress[$num];
       $state = $explodAddress[$num - 1];
       $request->uploadBanner;
       if($request->uploadBanner =='undefined' || $request->uploadBanner == '' || empty($request->uploadBanner)){
             $event['image'] = '';
        }
        else
        {
           $imageName = time() . '.' . $request->uploadBanner->getClientOriginalExtension();
                // $image_uploaded = $request->uploadBanner->move(public_path('/uploads/event'), $imageName);
                
                if (compress($request->uploadBanner,public_path('/uploads/event/' . $imageName))) {
                
                   $event['image'] = $imageName;
               }
           
        }
        $user = \Auth::user();
        $data = new Event();
        $data->user()->associate($request->user());
        $data->event_title = $request->eventfor;
        $data->post_category = $request->post_category;
        $data->event_modal_image = $event['image'];
        $data->event_description = $request->event_description;
        $data->event_address = $request->address;
        $data->latitude = $request->lat;
        $data->longitude = $request->lng;
        $data->event_country = $county;
        $data->event_city = $state;
        $data->event_fee_type = $request->eventJoinType;
        $data->event_fee = $request->eventFee;
        $data->event_referral_commission = $request->referralPer;
        $data->need_approval = $request->eventApproval;
        $data->total_tickets = $request->eventTicket;
        $data->is_published = $published;
        $data->save();
        
        $eventDateTime = DB::table('temp_event_date_time')
                          ->where('temp_event_id',$request->tempEventId)
                          ->get();
        foreach($eventDateTime as $dateTime)
        {
          $eventM = new EventModal();
          $startEventTime = $dateTime->start_hours.':'.$dateTime->start_minit.' '.$dateTime->start_type;
          $endEventTime = $dateTime->end_hours.':'.$dateTime->end_minit.' '.$dateTime->end_type;

          $eventM->user()->associate($request->user());
          $eventM->event_date             = $dateTime->start_date;
          $eventM->event_start_time       = $startEventTime;
          $eventM->event_end_date         = $dateTime->end_date;
          $eventM->event_end_time         = $endEventTime;
          $eventM->event_id               = $data->id;
          $eventM->goingstatus             = $dateTime->goingstatus;
          $eventM->save();
        }
        $deleteTemp = TempEventDateTime::where('temp_event_id', $request->tempEventId)->delete();
        //Session::flash('success', 'Event Add Successfully');
        //return redirect()->to('events');

        $finalData['eventId'] = $data->id;
        $finalData['userId'] = $user->id;
        return response()->json($finalData);
    }

    //event model edit
    public function eventModelEdit(Request $request)
    {
        $id = $request->id;
        $userId = $request->userId;
        $user = \Auth::user();

        $modelEventEdit =  DB::table('events')->where('id',$id)->get();
        $getUserData =  DB::table('users')->where('id',$userId)->get()->first();

        foreach ($modelEventEdit as  $value);

        $currDate = date('m/d/Y');
        $eventId = $value->id;
        


        $data['id'] = $value->id;
        $data['user_id'] = $value->user_id;
        $data['event_title'] = $value->event_title;
        $data['event_city'] = $value->event_city;
        $data['event_country'] = $value->event_country;
        $data['event_address'] = $value->event_address;
        $data['need_approval'] = $value->need_approval;
        $data['event_description'] = $value->event_description;
        $data['event_modal_image'] = '/uploads/event/'.$value->event_modal_image;
        $data['is_published'] = $value->is_published;
        $data['event_fee_type'] = $value->event_fee_type;
        $data['event_fee'] = $value->event_fee;
        $data['event_referral_commission'] = $value->event_referral_commission;
        $data['latitude'] = $value->latitude;
        $data['longitude'] = $value->longitude;
        $getEventDate = EventModal::where('event_date', ">=",$currDate )->where('event_id',"=",$id)->first();
        

        $data['modelId'] = $getEventDate->id;
        $data['event_date'] = $getEventDate->event_date;
        $data['event_start_time'] = $getEventDate->event_start_time;
        $data['event_end_time'] = $getEventDate->event_end_time;
        $data['event_end_date'] = $getEventDate->event_end_date;
        $data['goingstatus'] = $getEventDate->goingstatus;

        $countEventGoing = EventVisitors::where('event_modal_id','=',$getEventDate->id)->where('going_status','approved')->count();

        $countEventWaiting = EventVisitors::where('event_modal_id','=',$getEventDate->id)->where('going_status','pending')->count();

        $userJoinStatus = EventVisitors::where('event_modal_id','=',$getEventDate->id)->where('user_id','=',$user->id)->first();

        $data['going'] = $countEventGoing;
        $data['waiting'] = $countEventWaiting;

        $data['user_location'] = $getUserData->location;
        
        $data['user_image'] = '/uploads/avatars/'.$getUserData->avatar;
        if($userJoinStatus)
        {
             $data['userGoingStatus'] = $userJoinStatus->going_status;
        }
        $savedEvents = SavedPost::where('post_type','=','event')->where('post_id','=',$id)->where('user_id','=',$user->id)->orderBy('id', 'desc')->get()->first();
         if($savedEvents)
         {
            $data['checkSaved'] = 1;
         }
         else
         {
            $data['checkSaved'] = 0;
         }
        $data['url'] = url('share/'.$id.'/'.$user->id);
        return response()->json($data);
    }

     //event date time 
    public function eventEditDateTime(Request $request)
    {
        $id = $request->id;
         $user = \Auth::user();
       $userId = $request->userId;
        $currDate = date('m/d/Y');
        $eventDetails =  DB::table('events')->where('id',$id)->first();
        if($eventDetails->need_approval == 'Yes')
        {
            $needApprove = 1;
        }
        else
        {
            $needApprove = 0;
        }

        $getEventDate1 = EventModal::where('event_date', ">=",$currDate )->where('event_id',"=",$id)->get();
      
        
        
        $data = '<div id="table1">';
        foreach($getEventDate1 as $evandDateTime)
        {
          $checkVisited = EventVisitors::where('event_modal_id','=',$evandDateTime->id)->where('user_id','=',$user->id)->first();

           $countEventGoing = EventVisitors::where('event_modal_id','=',$evandDateTime->id)->where('going_status','approved')->count();

          $countEventWaiting = EventVisitors::where('event_modal_id','=',$evandDateTime->id)->where('going_status','pending')->count();

         $startTime = explode(':',$evandDateTime['event_start_time']);
         $startType = explode(' ',$evandDateTime['event_start_time']);

         $endTime = explode(':',$evandDateTime['event_end_time']);
         $endType = explode(' ',$evandDateTime['event_end_time']);
        
           
            $data .=  '<div class="raw'.$evandDateTime['id'].'"><br/>
                    <div class="col-sm-6 col-md-12" >
                      <div class="row">
                        <div class="col-sm-12 col-md-5">
                          <div class="input-group date">
                            <input type="text" class="form-control" name="" value="'.$evandDateTime['event_date'].'" id="eventStartDate">
                              <span class="cop-input-group-addon"><i class="fa fa-calendar"></i></span>
                          </div>
                        </div>
                        <div class="col-sm-12 col-md-5">
                          <div class="input-group date">
                            <input type="text" name="" value="'.$evandDateTime['event_end_date'].'" class="form-control" id="eventEndDate"><span class="cop-input-group-addon"><i class="fa fa-calendar"></i></span>
                          </div>
                        </div>
                          <div class="col-sm-12 col-md-2">';
                        if($userId == $user->id)
                      {
                          $data .= '<a href="#" style="color: red" onclick="deleteListEditSelectedDateTime('.$evandDateTime['id'].')">Delete</a>';
                      }
                        
                        $data .='</div>
                        <br/>
                        <div class="col-sm-12 col-md-6">
                          <br/>
                          <div class="row">
                          <div class="col-md-2">
                            <i class="fa fa-clock-o" style="width: 10px;padding: 10px" aria-hidden="true"></i>
                          </div>
                          <div class="col-md-3">
                            <select style="padding: 5px" id="start_house">
                              <option value="'.$startTime[0].'">'.$startTime[0].'</option>
                            </select>
                          </div>
                          <div class="col-md-3">
                            <select style="padding: 5px" id="start_minit">
                              <option value="'.substr($startTime[1], 0, 2).'">'.substr($startTime[1], 0, 2).'</option>
                            </select>
                          </div>
                          <div class="col-md-3">
                            <select style="padding: 5px" id="startTimeType">
                              <option>'.$startType[1].'</option>
                            </select>
                          </div>
                          <div class="col-md-3">
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6">
                        <br/>
                        <div class="row">
                          <div class="col-md-2">
                            <i class="fa fa-clock-o" style="width: 10px;padding: 10px" aria-hidden="true"></i>
                          </div>
                          <div class="col-md-3">
                            <select style="padding: 5px" id="end_house">
                              <option value="'.$endTime[0].'">'.$endTime[0].'</option>
                            </select>
                          </div>
                          <div class="col-md-3">
                            <select style="padding: 5px" id="end_minit">
                              <option value="'.substr($endTime[1], 0, 2).'">'.substr($endTime[1], 0, 2).'</option>
                            </select>
                          </div>
                          <div class="col-md-3">
                            <select style="padding: 5px" id="end_time_type">
                              <option>'.$endType[1].'</option>
                            </select>
                          </div>
                          <div class="col-md-3">
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6">
                      ';
                      if($userId == $user->id)
                      {
                           $data .='
                          <div class="row">
                            <div class="col-md-6">
                              <span style="color: blue"><a href="#" onclick="goingParticipent('.$evandDateTime['id'].','.$countEventGoing.')">'.$countEventGoing.' going </a></span>
                            </div>
                            <div class="col-md-6">
                              <span style="color: blue"><a href="#" onclick="waitingParticipent('.$evandDateTime['id'].','.$countEventWaiting.')">'.$countEventWaiting.' waiting </a></span>
                            </div>
                          </div>
                        ';
                      }
                      else
                      {
                          $data .='
                          <div class="row">
                            <div class="col-md-6">
                              <span style="color: blue">'.$countEventGoing.' going </span>
                            </div>
                            <div class="col-md-6">
                              <span style="color: blue">'.$countEventWaiting.' waiting</span>
                            </div>
                          </div>
                        ';
                      }
                    

                    $data .='</div><div class="col-sm-12 col-md-6">
                      <div class="row">
                        <div class="col-md-6"></div>
                        <div class="col-md-6" >
                          <center>
                            <b style="font-size: 20px;color: blue" >
                            ';
                            if($checkVisited)
                            {
                              if($checkVisited->going_status == "pending")
                              {
                                  $data .='<a href="#" id="1" onclick=""><div id=""><img = src="/images/pending.png"   style="width: 80px"></div></a><input type="hidden" name="" value="not going" id="goingStatus">';
                              }
                              else if($checkVisited->going_status == "rejected")
                              {
                                $data .='<a href="#" id="1" onclick=""><div id=""><img = src="/images/rejected.jpg"   style="width: 80px"></div></a><input type="hidden" name="" value="not going" id="goingStatus">';
                              }
                              else
                              {
                                $data .='<a href="#" id="1" onclick=""><div id=""><img = src="/images/going.png"   style="width: 80px"></div></a><input type="hidden" name="" value="not going" id="goingStatus">';
                              }
                            }
                            else 
                            {
                              if($eventDetails->event_fee_type == 'Not Free')
                              {
                                   $data .='<a href="#" id="1" onclick="eventPay('.$eventDetails->event_fee.','.json_encode($eventDetails->user_id).','.json_encode($eventDetails->id).','.json_encode($evandDateTime->id).','. json_encode($needApprove).')"><div id=""><img = src="/images/notgoing.png"   style="width: 80px"></div></a><input type="hidden" name="" value="not going" id="goingStatus">';
                              }
                              else
                              {
                                   $data .='<a href="#" id="1" onclick="freeJoinEvent('.json_encode($eventDetails->user_id).','.json_encode($eventDetails->id).','.json_encode($evandDateTime->id).','.json_encode($needApprove).')"><div id=""><img = src="/images/notgoing.png"   style="width: 80px"></div></a><input type="hidden" name="" value="not going" id="goingStatus">';
                              }
                             
                            }
                            
                            $data .='
                             </b>
                          </center>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

          ';
       
        }
        $data .= '</div>';
        $user = \Auth::user();

        if($evandDateTime->user_id == $user->id)
        {
          $data .= '<br/><span><button class="continue" onclick="editEventAddMore('.$id.')" type="button">Add date</button><br><br>
          <button class="btn btn-success" style="width: 100%" id="eventpublish" onclick="editeventpublish('.$id.',this.id)" type="button">Publish</button><br><br>
          <button class="continue" style="background: lightgray" id="submitsaveindraft" onclick="editeventpublish('.$id.',this.id)" type="button">Save as druft</button><br><br>
          <button class="cancel" onclick="scheduleCancel()" type="button">CANCEL</button>
        </span>';
        }
        
        echo $data;

    }

    //edit event add datetime
    public function editEventDateTime(Request $request)
    {

      if($request->editCheck == 'onlyDateTime')
      {
          $eventDateTime = DB::table('temp_event_date_time')
                            ->where('temp_event_id',$request->eventId)
                            ->get();
          foreach($eventDateTime as $dateTime)
          {
            $eventM = new EventModal();
            $startEventTime = $dateTime->start_hours.':'.$dateTime->start_minit.' '.$dateTime->start_type;
            $endEventTime = $dateTime->end_hours.':'.$dateTime->end_minit.' '.$dateTime->end_type;

            $eventM->user()->associate($request->user());
            $eventM->event_date             = $dateTime->start_date;
            $eventM->event_start_time       = $startEventTime;
            $eventM->event_end_date         = $dateTime->end_date;
            $eventM->event_end_time         = $endEventTime;
            $eventM->event_id               = $request->id;
            $eventM->goingstatus             = $dateTime->goingstatus;
            $eventM->save();
          }
          $deleteTemp = TempEventDateTime::where('temp_event_id', $request->eventId)->delete();
          if($deleteTemp)
          {
              return 'success';
          }
          
      }
      else
      {
       // echo 'Done';
          echo $id = $request->eventId;
          if($request->eventStatus == 'eventpublish')
         {
            $published = 'yes';
         }
         else
         {
            $published = 'no';
         }
         $explodAddress = explode(",", $request->address);
         $num = (count($explodAddress) - 1);
         $county = $explodAddress[$num];
         $state = $explodAddress[$num - 1];
         $request->uploadBanner;
        
          $user = \Auth::user();
          $data = Event::find($id);
          $data->user()->associate($request->user());
          $data->event_title = $request->eventfor;
           if($request->uploadBanner =='undefined' || $request->uploadBanner == '' || empty($request->uploadBanner)){
              // $event['image'] = '';
          }
          else
          {
             $imageName = time() . '.' . $request->uploadBanner->getClientOriginalExtension();
                  $image_uploaded = $request->uploadBanner->move(public_path('/uploads/event'), $imageName);
                  if ($image_uploaded) {
                  
                     $event['image'] = $imageName;
                     $data->event_modal_image = $event['image'];
                 }
          }
         
          
          $data->event_description = $request->event_description;
          $data->event_address = $request->address;
          $data->latitude = $request->lat;
          $data->longitude = $request->lng;
          $data->event_country = $county;
          $data->event_city = $state;
          $data->event_fee_type = $request->eventJoinType;
          $data->event_fee = $request->eventFee;
          $data->event_referral_commission = $request->referralPer;
          $data->need_approval = $request->eventApproval;
          $data->is_published = $published;
          $data->save();
          
          $eventDateTime = DB::table('temp_event_date_time')
                            ->where('temp_event_id',$request->tempEventId)
                            ->get();
          foreach($eventDateTime as $dateTime)
          {
            $eventM = new EventModal();
            $startEventTime = $dateTime->start_hours.':'.$dateTime->start_minit.' '.$dateTime->start_type;
            $endEventTime = $dateTime->end_hours.':'.$dateTime->end_minit.' '.$dateTime->end_type;

            $eventM->user()->associate($request->user());
            $eventM->event_date             = $dateTime->start_date;
            $eventM->event_start_time       = $startEventTime;
            $eventM->event_end_date         = $dateTime->end_date;
            $eventM->event_end_time         = $endEventTime;
            $eventM->event_id               = $data->id;
            $eventM->goingstatus             = $dateTime->goingstatus;
            $eventM->save();
          }
          $deleteTemp = TempEventDateTime::where('temp_event_id', $request->tempEventId)->delete();
          if($deleteTemp)
          {
              return response()->json('Success');
          }
          
      }
       
    }

    public function eventDelete(Request $request)
    {
      $id = $request->eventId;

      $eventDelete = Event::where('id', $id)->delete();
      $eventModelDelete = EventModal::where('event_id', $id)->delete();
   

      //Session::flash('success', 'The post was sucessfully deleted.');
      //if()
      return response()->json('success');
    }

    //going participent list
    public function goingParticipentList(Request $request)
    {
        $modelId = $request->modelId;
        $goingEventDatetime = EventModal::where('id','=',$modelId)->first();
        $startTime = explode(':',$goingEventDatetime['event_start_time']);
         $startType = explode(' ',$goingEventDatetime['event_start_time']);

          $eventId = $goingEventDatetime->event_id;
        $waitingEventDatetime = Event::where('id','=',$eventId)->get();
        foreach($waitingEventDatetime as $geteventeventfee);
        //echo $geteventeventfee->event_fee;
         $endTime = explode(':',$goingEventDatetime['event_end_time']);
         $endType = explode(' ',$goingEventDatetime['event_end_time']);
        $eventGoingParticipentList= DB::table('event_visitors as e')
                                    ->Join('users as u', 'u.id','=','e.user_id')
                                     ->select('u.name','u.avatar','e.id','e.owner_id','e.user_id')
                                    ->where('e.event_modal_id','=',$modelId)
                                    ->where('e.going_status','approved')
                                    ->get();

        $countEventWaiting = EventVisitors::where('event_modal_id','=',$modelId)->where('going_status','pending')->count();

        $participentList = '<div class="row">
              <div class="col-sm-12 col-md-6">
                <div class="input-group date">
                  <input type="text" class="form-control input-small" value="'.$goingEventDatetime['event_date'].'" name="" readonly>
                  <span class="cop-input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </span>
                </div>
              </div>
              <div class="col-sm-12 col-md-6">
                <div class="input-group date">
                  <input type="text" class="form-control input-small" value="'.$goingEventDatetime['event_end_date'].'" name="" readonly>
                  <span class="cop-input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </span>
                </div>
              </div>
              <br/>
              <div class="col-sm-12 col-md-6">
                <br/>
                <div class="row">
                  <div class="col-md-2">
                    <i class="fa fa-clock-o" style="width: 10px;padding: 10px" aria-hidden="true"></i>
                  </div>
                  <div class="col-md-3">
                    <select style="padding: 5px" id="editstart_house">
                      <option>'.$startTime[0].'</option>
                    </select>
                  </div>
                  <div class="col-md-3">
                     <select style="padding: 5px" id="editstart_minit">
                        <option value="'.substr($startTime[1], 0, 2).'">'.substr($startTime[1], 0, 2).'</option>
                    </select>
                  </div>
                  <div class="col-md-3">
                     <select style="padding: 5px" id="editstartTimeType">
                      <option>'.$startType[1].'</option>
                    </select>
                  </div>
                   <div class="col-md-3">
                   </div>
                </div>
              </div>
              <div class="col-sm-12 col-md-6">
                    
                <br/>
                <div class="row">
                  <div class="col-md-2">
                    <i class="fa fa-clock-o" style="width: 10px;padding: 10px" aria-hidden="true"></i>
                  </div>
                  <div class="col-md-3">
                    <select style="padding: 5px" id="editend_house">
                      <option>'.$endTime[0].'</option>
                    </select>
                  </div>
                  <div class="col-md-3">
                     <select style="padding: 5px" id="editend_minit">
                      
                        <option value="'.substr($endTime[1], 0, 2).'">'.substr($endTime[1], 0, 2).'</option>
                     
                      
                    </select>
                  </div>
                  <div class="col-md-3">
                     <select style="padding: 5px" id="editend_time_type">
                      <option>'.$endType[1].'</option>
                    </select>
                  </div>
                   <div class="col-md-3">
                   </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-2"></div>
              <div class="col-md-10" style="color: blue">'.$countEventWaiting.' waiting</div>
            </div>

            <div class="row">
              <div class="col-md-12"><hr/></div>
            </div>
            ';

            foreach ($eventGoingParticipentList as $goingList) {
                $participentList .=

                '<div class="row">
              <div class="col-md-6">
                <div class="row">
                  <div class="col-md-3">
                    <img src="/uploads/avatars/'.$goingList->avatar.'" style="height: 30px; width: 30px"/>
                  </div>
                  <div class="col-md-9">'.$goingList->name.'</div>
                </div>
              
              </div>
              <div class="col-md-6" style="text-align: right">
                <a href="#" onclick="eventRejectUser('.$modelId.','.$goingList->id.','.$goingList->owner_id.','.$goingList->user_id.','.$geteventeventfee->event_fee.')"> <i class="fa fa-times-circle-o fa-2x" aria-hidden="true" style="color: red"></i></a>
              </div>
            </div>';
            }

            echo $participentList;
    }

    //waiting participent list
    public function waitingParticipentList(Request $request)
    {
        $modelId = $request->modelId;
        $waitingEventDatetime = EventModal::where('id','=',$modelId)->first();

        $startTime = explode(':',$waitingEventDatetime['event_start_time']);
         $startType = explode(' ',$waitingEventDatetime['event_start_time']);

         $endTime = explode(':',$waitingEventDatetime['event_end_time']);
         $endType = explode(' ',$waitingEventDatetime['event_end_time']);
        $eventWaitingParticipentList= DB::table('event_visitors as e')
                                    ->Join('users as u', 'u.id','=','e.user_id')
                                    ->select('u.name','u.avatar','e.id')
                                    ->where('e.event_modal_id','=',$modelId)
                                    ->where('e.going_status','pending')
                                    ->get();

        $countEventGoing = EventVisitors::where('event_modal_id','=',$modelId)->where('going_status','approved')->count();

        $participentList = '<div class="row">
              <div class="col-sm-12 col-md-6">
                <div class="input-group date">
                  <input type="text" class="form-control input-small" value="'.$waitingEventDatetime['event_date'].'" name="" readonly>
                  <span class="cop-input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </span>
                </div>
              </div>
              <div class="col-sm-12 col-md-6">
                <div class="input-group date">
                  <input type="text" class="form-control input-small" value="'.$waitingEventDatetime['event_end_date'].'" name="" readonly>
                  <span class="cop-input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </span>
                </div>
              </div>
              <br/>
              <div class="col-sm-12 col-md-6">
                <br/>
                <div class="row">
                  <div class="col-md-2">
                    <i class="fa fa-clock-o" style="width: 10px;padding: 10px" aria-hidden="true"></i>
                  </div>
                  <div class="col-md-3">
                    <select style="padding: 5px" id="editstart_house">
                      <option>'.$startTime[0].'</option>
                    </select>
                  </div>
                  <div class="col-md-3">
                     <select style="padding: 5px" id="editstart_minit">
                        <option value="'.substr($startTime[1], 0, 2).'">'.substr($startTime[1], 0, 2).'</option>
                    </select>
                  </div>
                  <div class="col-md-3">
                     <select style="padding: 5px" id="editstartTimeType">
                      <option>'.$startType[1].'</option>
                    </select>
                  </div>
                   <div class="col-md-3">
                   </div>
                </div>
              </div>
              <div class="col-sm-12 col-md-6">
                    
                <br/>
                <div class="row">
                  <div class="col-md-2">
                    <i class="fa fa-clock-o" style="width: 10px;padding: 10px" aria-hidden="true"></i>
                  </div>
                  <div class="col-md-3">
                    <select style="padding: 5px" id="editend_house">
                      <option>'.$endTime[0].'</option>
                    </select>
                  </div>
                  <div class="col-md-3">
                     <select style="padding: 5px" id="editend_minit">
                      
                        <option value="'.substr($endTime[1], 0, 2).'">'.substr($endTime[1], 0, 2).'</option>
                     
                      
                    </select>
                  </div>
                  <div class="col-md-3">
                     <select style="padding: 5px" id="editend_time_type">
                      <option>'.$endType[1].'</option>
                    </select>
                  </div>
                   <div class="col-md-3">
                   </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-2"></div>
              <div class="col-md-10" style="color: blue">'.$countEventGoing.' going</div>
            </div>

            <div class="row">
              <div class="col-md-12"><hr/></div>
            </div>
            ';

            foreach ($eventWaitingParticipentList as $waitingList) {
                $participentList .=

                '<div class="row">
              <div class="col-md-6">
                <div class="row">
                  <div class="col-md-3">
                    <img src="/uploads/avatars/'.$waitingList->avatar.'" style="height: 30px; width: 30px"/>
                  </div>
                  <div class="col-md-9">'.$waitingList->name.'</div>
                </div>
              
              </div>
              <div class="col-md-6" style="text-align: right">
                 <a href="#" onclick="eventApproveUser('.$waitingList->id.','.$modelId.')"><i class="fa fa-check-circle fa-2x" aria-hidden="true"  style="color: green"></i></a>
                 <a href="#" ><i class="fa fa-times-circle-o fa-2x" aria-hidden="true" style="color: red"></i></a>
              </div>
            </div>';
            }

            echo $participentList;
    }
    //update event join need to approval 
      public function updateEventRequest(Request $request)
    {
        $id = $request->Id;
        $modelId = $request->modelId;
        $updateApproval = EventVisitors::find($id);
        $updateApproval->going_status = 'approved';
        $updateApproval->save();
        $user = \Auth::user();

        $getFees = DB::table('events')->where('id',$updateApproval->event_id)->first();
        $transaction_id = $this->generateUniqueString($this->permitted_chars, 16);
        
        if(!empty($getFees->event_fee) || $getFees->event_fee != null)
        {
          $eventMainCommission = $getFees->event_fee * $getFees->event_referral_commission / 100;

          $getStoreComm =  DB::table('users')->where('email','hi5@hi5.com')->get()->first();
          $storId = $getStoreComm->id;

          $checkReferal = DB::table('referral_post')->where('user_id',$updateApproval->user_id)->where('event_id', $updateApproval->event_id)->first();
          if($checkReferal)
          {


              

              $eventData = Event::where('id',$checkReferal->event_id)->first();
              $eventFee = $eventData->event_fee;
              $eventCommission = $eventData->event_referral_commission/2;
              $finalComm = $eventFee * $eventCommission / 100;
              $adminCommission = $finalComm / 2;
              
              $referelPer = $checkReferal->referral_per;


              $data['user_id'] = $updateApproval->user_id;
              $data['type'] = "db";
              $data['description'] = "Give Commission Amount to Referal User";
              $data['amount'] = $finalComm;
              $date = date("Y-m-d");
              $data['datwise'] = $date;
              $data['transaction_id'] = $transaction_id;
              $data['transaction_by'] = $updateApproval->user_id;
              $data['posted_by']      = $updateApproval->owner_id;
              $withdraw = Balance::create($data);
              $data['user_id'] = $checkReferal->referred_id;
              $data['type'] = "cr";
              $data['description'] = "Event Refered Payment";
              $data['amount'] = $finalComm;
              $date = date("Y-m-d");
              $data['datwise'] = $date;
              $data['transaction_id'] = $transaction_id;
              $data['transaction_by'] = $updateApproval->user_id;
              $data['posted_by']      = $updateApproval->owner_id;
              $withdraw = Balance::create($data);
              
              $data['user_id'] = $updateApproval->user_id;
              $data['type'] = "db";
              $data['description'] = "Give Commission Amount to Admin";
              $data['amount'] = $adminCommission;
              $date = date("Y-m-d");
              $data['datwise'] = $date;
              $data['transaction_id'] = $transaction_id;
              $data['transaction_by'] = $updateApproval->user_id;
              $data['posted_by']      = $updateApproval->owner_id;
              $withdraw = Balance::create($data);
              $data['user_id'] = $storId;
              $data['type'] = "cr";
              $data['description'] = "Event Refered Payment";
              $data['amount'] = $adminCommission;
              $date = date("Y-m-d");
              $data['datwise'] = $date;
              $data['transaction_id'] = $transaction_id;
              $data['transaction_by'] = $updateApproval->user_id;
              $data['posted_by']      = $updateApproval->owner_id;
              $withdraw = Balance::create($data);
              
              $data['user_id'] = $updateApproval->user_id;
              $data['type'] = "db";
              $data['description'] = "Give Commission Amount to Return";
              $data['amount'] = $adminCommission;
              $date = date("Y-m-d");
              $data['datwise'] = $date;
              $data['transaction_id'] = $transaction_id;
              $data['transaction_by'] = $updateApproval->user_id;
              $data['posted_by']      = $updateApproval->owner_id;
              $withdraw = Balance::create($data);
              $data['user_id'] = $updateApproval->user_id;
              $data['type'] = "cr";
              $data['description'] = "Event Refered Retunr Payment";
              $data['amount'] = $adminCommission;
              $date = date("Y-m-d");
              $data['datwise'] = $date;
              $data['transaction_id'] = $transaction_id;
              $data['transaction_by'] = $updateApproval->user_id;
              $data['posted_by']      = $updateApproval->owner_id;
              $withdraw = Balance::create($data);
          }
          else
          {
              $data['user_id'] = $updateApproval->user_id;
              $data['type'] = "db";
              $data['description'] = "Give Commission Amount to Admin";
              $data['amount'] = $eventMainCommission;
              $date = date("Y-m-d");
              $data['datwise'] = $date;
              $data['transaction_id'] = $transaction_id;
              $data['transaction_by'] = $updateApproval->user_id;
              $data['posted_by']      = $updateApproval->owner_id;
              $withdraw = Balance::create($data);
              $data['user_id'] = $storId;
              $data['type'] = "cr";
              $data['description'] = "Event Refered Payment";
              $data['amount'] = $eventMainCommission;
              $date = date("Y-m-d");
              $data['datwise'] = $date;
              $data['transaction_id'] = $transaction_id;
              $data['transaction_by'] = $updateApproval->user_id;
              $data['posted_by']      = $updateApproval->owner_id;
              $withdraw = Balance::create($data);
          }
          $eventAmount = $getFees->event_fee - $eventMainCommission;
          $user = \Auth::user();
          $data['user_id'] = $updateApproval->user_id;
          $data['type'] = "db";
          $data['description'] = "Event Fee";
          $data['amount'] = $eventAmount;
          $date = date("Y-m-d");
          $data['datwise'] = $date;
          $data['transaction_id'] = $transaction_id;
          $data['transaction_by'] = $updateApproval->user_id;
          $data['posted_by']      = $updateApproval->owner_id;
          $withdraw = Balance::create($data);
          $data1['user_id'] = $updateApproval->owner_id;
          $data1['type'] = "cr";
          $data1['description'] = "Event Fee Collected!";
          $data1['amount'] = $eventAmount;
          $date = date("Y-m-d");
          $data1['datwise'] = $date;
          $data1['transaction_id'] = $transaction_id;
          $data1['transaction_by'] = $updateApproval->user_id;
          $data1['posted_by']      = $updateApproval->owner_id;
          $withdraw = Balance::create($data1);
        }
        $countEventWaiting = EventVisitors::where('event_modal_id','=',$modelId)->where('going_status','pending')->count();
        return response()->json($countEventWaiting);
    }
   // update event join need to approval 
    public function rejectEventRequest(Request $request)
    {
        $id = $request->visitorId;
        $ownerId = $request->ownerId;
        $amount = $request->amount;
        $userId = $request->userId;
        $modelId = $request->modelId;

        $data['user_id'] = $ownerId;
        $data['type'] = "db";
        $data['description'] = "Event Fee Refund";
        $data['amount'] = $amount;
        $date = date("Y-m-d");
        $data['datwise'] = $date;
        $withdraw = Balance::create($data);
        $data1['user_id'] = $userId;
        $data1['type'] = "cr";
        $data1['description'] = "Event Fee Refund!";
        $data1['amount'] = $amount;
        $date = date("Y-m-d");
        $data1['datwise'] = $date;
        $withdraw = Balance::create($data1);

        $updateApproval = EventVisitors::find($id);
        $updateApproval->going_status = 'pending';
        $updateApproval->save();

         $countEventGoing = EventVisitors::where('event_modal_id','=',$modelId)->where('going_status','approved')->count();
        return response()->json($countEventGoing);
    }
    //select chenge event date time
    public function selectChangeDateTime(Request $request)
    {
        $id = $request->changeId;
        $data = TempEventDateTime::find($id);
        $data->save();
        return response()->json($data);

    }

    //update event date time
    public function updateSelectedDateTime(Request $request)
    {
        $id = $request->updateId;
        $data = TempEventDateTime::find($id);
        $data->start_date = $request->eventStartDate;
        $data->start_hours = $request->start_house;
        $data->start_minit = $request->start_minit;
        $data->start_type = $request->startTimeType;
        $data->end_date = $request->eventEndDate;
        $data->end_hours = $request->end_house;
        $data->end_minit = $request->end_minit;
        $data->end_type = $request->end_time_type;
        $data->save();
        return response()->json($data);
    }

    //delete event date time
    public function deleteEventDateTime(Request $request)
    {
         $id = $request->deleteId;
        $eventM = TempEventDateTime::find($id);
        $eventM->delete();
        if($eventM)
        {
           return response()->json('Success');
        }
    }

    //delete event date time
    public function deleteListEventDateTime(Request $request)
    {
         $id = $request->deleteId;
        $eventM = EventModal::find($id);
        $eventM->delete();
        if($eventM)
        {
           return response()->json('Success');
        }
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

}
