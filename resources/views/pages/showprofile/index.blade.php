@extends('layouts.app')
@section('open-graph')

@if(isset($open_graph))
<meta property="og:url" content="{{ $open_graph['url'] }}" />
<meta property="og:type" content="website" />
<meta property="og:title" content="{{ $open_graph['title'] }}" />
<meta property="og:description" content="{{ $open_graph['description'] }}" />
<meta property="og:image" content="{{ $open_graph['image'] }}" />
@endif
@endsection



@section('content')

<div class="fb-messengermessageus" messenger_app_id="95100348886" page_id="XYZ" color="blue" size="large"></div>

@include('partials._user-profile')
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9 col-sm-12 col-xs-12">

            <!-- <a href="{{url('generate-pdf')}}"><img src="{{url('img/download.png')}}" style="height: 25px ;width: 33px;"> </a>

                <a href="#" style="padding-top:0.25rem; margin-left: 2.75rem; color:#00CD00;" data-toggle="modal"
                   data-target="#myModal"><i class="fas fa-play-circle" style="padding-right: 1rem;"></i>Play Video</a>
                <i class="fa fa-map-marker" aria-hidden="true" style="margin-left: 0"> United State | </i>
 -->
            <form method="post" action="{{url('about/userProfile')}}">
                {{csrf_field()}}
                <input type="hidden" name="userIdAbout" value="{{Auth::user()->id}}">

                <div class="card-body">
                    <div class="form-group">
                        <textarea class="form-control form-control-lg " id="editor" name="about"
                            rows="8">{{Auth::user()->about}}</textarea>
                    </div>
                    <div class="form-group mb-2">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success btn-lg float-right">
                                Update
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
            <div class="exampleSlider">
                <div class="MS-content">
                    @php
                    $PleftAds = \App\library\SiteHelper::getLeftAds('profile',Auth::user()->id)->toArray();
                    $PrightAds = \App\library\SiteHelper::getRightAds('profile',Auth::user()->id)->toArray();
                    $PbotAdsot = \App\library\SiteHelper::getBottomAds('profile',Auth::user()->id)->toArray();
                    $allAdsP = array_merge($PleftAds,$PrightAds,$PbotAdsot);
                    @endphp
                    @foreach($allAdsP as $bottomAd)
                    <div class="item">
                        <a href="{{ 'http://'.$bottomAd['image_link'] }}"><img height="50px"
                                style="max-height:100px;height:100px"
                                src="{{ asset('/uploads/adsImages/'.$bottomAd['image']) }}" class="img-responsive"></a>
                        <span>{{$bottomAd['adds_name']}} </span>

                    </div>
                    @endforeach


                    <div class="MS-controls">
                        <button class="MS-left"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
                        <button class="MS-right"><i class="fa fa-chevron-right" aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>
</div>


<div class="modal fade" id="playVideo" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Video Link</h4>
            </div>
            <div class="modal-body">
                <input type="text" onkeyup="videoFunction()" id="videoId" class="form-control mr-sm-2"
                    placeholder="Youtube Link">
                <div class="col-md-6">
                    <iframe src="https://www.youtube.com/watch?v=UqNJb0mWJ20" id="iframe_link" width="400" height="300"
                        frameborder="0" allowfullscreen></iframe>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
@endsection
@section('extra-JS')
@endsection