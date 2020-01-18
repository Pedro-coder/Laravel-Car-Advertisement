@extends('layouts.app')
@section('custom-styles')

@endsection

@section('content')
    @include('partials.other_user_profile')
    <br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 col-sm-12 col-xs-12">

                {!!$user->about!!}

            </div>
        </div>
    </div>

@endsection

@section('extra-JS')

@endsection