<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\EventInvitation;
use App\EventModal;
use App\Event;
use App\User;
use App\Balance;
use App\EventVisitors;
use Illuminate\Support\Facades\Auth;
use Image;
use Session;
use Purifier;
use Storage;
use Mail;

class EventsController extends Controller
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

        $user = Auth::user();
        $date = date('m/d/Y');

        $events = Event::where('is_published',"yes")->orderBy('id', 'desc')->get();
        $eventOptions = EventModal::all();
        $eventVisitors = EventVisitors::all();

        $comingDates = array();
        $finalEvents = array();

        $eventVisitorsPending = EventVisitors::where('going_status','pending')->get();
        $eventVisitorsGoing = EventVisitors::where('going_status','approved')->get();
        foreach($events as $event){

            $date_to_show = EventModal::where('event_id',$event->id)->where('event_date','>=',$date)->orderBy('event_date','asc')->first();
            //return $date_to_show;
            if(empty($date_to_show)){
                unset($event);
            }else{
                array_push($comingDates,$date_to_show);
            }

        }

        foreach($comingDates as $d){

            $e = Event::where('is_published',"yes")->where('id', $d->event_id)->first();
            array_push($finalEvents,$e);

        }
//return $finalEvents;
        //$date_to_show = EventModal::where('event_id',$id)->where('event_date','>=',$date)->orderBy('event_date','asc')->first();

        //return $comingDates;
        $pendingCount = $eventVisitorsPending->count();
        $goingCount = $eventVisitorsGoing->count();



        return view('pages.events.index',compact('finalEvents','eventVisitors','pendingCount','goingCount','comingDates', 'user'))
            ->withEventOptions($eventOptions)
            ->withEvents($events);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $eventOptions = EventModal::all();
        $events = EventModal::orderBy('id', 'asc')->paginate(1);
        $eventVisitors = EventVisitors::all();

        $eventVisitorsPending = EventVisitors::where('going_status','pending')->get();
        $eventVisitorsGoing = EventVisitors::where('going_status','approved')->get();

        $pendingCount = $eventVisitorsPending->count();
        $goingCount = $eventVisitorsGoing->count();
        $users = User::all();
        $id = "";
        return view('pages.events.create',compact('eventVisitors','pendingCount','goingCount','users','id'))->withEventOptions($eventOptions)->withEvents($events);
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
        //return $request;exit;
        $this->validate($request, array(
            'event_checked'               => '',
            'schedule_checked'            => '',
            'event_featured_image'        => '',
            'event_date'                  => '',
            'event_start_time'            => '',
            'event_end_time'              => '',
            'event_ticket_price'          => '',
            'event_details'               => '',
            'event_title'                 => '',
            'interested_in_event'         => '',
            'going_in_event'              => '',
            'event_city'                  => '',
            'event_country'               => '',
            'event_phone'                 => '',
            'event_address'               => '',
            'event_is_online'             => '',
            'no_need_approval'            => '',
            'need_approval'               => '',
            'event_host_image'            => '',
            'event_host_name'             => '',
            'event_type'                  => '',
            'event_description'           => '',
        ));

        // store in the database
        $event = new Event;
        $edit = \Auth::user()->name;
        $edit_id = \Auth::user()->id;

        $event->user()->associate($request->user());
        $event->event_checked             = $request->event_checked;
        $event->schedule_checked          = $request->schedule_checked;
        $event->event_date                = $request->event_date;
        $event->event_start_time          = $request->event_start_time;
        $event->event_end_time            = $request->event_end_time;
        $event->event_ticket_price        = $request->event_ticket_price;
        $event->event_details             = $request->event_details;
        $event->event_title               = $request->event_title;
        $event->interested_in_event       = $request->interested_in_event;
        $event->going_in_event            = $request->going_in_event;
        $event->event_city                = $request->event_city;
        $event->event_country             = $request->event_country;
        $event->event_phone               = $request->event_phone;
        $event->event_address             = $request->event_address;
        $event->event_is_online           = $request->event_is_online;
        $event->no_need_approval          = $request->no_need_approval;
        $event->need_approval             = $request->need_approval;
        $event->event_host_name           = $request->event_host_name;
        $event->event_type                = $request->event_type;
        $event->event_description         = $request->event_description;
        $event->edited = $edit ;
        $event->edited_id = $edit_id;
        //Save Event Image
        if ($request->hasFile('event_featured_image')) {
            $image = $request->file('event_featured_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('uploads/event/' . $filename);
            compress($image, $location );
            // Image::make($image)->resize(640,480)->save($location);
            $event->event_featured_image = $filename;
        }

        //Save Event host Image
        if ($request->hasFile('event_host_image')) {
            $image = $request->file('event_host_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('uploads/event/' . $filename);
            compress($image, $location );
            // Image::make($image)->resize(640,480)->save($location);
            $event->event_host_image = $filename;
        }

        $event->save();

        Session::flash('success', 'The Event successfully Saved to Draft!');
        // redirect to another page
        //return redirect()->route('eventM.index');
        return redirect()->route('events.index');
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
        $event = Event::find($id);
        $eventOptions = EventModal::where('event_id',$id);
        $date = date('m/d/Y');

        // $eventVisitorsPending = EventVisitors::all();
        //return $eventOptions;
        $eventVisitorsPending = EventVisitors::where('going_status','pending')->get();
        $eventVisitorsGoing = EventVisitors::where('going_status','approved')->get();
        $eventVisitors = EventVisitors::all();

        $eventVisitorsPending1 = EventVisitors::where('going_status','pending')->get();
        $date_to_show = EventModal::where('event_id',$id)->where('event_date','>=',$date)->orderBy('event_date','asc')->first();


        $pendingCount = $eventVisitorsPending1->count();
        $goingCount = $eventVisitorsGoing->count();

        $users = User::all();

        return view('pages.events.show',compact('eventVisitors','pendingCount','goingCount','users','date_to_show'))->withEvent($event)->withEventOptions($eventOptions);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::find($id);
        $eventOptions = EventModal::all();

        $eventVisitorsPending = EventVisitors::where('going_status','pending')->get();
        $eventVisitorsGoing = EventVisitors::where('going_status','approved')->get();
        $eventVisitors = EventVisitors::all();

        $pendingCount = $eventVisitorsPending->count();
        $goingCount = $eventVisitorsGoing->count();

        $users = User::all();

        return view('pages.events.edit',compact('eventVisitors','pendingCount','goingCount','users'))->withEvent($event)->withEventOptions($eventOptions);
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
        $event = Event::find($id);
        // validate the data
        $this->validate($request, array(
            'event_checked'               => '',
            'schedule_checked'            => '',
            'event_featured_image'        => '',
            'event_date'                  => '',
            'event_start_time'            => '',
            'event_end_time'              => '',
            'event_ticket_price'          => '',
            'event_details'               => '',
            'event_title'                 => '',
            'interested_in_event'         => '',
            'going_in_event'              => '',
            'event_city'                  => '',
            'event_country'               => '',
            'event_phone'                 => '',
            'event_address'               => '',
            'event_is_online'             => '',
            'no_need_approval'            => '',
            'need_approval'               => '',
            'event_host_image'            => '',
            'event_type'                  => '',
            'event_description'           => '',
        ));

        $event = Event::find($id);
        $edit = \Auth::user()->name;
        $edit_id = \Auth::user()->id;
        $event->event_checked       = $request->input('event_checked');
        $event->schedule_checked    = $request->input('schedule_checked');
        $event->event_date          = $request->input('event_date');
        $event->event_start_time    = $request->input('event_start_time');
        $event->event_end_time      = $request->input('event_end_time');
        $event->event_ticket_price  = $request->input('event_ticket_price');
        $event->event_details       = $request->input('event_details');
        $event->event_title         = $request->input('event_title');
        $event->interested_in_event = $request->input('interested_in_event');
        $event->going_in_event      = $request->input('going_in_event');
        $event->event_city          = $request->input('event_city');
        $event->event_country       = $request->input('event_country');
        $event->event_phone         = $request->input('event_phone');
        $event->event_address       = $request->input('event_address');
        $event->event_is_online     = $request->input('event_is_online');
        $event->no_need_approval    = $request->input('no_need_approval');
        $event->need_approval       = $request->input('need_approval');
        $event->event_type          = $request->input('event_type');
        $event->event_host_name     = $request->input('event_host_name');
        $event->event_description   = $request->input('event_description');
        $event->edited = $edit ;
        $event->edited_id = $edit_id;

        if ($request->hasFile('event_featured_image')) {
            //add new photo
            $image = $request->file('event_featured_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('uploads/event/' . $filename);
            Image::make($image)->resize(640,480)->save($location);
            $oldfilename = $event->event_featured_image;
            //update the database
            $event->event_featured_image = $filename;
            //delete the olf photo
            Storage::delete($oldfilename);
        }

        if ($request->hasFile('event_host_image')) {
            //add new photo
            $image = $request->file('event_host_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('uploads/event/' . $filename);
            Image::make($image)->resize(640,480)->save($location);
            $oldfilename = $event->event_host_image;
            //update the database
            $event->event_host_image = $filename;
            //delete the olf photo
            Storage::delete($oldfilename);
        }

        $event->save();

        Session::flash('success', 'The Event successfully updated!');
        return redirect()->route('events.show', $event->id);
        // return view('pages.events.show')->withEvent($event);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function goingToEvent($user_id,$owner_id,$event_id,$event_modal_id){

        //return $event_modal_id;
        $data['user_id'] = $user_id;
        $data['owner_id'] = $owner_id;
        $data['event_id'] = $event_id;
        $data['event_modal_id'] = $event_modal_id;

        $addVisitor = EventVisitors::create($data);
        Session::flash('success', 'The Request Submitted For Approval From Admin/Owner!');
        return back();

    }

    public function notGoingToEvent($user_id,$owner_id,$event_id,$event_modal_id){

        $data['user_id'] = $user_id;
        $data['owner_id'] = $owner_id;
        $data['event_id'] = $event_id;
        $data['event_modal_id'] = $event_modal_id;

        $checkStatus = EventVisitors::where('user_id',$user_id)->where('event_id',$event_id)->where('event_modal_id',$event_modal_id)->first();

        $event = Event::where('id',$event_id)->first();
        $amount = $event->event_ticket_price;
        if($event->no_need_approval == "on"){

            $addVisitor = EventVisitors::where('user_id',$user_id)->where('event_id',$event_id)->where('event_modal_id',$event_modal_id)->delete();

            Session::flash('success', 'The Request for going to event is removed Successfully!');
            return back();

        }
        else{

            if($checkStatus->going_status == "approved"){

                $data1['user_id'] = $user_id;
                $data1['type'] = "cr";
                $data1['description'] = "Event Fee Refunded!";
                $data1['amount'] = $amount;
                $date = date("Y-m-d");
                $data1['datwise'] = $date;
                $withdraw = Balance::create($data1);

                $data1['user_id'] = $checkStatus->owner_id;
                $data1['type'] = "db";
                $data1['description'] = "Event Fee Refunded!";
                $data1['amount'] = $amount;
                $date = date("Y-m-d");
                $data1['datwise'] = $date;
                $withdraw = Balance::create($data1);

                $addVisitor = EventVisitors::where('user_id',$user_id)->where('event_id',$event_id)->delete();
                Session::flash('success', 'The Request for Not-going to event is Accepted and Refunded Successfully!');
                return back();


            }else{
                $addVisitor = EventVisitors::where('user_id',$user_id)->where('event_id',$event_id)->delete();

                Session::flash('success', 'The Request for going to event is removed Successfully!');
                return back();
            }

        }


    }

    public function eventStatus($status,$user_id,$event_id,$amount){

        //return $amount;

        $updateStatus = EventVisitors::where('user_id',$user_id)->where('event_id',$event_id)->first();
        $first_status = $updateStatus->going_status;
        $updateStatus->going_status = $status;
        $updateStatus->save();


        if($status == "approved"){

            $data['user_id'] = $user_id;
            $data['type'] = "db";
            $data['description'] = "Event Fee";
            $data['amount'] = $amount;
            $date = date("Y-m-d");
            $data['datwise'] = $date;
            $withdraw = Balance::create($data);

            $data['user_id'] = $updateStatus->owner_id;
            $data['type'] = "cr";
            $data['description'] = "Event Fee Collected";
            $data['amount'] = $amount;
            $date = date("Y-m-d");
            $data['datwise'] = $date;
            $withdraw = Balance::create($data);


            Session::flash('success', 'Approved Successfully!');
            return back();

        }else{

            Session::flash('success', 'Rejected Successfully!');
            return back();

        }


    }

    public function search(Request $request){

        $user = User::where('email',$request->find_email)->first();

        if($user){
            $events = Event::where('user_id',$user->id)->orderBy('id', 'desc')->paginate(10);
            $eventOptions = EventModal::all();
            $eventVisitors = EventVisitors::all();

            $eventVisitorsPending = EventVisitors::where('going_status','pending')->get();
            $eventVisitorsGoing = EventVisitors::where('going_status','approved')->get();

            $pendingCount = $eventVisitorsPending->count();
            $goingCount = $eventVisitorsGoing->count();

            return view('pages.events.index',compact('eventVisitors','pendingCount','goingCount'))
                ->withEventOptions($eventOptions)
                ->withEvents($events);

        }
        else{
            Session::flash('failure', 'No Such User Exist!');
            return back();
        }

    }

    public function eventInvite( Request $request , $event_id ){

        //return $request;exit;
        $event = Event::where('id',$event_id)->first();

        $email = new EventInvitation($event);
        Mail::to($request->find_email)->send($email);

        Session::flash('success', 'Invitation Sended!');
        return back();

    }

    public function draftEvents($user_id){

        $draftEevents = Event::where('user_id',$user_id)->where('is_published',"no")->get();

        return view('pages.events.draft',compact('draftEevents'));


    }

    public function draftAddPlan($event_id){

        $event = Event::where('id', $event_id)->first();

        return view('pages.events.draft_plan_And_price',compact('event'));

    }

    public function eventPlanPrice($event_id){

        $date = date('m/d/Y');
        $event = Event::where('id', $event_id)->first();
        $eventPlans = EventModal::where('event_id',$event_id)->where('event_date','>=',$date)->get();

        $date_to_show = EventModal::where('event_id',$event_id)->where('event_date','>',$date)->orderBy('event_date','asc')->first();

        //   /return $date_to_show;

        $eventVisitors = EventVisitors::all();

        $eventVisitorsPending = EventVisitors::where('going_status','pending')->get();
        $eventVisitorsGoing = EventVisitors::where('going_status','approved')->get();

        $pendingCount = $eventVisitorsPending->count();
        $goingCount = $eventVisitorsGoing->count();
        $users = User::all();

// return $eventPlans;
        return view('pages.events.event_show_plan_price',compact('event','eventPlans','goingCount','pendingCount','date_to_show','eventVisitors','users'));

    }

    public function passedEvents()
    {
        $date = date('m/d/Y');

        $events = Event::where('is_published',"yes")->orderBy('id', 'desc')->get();
        $eventOptions = EventModal::all();
        $eventVisitors = EventVisitors::all();

        $comingDates = array();
        $finalEvents = array();

        $eventVisitorsPending = EventVisitors::where('going_status','pending')->get();
        $eventVisitorsGoing = EventVisitors::where('going_status','approved')->get();
        foreach($events as $event){

            $date_to_show = EventModal::where('event_id',$event->id)->where('event_date','<',$date)->orderBy('event_date','asc')->first();
            //return $date_to_show;
            if(empty($date_to_show)){
                unset($event);
            }else{
                array_push($comingDates,$date_to_show);
            }

        }

        foreach($comingDates as $d){

            $e = Event::where('is_published',"yes")->where('id', $d->event_id)->first();
            array_push($finalEvents,$e);

        }
//return $finalEvents;
        //$date_to_show = EventModal::where('event_id',$id)->where('event_date','>=',$date)->orderBy('event_date','asc')->first();

        //return $comingDates;
        $pendingCount = $eventVisitorsPending->count();
        $goingCount = $eventVisitorsGoing->count();

        return view('pages.events.passed_events',compact('finalEvents','eventVisitors','pendingCount','goingCount','comingDates'))
            ->withEventOptions($eventOptions)
            ->withEvents($events);

    }

    public function clubEvents(){

        $date = date('m/d/Y');

        $events = Event::where('is_published',"yes")->where('event_type','club_event')->orderBy('id', 'desc')->get();
        $eventOptions = EventModal::all();
        $eventVisitors = EventVisitors::all();

        $comingDates = array();
        $finalEvents = array();

        $eventVisitorsPending = EventVisitors::where('going_status','pending')->get();
        $eventVisitorsGoing = EventVisitors::where('going_status','approved')->get();
        foreach($events as $event){

            $date_to_show = EventModal::where('event_id',$event->id)->where('event_date','>=',$date)->orderBy('event_date','asc')->first();
            //return $date_to_show;
            if(empty($date_to_show)){
                unset($event);
            }else{
                array_push($comingDates,$date_to_show);
            }

        }

        foreach($comingDates as $d){

            $e = Event::where('is_published',"yes")->where('id', $d->event_id)->first();
            array_push($finalEvents,$e);

        }
//return $finalEvents;
        //$date_to_show = EventModal::where('event_id',$id)->where('event_date','>=',$date)->orderBy('event_date','asc')->first();

        //return $comingDates;
        $pendingCount = $eventVisitorsPending->count();
        $goingCount = $eventVisitorsGoing->count();

        return view('pages.events.club_events',compact('finalEvents','eventVisitors','pendingCount','goingCount','comingDates'))
            ->withEventOptions($eventOptions)
            ->withEvents($events);

    }

    public function clubMemberEvents(){

        $date = date('m/d/Y');

        $events = Event::where('is_published',"yes")->where('event_type','club_member_event')->orderBy('id', 'desc')->get();
        $eventOptions = EventModal::all();
        $eventVisitors = EventVisitors::all();

        $comingDates = array();
        $finalEvents = array();

        $eventVisitorsPending = EventVisitors::where('going_status','pending')->get();
        $eventVisitorsGoing = EventVisitors::where('going_status','approved')->get();
        foreach($events as $event){

            $date_to_show = EventModal::where('event_id',$event->id)->where('event_date','>=',$date)->orderBy('event_date','asc')->first();
            //return $date_to_show;
            if(empty($date_to_show)){
                unset($event);
            }else{
                array_push($comingDates,$date_to_show);
            }

        }

        foreach($comingDates as $d){

            $e = Event::where('is_published',"yes")->where('id', $d->event_id)->first();
            array_push($finalEvents,$e);

        }
//return $finalEvents;
        //$date_to_show = EventModal::where('event_id',$id)->where('event_date','>=',$date)->orderBy('event_date','asc')->first();

        //return $comingDates;
        $pendingCount = $eventVisitorsPending->count();
        $goingCount = $eventVisitorsGoing->count();

        return view('pages.events.club__member_events',compact('finalEvents','eventVisitors','pendingCount','goingCount','comingDates'))
            ->withEventOptions($eventOptions)
            ->withEvents($events);

    }


    public function profileEvents($user_id)
    {

        $user = User::find($user_id);
        $date = date('m/d/Y');

        $events = Event::where('is_published',"yes")->where('user_id', $user_id)->orderBy('id', 'desc')->get();
        $eventOptions = EventModal::all();
        $eventVisitors = EventVisitors::all();

        $comingDates = array();
        $finalEvents = array();

        $eventVisitorsPending = EventVisitors::where('going_status','pending')->get();
        $eventVisitorsGoing = EventVisitors::where('going_status','approved')->get();
        foreach($events as $event){


            $date_to_show = EventModal::where('event_id',$event->id)->where('event_date','>=',$date)->orderBy('event_date','asc')->first();
            //return $date_to_show;
            if(empty($date_to_show)){
                unset($event);
            }else{
                array_push($comingDates,$date_to_show);
            }

        }

        foreach($comingDates as $d){

            $e = Event::where('is_published',"yes")->where('id', $d->event_id)->first();
            array_push($finalEvents,$e);

        }
//return $finalEvents;
        //$date_to_show = EventModal::where('event_id',$id)->where('event_date','>=',$date)->orderBy('event_date','asc')->first();

        //return $comingDates;
        $pendingCount = $eventVisitorsPending->count();
        $goingCount = $eventVisitorsGoing->count();



        return view('pages.events.index',compact('finalEvents','eventVisitors','pendingCount','goingCount','comingDates', 'user'))
            ->withEventOptions($eventOptions)
            ->withEvents($events);

    }

    public function saveEvent($eventId)
    {
        $event = Event::find($eventId);
        $event->toggleFavorite();

        Session::flash('success', 'Event Save Status Updated successfully!');
        return back();
    }

     public function activeEvent(Request $request)
    {
        $user = Auth::user();
        $events = Event::where('is_published','=','yes')->where('user_id',$user->id)->orderBy('id', 'desc')->get(); 
        // return view('pages.events.activeevent');
        return view('pages.events.activeevent')
        ->withEvents($events);
    }

     public function goingEvent(Request $request)
    {
        $user = Auth::user();
        $events = Event::where('is_published','=','yes')->orderBy('id', 'desc')->get(); 
        // return view('pages.events.activeevent');
        return view('pages.events.goingevent')
        ->withEvents($events);
    }

     public function pastEvent(Request $request)
    {
        $user = Auth::user();
        $events = Event::where('is_published','=','yes')->orderBy('id', 'desc')->get(); 
        // return view('pages.events.activeevent');
        return view('pages.events.pastevent')
        ->withEvents($events);
    }

     public function closeEvent(Request $request)
    {
        $user = Auth::user();
        $events = Event::where('is_published','=','yes')->where('user_id',$user->id)->orderBy('id', 'desc')->get(); 
        // return view('pages.events.activeevent');
        return view('pages.events.closeevent')
        ->withEvents($events);
    }

}
