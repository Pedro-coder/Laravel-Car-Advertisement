@extends('layouts.app')
@section('custom-styles')
<style type="text/css">
.carousel-control-prev {
  margin-left: -88px;
}

.carousel-control-next {
  margin-right: -85px;
}


.carousel-control {
	top: 50%;
}

.glyphicon-chevron-left, .glyphicon-chevron-right {
  color: grey;
  font-size: 40px;
}
.carousel-control-next-icon:after
{
  content: '>';
  font-size: 35px;
  color: #1e1e1e;
  width: 2px;
}

.carousel-control-prev-icon:after {
  content: '<';
  font-size: 35px;
  color: #1e1e1e;
    width: 2px;

}
</style>
@section('content')
<div class="container">
        <div class="col-md-12">
           	<div class="card">
            <div class="card-header cop-h-f-weight">
	              	Training
	              	<a href="{!! route('home') !!}">	<i class="fa fa-times-circle fl-r crs-pntr cop-cross-sign"></i></a>
	            </div>
	                        <div class="card-body" style="background-color:black">
	  	
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel"  data-interval="false">
 
  <ol class="carousel-indicators">
	 @foreach ($Trainees as $key => $item)
      <li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
   @endforeach
  </ol>
 
  <div class="carousel-inner" role="listbox">
   @foreach ($Trainees as $key => $item)
       <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
<!--            <img class="d-block img-fluid" src="{{ $item->image }}" alt="{{ $item->title }}">
 -->             
       					     <span class="pad-l-10" style="color:white"> {!! $item->title !!}</span>
          @if($item->image != null)
            <div class="row mar-t-15">
				        <div class="col-md-6">
				            <img width="500" height="300" id="ImagePreview" src="{{asset('uploads/Training/'.$item->image)}}" alt="Image" class="img-responsive"/>
				        </div>
				      <div class="col-md-6">
				        <iframe src="{{ $item->youlink }}" id="iframe_link{{$key}}" width="500" height="300" frameborder="0"   allowfullscreen></iframe>
				       </div>
				   </div>
          @else
          <div class="row mar-t-15">
            
          <div class="col-md-6">
            <iframe src="{{ $item->youlink }}" id="iframe_link{{$key}}" width="500" height="300" frameborder="0"   allowfullscreen></iframe>
           </div>
       </div>
          @endif      		
       </div>
    @endforeach
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
<span class="carousel-control-prev-icon" aria-hidden="true"></span>
    {{-- <span class="sr-only">Previous</span> --}}
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    {{-- <span class="sr-only">Next</span> --}}
  </a>
</div>
                            </div>
	 </div>    
    </div>
</div>
@endsection
