@extends('layouts.app')
@section('open-graph')

    @if(isset($open_graph))
        <meta property="og:url" content="{{ $open_graph['url'] }}"/>
        <meta property="og:type" content="website"/>
        <meta property="og:title" content="{{ $open_graph['title'] }}"/>
        <meta property="og:description" content="{{ $open_graph['description'] }}"/>
        <meta property="og:image" content="{{ $open_graph['image'] }}"/>
    @endif
@endsection

@section('custom-styles')


        @if(isFollowing(Auth::user()->id, $user->id))
            <style>
                .following-dropdown {
                    display: block;
                }

                .follow-btn {
                    display: none;
                }
            </style>
        @else
            <style>
                .following-dropdown {
                    display: none;
                }

                .follow-btn {
                    display: block;
                }
            </style>
        @endif

@endsection






@section('content')
<div class="fb-messengermessageus" messenger_app_id="95100348886" page_id="XYZ" color="blue" size="large"></div>
@include('pages.taxi.PopUp')
@include('partials.other_user_profile')
@include('pages.taxi.PopUpJsCss') 
@endsection

@section('extra-JS')

   @include('partials.other_user_profile_js')


@endsection