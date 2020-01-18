@extends('layouts.app')

@section('content')
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

        #timeText{
            color:black !important;
        }
    </style>
    <style type="text/css">
        /*.hoverSet :hover {
             border: 5px solid ;
             overflow: hidden;
         }*/
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
        }
    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div id="columns">
                    @foreach ($posts as $post)
                        @if ($post -> post_type == "buyer")
                            <?php
                            $buyer = App\Buyer::where('id', $post->post_id)->get()->first();
                            if(!empty($seller)){
                            ?>
                            <figure class="share-save-icon">
                                <img class="share-save-icon-buyr w-4" style="" src="{{asset('img/' . 'referrer.png')}}">
                                <img id="{{$buyer->id}}" data-value="{{$id}}" data-value1="buyer"
                                     class="share-save-icon-buyr w-4 m-2-45" style=""
                                     src="{{asset('img/' . 'save3.jpg')}}">
                                <a href="{{ route('buyer.show', $buyer->id) }}">
                                    <img src="{{ asset('uploads/buyer/' . $buyer->buyer_featured_image) }}">
                                    <figcaption><strong>{{ $buyer->buyer_pro_title }}</strong></figcaption>
                                    <figcaption class="mt-2"><small
                                                class="text-muted">{{ date('M j, Y', strtotime($buyer->created_at)) }}</small>
                                    </figcaption>
                                    <figcaption class="float-left"><small
                                                class="text-muted"><strong>Buy</strong></small></figcaption>
                                </a>
                            </figure>
                            <?php } ?>
                        @elseif($post -> post_type == "seller")
                            <?php
                            $seller = App\Seller::where('id', $post->post_id)->get()->first();
                            if(!empty($seller)){
                            ?>
                            <figure class="share-save-icon">
                                <img class="share-save-icon-buyr w-4" src="{{asset('img/' . 'referrer.png')}}">
                                <img id="{{$seller->id}}" data-value="{{$id}}" data-value1="seller"
                                     class="share-save-icon-buyr w-4 m-2-45" style=""
                                     src="{{asset('img/' . 'save3.jpg')}}">
                                <a href="{{ route('seller.show', $seller->id) }}">
                                    <img src="{{ asset('uploads/seller/' . $seller->seller_featured_image) }}">
                                    <figcaption><strong>{{ $seller->seller_pro_title }}</strong></figcaption>
                                    <figcaption class="mt-2"><small
                                                class="text-muted">{{ date('M j, Y', strtotime($seller->created_at)) }}</small>
                                    </figcaption>
                                    <figcaption class="float-left"><small
                                                class="text-muted"><strong>Sell</strong></small></figcaption>
                                </a>
                            </figure>
                            <?php } ?>
                        @elseif($post -> post_type == "article")

                            <?php
                            $article = App\Article::where('id', $post->post_id)->get()->first();
                            if(!empty($article)){
                            ?>
                            <figure class="share-save-icon">
                                <img class="share-save-icon-buyr w-4" src="{{asset('img/' . 'referrer.png')}}">
                                <img id="{{$article->id}}" data-value="{{$id}}" data-value1="article"
                                     class="share-save-icon-buyr w-4 m-2-45" style=""
                                     src="{{asset('img/' . 'save3.jpg')}}">
                                <a href="{{ route('article.show', $article->id) }}">
                                    <img src="{{ asset('uploads/article/' . $article->article_featured_image) }}">
                                    <figcaption><strong>{{ $article->article_title }}</strong></figcaption>
                                    <figcaption class="mt-2"><small
                                                class="text-muted">{{ date('M j, Y', strtotime($article->created_at)) }}</small>
                                    </figcaption>
                                    <figcaption class="float-left"><small
                                                class="text-muted"><strong>Article</strong></small></figcaption>
                                </a>
                            </figure>
                            <?php }

                            ?>


                        @endif
                    @endforeach
                </div>

            </div>
        </div>

        <div class="row">
            @foreach ($posts as $post)
                @if ($post -> post_type == "event")
                    <?php
                    $event = App\Event::where('id', $post->post_id)->get()->first();
                    if(!empty($event)){
                    $userId = Auth::user()->id;
                    $paydate_raw = DB::raw("STR_TO_DATE(`event_date`, '%m/%d/%Y')");
                    $currDate = date('m/d/Y');
                    $getEventDateSavePost = App\EventModal::where('event_date', ">=", $currDate)->where('event_id', $event->id)->orderBy('event_date', 'asc')->get()->first();

                    $savedEvents = App\SavedPost::where('post_type', '=', 'event')->where('post_id', '=', $event->id)->where('user_id', '=', $userId)->get()->first();
                    $eventVisitor = App\EventVisitors::where('user_id', '=', $userId)->where('event_id', $event->id)->get()->first();
                    $checkPermission = DB::table('user_menu')->where('menu_options_id', '=', '18')->where('user_id', '=', $userId)->get()->first();
                    if ($checkPermission) {
                        $permission = 1;
                    } else {
                        $permission = 0;
                    }
                    ?>

                    <?php
                    if(!empty($getEventDateSavePost))
                    {


                    ?>
                    <div class="col-md-3 hoverSet">
                        <div class="card mb-3 set" style="width: 17rem;">
                            <?php
                            if(empty($event->event_modal_image))
                            {
                            ?>
                            <a href="#" id="viewEventDetails"
                               onclick="viewEventDetails(<?php echo $event->id ?>,<?php echo $event->user_id ?>)"><img
                                        class="card-img-top" src="/images/image_not_found.jpg"
                                        style="padding: 10px;height: 200px" alt="Card image cap"></a>
                            <?php
                            }
                            else
                            {
                            ?>
                            <a href="#" id="viewEventDetails"
                               onclick="viewEventDetails(<?php echo $event->id ?>,<?php echo $event->user_id ?>)"><img
                                        class="card-img-top" src="/uploads/event/{{ $event->event_modal_image }}"
                                        style="padding: 10px;height: 200px" alt="Card image cap"></a>
                            <?php
                            }
                            ?>


                            <span class="overlay_badge_buy" id="" style="background: none;padding: 0;">
                                     <img src="/images/eventLogo.png" id="" style="height: 40px;">
                                    </span>
                            <span class="overlay_badge_buy"
                                  style="background: none;padding: 0;margin-left: 145px;margin-top: 2px">

                                    @if(Auth::user()->id == $getEventDateSavePost->user_id || $permission == 1)

                                    <a href="#" onclick="deleteEvent(<?php echo $event->id ?>);">
                                        <img src="/images/close.png" style="height: 30px;" class="img-thumbnail">
                                    </a>
                                @endif
                                    </span>
                            <span class="overlay_badge_buy"
                                  style="background: none;margin-left: 180px;padding: 0;margin-top: 2px">
                                    @if(Auth::user()->id == $getEventDateSavePost->user_id|| $permission == 1)

                                    <a href="#" onclick="eventEdit(<?php echo $event->id ?>)"><img
                                                src="/images/edit.png" style="height: 30px;" class="img-thumbnail"></a>
                                @endif
                                    </span>
                            <span class="overlay_badge_buy"
                                  style="background: none;padding: 0;margin-left: 215px;margin-top: 2px">


                                    <?php
                                if(!empty($savedEvents))
                                {
                                ?>
                                        <a href="#"
                                           onclick="unSavedPost(<?php echo $event->id ?>,<?php echo $userId  ?>)">
                                         <img src="/images/rating.png" style="height: 30px;"
                                              id="savedImage<?php echo $event->id; ?>" class="img-thumbnail">
                                        </a>
                                        <?php
                                }
                                else
                                {
                                ?>
                                         <a href="#"
                                            onclick="savedPost(<?php echo $event->id ?>,<?php echo Auth::user()->id  ?>)">
                                         <img src="/images/rating_blank.png" style="height: 30px;"
                                              id="savedImage<?php echo $event->id; ?>" class="img-thumbnail">
                                         </a>
                                        <?php
                                }
                                ?>


                                    </span>
                            <strong style="align-self: center;"
                                    onclick="viewEventDetails(<?php echo $event->id ?>,<?php echo $event->user_id ?>)">{{ $event->event_title }}</strong>
                            <div class="divback">
                                <label style="padding-right: 33px;background: lightgray"> <big class="bigtext">
                                        <?php
                                        if ($event->event_fee_type == 'Not Free') {
                                            echo '$ ' . $event->event_fee;
                                        } else {
                                            echo $event->event_fee_type;
                                        }

                                        ?>

                                    </big></label>
                                <label class="ordertext float-right">{{ $event->event_city }}
                                    , {{ $event->event_country }}</label><br>
                                <div style="flex-flow: column;">
                                    <label style="align-self: flex-start;background: #ffffff;padding: 5px"><span
                                                style="font-size: 20px;"><span style="color: red">
                                            {{ date('M j, Y', strtotime($getEventDateSavePost->event_date)) }}
                                            </span><br/> </span></label>
                                    <label style="align-self: flex-start;float: right">
                                        <?php
                                        if(!empty($eventVisitor))
                                        {
                                        $key = array_search($getEventDateSavePost->id, $tempVisitorList);
                                        if($eventVisitor->going_status == 'pending')
                                        {
                                        ?>
                                        <span style="padding: 5px;color: yellow;background: lightgray;border: 1px solid black;font-size: 20px;font-weight: bold;">Pending</span>
                                        <?php
                                        }
                                        else if($eventVisitor->going_status == 'rejected')
                                        {
                                        ?>
                                        <span style="padding: 5px;color: red;background: lightgray;border: 1px solid black;font-size: 20px;font-weight: bold;">Rejected</span>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                        <img = src="/images/going.png"   style="width: 80px
                                        ;
                                            height: 30px"/>
                                        <?php
                                        }
                                        ?>
                                        <?php
                                        }
                                        else
                                        {
                                        if ($event->need_approval == 'Yes') {
                                            $needApprove = 1;
                                        } else {
                                            $needApprove = 0;
                                        }
                                        if($event->event_fee_type == 'Not Free')
                                        {

                                        ?>

                                        <img = src="/images/notgoing.png"  onclick=
                                        'eventPay(<?php echo json_encode($event->event_title); ?>,<?php echo json_encode($event->event_fee); ?>,<?php echo json_encode($event->user_id); ?>,<?php echo json_encode($event->id); ?>,<?php echo json_encode($getEventDateSavePost->id) ?>,<?php echo json_encode($needApprove); ?>)
                                        ' style="width: 80px
                                        ;
                                            height: 30px"/>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                        <img = src="/images/notgoing.png" onclick=
                                        "freeJoinEvent(<?php echo json_encode($event->user_id); ?>,<?php echo json_encode($event->id); ?>,<?php echo json_encode($getEventDateSavePost->id) ?>,<?php echo json_encode($needApprove); ?>)
                                        "  style="width: 80px
                                        ;
                                            height: 30px"/>
                                        <?php
                                        }

                                        }
                                        ?>
                                    </label>
                                    <div style="padding: 5px;border-radius: 2px;background: white"><a href="#"
                                                                                                      onclick="share({{Auth::user()->id}})">
                                            <i class="fas fa-share" style="font-size: 25px;color: #00a3e9"></i></a>&nbsp;345&nbsp;&nbsp;<span
                                                class="float-right" style="font-size: 20px;">{{ $event->event_referral_commission }}% Refferal</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } } ?>


                @elseif($post -> post_type == "buy")
                    @php
                        $buyer=\App\Buyer::find($post->post_id);
                    @endphp
                    @isset($buyer)
                            <?php
                            $checkPermission = DB::table('user_menu')->where('menu_options_id', '=', '18')->where('user_id', '=', auth()->id())->get()->first();
                            if ($checkPermission) {
                                $permission = 1;
                            } else {
                                $permission = 0;
                            }
                            ?>
                            @php $bidAmount=bidAmountIfAlreadyBid($buyer,'buy');
                           $isPostSaved=isSavedPost($buyer->id,'buy',auth()->id());
                            @endphp
                            @php $bid=$buyer->bids()->where('user_id',auth()->id())->first() @endphp
                            <div class="col-md-3 hoverSet">
                                <div class="card mb-3 set" style="width: 17rem;">
                                    <a href="#" data-bids="{{getPostTotalBids($buyer,'buy')}}"
                                       data-orders="{{getPostBidOrders($buyer,'buy')}}" data-isSaved="{{$isPostSaved}}"
                                       data-user-name="{{$buyer->user->name}}" data-avatar="{{$buyer->user->avatar}}"
                                       data-all="{{json_encode($buyer)}}"
                                       onclick="showPostDetails('{{$buyer->id}}','{{auth()->id()}}',this)">
                                        <img class="card-img-top"
                                             src="{{$buyer->buyer_featured_image?"uploads/buyer/".$buyer->buyer_featured_image:"/images/image_not_found.jpg"}}"
                                             style="padding: 10px;" alt="Card image cap">
                                    </a>
                                    <span class="overlay_badge_buy">Buy</span>
                                    @if(auth()->id()==$buyer->user_id || $permission==1)
                                        <span class="overlay_badge_buy" id="buyDelete"
                                              style="background: none;padding: 0;margin-left: 145px;margin-top: 2px">
                                         <a href="#" onclick="deleteBuy('{{$buyer->id}}')">
                                              <img src="/images/close.png" style="height: 30px;"
                                                   class="deleteButton img-thumbnail">
                                          </a>
                                </span>
                                        <span class="overlay_badge_buy" id="buyEdit"
                                              style="background: none;margin-left: 180px;padding: 0;margin-top: 2px">
                                                            <a href="#"
                                                               onclick="buyEdit('{{$buyer->id}}','{{$buyer->user_id}}')"
                                                               class=""><img src="/images/edit.png"
                                                                             style="height: 30px;"
                                                                             class=" img-thumbnail"></a>
                                                        </span>
                                    @endif
                                    <span class="overlay_badge_buy" id="savedButton"
                                          style="background: none;padding: 0;margin-left: 215px;margin-top: 2px">
                                 <a href="#" onclick="saveBuySell('{{$buyer->id}}','{{auth()->id()}}','buy')">
                                 <img src="{{$isPostSaved?'/images/rating.png':'/images/rating_blank.png'}}"
                                      style="height: 30px;" id="savedBuy{{$buyer->id}}"
                                      class="savedButton img-thumbnail">
                                 </a>
                            </span>


                                    <strong style="align-self: center;">{{$buyer->buyer_pro_title}}</strong>
                                    <div class="divback">
                                        <label style="padding-right: 16px;">Current rate : <big class="bigtext"> US
                                                ${{getCurrentRate($buyer)}}</big></label><label
                                                class="ordertext float-right">
                                            @if($buyer->user_id==auth()->id())
                                                <a onclick="buySellOrder('{{$buyer->id}}','{{getPostBidOrders($buyer,'buy')}}')"
                                                   href="#">[ {{getPostBidOrders($buyer)}} orders] </a>
                                            @else
                                                [ {{getPostBidOrders($buyer)}} orders]
                                            @endif
                                        </label><br>
                                        <div style="flex-flow: column;">

                                            <label style="align-self: flex-start;">{{--Auto order--}}</label>
                                            @if((isset($bid) && $bid->status =='pending') || !isset($bid))
                                                <input type="text" value="{{$bidAmount}}" class="bidinput"
                                                       data-id="{{$buyer->id}}" size="4"
                                                       style="align-self: center;">
                                                <button data-id="{{$buyer->id}}" data-max="{{getCurrentRate($buyer)}}"
                                                        class="triggerBid"
                                                        style="background-color: #0055a2;border-color: #0055a2;color: #fff">
                                                    Bid
                                                </button>
                                                <button data-id="{{$buyer->id}}" data-post-type='buy'
                                                        class="closebidinput {{$bidAmount?'typing':''}}"
                                                        style="color: #fff;margin-right: 35px;"><i
                                                            style="display: none" class="fas fa-close"></i></button>
                                            @endif
                                            <label class="bidtext float-right">
                                                @if($buyer->user_id==auth()->id())
                                                    <a onclick="buySellBids('{{$buyer->id}}','{{getPostTotalBids($buyer,'buy')}}')"
                                                       href="#">[ {{getPostTotalBids($buyer)}} bid ]</a>
                                                @else
                                                    [ {{getPostTotalBids($buyer)}} orders]
                                                @endif
                                            </label>
                                            <h6 data-time="{{$buyer->created_at->addHours($buyer->hour)}}"
                                                class="countDownTimer" id="showCountDownTimer"
                                                style="text-align: center; background-color: #f8f8f8">{{$buyer->hour}}</h6>
                                            <div style="padding: 5px;border-radius: 2px;">
                                                <i class="fas fa-share" style="font-size: 25px;color: #00a3e9"></i>&nbsp;345&nbsp;&nbsp;<span
                                                        class="float-right" style="font-size: 20px;">{{$buyer->buyer_commission_percentage/2}}% Refferal</span>
                                            </div>
                                            <div style="text-align: center">
                                                <span>{{$buyer->buyer_location}}</span>
                                            </div>
                                            <div style="text-align: center">

                                                @if($bid)
                                                    @if($bid->status=='ordered')
                                                        <span style="padding: 10px"><button data-id="{{$bid->id}}"
                                                                                            class="place-in-process">In Process</button></span>
                                                        <span style="padding: 10px"><button data-type="seller" data-id="{{$bid->id}}"
                                                                                            class="normal-dispute">Dispute</button></span>
                                                    @elseif($bid->status=='in_process')
                                                        <span style="padding: 10px"><button data-type="seller" data-id="{{$bid->id}}"
                                                                                            class="place-delivered">Delivered</button></span>
                                                        <span style="padding: 10px"><button data-type="seller" data-id="{{$bid->id}}"
                                                                                            class="normal-dispute">Dispute</button></span>

                                                    @elseif($bid->status=='delivered')
                                                        <span style="padding: 10px"></span><span style="padding: 10px"><button
                                                                    data-id="{{$bid->id}}" data-type="seller"
                                                                    class="normal-dispute">Dispute</button></span>

                                                    @elseif($bid->status=='paid')
                                                        <input value="{{userReview(auth()->id(),@$bid::buyer()->user_id,$bid->id)}}" data-bid-user="{{@$bid::buyer()->user_id}}" data-bid-id="{{$bid->id}}" class="rating-from-seller rating-loading" style="padding-top:5px">

                                                    @elseif($bid->status=='closed')
                                                        <input value="{{userReview(auth()->id(),@$bid::buyer()->user_id,$bid->id)}}"  class="ownRating own-rating rating-loading" style="padding-top:5px">

                                                    @elseif($bid->status=='got_dispute')
                                                        <span style="padding: 10px"><button data-id="{{$bid->id}}" data-type="seller"
                                                                                            class="normal-withdraw">Withdraw</button></span>
                                                        <span style="padding: 10px"></span><span style="padding: 10px"><button
                                                                    data-id="{{$bid->id}}" data-type="seller"
                                                                    class="normal-dispute">Dispute</button></span>
                                                    @elseif($bid->status=='send_dispute')
                                                        <span style="padding: 10px"><button data-id="{{$bid->id}}" data-type="seller"
                                                                                            class="normal-accept">Accept</button></span>
                                                        <span style="padding: 10px"></span><span style="padding: 10px"><button
                                                                    data-id="{{$bid->id}}" data-type="seller"
                                                                    class="normal-dispute">Dispute</button></span>
                                                    @endif
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                    @endisset
                @endif
            @endforeach
        </div>

        <style type="text/css">
            /*.hoverSet :hover {
                 border: 5px solid ;
                 overflow: hidden;
             }*/
            .hoverSet:hover .set {

                border: 4px solid orange;
                padding: 2px;
            }
        </style>
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
        </style>
        <style type="text/css">
            /*.hoverSet :hover {
                 border: 5px solid ;
                 overflow: hidden;
             }*/
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

            #eventEdit {
                display: none;
            }

            .hoverSet:hover #savedButton {
                display: block;
            }

            .hoverSet:hover #eventDelete {
                display: block;
            }

            .hoverSet:hover #eventEdit {
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
            }
        </style>
        <div class="row">
            @isset($events)
                @foreach($events as $event)
                    @isset($getEventDate)
                        @foreach ($getEventDate as $key)
                            @if($event->id == $key->event_id)
                                <div class="col-md-3 hoverSet">
                                    <div class="card mb-3 set" style="width: 17rem;">
                                        <?php
                                        if(empty($event->event_modal_image))
                                        {
                                        ?>
                                        <a href="#" id="viewEventDetails"
                                           onclick="viewEventDetails(<?php echo $event->id ?>,<?php echo $event->user_id ?>)"><img
                                                    class="card-img-top" src="/images/image_not_found.jpg"
                                                    style="padding: 10px;height: 200px" alt="Card image cap"></a>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                        <a href="#" id="viewEventDetails"
                                           onclick="viewEventDetails(<?php echo $event->id ?>,<?php echo $event->user_id ?>)"><img
                                                    class="card-img-top"
                                                    src="/uploads/event/{{ $event->event_modal_image }}"
                                                    style="padding: 10px;height: 200px" alt="Card image cap"></a>
                                        <?php
                                        }
                                        ?>


                                        <span class="overlay_badge_buy" id="" style="background: none;padding: 0;">
                                     <img src="/images/eventLogo.png" id="" style="height: 40px;">
                                    </span>

                                        <span class="overlay_badge_buy"
                                              style="background: none;padding: 0;margin-left: 180px;margin-top: 2px">

                                    @if(Auth::user()->id == $key->user_id)
                                                <a href="#" onclick="deleteEvent(<?php echo $event->id ?>);">
                                        <img src="/images/close.png" style="height: 30px;" class="img-thumbnail">
                                    </a>
                                            @endif
                                    </span>
                                        <span class="overlay_badge_buy"
                                              style="background: none;margin-left: 220px;padding: 0;margin-top: 2px">
                                    @if(Auth::user()->id == $key->user_id)
                                                <a href="#"
                                                   onclick="eventEdit(<?php echo $event->id ?>,<?php echo $event->user_id ?>)"><img
                                                            src="/images/edit.png" style="height: 30px;"
                                                            class="img-thumbnail"></a>
                                            @endif
                                    </span>

                                        <strong style="align-self: center;"
                                                onclick="viewEventDetails(<?php echo $event->id ?>,<?php echo $event->user_id ?>)">{{ $event->event_title }}</strong>
                                        <div class="divback">
                                            <label style="padding-right: 33px;background: lightgray"> <big
                                                        class="bigtext">
                                                    <?php
                                                    if ($event->event_fee_type == 'Not Free') {
                                                        echo '$ ' . $event->event_fee;
                                                    } else {
                                                        echo $event->event_fee_type;
                                                    }

                                                    ?>

                                                </big></label>
                                            <label class="ordertext float-right">{{ $event->event_city }}
                                                , {{ $event->event_country }}</label><br>
                                            <div style="flex-flow: column;">
                                                <label style="align-self: flex-start;background: #ffffff;padding: 5px"><span
                                                            style="font-size: 20px;"><span style="color: red">
                                            {{ date('M j, Y', strtotime($key->event_date)) }}
                                            </span><br/> </span></label>
                                                <label style="align-self: flex-start;float: right">
                                                    <?php
                                                    if(array_search($key->id, $tempVisitorList))
                                                    {
                                                    $key = array_search($key->id, $tempVisitorList);
                                                    if($tempVisitorList[$key + 1] == 'pending')
                                                    {
                                                    ?>
                                                    <span style="padding: 5px;color: yellow;background: lightgray;border: 1px solid black;font-size: 20px;font-weight: bold;">Pending</span>
                                                    <?php
                                                    }
                                                    else if($tempVisitorList[$key + 1] == 'rejected')
                                                    {
                                                    ?>
                                                    <span style="padding: 5px;color: red;background: lightgray;border: 1px solid black;font-size: 20px;font-weight: bold;">Rejected</span>
                                                    <?php
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                    <img = src="/images/going.png"   style="width: 80px
                                                    ;
                                                        height: 30px"/>
                                                    <?php
                                                    }
                                                    ?>
                                                    <?php
                                                    }
                                                    else
                                                    {
                                                    if ($event->need_approval == 'Yes') {
                                                        $needApprove = 1;
                                                    } else {
                                                        $needApprove = 0;
                                                    }
                                                    if($event->event_fee_type == 'Not Free')
                                                    {

                                                    ?>

                                                    <img = src="/images/notgoing.png"  onclick=
                                                    'eventPay(<?php echo json_encode($event->event_title); ?>,<?php echo json_encode($event->event_fee); ?>,<?php echo json_encode($event->user_id); ?>,<?php echo json_encode($event->id); ?>,<?php echo json_encode($key->id) ?>,<?php echo json_encode($needApprove); ?>)
                                                    ' style="width: 80px
                                                    ;
                                                        height: 30px"/>
                                                    <?php
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                    <img = src="/images/notgoing.png" onclick=
                                                    "freeJoinEvent(<?php echo json_encode($event->user_id); ?>,<?php echo json_encode($event->id); ?>,<?php echo json_encode($key->id) ?>,<?php echo json_encode($needApprove); ?>)
                                                    "  style="width: 80px
                                                    ;
                                                        height: 30px"/>
                                                    <?php
                                                    }

                                                    }
                                                    ?>
                                                </label>
                                                <div style="padding: 5px;border-radius: 2px;background: white"><a
                                                            href="#" onclick="share({{Auth::user()->id}})">
                                                        <i class="fas fa-share"
                                                           style="font-size: 25px;color: #00a3e9"></i></a>&nbsp;345&nbsp;&nbsp;<span
                                                            class="float-right" style="font-size: 20px;">{{ $event->event_referral_commission }}% Refferal</span>
                                                </div>
                                                <span style="color: red">Un published post</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                break;
                                ?>
                            @endif
                        @endforeach
                    @endisset
                @endforeach
            @endisset
        </div>
    </div>
@endsection


@section('extra-JS')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(".share-save-icon-buyr").click(function () {
            var user_id = $(this).attr("data-value");
            var post_id = $(this).attr("id");
            var post_type = $(this).attr("data-value1");
            var status = 0;
            $.ajax({
                url: "SavePost",
                type: "POST",
                data: {user_id: user_id, post_id: post_id, post_type: post_type, status: status},
                dataType: "JSON",
                success: function (data) {
                    console.log(data);
                    location.reload();
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });
        });
    </script>

    <script>
        function shareOnFb(eventId) {
            var url = "{{ route('events.show', ['EVENT_ID' => "EVENT_ID"]) }}".replace("EVENT_ID", eventId);
            FB.ui({
                method: 'share',
                href: url,
                app_id: "2223725464559470"
            }, function (response) {
            });
        }
    </script>

@endsection
