<?php
use Illuminate\Support\Facades\DB;
$site_info = DB::table('site_info')->get();
$info_element_array = array();
foreach ($site_info as $info_element){
    $info_element_array[$info_element->attr_name] = $info_element->attr_value;
}
?>
@php
    $currentPage = 'otherpages';
$adsUserId = 0;
@endphp
@if (isset($controller) && $controller == 'UserController')
    @php
        $currentPage = 'profile';
    $adsUserId = $user->id;
    @endphp
@endif
   <!-- CSS -->
    <link href="{{url('/slider')}}/css/custom.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

<div class="second-nav">

    <div class="">
<div class="exampleSlider">
       <div class="MS-content">
    @php

      $topadd = \App\library\SiteHelper::getTopAds($currentPage,$adsUserId);
        @endphp
     @foreach($topadd as $k => $bottomAd)
		<div class="item">
			<a href="{{ 'http://'.$bottomAd->image_link }}"><img height="50px" style="max-height:100px;height:100px" src="{{ asset('/uploads/adsImages/'.$bottomAd->image) }}" class="img-responsive"></a>
            <span>{{$bottomAd->adds_name}} </span>
           
		</div>
        @endforeach
	</div>
       <div class="MS-controls">
           <button class="MS-left"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
           <button class="MS-right"><i class="fa fa-chevron-right" aria-hidden="true"></i></button>
       </div>
   </div>
     
    </div>
</div>


    <!-- Include jQuery -->
    <script src="{{url('/slider')}}/js/jquery-2.2.4.min.js"></script>

    <!-- Include Multislider -->
    <script src="{{url('/slider')}}/js/multislider.min.js"></script>

    <!-- Initialize element with Multislider -->
    <script>
    $('.exampleSlider').multislider({
        interval: 4000,
        slideAll: false,
        duration: 1500
    });
    </script>
    <style>

      .exampleSlider .MS-content .item{
        width:20% !important;
        max-height:120px;
        height:120px;
      }
      .exampleSlider .MS-content .item img{
          width:100% !important;
      }
.exampleSlider {
  border:0px !important;
}
.exampleSlider .MS-content{
  margin:2px 5% !important;
  border:0px !important;
}
      </style>