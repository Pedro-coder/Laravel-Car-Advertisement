@extends('layouts.app')

@section('content')
<style>
    .modal-content {
        position: relative;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-direction: column;
        flex-direction: column;
        width: 70%;
        pointer-events: auto;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid rgba(0,0,0,.7);
        border-radius: .5rem;
        outline: 10px;
        padding:10px;
        margin-left: auto;
        margin-right: auto;
    }
</style>
<div class="card modal-content">
    <div>
        <a style="float:right" href="{{url('/home')}}"><i class="fas fa-times"></i></a>
        <p>{!! $about_us !!}</p>
    </div> 
  
</div>

@endsection
