<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@if ($setting = \App\Setting::first())
<meta name="pusher_app_key" content='{{ $setting->pusher_app_key }}'>
<meta name="pusher_app_cluster" content='{{ $setting->pusher_app_cluster }}'>
@endif
<style>
.cls-left-add-title span {
    height: 22px;
    background-color: #000;
    width: 100%;
    display: block;
    line-height: 22px;
    text-align: center;
    bottom: 0px;
    position: absolute;
    opacity: 0.8;
}

.footer {
    position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;

    color: white;
    text-align: center;
}

.cls-social {
    background-color: orange;
}

.adsMargin {
    background-color: #fff;
}

@media (max-width: 700px) {
    .foot-add-row {
        display: none;
    }
}

.heart {
    cursor: pointer;
    height: 50px;
    width: 50px;
    background-image: url('https://abs.twimg.com/a/1446542199/img/t1/web_heart_animation.png');
    background-position: left;
    background-repeat: no-repeat;
    background-size: 2900%;
}

.heart:hover {
    background-position: right;
}

.is_animating {
    animation: heart-burst .8s steps(28) 1;
}

@keyframes heart-burst {
    from {
        background-position: left;
    }

    to {
        background-position: right;
    }
}


.text-white {}

.look-like-btn {
    background-color: Transparent;
    background-repeat: no-repeat;
    border: none !important;
    cursor: pointer !important;
    overflow: hidden;
    color: #364759;
    box-shadow: none !important;
}

.cls-right-add-img img {
    width: 100%;
    min-height: 100px;
}

.cls-right-add-block {
    margin-bottom: 10px;
}

.cls-right-add-block div {
    padding: 0px;
    padding-left: 2px;
}

.cls-right-add-img span {
    position: absolute;
    transform: translate(-100%, 0px);
    background: #000;
    color: #fff;
    opacity: 0.6;
    width: 100%;
    bottom: 10px;
    height: 30px;
    text-align: center;
}


.sm-add-root {
    margin-bottom: 10px;
    max-height: 200px;
}

.sm-add-root img {
    width: 100%;
    min-height: 100px;
    max-height: 200px;
}

.sm-add-root div {
    padding: 0px;
    padding-left: 2px;
}

.sm-add-root span {
    position: absolute;
    transform: translate(-100%, 170px);
    background: #000;
    color: #fff;
    opacity: 0.6;
    width: 93%;
    height: 30px;
    text-align: center;
}

.cls-left-add-root.d-none.d-md-block {
    padding-left: 14px;
}

.foot-add-row .col-md-1 span {
    position: absolute;
    background: black;
    transform: translate(-100%, 0%);
    width: 101%;
    bottom: 0;
    height: 38px;
    opacity: 0.5;
}

.foot-add-row .col-md-1 {
    margin: 0px;
    padding: 0px;
}

.foot-add-row .col-md-1 img {
    width: 100%;
    height: 100px;
}

.overlay_badge_buy.buyDelete,
.overlay_badge_buy.eventDelete,
.overlay_badge_buy.buyEdit,
.overlay_badge_buy.eventEdit,
.overlay_badge_buy.savedButton {
    max-width: 30px;
    float: right;
    left: unset !important;
    right: 0px;
}

.overlay_badge_buy.buyDelete,
.overlay_badge_buy.eventDelete {
    right: 65px
}

.overlay_badge_buy.buyEdit,
.overlay_badge_buy.eventEdit {
    right: 32px
}

.cls-add-row {
    /* min-height:<?php echo $setting->view_style == 'facebook' ? 400 : 450 ?>px; */
}

.cls-add-row img,
.cls-add-row div {
    max-height: 205px;
    max-width: 255px;

}

@media(min-width: 1200px) {

    .cls-cnt {
        min-width: <?php echo $setting->view_style=='facebook'? 50: 80 ?>% !important;
        max-width: <?php echo $setting->view_style=='facebook'? 50: 80 ?>% !important;
    }

    .cls-left-add-root,
    .cls-right-add-root {
        min-width: <?php echo $setting->view_style=='facebook'? 25: 9 ?>% !important;
        padding: 20px;
    }

}

.cls-left-add-img img {
    width: 100%;
    max-height: 200px;
}
</style>
@include('partials.head')
<?php
use Illuminate\Support\Facades\DB;
$site_info = DB::table('site_info')->get();
$info_element_array = array();
foreach ($site_info as $info_element) {
    $info_element_array[$info_element->attr_name] = $info_element->attr_value;
}
?>
{{--<body style="background: url('/uploads/avatars/{{$info_element_array['above_footer_pic']}}'); background-size:
cover;" >--}}
@include('partials.ModelPopup')
@include('partials.second_nav')
@include('partials.nav')

@php
$currentPage = 'otherpages';
$adsUserId = 0;
@endphp
@if ($controller == 'UserController')
@php
$currentPage = 'profile';
$adsUserId = $user->id;
@endphp
@endif
<!-- <div class="row adsMargin position-relative">
    <div class="col-md-12">
        <div class="">
            <div class="row">
                @php
                    $topAds       = \App\library\SiteHelper::getTopAds($currentPage,$adsUserId);
                    $countTopAdds = (sizeof($topAds));


                @endphp
                <?php
                if ($countTopAdds == 0) {
                    $countTopAdds = 1;
                }
                $numberOfCols = 12 / $countTopAdds;
                ?>
                @foreach($topAds as $topAd)
                    <div class="col-md-<?php echo $numberOfCols ?>">
                        <div class="adsContent">
                            @if($topAd->adds_type == 'image')
                                <a class="adsLink" href="{{ 'http://'.$topAd->image_link }}" target="_blank">
                                    <img src="{{ asset('/uploads/adsImages/'.$topAd->image) }}" class="adsImage">
                                </a>
                            @elseif($topAd->adds_type == 'embed_code')
                                <?php echo $topAd->embed_code ?>
                            @elseif($topAd->adds_type == 'referral_code')
                                {{ $topAd->referral_code }}
                            @else
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-md-1 ads-position-absolute-left">
        <div class="row" style="height:300px;width:159px;">
           
            @php
                $leftAds = \App\library\SiteHelper::getLeftAds($currentPage,$adsUserId);
            @endphp
            @foreach($leftAds as $leftAd)
                <div class="col-md-12">
                    <div class="adsContent">
                        @if($leftAd->adds_type == 'image')
                            <a class="adsLink" href="{{ 'http://'.$leftAd->image_link }}" target="_blank">
                                <img src="{{ asset('/uploads/adsImages/'.$leftAd->image) }}" class="adsImage"
                                     style="height:300px;">
                            </a>
                        @elseif($leftAd->adds_type == 'embed_code')
                            <?php echo $leftAd->embed_code ?>
                        @elseif($leftAd->adds_type == 'referral_code')
                            {{ $leftAd->referral_code }}
                        @else
                        @endif
                    </div>
                </div>
            @endforeach
            
        </div>
    </div>
    <div class="col-md-1 ads-position-absolute-right">
        <div class="row" style="height:300px;width:159px;">
            @php
                $rightAds = \App\library\SiteHelper::getRightAds($currentPage,$adsUserId);
            @endphp
            @foreach($rightAds as $rightAd)
                <div class="col-md-12">
                    <div class="adsContent">
                        @if($rightAd->adds_type == 'image')
                            <a class="adsLink" href="{{ 'http://'.$rightAd->image_link }}" target="_blank">
                                <img src="{{ asset('/uploads/adsImages/'.$rightAd->image) }}" class="adsImage"
                                     style="height:300px">
                            </a>
                        @elseif($rightAd->adds_type == 'embed_code')
                            <?php echo $rightAd->embed_code ?>
                        @elseif($rightAd->adds_type == 'referral_code')
                            {{ $rightAd->referral_code }}
                        @else
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div> -->
@php

$popupAds = \App\library\SiteHelper::getPopupAds($currentPage,$adsUserId);
@endphp
@if($popupAds->count() > 0)
<div id="open-modal" class="modal-window modal-sm" style="display: block;padding:0px;">
    <div>
        <div class="closebtnarea" align="right"><i title="Close" onclick="$('#open-modal').hide('slow');"
                class="fa fa-times-circle fl-r crs-pntr" style="font-size:27px;color:#6c757d;"></i></div>
        <br>
        <div class="container">
            <div class="">
                @foreach($popupAds as $popupAd)
                <div class="col-md-12 margin-bottom-15"
                    style="padding-right: 10px;padding-bottom: 10px;padding-left: 10px;">
                    <div class="adsContent">
                        @if($popupAd->adds_type == 'image')
                        <a class="adsLink" href="{{ 'http://'.$popupAd->image_link }}" target="_blank">
                            <img src="{{ asset('/uploads/adsImages/'.$popupAd->image) }}" class="adsImage"
                                style="height:300px;border-radius: 10px;">
                        </a>
                        @elseif($popupAd->adds_type == 'embed_code')
                        <?php echo $popupAd->embed_code ?>
                        @elseif($popupAd->adds_type == 'referral_code')
                        {{ $popupAd->referral_code }}
                        @else
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div style="position:fixed; right:0%; bottom:0%;z-index: 2;">
    <div id="messagepop"></div>
</div>

@endif
@yield('content')
@if (!isset($homeList))

<?php 
$leftAds = \App\library\SiteHelper::getLeftAds('otherpages',0);
$rightAds = \App\library\SiteHelper::getRightAds('otherpages',0);
$botAdsot = \App\library\SiteHelper::getBottomAds('otherpages',0)->toArray();
$topAdsot = \App\library\SiteHelper::getTopAds('otherpages',0)->toArray();
// $allAds = array_merge($rightAds->toArray(),$leftAds->toArray(), $topAdsot, $botAdsot);
$allAds = array_merge($rightAds->toArray(),$leftAds->toArray(), $botAdsot);

$allAdsCount = count($allAds);
$addCnt = 0;
if($allAdsCount  > 0 && $addCnt < $allAdsCount) { 
    ?>
<br>
<div class="row justify-content-center "> <?php
    for ($addCnt=0; $addCnt < $allAdsCount; $addCnt++) { 
        ?>
    <div class="col-md-12 cls-bottom-add-item ">
        <a href="{{ ($allAds[$addCnt]['image_link']) ? $allAds[$addCnt]['image_link'] : '#' }}"
            {{ ($allAds[$addCnt]['image_link']) ? 'target="_blank"' : '' }} class="add-link">
            <img class="" height="200" width="100%"
                src="{{$allAds[$addCnt]['image']?"uploads/adsimages/".$allAds[$addCnt]['image']:"/images/image_not_found.jpg"}}"
                alt="Card image cap">
            <br>
            <span class="">{{$allAds[$addCnt]['adds_name']}}</span>
        </a>
    </div>
    <?php } ?>
</div>
<?php } ?>
@endif
<style>
.cls-bottom-add-item a span {
    opacity: 0.8;
    width: 100%;
    height: 25px;
    line-height: 25px;
    display: block;
    background-color: #000;
    text-align: center;
    position: relative;
    bottom: 25px;
}

ul.footer-social li {
    margin: 27px 5px 0 5px;
    padding: 0;
}

.social-section {
    width: 100%;
    height: 45px;
    text-align: center;
}

ul.footer-social li {
    height: 30px;
    font-size: 20px;
    display: inline-block;
    margin: 10px 11px 0 11px;
}

ul.footer-social li a {
    color: #FFF;
}
</style>
<!-- Scroll top buttm -->
<button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
<script>
mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {
    scrollFunction()
};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        mybutton.style.display = "block";
    } else {
        mybutton.style.display = "none";
    }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    $("html, body").animate({
        scrollTop: 0
    }, "slow");
    return false;
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}
</script>
<style>
#myBtn {
    display: none;
    /* Hidden by default */
    position: fixed;
    /* Fixed/sticky position */
    bottom: 20px;
    /* Place the button at the bottom of the page */
    right: 30px;
    /* Place the button 30px from the right */
    z-index: 99;
    /* Make sure it does not overlap */
    border: none;
    /* Remove borders */
    outline: none;
    /* Remove outline */
    background-color: orange;
    /* Set a background color */
    color: white;
    /* Text color */
    cursor: pointer;
    /* Add a mouse pointer on hover */
    padding: 15px;
    /* Some padding */
    border-radius: 10px;
    /* Rounded corners */
    font-size: 18px;
    /* Increase font size */
}

#myBtn:hover {
    background-color: #c38108;
    /* Add a dark-grey background on hover */
}
</style>
<!-- Scroll top buttm -->

<div class="footer d-none  cls-footer">
    <div class="row  cls-social">
        <div class="col-md-12 social-section">
            <ul class="footer-social">
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                <li><a href="#"><i class="fa fa-vimeo-square"></i></a></li>
                <li><a href="#"><i class="fa fa-tumblr"></i></a></li>
                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                <li><a href="#"><i class="fa fa-flickr"></i></a></li>
                <li><a href="#"><i class="fa fa-rss"></i></a></li>
            </ul>
        </div>
    </div>
    @if(isset($controller) && in_array( $controller, ['HomeController', 'PublicPageController']))
    <div class=" adsMargin">
        <div class="">
            <div class="exampleSlider">
                <div class="MS-content">
                    @php
                    $bottomAds = \App\library\SiteHelper::getBottomAds($currentPage,$adsUserId);
                    $countBottomAdds = (sizeof($bottomAds));
                    @endphp
                    @foreach($bottomAds as $bottomAd)
                    <div class="item">
                        <a href="{{ 'http://'.$bottomAd->image_link }}"><img height="50px"
                                style="max-height:100px;height:100px"
                                src="{{ asset('/uploads/adsImages/'.$bottomAd->image) }}" class="img-responsive"></a>
                        <span>{{$bottomAd->adds_name}} </span>

                    </div>
                    @endforeach


                    <div class="MS-controls">
                        <button class="MS-left"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
                        <button class="MS-right"><i class="fa fa-chevron-right" aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
</div>

<div style="position:fixed; right:0%; bottom:0%;z-index:2">
    <div id="messagepop">

    </div>
</div>
@include('partials.footer')
@include('partials.filter-modal')

@include('partials.JS')
@include('partials.ModelPopupJs')

{{--<div class="footer"--}}
{{--style="background-image: url('/uploads/avatars/{{$info_element_array['footer_pic']}}'); min-height: 30px;
background-size: cover;">--}}

{{--</div>--}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<style>
.fixed {
    position: fixed;
}

#right-add-root.fixed {
    position: fixed;
    right: 10px;
}

.fixed-cnt {
    float: initial !important;
}
</style>
<script>
var idleTime = 0;
$(document).ready(function() {
    stiky();
    stikyRight();
    //Increment the idle time counter every minute.
    var idleInterval = setInterval(timerIncrement, 1000); // 1 minute

    //Zero the idle timer on mouse movement.
    $(this).bind('mousewheel', function(e) {
        idleTime = 0;
        $('.cls-footer').addClass('d-none');
    });
    $(this).mousemove(function(e) {
        idleTime = 0;
        $('.cls-footer').addClass('d-none');
    });
    $(this).keypress(function(e) {
        $('.cls-footer').addClass('d-none');
        idleTime = 0;
    });
});

function timerIncrement() {
    idleTime = idleTime + 1;
    if (idleTime > 3) { // 20 minutes
        //    alert('idel')
        $('.cls-footer').removeClass('d-none');
    }
}

function stiky() {
    $(function() {
        var nav = 100;
        var $window = $(window);
        var lastScrollTop = $window.scrollTop();
        var wasScrollingDown = true;

        var $sidebar = $("#left-add-root");
        if ($sidebar.length > 0) {

            var initialSidebarTop = $sidebar.position().top;

            $window.scroll(function(event) {

                var windowHeight = $window.height();
                var sidebarHeight = $sidebar.outerHeight();

                var scrollTop = $window.scrollTop();
                var scrollBottom = scrollTop + windowHeight;

                var sidebarTop = $sidebar.position().top;
                var sidebarBottom = sidebarTop + sidebarHeight;

                var heightDelta = Math.abs(windowHeight - sidebarHeight);
                var scrollDelta = lastScrollTop - scrollTop;

                var isScrollingDown = (scrollTop > lastScrollTop);
                var isWindowLarger = (windowHeight > sidebarHeight);

                if ((isWindowLarger && scrollTop > initialSidebarTop) || (!isWindowLarger && scrollTop >
                        initialSidebarTop + heightDelta)) {
                    $sidebar.addClass('fixed');
                    $('.cls-cnt').addClass('fixed-cnt');
                } else if (!isScrollingDown && scrollTop <= initialSidebarTop) {
                    $('.cls-cnt').removeClass('fixed-cnt');
                    $sidebar.removeClass('fixed');
                }

                var dragBottomDown = (sidebarBottom <= scrollBottom && isScrollingDown);
                var dragTopUp = (sidebarTop >= scrollTop && !isScrollingDown);

                if (dragBottomDown) {
                    if (isWindowLarger) {
                        $sidebar.css('top', 0 + nav);
                    } else {
                        $sidebar.css('top', -heightDelta + nav);
                    }
                } else if (dragTopUp) {
                    $sidebar.css('top', 0);
                } else if ($sidebar.hasClass('fixed')) {
                    var currentTop = parseInt($sidebar.css('top'), 10);

                    var minTop = -heightDelta + 75;
                    var scrolledTop = currentTop + scrollDelta + nav;

                    var isPageAtBottom = (scrollTop + windowHeight >= $(document).height());
                    var newTop = (isPageAtBottom) ? minTop : scrolledTop;

                    $sidebar.css('top', newTop + nav);
                }

                lastScrollTop = scrollTop;
                wasScrollingDown = isScrollingDown;
            });
        }
    });
}


function stikyRight() {
    $(function() {
        var nav = 100;
        var $window = $(window);
        var lastScrollTop = $window.scrollTop();
        var wasScrollingDown = true;

        var $sidebar = $("#right-add-root");
        if ($sidebar.length > 0) {

            var initialSidebarTop = $sidebar.position().top;

            $window.scroll(function(event) {

                var windowHeight = $window.height();
                var sidebarHeight = $sidebar.outerHeight();

                var scrollTop = $window.scrollTop();
                var scrollBottom = scrollTop + windowHeight;

                var sidebarTop = $sidebar.position().top;
                var sidebarBottom = sidebarTop + sidebarHeight;

                var heightDelta = Math.abs(windowHeight - sidebarHeight);
                var scrollDelta = lastScrollTop - scrollTop;

                var isScrollingDown = (scrollTop > lastScrollTop);
                var isWindowLarger = (windowHeight > sidebarHeight);

                if ((isWindowLarger && scrollTop > initialSidebarTop) || (!isWindowLarger && scrollTop >
                        initialSidebarTop + heightDelta)) {
                    $sidebar.addClass('fixed');
                    $('.cls-cnt').addClass('fixed-cnt');
                } else if (!isScrollingDown && scrollTop <= initialSidebarTop) {
                    $('.cls-cnt').removeClass('fixed-cnt');
                    $sidebar.removeClass('fixed');
                }

                var dragBottomDown = (sidebarBottom <= scrollBottom && isScrollingDown);
                var dragTopUp = (sidebarTop >= scrollTop && !isScrollingDown);

                if (dragBottomDown) {
                    if (isWindowLarger) {
                        $sidebar.css('top', 0 + nav);
                    } else {
                        $sidebar.css('top', -heightDelta + nav);
                    }
                } else if (dragTopUp) {
                    $sidebar.css('top', 0);
                } else if ($sidebar.hasClass('fixed')) {
                    var currentTop = parseInt($sidebar.css('top'), 10);

                    var minTop = -heightDelta + 75;
                    var scrolledTop = currentTop + scrollDelta + nav;

                    var isPageAtBottom = (scrollTop + windowHeight >= $(document).height());
                    var newTop = (isPageAtBottom) ? minTop : scrolledTop;

                    $sidebar.css('top', newTop + nav);
                }

                lastScrollTop = scrollTop;
                wasScrollingDown = isScrollingDown;
            });
        }
    });
}
</script>
</body>

</html>