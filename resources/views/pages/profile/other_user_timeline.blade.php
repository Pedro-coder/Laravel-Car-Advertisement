@extends('layouts.app')

@section('content')
    @include('partials.other_user_profile')
    <section id="admin" class="admin-panel">
        <div class="container ">

            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="row">
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
                        @php $bid=$buyer->bids()->where('user_id',auth()->id())->first() @endphp
                        <div class="col-md-3 hoverSet">
                            <div class="card mb-3 set" style="width: 17rem;">
                                <a href="#" data-bids="{{getPostTotalBids($buyer,'buy')}}"
                                   data-orders="{{getPostBidOrders($buyer,'buy')}}" data-isSaved="{{$isPostSaved}}"
                                   data-user-name="{{$buyer->user->name}}" data-avatar="{{$buyer->user->avatar}}"
                                   data-all="{{json_encode($buyer)}}"
                                   onclick="showPostDetails('{{$buyer->id}}','{{auth()->id()}}',this)">
                                    <img class="card-img-top"
                                         src="{{asset(($buyer->buyer_featured_image?"uploads/buyer/".$buyer->buyer_featured_image:"/images/image_not_found.jpg"))}}"
                                         style="padding: 10px;" alt="Card image cap">
                                </a>
                                <span class="overlay_badge_buy">Buy</span>
                                @if(auth()->id()==$buyer->user_id || $permission==1)
                                <span class="overlay_badge_buy" id="buyDelete"
                                      style="background: none;padding: 0;margin-left: 145px;margin-top: 2px">
                                    <a href="#" onclick="deleteBuy('{{$buyer->id}}')">
                                        <img src="{{asset('/images/close.png')}}" style="height: 30px;"
                                             class="deleteButton img-thumbnail">
                                    </a>
                                </span>
                                <span class="overlay_badge_buy" id="buyEdit"
                                      style="background: none;margin-left: 180px;padding: 0;margin-top: 2px">
                                    <a href="#"
                                       onclick="buyEdit('{{$buyer->id}}','{{$buyer->user_id}}')"
                                       class=""><img src="{{asset('/images/edit.png"')}}"
                                                  style="height: 30px;"
                                                  class=" img-thumbnail"></a>
                                </span>
                                @endif
                                <span class="overlay_badge_buy" id="savedButton"
                                      style="background: none;padding: 0;margin-left: 215px;margin-top: 2px">
                                    <a href="#" onclick="saveBuySell('{{$buyer->id}}','{{auth()->id()}}', 'buy')">
                                        <img src="{{asset(($isPostSaved?'/images/rating.png':'/images/rating_blank.png'))}}"
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
                        @endforeach
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
                        <div class="col-md-3 hoverSet">
                            <div class="card mb-3 set" style="width: 17rem;">
                                <a href="#" data-bids="{{getSellPostTotalBids($seller,'sell')}}"
                                   data-orders="{{getSellPostBidOrders($seller,'sell')}}" data-isSaved="{{$isPostSaved}}"
                                   data-user-name="{{$seller->user->name}}" data-avatar="{{$seller->user->avatar}}"
                                   data-all="{{json_encode($seller)}}"
                                   onclick="showPostDetails('{{$seller->id}}','{{auth()->id()}}', this)">
                                    <img class="card-img-top"
                                         src="{{asset($seller->seller_featured_image?"uploads/seller/".$seller->seller_featured_image:"/images/image_not_found.jpg")}}"
                                         style="padding: 10px;" alt="Card image cap">
                                </a>
                                <span class="overlay_badge_sell">Sell</span>
                                @if(auth()->id()==$seller->user_id || $permission==1)
                                <span class="overlay_badge_buy" id="buyDelete"
                                      style="background: none;padding: 0;margin-left: 145px;margin-top: 2px">
                                    <a href="#" onclick="deleteBuy('{{$seller->id}}')">
                                        <img src="{{asset('/images/close.png')}}" style="height: 30px;"
                                             class="deleteButton img-thumbnail">
                                    </a>
                                </span>
                                <span class="overlay_badge_buy" id="buyEdit"
                                      style="background: none;margin-left: 180px;padding: 0;margin-top: 2px">
                                    <a href="#"
                                       onclick="buyEdit('{{$seller->id}}','{{$seller->user_id}}')"
                                       class=""><img src="{{asset('/images/edit.png')}}"
                                                  style="height: 30px;"
                                                  class=" img-thumbnail"></a>
                                </span>
                                @endif
                                <span class="overlay_badge_buy" id="savedButton"
                                      style="background: none;padding: 0;margin-left: 215px;margin-top: 2px">
                                    <a href="#" onclick="saveBuySell('{{$seller->id}}','{{auth()->id()}}', 'sell')">
                                        <img src="{{asset($isPostSaved?'/images/rating.png':'/images/rating_blank.png')}}"
                                             style="height: 30px;" id="savedBuy{{$seller->id}}"
                                             class="savedButton img-thumbnail">
                                    </a>
                                </span>


                                <strong style="align-self: center;">{{$seller->seller_pro_title}}</strong>
                                <div class="divback">
                                    <label style="padding-right: 16px;">Current rate : <big class="bigtext"> US
                                            ${{getSellCurrentRate($seller)}}</big></label><label
                                        class="ordertext float-right">
                                        @if($seller->user_id==auth()->id())
                                        <a onclick="sellOrder('{{$seller->id}}','{{getSellPostBidOrders($seller,'sell')}}')"
                                           href="#">[ {{getSellPostBidOrders($seller, 'sell')}} orders] </a>
                                        @else
                                        [ {{getSellPostBidOrders($seller)}} orders]
                                        @endif
                                    </label><br>
                                    <div style="flex-flow: column;">

                                        <label style="align-self: flex-start;">{{--Auto order--}}</label>
                                        @if((isset($bid) && $bid->status =='pending') || !isset($bid))
                                        <input type="text" value="{{$bidAmount}}" class="sellinput"
                                               data-id="{{$seller->id}}" size="4"
                                               style="align-self: center;">
                                        <button data-id="{{$seller->id}}" data-max="{{getCurrentRate($seller)}}"
                                                class="triggerSellBid"
                                                style="background-color: #0055a2;border-color: #0055a2;color: #fff">
                                            Bid
                                        </button>
                                        <button data-id="{{$seller->id}}" data-post-type='buy'
                                                class="closebidinput {{$bidAmount?'typing':''}}"
                                                style="color: #fff;margin-right: 35px;"><i
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
                                        <h6 data-time="{{$seller->created_at->addHours($seller->hour)}}"
                                            class="countDownTimer" id="showCountDownTimer"
                                            style="text-align: center; background-color: #f8f8f8">{{$seller->hour}}</h6>
                                        <div style="padding: 5px;border-radius: 2px;">
                                            <i class="fas fa-share" style="font-size: 25px;color: #00a3e9"></i>&nbsp;345&nbsp;&nbsp;<span
                                                class="float-right" style="font-size: 20px;">{{$seller->seller_commission_percentage/2}}% Refferal</span>
                                        </div>
                                        <div style="text-align: center">
                                            <span>{{$seller->seller_location}}</span>
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
                                            <input data-bid-id="{{$bid->id}}" class="rating-from-seller rating-loading" style="padding-top:5px">

                                            @elseif($bid->status=='closed')
                                            <input  class="ownRating own-rating rating-loading" style="padding-top:5px">

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
                        @endforeach
                        @endisset
                        @isset($articles)
                        @foreach ($articles as $article)
                        <figure class="share-save-icon">
                            <img class="share-save-icon-buyr w-4" src="{{asset('img/' . 'referrer.png')}}">
                            <img id="{{$article->id}}" data-value="{{$id}}" data-value1="article"
                                 data-value-2="blue"
                                 class="share-save-icon-buyr w-4 m-2-45 blue <?php if ($article->article_saved_status == 1) { ?>  hide  <?php } ?>"
                                 style="" src="{{asset('img/' . 'save2.png')}}">
                            <img id="{{$article->id}}" data-value="{{$id}}" data-value1="article"
                                 data-value-2="yellow"
                                 class="share-save-icon-buyr w-4 m-2-45 yellow <?php if ($article->article_saved_status == 0) { ?>  hide  <?php } ?>"
                                 style="" src="{{asset('img/' . 'save3.jpg')}}">
                                 <?php
                                 if ($article->article_saved_status != 1 && $article->article_saved_status != 0) {
                                     ?>
                                <img id="{{$article->id}}" data-value="{{$id}}" data-value1="article"
                                     data-value-2="blue" class="share-save-icon-buyr w-4 m-2-45 blue" style=""
                                     src="{{asset('img/' . 'save2.png')}}">
                                     <?php
                                 }
                                 ?>
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
                        @endforeach
                        @endisset
                        @isset($posts)
                        @foreach ($posts as $post)
                        <div class="col-md-3 hoverSet home-page-post">
                            <div class="card mb-3 set" style="width: 17rem;">
                                @if($post->read_amount == 0)
                                <a href="/blod-details/{{$post->id}}" id="viewEventDetails">
                                    @if(empty($post->image))
                                    <img class="card-img-top" src="{{asset('/images/image_not_found.jpg')}}"
                                         style="padding: 10px;height: 200px" alt="Card image cap">
                                    @else
                                    <img class="card-img-top"
                                         src="{{ asset('uploads/blog/' . $post->image) }}"
                                         style="padding: 10px;height: 200px" alt="Card image cap">
                                    @endif
                                </a>
                                @else
                                <a href="javascript:void(0)" id="viewEventDetails"
                                   onclick="showMsg('<?php echo $post->heading ?>',<?php echo $post->read_amount ?>,<?php echo $post->user_id ?>,<?php echo $post->id ?>)">
                                    @if(empty($post->image))
                                    <img class="card-img-top" src="{{asset('/images/image_not_found.jpg')}}"
                                         style="padding: 10px;height: 200px" alt="Card image cap">
                                    @else
                                    <img class="card-img-top"
                                         src="{{ asset('uploads/blog/' . $post->image) }}"
                                         style="padding: 10px;height: 200px" alt="Card image cap">
                                    @endif
                                </a>
                                @endif

                                <span class="overlay_badge_buy" id="" style="background: none;padding: 0;">
                                    <i class="fab fa-blogger fa-2x" style="color:sandybrown"></i>
                                </span>
                                <span class="overlay_badge_buy" id="eventDelete"
                                      style="background: none;padding: 0;margin-left: 145px;margin-top: 2px">

                                    @if($id == $post->user_id)
                                    <a href="#" onclick="deleteBlog(<?php echo $post->id ?>);">
                                        <img src="{{asset('/images/close.png')}}" style="height: 30px;" class="deleteButton img-thumbnail">
                                    </a>
                                    @endif
                                </span>
                                <span class="overlay_badge_buy" id="eventEdit"
                                      style="background: none;margin-left: 180px;padding: 0;margin-top: 2px">
                                    @if(Auth::user()->id == $post->user_id )
                                    <a href="#" class="" onclick="blogEdit(<?php echo $post->id ?>,<?php echo $post->user_id ?>)"><img src="{{asset('/images/edit.png')}}" style="height: 30px;"
                                                                                                                                       class="editButton img-thumbnail"></a>
                                    @endif
                                </span>
                                <span class="overlay_badge_buy" id="savedButton"
                                      style="background: none;padding: 0;margin-left: 215px;margin-top: 2px">
                                    <a href="#">
                                        <img src="{{asset('/images/rating_blank.png')}}" style="height: 30px;"
                                             id="savedImage<?php echo $post->id; ?>" class="savedButton img-thumbnail">
                                    </a>
                                </span>
                                @if($post->read_amount == 0)
                                <a class="blog-title" href="/blod-details/{{$post->id}}">
                                    <strong style="align-self: center;">{{ $post->heading }}</strong></a>
                                @else
                                <a class="blog-title" href="javascript:void(0)"
                                   onclick="showMsg('<?php echo $post->heading ?>',<?php echo $post->read_amount ?>,<?php echo $post->user_id ?>,<?php echo $post->id ?>)">
                                    <strong style="align-self: center;">{{ $post->heading }}</strong>
                                </a>
                                @endif
                                <div class="divback">
                                    <label style="padding-right: 33px;background: lightgray"> <big class="bigtext">
                                            <?php
                                            if ($post->read_amount == 'Free') {
                                                echo 'Free';
                                            } else {
                                                echo '$' . $post->read_amount;
                                            }
                                            ?>

                                        </big></label>

                                    <div style="flex-flow: column;">
                                        <label style="align-self: flex-start;background: #ffffff;padding: 5px"><span
                                                style="font-size: 12px; text-align: center;"><span>Published:
                                                    {{ date('M j, Y', strtotime($post->created_at)) }}
                                                </span><br/> </span></label>
                                        <label style="align-self: flex-start;float: right">
                                    </div>
                                    <div class="icons">
                                        <a href="javascript:void(0)"><i class="fas fa-comment"></i></a>
                                        <a href="javascript:void(0)"><i class="fa fa-thumbs-up"></i></a>
                                        <a href="javascript:void(0)"><i class="fa fa-share-alt"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endisset
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
$countShare = DB::table('referral_post')->where('event_id', '=', $event->id)->count();

//count waiting 
$countWaiting = DB::table('event_visitors')->where('event_id', '=', $event->id)->where('going_status', 'pending')->count();
//count going
$countGoing = DB::table('event_visitors')->where('event_id', '=', $event->id)->where('going_status', 'approved')->count();

if ($checkPermission) {
    $permission = 1;
} else {
    $permission = 0;
}
?>

                        <?php
                        if ($getEventDateSavePost) {
                            ?>
                            <div class="col-md-3 hoverSet">
                                <div class="card mb-3 set" style="width: 17rem;">
                            <?php
                            if (empty($event->event_modal_image)) {
                                ?>
                                        <a href="#" id="viewEventDetails" onclick="viewEventDetails(<?php echo $event->id ?>,<?php echo $event->user_id ?>)"><img class="card-img-top" src="{{asset('/images/image_not_found.jpg')}}" style="padding: 10px;height: 200px" alt="Card image cap"></a>
                                        <?php
                                    } else {
                                        ?>
                                        <a href="#" id="viewEventDetails" onclick="viewEventDetails(<?php echo $event->id ?>,<?php echo $event->user_id ?>)"><img class="card-img-top" src="{{asset('/uploads/event/'.$event->event_modal_image) }}" style="padding: 10px;height: 200px" alt="Card image cap"></a>
                                        <?php
                                    }
                                    ?>


                                    <span class="overlay_badge_buy"  id="" style= "background: none;padding: 0;">
                                        <img src="{{asset('/images/eventLogo.png')}}" id="" style="height: 40px;"  >
                                    </span>
                                    <span class="overlay_badge_buy" id="eventDelete" style="background: none;padding: 0;margin-left: 145px;margin-top: 2px">

                                        @if($userId == $getEventDateSavePost->user_id  || $permission == 1)
                                        <a href="#" onclick="deleteEvent(<?php echo $event->id ?>);" >
                                            <img src="{{asset('/images/close.png')}}"  style="height: 30px;"  class="deleteButton img-thumbnail">
                                        </a>
                                        @endif
                                    </span>
                                    <span class="overlay_badge_buy" id="eventEdit" style="background: none;margin-left: 180px;padding: 0;margin-top: 2px">
                                        @if(Auth::user()->id == $getEventDateSavePost->user_id || $permission == 1)
                                        <a href="#" onclick="eventEdit(<?php echo $event->id ?>,<?php echo $event->user_id ?>)" class="" ><img src="{{asset('/images/edit.png')}}" style="height: 30px;"  class="editButton img-thumbnail"></a>
                                        @endif
                                    </span>
                                    <span class="overlay_badge_buy" id="savedButton" style="background: none;padding: 0;margin-left: 215px;margin-top: 2px">


    <?php
    if (!empty($savedEvents)) {
        ?>
                                            <a href="#" onclick="savedPost(<?php echo $event->id ?>,<?php echo Auth::user()->id ?>)" >
                                                <img src="{{asset('/images/rating.png')}}" style="height: 30px;" id="savedImage<?php echo $event->id; ?>"  class="savedButton img-thumbnail">
                                            </a>
                                            <?php
                                        } else {
                                            ?>
                                            <a href="#" onclick="savedPost(<?php echo $event->id ?>,<?php echo Auth::user()->id ?>)" >
                                                <img src="{{asset('/images/rating_blank.png')}}" style="height: 30px;" id="savedImage<?php echo $event->id; ?>"  class="savedButton img-thumbnail">
                                            </a>
                                            <?php
                                        }
                                        ?>


                                    </span>
                                    <strong style="align-self: center;" onclick="viewEventDetails(<?php echo $event->id ?>,<?php echo $event->user_id ?>)">{{ $event->event_title }}</strong>
                                    <div class="divback">
                                        <label style="padding-right: 3px;background: lightgray">
                                        <?php
                                        if ($event->need_approval == 'Yes') {
                                            if ($event->event_fee_type == 'Not Free') {
                                                if (!empty($eventVisitor)) {
                                                    if ($eventVisitor->going_status == 'pending') {
                                                        echo "Applied : ";
                                                    } else if ($eventVisitor->going_status == 'rejected') {
                                                        echo "Appliend : ";
                                                    } else {
                                                        echo "Paid : ";
                                                    }
                                                } else {
                                                    echo "Apply to join : ";
                                                }
                                            } else {
                                                echo " join : ";
                                            }
                                        } else {
                                            if ($event->event_fee_type == 'Not Free') {
                                                if (!empty($eventVisitor)) {
                                                    echo "Paid : ";
                                                } else {
                                                    echo "Pay to join : ";
                                                }
                                            } else {
                                                echo "join : ";
                                            }
                                        }
                                        ?>


                                            <big class="bigtext">

                                            <?php
                                            if ($event->need_approval == 'Yes') {
                                                $needApprove = 1;
                                            } else {
                                                $needApprove = 0;
                                            }
                                            if ($event->event_fee_type == 'Not Free') {
                                                echo '$ ' . $event->event_fee;
                                            } else {
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
                                            if ($event->need_approval == 'Yes') {
                                                ?><br/>
                                                <?php
                                                if ($event->event_fee_type == 'Not Free') {
                                                    if (!empty($eventVisitor)) {
                                                        if ($eventVisitor->going_status == 'pending') {
                                                            ?>
                                                        <span style="color: #2b7a94">Applied </span>&nbsp;&nbsp;&nbsp;<a href="#" onclick="cancelRequest(<?php echo json_encode($event->user_id); ?>,<?php echo json_encode($event->id); ?>,<?php echo json_encode($getEventDateSavePost->id) ?>,<?php echo $event->event_fee; ?>)"><i class="fa fa-times 2x" style="color: white;background:#656510;padding: 5px" aria-hidden="true"></i></a>
                                                                <?php
                                                            } else if ($eventVisitor->going_status == 'rejected') {
                                                                ?>
                                                        <span style="color: red">Rejected</span>
                                                                <?php
                                                            } else {
                                                                ?>
                                                        <span style="color: #2b7a94">Going</span>
                                                                <?php
                                                            }
                                                        } else {
                                                            ?>
                                                    <a href="#" class="btn btn-outline-info" onclick='eventPay1(<?php echo json_encode($event->event_fee); ?>,<?php echo json_encode($event->user_id); ?>,<?php echo json_encode($event->id); ?>,<?php echo json_encode($getEventDateSavePost->id) ?>,<?php echo json_encode($needApprove); ?>)'  style="width: 50px;height: 25px;padding: 0;">Apply</a>
                                                            <?php
                                                        }
                                                    } else {
                                                        if (!empty($eventVisitor)) {
                                                            if ($eventVisitor->going_status == 'pending') {
                                                                ?>
                                                        <span style="color: #2b7a94">Applied </span>&nbsp;&nbsp;&nbsp;<a href="#" onclick="cancelRequest(<?php echo json_encode($event->user_id); ?>,<?php echo json_encode($event->id); ?>,<?php echo json_encode($getEventDateSavePost->id) ?>,<?php echo $event->event_fee; ?>)"><i class="fa fa-times 2x" style="color: white;background:#656510;padding: 5px" aria-hidden="true"></i></a>
                                                                <?php
                                                            } else if ($eventVisitor->going_status == 'rejected') {
                                                                ?>
                                                        <span style="color: red">Rejected</span>
                    <?php
                } else {
                    ?>
                                                        <span style="color: #2b7a94">Going</span>
                    <?php
                }
            } else {
                ?>
                                                    <a href="#" class="btn btn-outline-info" onclick="freeJoinEvent(<?php echo json_encode($event->user_id); ?>,<?php echo json_encode($event->id); ?>,<?php echo json_encode($getEventDateSavePost->id) ?>,<?php echo json_encode($needApprove); ?>)"  style="width: 50px;height: 25px;padding: 0;">Apply</a>
                                                    <?php
                                                }
                                                ?>

                                                <?php
                                            }
                                        } else {
                                            ?><br/>
                                            <?php
                                            if ($event->event_fee_type == 'Not Free') {
                                                if (!empty($eventVisitor)) {
                                                    ?>
                                                    <span style="color: #2b7a94">Going</span>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <a href="#"  class="btn btn-outline-info" onclick='eventPay1(<?php echo json_encode($event->event_fee); ?>,<?php echo json_encode($event->user_id); ?>,<?php echo json_encode($event->id); ?>,<?php echo json_encode($getEventDateSavePost->id) ?>,<?php echo json_encode($needApprove); ?>)' style="width: 50px;height: 25px;padding: 0;"><span>Pay</span></a>
                                                    <?php
                                                }
                                            } else {
                                                if (!empty($eventVisitor)) {
                                                    ?>
                                                    <span style="color: #2b7a94">Going</span>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <a href="#" class="btn btn-outline-info" onclick="freeJoinEvent(<?php echo json_encode($event->user_id); ?>,<?php echo json_encode($event->id); ?>,<?php echo json_encode($getEventDateSavePost->id) ?>,<?php echo json_encode($needApprove); ?>)"  style="width: 50px;height: 25px;padding: 0;">Join</a>
                                                    <?php
                                                }
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
                                            <!-- <label style="align-self: flex-start;float: right;margin-top: -40px">
                                        <?php
                                        if (!empty($eventVisitor)) {
                                            if ($eventVisitor->going_status == 'pending') {
                                                ?>
                                                            <span style="padding: 5px;color: yellow;background: lightgray;border: 1px solid black;font-size: 20px;font-weight: bold;">Pending</span><br/>
                                                            <a href="#" onclick="cancelRequest(<?php echo json_encode($event->user_id); ?>,<?php echo json_encode($event->id); ?>,<?php echo json_encode($getEventDateSavePost->id) ?>,<?php echo $event->event_fee; ?>)">Cancel Request</a>
                                                <?php
                                            } else if ($eventVisitor->going_status == 'rejected') {
                                                ?>
                                                            <span style="padding: 5px;color: red;background: lightgray;border: 1px solid black;font-size: 20px;font-weight: bold;">Rejected</span>
                                                <?php
                                            } else {
                                                ?>
                                                            <img = src="/images/going.png"   style="width: 80px;height: 30px"/>
                                                <?php
                                            }
                                            ?>
                                            <?php
                                        } else {

                                            if ($event->event_fee_type == 'Not Free') {
                                                ?>

                                                                    <img = src="/images/notgoing.png"  onclick='eventPay(<?php echo json_encode($event->event_fee); ?>,<?php echo json_encode($event->user_id); ?>,<?php echo json_encode($event->id); ?>,<?php echo json_encode($getEventDateSavePost->id) ?>,<?php echo json_encode($needApprove); ?>)' style="width: 80px;height: 30px"/>
                                                <?php
                                            } else {
                                                ?>
                                                                    <img = src="/images/notgoing.png" onclick="freeJoinEvent(<?php echo json_encode($event->user_id); ?>,<?php echo json_encode($event->id); ?>,<?php echo json_encode($getEventDateSavePost->id) ?>,<?php echo json_encode($needApprove); ?>)"  style="width: 80px;height: 30px"/>
                                                <?php
                                            }
                                        }
                                        ?>
                                            </label> -->
                                            <!-- <div style="padding: 5px;border-radius: 2px;background: white">
                                              <a href="#" onclick="share1({{Auth::user()->id}})">
                                                <i class="fas fa-share" style="font-size: 25px;color: #00a3e9"></i></a>&nbsp;345&nbsp;&nbsp;<span class="float-right" style="font-size: 20px;">{{ $event->event_referral_commission }}% Refferal</span>
                                            </div> -->
                                            <div style="padding: 5px;border-radius: 2px;">
                                                @php($url = url('share/'.$event->id.'/'.Auth::user()->id))
                                                <a href="javascript:void(0);" onclick="fb_share('{{ $url }}','{{ $event->event_title }}')" class="fbBtm"><i class="fas fa-share" style="font-size: 25px;color: #00a3e9"></i> </a>
                                                &nbsp;{{$countShare}}&nbsp;&nbsp;<span class="float-right" style="font-size: 20px;">{{ $event->event_referral_commission }}% Refferal</span>
                                            </div>
                                            <div style="padding: 5px;border-radius: 2px;background: lightgray">
                                                <span class="" style="font-size: 15px;font-weight: bold;"><center>{{ $event->event_city }}, {{ $event->event_country }}</center></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                    <?php } ?>
                        @endforeach
                        @endisset
                        @isset($result)
                        @foreach($result as $res)
                        <div class="col-md-3    ">
                            <div class="card text-center card-width">
                                <div class="card-header filter">
                                    <div class="row no-margin" style="width: 100%">
                                        <div class="col-md-2" style="padding-right: 0; padding-left: 2px">
                                            <div class="img-container">
                                                <img width="100%"
                                                     src="{{ asset('/uploads/avatars').'/' . $res['user_pic'] }}">
                                            </div>
                                        </div>
                                        <div class="col-md-5" style="padding-left: 0;text-align: left">
                                            <div class="title-container ml-2"><span
                                                    style="position: absolute;bottom: 0;">{{ $res['user_name'] }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-5 align-self-end">
                                            <input id="ownRatingMobileCard" name="ownRating"
                                                   class="rating rating-loading own-rating rating-xs ownRatingMobileCard"
                                                   value="{{averageReview($res['user_id'])}}"
                                                   style="padding-top: 8px;">

                                        </div>
                                    </div>

                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <img width="100%" src="{{asset('/uploads/' .$res['image'])}}">
                                        </div>
                                    </div>
                                    <h5 class="card-title">{{$res['heading']}}</h5>
                                </div>
                                <div class="card-footer text-muted">
                                    {!!  $res['btn'] !!}
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endisset
                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection

@section('extra-JS')
    <script>

        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(".share-save-icon-buyr").click(function () {
                var user_id = $(this).attr("data-value");
                var post_id = $(this).attr("id");
                var post_type = $(this).attr("data-value1");
                var saved_cls = $(this).attr("data-value-2");
                var status = "";
                if (saved_cls == "blue") {
                    $(this).addClass('hide');
                    $(this).next().removeClass('hide');
                    // $(".blue").addClass('hide');
                    // $(".yellow").removeClass('hide');
                    status = 1;
                } else {
                    $(this).addClass('hide');
                    $(this).prev().removeClass('hide');
                    // $(".yellow").addClass('hide');
                    // $(".blue").removeClass('hide');
                    status = 0;
                }
                $.ajax({
                    url: "SavePost",
                    type: "POST",
                    data: {user_id: user_id, post_id: post_id, post_type: post_type, status: status},
                    dataType: "JSON",
                    success: function (data) {
                        console.log(data);

                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        alert('Something went wrong');
                    }
                });
            });
        });

        function showMsg(heading, amount, owner_id, id) {
            Swal.fire({
                title: 'Pay To Read?',
                text: "You have to pay $" + amount + " to read!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: 'green',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Pay'
            }).then((result) => {
                if (result.value) {
                    $.ajax({

                        url: '/blog/pay-to-read/' + amount + '/' + owner_id,
                        type: 'GET',

                        success: function (response) {

                            console.log(response);
                            Swal.fire(
                                'Payment Done!',
                                'You can now read blog.',
                                'success'
                            ).then((result) => {
                                if (result.value) {
                                    window.location = '/blod-details/' + id;
                                }
                            });

                        }
                    });
                }
            });
        }
    </script>
    <div id="fb-root"></div>
    <script>
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
