@extends('layouts.app')
@section('custom-styles')
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-formhelpers.min.css') }}">
@endsection
@section('content')
  
     @include('partials._user-profile')
    <style type="text/css">
        .overlay_badge_sell {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: skyblue;
            color: white;
            padding-left: 10px;
            padding-right: 10px;
        }

        .overlay_badge_buy {
            position: absolute;
            float: right;
            top: 10px;
            left: 10px;
            background-color: green;
            color: white;
            pointer-events: auto;
            padding-left: 10px;
            padding-right: 10px;
        }

        .divback {
            background-color: #e3e3e3;
            padding: 5px;
            margin: 5px;
        }

        .bigtext {
            color: black;
            font-weight: bolder;
        }

        .ordertext {
            color: #a658a6;
        }

        .bidtext {
            color: #4e66c4;
            align-self: flex-end;
        }

        .typing {
            background-color: #f47e2b;
            border-color: #f47e2b;
        }

        .typing i {
            display: block !important;
        }

        #timeText {
            color: black !important;
        }
        
        .hoverSet:hover .set {

                border: 4px solid orange;
                padding: 2px;

            }

            #savedButton {
                display: none;
            }

            #eventDelete {
                display: none;
            }

            #buyDelete {
                display: none;
            }

            #eventEdit {
                display: none;
            }

            #buyEdit {
                display: none;
            }

            .hoverSet:hover #savedButton {
                display: block;
            }

            .hoverSet:hover #eventDelete {
                display: block;
            }

            .hoverSet:hover #buyDelete {
                display: block;
            }

            .hoverSet:hover #eventEdit {
                display: block;
            }

            .hoverSet:hover #buyEdit {
                display: block;
            }

            .overlay_badge_buy:hover .editButton {
                border: 1px solid orange;
                padding: 2px;
            }

            .overlay_badge_buy:hover .deleteButton {
                border: 1px solid orange;
                padding: 2px;
            }

            .overlay_badge_buy:hover .savedButton {
                border: 1px solid orange;
                padding: 2px;
    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row">
                 
               
                    @isset($events)
                        @foreach($events as $event)
                            <?php
                            $userId = Auth::user()->id;
                            $paydate_raw = DB::raw("STR_TO_DATE(`event_date`, '%m/%d/%Y')");
                            $currDate = date('m/d/Y');
                            $getEventDateSavePost = App\EventModal::where('event_date', ">=", $currDate)->where('event_id', $event->id)->orderBy('event_date', 'asc')->get()->first();
                            // echo $getEventDateSavePost;
                            // exit();
                            $savedEvents = App\SavedPost::where('post_type', '=', 'event')->where('post_id', '=', $event->id)->where('user_id', '=', $userId)->get()->first();
                            $eventVisitor = App\EventVisitors::where('user_id', '=', $userId)->where('event_id', $event->id)->get()->first();
                            $checkPermission = DB::table('user_menu')->where('menu_options_id', '=', '18')->where('user_id', '=', $userId)->get()->first();
                            $countShare = DB::table('referral_post')->where('event_id','=',$event->id)->count();

                            //count waiting 
                            $countWaiting = DB::table('event_visitors')->where('event_id','=',$event->id)->where('going_status','pending')->count();
                            //count going
                            $countGoing = DB::table('event_visitors')->where('event_id','=',$event->id)->where('going_status','approved')->count();

                            //count waiting 
                            $countWaiting = DB::table('event_visitors')->where('event_id','=',$event->id)->where('going_status','pending')->count();
                            //count going
                            $countGoing = DB::table('event_visitors')->where('event_id','=',$event->id)->where('going_status','approved')->count();

                            if ($checkPermission) {
                                $permission = 1;
                            } else {
                                $permission = 0;
                            }
                            ?>

                            <?php
                            if($getEventDateSavePost)
                            {
                              ?>
                              @isset($eventVisitor)
                              <?php


                              if($eventVisitor->going_status == 'pending' || $eventVisitor->going_status == 'approved')
                              {
                                  ?>
                                  <div class="col-md-3 hoverSet">
                                    <div class="card mb-3 set" style="width: 17rem;">
                                        <?php
                                        if(empty($event->event_modal_image))
                                        {
                                            ?>
                                            <a href="#" id="viewEventDetails" onclick="viewEventDetails(<?php echo $event->id ?>,<?php echo $event->user_id ?>)"><img class="card-img-top" src="/images/image_not_found.jpg" style="padding: 10px;height: 200px" alt="Card image cap"></a>
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                            <a href="#" id="viewEventDetails" onclick="viewEventDetails(<?php echo $event->id ?>,<?php echo $event->user_id ?>)"><img class="card-img-top" src="/uploads/event/{{ $event->event_modal_image }}" style="padding: 10px;height: 200px" alt="Card image cap"></a>
                                            <?php
                                        }
                                        ?>
                                       

                                        <span class="overlay_badge_buy"  id="" style= "background: none;padding: 0;">
                                         <img src="/images/eventLogo.png" id="" style="height: 40px;"  > 
                                        </span>
                                        <span class="overlay_badge_buy" id="eventDelete" style="background: none;padding: 0;margin-left: 145px;margin-top: 2px">
                                       
                                        @if($userId == $getEventDateSavePost->user_id  || $permission == 1)
                                        <a href="#" onclick="deleteEvent(<?php echo $event->id ?>);" >
                                            <img src="/images/close.png"  style="height: 30px;"  class="deleteButton img-thumbnail">
                                        </a>
                                        @endif
                                        </span>
                                        <span class="overlay_badge_buy" id="eventEdit" style="background: none;margin-left: 180px;padding: 0;margin-top: 2px">
                                        @if(Auth::user()->id == $getEventDateSavePost->user_id || $permission == 1)
                                            <a href="#" onclick="eventEdit(<?php echo $event->id ?>,<?php echo $event->user_id ?>)" class="" ><img src="/images/edit.png" style="height: 30px;"  class="editButton img-thumbnail"></a>
                                        @endif
                                        </span>
                                        <span class="overlay_badge_buy" id="savedButton" style="background: none;padding: 0;margin-left: 215px;margin-top: 2px">
                                        
                                            
                                        <?php
                                        if(!empty($savedEvents))
                                        {
                                            ?>
                                            <a href="#" onclick="savedPost(<?php echo $event->id ?>,<?php echo Auth::user()->id  ?>)" >
                                             <img src="/images/rating.png" style="height: 30px;" id="savedImage<?php echo $event->id; ?>"  class="savedButton img-thumbnail">
                                            </a>
                                            <?php
                                        }
                                        else
                                        {
                                             ?>
                                             <a href="#" onclick="savedPost(<?php echo $event->id ?>,<?php echo Auth::user()->id  ?>)" >
                                             <img src="/images/rating_blank.png" style="height: 30px;" id="savedImage<?php echo $event->id; ?>"  class="savedButton img-thumbnail">
                                             </a>
                                            <?php
                                        }
                                        ?>
                                       
                                      
                                        </span>
                                        <strong style="align-self: center;" onclick="viewEventDetails(<?php echo $event->id ?>,<?php echo $event->user_id ?>)">{{ $event->event_title }}</strong>
                                        <div class="divback">
                                            <label style="padding-right: 3px;background: lightgray"> 
                                              <?php
                                            if($event->need_approval == 'Yes')
                                            {
                                                  if(!empty($eventVisitor))
                                                  {
                                                    if($eventVisitor->going_status == 'pending')
                                                    {
                                                        echo "Applied : ";
                                                    }
                                                    else if($eventVisitor->going_status == 'rejected')
                                                    {
                                                      echo "Appliend : ";
                                                    }
                                                    else
                                                    {
                                                      echo "Paid : ";
                                                    }
                                                  }
                                                  else
                                                  {
                                                    echo "Apply to join : ";
                                                  }
                                              
                                            }
                                            else
                                            {
                                              if(!empty($eventVisitor))
                                              {
                                                echo "Paid : "; 
                                              }
                                              else
                                              {
                                                echo "Pay to join : ";
                                              }
                                              
                                            }
                                            ?>  
                                              

                                               <big class="bigtext">
                                            
                                            <?php
                                            if($event->need_approval == 'Yes')
                                              {
                                                  $needApprove = 1;
                                              }
                                              else
                                              {
                                                  $needApprove = 0;
                                              }
                                              if($event->event_fee_type == 'Not Free')
                                              {
                                                 echo '$ '.$event->event_fee;
                                              }
                                              
                                              else
                                              {
                                                echo $event->event_fee_type;
                                              }
                                                
                                              
                                              ?> 


                                            </big> </label><label class="ordertext float-right">
                                                @if(Auth::user()->id == $getEventDateSavePost->user_id || $permission == 1)
                                                    <a href="#" style="text-decoration-line: none;" onclick="goingParticipent(<?php echo $getEventDateSavePost->id ?>,<?php echo $countGoing ?>)">
                                                    [ {{$countGoing}} going ]
                                                    </a>
                                                @else
                                                    [ {{$countGoing}} going ]
                                                @endif

                                        </label> 
                                            <?php
                                            if($event->need_approval == 'Yes')
                                            {
                                                ?><br/>
                                                 <?php 
                                                    if(!empty($eventVisitor))
                                                  {
                                                    if($eventVisitor->going_status == 'pending')
                                                    {
                                                      ?>
                                                      <span style="color: #2b7a94">Applied </span>&nbsp;&nbsp;&nbsp;<a href="#" onclick="cancelRequest(<?php echo json_encode($event->user_id); ?>,<?php echo json_encode($event->id); ?>,<?php echo json_encode($getEventDateSavePost->id) ?>,<?php echo $event->event_fee; ?>)"><i class="fa fa-times 2x" style="color: white;background:#656510;padding: 5px" aria-hidden="true"></i></a>
                                                      <?php
                                                    }
                                                    else if($eventVisitor->going_status == 'rejected')
                                                    {
                                                      ?>
                                                      <span style="color: red">Rejected</span>
                                                      <?php
                                                    }
                                                    else
                                                    {
                                                      ?>
                                                      <span style="color: #2b7a94">Going</span>
                                                      <?php
                                                    }
                                                  }
                                                  else
                                                  {
                                                    ?>
                                                <a href="#" class="btn btn-outline-info" onclick='eventPay(<?php echo json_encode($event->event_fee); ?>,<?php echo json_encode($event->user_id); ?>,<?php echo json_encode($event->id); ?>,<?php echo json_encode($getEventDateSavePost->id) ?>,<?php echo json_encode($needApprove); ?>)'  style="width: 50px;height: 25px;padding: 0;">Apply</a>
                                                <?php
                                              }
                                            }
                                            else
                                            {
                                                ?><br/>
                                                 <?php 
                                                    if(!empty($eventVisitor))
                                                  {
                                                    ?>
                                                    <span style="color: #2b7a94">Going</span>
                                                    <?php
                                                  }
                                                  else
                                                  {
                                                    ?>
                                                    <a href="#"  class="btn btn-outline-info" onclick='eventPay(<?php echo json_encode($event->event_fee); ?>,<?php echo json_encode($event->user_id); ?>,<?php echo json_encode($event->id); ?>,<?php echo json_encode($getEventDateSavePost->id) ?>,<?php echo json_encode($needApprove); ?>)' style="width: 50px;height: 25px;padding: 0;"><span>Pay</span></a>
                                                    <?php
                                                  }
                                                
                                            }
                                            ?>
                                            <label class="ordertext float-right">
                                                @if(Auth::user()->id == $getEventDateSavePost->user_id || $permission == 1)
                                                    <a href="#" style="text-decoration-line: none;" onclick="waitingParticipent(<?php echo $getEventDateSavePost->id ?>,<?php echo $countWaiting ?>)">[ {{$countWaiting}} waiting ] </a>
                                                @else
                                                    [ {{$countWaiting}} waiting ]
                                                @endif
                                            </label><br>
                                            <div style="flex-flow: column;">
                                                <label style="align-self: flex-start;background: #ffffff;width: 100%"><span style=""><span style="">
                                                Upcomming Event: {{ date('M j, Y', strtotime($getEventDateSavePost->event_date)) }}
                                                </span><br/> </span></label>
                                               
                                                 <div style="padding: 5px;border-radius: 2px;">
                                                        @php($url = url('share/'.$event->id.'/'.Auth::user()->id))
                                                          <a href="javascript:void(0);" onclick="fb_share('{{ $url }}','{{ $event->event_title }}')" class="fbBtm"><i class="fas fa-share" style="font-size: 25px;color: #00a3e9"></i> </a>
                                                          &nbsp;{{$countShare}}&nbsp;&nbsp;<span class="float-right" style="font-size: 20px;">{{ $event->event_referral_commission }}% Refferal</span>
                                                      </div>
                                            </div>
                                        </div>
                                    </div>
                                  </div>
                                  <?php  
                                  
                              }
                              ?>
                              @endisset
                              <?php
                          }
                             ?>
                        @endforeach
                    @endisset
                 
                </div>
            </div>
        </div>
       
    </div>
@endsection
@section('extra-JS')

    <div id="fb-root"></div>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //shere event

        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.3&appId=403257377055066";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));


        function fb_share(dynamic_link, dynamic_title) {
            var app_id = '403257377055066';
            var pageURL = "https://www.facebook.com/dialog/feed?app_id=" + app_id + "&link=" + dynamic_link;
            var w = 600;
            var h = 400;
            var left = (screen.width / 2) - (w / 2);
            var top = (screen.height / 2) - (h / 2);
            window.open(pageURL, dynamic_title, 'toolbar=no, location=no, directories=no,status=no, menubar=yes, scrollbars=no, resizable=no, copyhistory=no, width=' + 800 + ',height=' + 650 + ', top=' + top + ', left=' + left)

            return false;
        }
    </script>

@endsection