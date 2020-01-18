@extends('layouts.app')

@section('content')
    <style type="text/css">
        .btn {
            display: inline-block;
            font-weight: 400;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            border: 1px solid transparent;
            padding: .375rem .75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: .25rem;
            transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        .time-and-true {
            border: 1px solid #eee;
            text-align: center;
            margin-top: 8px;
            padding: 3px;
        }

        .middle-div {
            background: #eee;
            margin: 41px 1px 20px -6px;
            height: 119px;
            padding: 13px;
        }

        .time-left-div {
            background: #f9f7f7;
            padding: 5px;
            height: 45px;
        }

        .referral-div input {
            width: 20%;
            padding: 0 3px 3px 5px;
            margin: 0 0 0 52px;
        }

        .referral-div h6 {
            font-weight: 700;
            font-size: .99rem;
            display: inline;
            vertical-align: sub;
        }

        .fa-question-circle {
            vertical-align: sub;
        }

        h6 {
            font-size: .80rem;
        }

        h5 {
            font-size: .95rem;
        }

        .top-image {
            height: 50px;
            width: 50px;
            float: left;;
        }

        .product-image {
            height: 190px;
            width: 330px;
            box-shadow: 1px 1px 1px 1px #eee;

        }

        .want-to-buy {
            width: 98% !important;
            padding: 0;
            background: #ffffff;
            margin: 0;
        }

        .current-bid-input {
            display: inline;
            width: 15%;

        }

        .product-name {
            width: 100%;
            font-weight: 800;

            text-align: center;
        }

        .bid-box {
            box-shadow: 1px 1px 1px 1px #0b682c;
            padding: 12px;
            margin: 32px;
        }

        @media only screen and (max-width: 600px) {
            .product-image {
                height: 184px;
                /*margin: 0;*/
                width: 240px;
                /*border-radius: 9%;*/
                box-shadow: 1px 1px 1px 1px #eee;
            }

            .product-name {
                width: 100%;
                font-weight: 800;

                text-align: center;
            }

            .want-to-buy {
                width: 100% !important;
                padding: 0;
                background: #ffffff;
                margin: 0;
            }

            .middle-div h6 {
                margin-left: -22px;
            }

            .middle-div h4 {
                margin-left: -39px;
            }

            .float-left {
                margin-top: 35px;
            }

            .middle-div {
                background: #eee;
                margin: 23px -3px 26px -3px;;
                height: 119px;
                padding: 13px;
            }

            .referral-div input {
                width: 28%;
                padding: 1px 10px 2px 14px;
                margin: 5px 3px 42px 25px;
            }

            .bid-box {
                box-shadow: 1px 1px 1px 1px #0b682c;
                padding: 3px;
                margin: 4px;
            }
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
    @include('partials._user-profile')
    <div class="container">
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
                     <div class="col-md-3 hoverSet">
                         <div class="card mb-3 set" style="width: 17rem;">
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
                                                 class="float-right" style="font-size: 20px;">{{$buyer->buyer_commission_percentage}}% Refferal</span>
                                     </div>
                                     <div style="text-align: center">
                                         <span>{{$buyer->buyer_location}}</span>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 @endforeach
             @endisset
         </div>
    </div>
@endsection

@section('extra-JS')

@endsection
