@extends('layouts.app')

@php
$leftAds = \App\library\SiteHelper::getLeftAds('otherpages',0);
$rightAds = \App\library\SiteHelper::getRightAds('otherpages',0);
$allAds = array_merge($rightAds->toArray(),$leftAds->toArray());
$allAdsCount = count($allAds);
$addCnt = 0;

$tot_posts = count($buyers) + count($sellers) + count($articles) + count($posts);
$totLedtAdds = count($leftAds);
$totrightAds = count($rightAds);
$post_col = 'col-md-3';
$repPrRow = ($totLedtAdds > 0) ? round( 6 / $totLedtAdds) : 0;
$repPrRowR = $totrightAds > 0 ? ceil( 4 / $totrightAds) :0 ;
$rows = ceil($tot_posts / 4 );
if($setting->view_style == 'facebook'){
$post_col = 'col-md-12';
$repPrRow = ($totLedtAdds > 0) ? ceil( 5 / $totLedtAdds) : 0;
$repPrRowR = $totrightAds > 0 ? ceil( 4 / $totrightAds) : 0;
$rows = ceil($tot_posts / 1 );
}
@endphp
@section('content')
<style>
.cls-padding-2 {
    padding: 3px;
}

#timeText {
    color: black !important;
}

.cls-left-add-img img {
    width: 100%;
    height: 60px;
}

.cls-left-add-block {
    margin-bottom: 10px;
}

.cls-left-add-block div {
    padding: 0px;
    padding-left: 2px;
}

.MYcontainer {

    width: 100%;
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto;
}

.footer {
    position: fixed;
}

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

.cls-left-add-root,
.cls-right-add-root {
    float: left;
    max-width: 100px;
}

.cls-cnt {
    float: left;
}
</style>
<div class="cls-left-add-root sticky_column d-none d-md-block" id="left-add-root">
    <?php
            // for ($i=0; $i < $rows; $i++) { ?>
    <div class="cls-add-row">
        <?php
                    for ($k=0; $k < $totLedtAdds; $k++) { 
                         $value = $leftAds[$k];
                        ?>
        <div class="row cls-left-add-block">
            <a href="{{ ($value->image_link ) ? $value->image_link : '#' }}"
                {{ ($value->image_link) ? 'target="_blank"' : '' }} class="add-link">
                <div class="cls-left-add-img col-md-4 col-lg-6">
                    <img class=""
                        src="{{$value->image?"uploads/adsimages/".$value->image:"/images/image_not_found.jpg"}}"
                        width="200px" alt="Card image cap">
                </div>
                <div class="col-md-8 cls-left-add-title col-lg-6">
                    <span class="">{{$value->adds_name}} </span>
                </div>
            </a>
        </div>
        <?php
                    }
                 ?> </div> <?php
            // }
            
            ?>
</div>
<div class="container cls-cnt">

    <!-- <div class="row justify-content-center"> -->
    <div class="row <?php echo $setting->view_style == 'facebook' ? 'justify-content-center' : '' ?>">
        @isset($buyers)
        @foreach($buyers as $buyer)
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
        <div class="{{$post_col}} col-sm-12 hoverSet">
            <div class="card cls-padding-2 mb-3 set">
                <a href="#" data-bids="{{getPostTotalBids($buyer,'buy')}}"
                    data-orders="{{getPostBidOrders($buyer,'buy')}}" data-isSaved="{{$isPostSaved}}"
                    data-user-name="{{$buyer->user->name}}" data-avatar="{{$buyer->user->avatar}}"
                    data-all="{{json_encode($buyer)}}"
                    onclick="showPostDetails('{{$buyer->id}}','{{auth()->id()}}',this)">
                    <img class="card-img-top"
                        src="{{$buyer->buyer_featured_image?"/uploads/buyer/".$buyer->buyer_featured_image:"/images/image_not_found.jpg"}}"
                        style="padding: 10px;" alt="Card image cap">
                </a>
                <span class="overlay_badge_buy">Buy</span>
                @if(auth()->id()==$buyer->user_id || $permission==1)
                <span class="overlay_badge_buy buyDelete" id="buyDelete"
                    style="background: none;padding: 0;margin-top: 2px">
                    <a href="#" onclick="deleteBuy('{{$buyer->id}}')">
                        <img src="/images/close.png" style="height: 30px;" class="deleteButton img-thumbnail">
                    </a>
                </span>
                <span class="overlay_badge_buy buyEdit" id="buyEdit"
                    style="background: none;padding: 0;margin-top: 2px">
                    <a href="#" onclick="buyEdit('{{$buyer->id}}','{{$buyer->user_id}}')" class=""><img
                            src="/images/edit.png" style="height: 30px;" class=" img-thumbnail"></a>
                </span>
                @endif
                <span class="overlay_badge_buy savedButton" id="savedButton"
                    style="background: none;padding: 0;margin-top: 2px">
                    <a href="#" onclick="saveBuySell('{{$buyer->id}}','{{auth()->id()}}','buy')">
                        <img src="{{$isPostSaved?'/images/rating.png':'/images/rating_blank.png'}}"
                            style="height: 30px;" id="savedBuy{{$buyer->id}}" class="savedButton img-thumbnail">
                    </a>
                </span>


                <strong style="align-self: center;">{{$buyer->buyer_pro_title}}</strong>
                <div class="divback">
                    <label style="padding-right: 16px;">Current rate : <big class="bigtext"> US
                            ${{getCurrentRate($buyer)}}</big></label><label class="ordertext float-right">
                        @if($buyer->user_id==auth()->id())
                        <a onclick="buySellOrder('{{$buyer->id}}','{{getPostBidOrders($buyer,'buy')}}')" href="#">[
                            {{getPostBidOrders($buyer)}} orders] </a>
                        @else
                        [ {{getPostBidOrders($buyer)}} orders]
                        @endif
                    </label><br>
                    <div style="flex-flow: column;">

                        <label style="align-self: flex-start;">{{--Auto order--}}</label>
                        <input type="text" value="{{$bidAmount}}" class="bidinput" data-id="{{$buyer->id}}" size="4"
                            style="align-self: center;">
                        <button data-id="{{$buyer->id}}" data-max="{{getCurrentRate($buyer)}}" class="triggerBid"
                            style="background-color: #0055a2;border-color: #0055a2;color: #fff">
                            Bid
                        </button>
                        <button data-id="{{$buyer->id}}" data-post-type='buy'
                            class="closebidinput {{$bidAmount?'typing':''}}" style="color: #fff;margin-right: 35px;"><i
                                style="display: none" class="fas fa-close"></i></button>
                        <label class="bidtext float-right">
                            @if($buyer->user_id==auth()->id())
                            <a onclick="buySellBids('{{$buyer->id}}','{{getPostTotalBids($buyer,'buy')}}')" href="#">[
                                {{getPostTotalBids($buyer)}} bid ]</a>
                            @else
                            [ {{getPostTotalBids($buyer)}} orders]
                            @endif
                        </label>
                        <h6 data-time="{{$buyer->created_at->addHours($buyer->hour)}}" class="countDownTimer"
                            id="showCountDownTimer" style="text-align: center; background-color: #f8f8f8">
                            {{$buyer->hour}}</h6>
                        <div style="padding: 5px;border-radius: 2px;">
                            <i class="fas fa-share"
                                style="font-size: 25px;color: #00a3e9"></i>&nbsp;345&nbsp;&nbsp;<span
                                class="float-right" style="font-size: 20px;">{{$buyer->buyer_commission_percentage}}%
                                Refferal</span>
                        </div>
                        <div style="text-align: center">
                            <span>{{$buyer->buyer_location}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php  if($allAdsCount  > 0 && $addCnt < $allAdsCount) { ?>
        <div class="col-sm-12  d-sm-block d-md-none sm-add-root d-lg-none">
            <a href="{{ ($allAds[$addCnt]['image_link']) ? $allAds[$addCnt]['image_link'] : '#' }}"
                {{ ($allAds[$addCnt]['image_link']) ? 'target="_blank"' : '' }} class="add-link">
                <img class=""
                    src="{{$allAds[$addCnt]['image']? 'uploads/adsimages/' .$allAds[$addCnt]['image']:"/images/image_not_found.jpg"}}"
                    alt="Card image cap">
                <span class="">{{$allAds[$addCnt]['adds_name']}}</span>
            </a>
            <?php 
            $addCnt++; 
            
            ?>
        </div>
        <?php } ?>
        @endforeach
        @endisset
        @isset($events)
        @foreach($events as $event)
        <?php
                            // $userId = Auth::user()->id;
                            $paydate_raw = DB::raw("STR_TO_DATE(`event_date`, '%m/%d/%Y')");
                            $currDate = date('m/d/Y');
                            $getEventDateSavePost = App\EventModal::where('event_date', ">=", $currDate)->where('event_id', $event->id)->orderBy('event_date', 'asc')->get()->first();


                            ?>

        <?php
                            if($getEventDateSavePost)
                            {
                            ?>
        <div class="{{$post_col}}  col-sm-12  hoverSet">
            <div class="card mb-3 cls-padding-2 set">
                <?php
                                    if(empty($event->event_modal_image))
                                    {
                                    ?>
                <a href="/home" id=""><img class="card-img-top" src="{{ URL::asset('images/image_not_found.jpg') }}"
                        style="padding: 10px;height: 200px" alt="Card image cap"></a>
                <?php
                                    }
                                    else
                                    {
                                    ?>
                <a href="/home" id=""><img class="card-img-top" src="/uploads/event/{{ $event->event_modal_image }}"
                        style="padding: 10px;height: 200px" alt="Card image cap"></a>
                <?php
                                    }
                                    ?>


                <span class="overlay_badge_buy" id="" style="background: none;padding: 0;">
                    <img src="/images/eventLogo.png" id="" style="height: 40px;">
                </span>

                <span class="overlay_badge_buy savedButton" id="savedButton"
                    style="background: none;padding: 0;margin-top: 2px">


                    <a href="/home">
                        <img src="/images/rating_blank.png" style="height: 30px;"
                            id="savedImage<?php echo $event->id; ?>" class="savedButton img-thumbnail">
                    </a>



                </span>
                <strong style="align-self: center;"><a href="/home">{{ $event->event_title }}</a></strong>
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
                                </span><br /> </span></label>
                        <label style="align-self: flex-start;float: right">


                            <img=src="/images/notgoing.png" style="width: 80px
                                                ;
                                                    height: 30px" />

                        </label>
                        <div style="padding: 5px;border-radius: 2px;background: white"><a href="#">
                                <i class="fas fa-share"
                                    style="font-size: 25px;color: #00a3e9"></i></a>&nbsp;345&nbsp;&nbsp;<span
                                class="float-right" style="font-size: 20px;">{{ $event->event_referral_commission }}%
                                Refferal</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php  } ?>

        <?php  if($allAdsCount  > 0 && $addCnt < $allAdsCount) { ?>
        <div class="col-sm-12  d-sm-block d-md-none sm-add-root d-lg-none">
            <a href="{{ ($allAds[$addCnt]['image_link']) ? $allAds[$addCnt]['image_link'] : '#' }}"
                {{ ($allAds[$addCnt]['image_link']) ? 'target="_blank"' : '' }} class="add-link">
                <img class=""
                    src="{{$allAds[$addCnt]['image']?"uploads/adsimages/".$allAds[$addCnt]['image']:"/images/image_not_found.jpg"}}"
                    alt="Card image cap">
                <span class="">{{$allAds[$addCnt]['adds_name']}}</span>
            </a>
            <?php 
            $addCnt++; 
            
            ?>
        </div>
        <?php } ?>
        @endforeach
        @endisset
        @isset($posts)
        @foreach ($posts as $post)
        <div class="{{$post_col}} col-sm-12 hoverSet home-page-post">
            <div class="card mb-3 cls-padding-2 set">
                @if($post->read_amount == 0)
                <a href="/blod-details/{{$post->id}}" id="viewEventDetails">
                    @if(empty($post->image))
                    <img class="card-img-top" src="/images/image_not_found.jpg" style="padding: 10px;height: 200px"
                        alt="Card image cap">
                    @else
                    <img class="card-img-top" src="{{ asset('uploads/blog/' . $post->image) }}"
                        style="padding: 10px;height: 200px" alt="Card image cap">
                    @endif
                </a>
                @else
                <a href="javascript:void(0)" id="viewEventDetails"
                    onclick="showMsg('<?php echo $post->heading ?>',<?php echo $post->read_amount  ?>,<?php echo $post->user_id ?>,<?php echo $post->id ?>)">
                    @if(empty($post->image))
                    <img class="card-img-top" src="/images/image_not_found.jpg" style="padding: 10px;height: 200px"
                        alt="Card image cap">
                    @else
                    <img class="card-img-top" src="{{ asset('uploads/blog/' . $post->image) }}"
                        style="padding: 10px;height: 200px" alt="Card image cap">
                    @endif
                </a>
                @endif

                <span class="overlay_badge_buy" id="" style="background: none;padding: 0;">
                    <i class="fab fa-blogger fa-2x" style="color:sandybrown"></i>
                </span>


                <span class="overlay_badge_buy savedButton" id="savedButton"
                    style="background: none;padding: 0;margin-top: 2px">
                    <a href="#">
                        <img src="/images/rating_blank.png" style="height: 30px;"
                            id="savedImage<?php echo $post->id; ?>" class="savedButton img-thumbnail">
                    </a>
                </span>
                @if($post->read_amount == 0)
                <a class="blog-title" href="/blod-details/{{$post->id}}">
                    <strong style="align-self: center;">{{ $post->heading }}</strong></a>
                @else
                <a class="blog-title" href="javascript:void(0)"
                    onclick="showMsg('<?php echo $post->heading ?>',<?php echo $post->read_amount  ?>,<?php echo $post->user_id ?>,<?php echo $post->id ?>)">
                    <strong style="align-self: center;">{{ $post->heading }}</strong>
                </a>
                @endif
                <div class="divback">
                    <?php
                                        if ($post->read_amount != 'Free') {
                                            echo 'Pay to read:';
                                        }

                                        ?>
                    <label style="padding-right: 33px;background: lightgray"> <big class="bigtext">
                            <?php
                                                if ($post->read_amount == 'Free') {
                                                    echo 'Free';
                                                } else {
                                                    echo '$' . $post->read_amount;
                                                }

                                                ?>

                        </big></label><span style="float: right">
                        <div class="icons"><a href="javascript:void(0)"><i
                                    class="fa fa-thumbs-up"></i></a>&nbsp;&nbsp;<span
                                style="background: #ffffff;padding: 2px">55</span></div>
                        <br />

                    </span>

                    <div>
                        <span style="background: #ffffff;float: left">Published</span>
                        <span style="float: right;margin-right: -45px"><span
                                style="background: #ffffff;padding: 2px">6</span></span>
                        <span style="float: right;margin-right: -17px">
                            <div class="icons"><a style="float: right" href="javascript:void(0)"><i
                                        class="fas fa-comment"></i></a></div>
                        </span>

                    </div><br /><br />

                    <div style="flex-flow: column;width: 100%">
                        <label style="align-self: flex-start;background: #ffffff;padding: 5px">
                            <span style="font-size: 12px; text-align: center;"><span>Published:
                                    {{ date('M j, Y', strtotime($post->created_at)) }}
                                </span><br /> </span></label>
                        <label style="align-self: flex-start;float: right">
                    </div>

                    <div style="padding: 5px;border-radius: 2px;">
                        <a href="javascript:void(0);" onclick="" class="fbBtm"><i class="fas fa-share"
                                style="font-size: 25px;color: #00a3e9"></i> </a>
                        &nbsp;345&nbsp;&nbsp;<span class="float-right" style="font-size: 20px;">20%
                            Refferal</span>
                    </div>
                </div>
            </div>
        </div>

        <?php  if($allAdsCount  > 0 && $addCnt < $allAdsCount) { ?>
        <div class="col-sm-12  d-sm-block d-md-none sm-add-root d-lg-none">
            <a href="{{ ($allAds[$addCnt]['image_link']) ? $allAds[$addCnt]['image_link'] : '#' }}"
                {{ ($allAds[$addCnt]['image_link']) ? 'target="_blank"' : '' }} class="add-link">
                <img class=""
                    src="{{$allAds[$addCnt]['image']?"uploads/adsimages/".$allAds[$addCnt]['image']:"/images/image_not_found.jpg"}}"
                    alt="Card image cap">
                <span class="">{{$allAds[$addCnt]['adds_name']}}</span>
            </a>
            <?php 
            $addCnt++; 
            ?>
        </div>
        <?php } ?>
        @endforeach
        
        <?php while ($addCnt < $allAdsCount) { ?>
          <?php  if($allAdsCount  > 0 && $addCnt < $allAdsCount) { ?>
        <div class="col-sm-12  d-sm-block d-md-none sm-add-root d-lg-none">
            <a href="{{ ($allAds[$addCnt]['image_link']) ? $allAds[$addCnt]['image_link'] : '#' }}"
                {{ ($allAds[$addCnt]['image_link']) ? 'target="_blank"' : '' }} class="add-link">
                <img class=""
                    src="{{$allAds[$addCnt]['image']?"uploads/adsimages/".$allAds[$addCnt]['image']:"/images/image_not_found.jpg"}}"
                    alt="Card image cap">
                <span class="">{{$allAds[$addCnt]['adds_name']}}</span>
            </a>
            <?php 
            $addCnt++; 
            ?>
        </div>
        <?php } } ?>
        @endisset

        @isset($sellers)
        @foreach ($sellers as $seller)
        <?php
                            $checkPermission = DB::table('user_menu')->where('menu_options_id', '=', '18')->where('user_id', '=', auth()->id())->get()->first();
                            if ($checkPermission) {
                                $permission = 1;
                            } else {
                                $permission = 0;
                            }
                            ?>
        @php
        $bidAmount=bidAmountIfAlreadyBid($seller,'buy');
        $isPostSaved=isSavedPost($seller->id,'buy',auth()->id());
        @endphp
        @php $bid=$seller->bids()->where('user_id',auth()->id())->first() @endphp
        <div class="{{$post_col}} col-sm-12  hoverSet">
            <div class="card mb-3 cls-padding-2 set">
                <a href="#" data-bids="{{getSellPostTotalBids($seller,'sell')}}"
                    data-orders="{{getSellPostBidOrders($seller,'sell')}}" data-isSaved="{{$isPostSaved}}"
                    data-user-name="{{$seller->user->name}}" data-avatar="{{$seller->user->avatar}}"
                    data-all="{{json_encode($seller)}}"
                    onclick="showPostDetails('{{$seller->id}}','{{auth()->id()}}',this)">
                    <img class="card-img-top"
                        src="{{$seller->seller_featured_image?"uploads/seller/".$seller->seller_featured_image:"/images/image_not_found.jpg"}}"
                        style="padding: 10px;" alt="Card image cap">
                </a>
                <span class="overlay_badge_sell">Sell</span>
                @if(auth()->id()==$seller->user_id || $permission==1)
                <span class="overlay_badge_buy buyDelete" id="buyDelete"
                    style="background: none;padding: 0;margin-top: 2px">
                    <a href="#" onclick="deleteBuy('{{$seller->id}}')">
                        <img src="/images/close.png" style="height: 30px;" class="deleteButton img-thumbnail">
                    </a>
                </span>
                <span class="overlay_badge_buy buyEdit" id="buyEdit"
                    style="background: none;padding: 0;margin-top: 2px">
                    <a href="#" onclick="buyEdit('{{$seller->id}}','{{$seller->user_id}}')" class=""><img
                            src="/images/edit.png" style="height: 30px;" class=" img-thumbnail"></a>
                </span>
                @endif
                <span class="overlay_badge_buy savedButton" id="savedButton"
                    style="background: none;padding: 0;margin-top: 2px">
                    <a href="#" onclick="saveBuySell('{{$seller->id}}','{{auth()->id()}}','sell')">
                        <img src="{{$isPostSaved?'/images/rating.png':'/images/rating_blank.png'}}"
                            style="height: 30px;" id="savedBuy{{$seller->id}}" class="savedButton img-thumbnail">
                    </a>
                </span>


                <strong style="align-self: center;">{{$seller->seller_pro_title}}</strong>
                <div class="divback">
                    <label style="padding-right: 16px;">Current rate : <big class="bigtext"> US
                            ${{getSellCurrentRate($seller)}}</big></label><label class="ordertext float-right">
                        @if($seller->user_id==auth()->id())
                        <a onclick="sellOrder('{{$seller->id}}','{{getSellPostBidOrders($seller,'sell')}}')" href="#">[
                            {{getSellPostBidOrders($seller, 'sell')}} orders] </a>
                        @else
                        [ {{getSellPostBidOrders($seller)}} orders]
                        @endif
                    </label><br>
                    <div style="flex-flow: column;">

                        <label style="align-self: flex-start;">{{--Auto order--}}</label>
                        @if((isset($bid) && $bid->status =='pending') || !isset($bid))
                        <input type="text" value="{{$bidAmount}}" class="sellinput" data-id="{{$seller->id}}" size="4"
                            style="align-self: center;">
                        <button data-id="{{$seller->id}}" data-max="{{getCurrentRate($seller)}}" class="triggerSellBid"
                            style="background-color: #0055a2;border-color: #0055a2;color: #fff">
                            Bid
                        </button>
                        <button data-id="{{$seller->id}}" data-post-type='buy'
                            class="closebidinput {{$bidAmount?'typing':''}}" style="color: #fff;margin-right: 35px;"><i
                                style="display: none" class="fas fa-close"></i></button>
                        @endif
                        <label class="bidtext float-right">
                            @if($seller->user_id==auth()->id())
                            <a onclick="SellBids('{{$seller->id}}','{{getSellPostTotalBids($seller,'sell')}}')"
                                href="#">[ {{getSellPostTotalBids($seller)}} bid ]</a>
                            @else
                            [ {{getSellPostTotalBids($seller)}} orders]
                            @endif
                        </label>
                        <h6 data-time="{{$seller->created_at->addHours($seller->hour)}}" class="countDownTimer"
                            id="showCountDownTimer" style="text-align: center; background-color: #f8f8f8">
                            {{$seller->hour}}</h6>
                        <div style="padding: 5px;border-radius: 2px;">
                            <i class="fas fa-share"
                                style="font-size: 25px;color: #00a3e9"></i>&nbsp;345&nbsp;&nbsp;<span
                                class="float-right"
                                style="font-size: 20px;">{{$seller->seller_commission_percentage/2}}%
                                Refferal</span>
                        </div>
                        <div style="text-align: center">
                            <span>{{$seller->seller_location}}</span>
                        </div>
                        <div style="text-align: center">

                            @if($bid)
                            @if($bid->status=='ordered')
                            <span style="padding: 10px"><button data-id="{{$bid->id}}" class="place-in-process">In
                                    Process</button></span>
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
                            <input data-bid-id="{{$bid->id}}" class="rating-from-seller rating-loading"
                                style="padding-top:5px">

                            @elseif($bid->status=='closed')
                            <input class="ownRating own-rating rating-loading" style="padding-top:5px">

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

        <?php  if($allAdsCount  > 0 && $addCnt < $allAdsCount) { ?>
        <div class="col-sm-12  d-sm-block d-md-none sm-add-root d-lg-none">
            <a href="{{ ($allAds[$addCnt]['image_link']) ? $allAds[$addCnt]['image_link'] : '#' }}"
                {{ ($allAds[$addCnt]['image_link']) ? 'target="_blank"' : '' }} class="add-link">
                <img class=""
                    src="{{$allAds[$addCnt]['image']?"uploads/adsimages/".$allAds[$addCnt]['image']:"/images/image_not_found.jpg"}}"
                    alt="Card image cap">
                <span class="">{{$allAds[$addCnt]['adds_name']}}</span>
            </a>
            <?php 
            $addCnt++; 
            
            ?>
        </div>
        <?php } ?>
        @endforeach
        @endisset
    </div>
</div>

<div class="cls-rigth-add-root   sticky_column  d-none d-md-block" id="right-add-root">
    <?php
            // for ($i=0; $i < $rows; $i++) {  ?>
    <div class="cls-add-row">
        <?php 
                    for ($k=0; $k < $totrightAds; $k++) { 
                         $value = $rightAds[$k];
                    ?>
        <div class="row cls-right-add-block">
            <div class="cls-right-add-img col-md-12">
                <a href="{{ ($value->image_link ) ? $value->image_link : '#' }}"
                    {{ ($value->image_link) ? 'target="_blank"' : '' }} class="add-link">
                    <img class=""
                        src="{{$value->image?"uploads/adsimages/".$value->image:"/images/image_not_found.jpg"}}"
                        alt="Card image cap">

                    <span class="">{{$value->adds_name}}</span>
                </a>
            </div>
        </div>
        <?php
                    }
                ?> </div> <?php
            // }
            ?>
</div>
@endsection