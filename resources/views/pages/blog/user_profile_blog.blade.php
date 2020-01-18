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

    @include('partials.other_user_profile_css')

@endsection



<div class="fb-messengermessageus" messenger_app_id="95100348886" page_id="XYZ" color="blue" size="large"></div>



@section('content')

    @include('partials.other_user_profile')

    <section id="admin" class="admin-panel">
        <div class="container ">
            <div class="row justify-content-center user-profile-row">
                <div class="col-md-9 col-sm-12 col-xs-12">

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title pt-2"><i class="fab fa-blogger fa-2x" style="color:sandybrown"></i><strong>BLOG </strong><a
                                        href="{{ URL('/home') }}"><i class="fa fa-times-circle fl-r crs-pntr"
                                                                     style="font-size:27px;color:#6c757d;"></i></a></h5>

                        </div>
                        <div class="card-body">
                            <div style="float:right">

                                {{--<a href="/my-blog"> <i class="fas fa-spinner fa-pulse"></i> &nbsp My Blog &nbsp </a>
                                <a href="/public-blog"> <i class="fas fa-spinner fa-pulse"></i> &nbsp Public Blog &nbsp</a>--}}
                                {{--<a href="/add-blog"> <i class="fas fa-plus"></i> &nbsp Add Blog &nbsp</a>--}}

                            </div>

                            <br><br><br>


                            @foreach ($posts as $post)
                                <div class="row">
                                    <div class="col-md-4">

                                        <div class="card-img-top">
                                            <a href="/blod-details/{{$post->id}}">
                                                <img src="{{ asset('uploads/blog/' . $post->image) }}" style="width: 100%;">
                                            </a>
                                        </div>

                                    </div>

                                    <div class="col-md-8">

                                        <?php

                                        $d = explode(" ", $post->created_at);

                                        $dates = date_create($d[0]);

                                        $dd = date_format($dates, "j-M-Y");

                                        ?>
                                        <a href="/blod-details/{{$post->id}}">
                                            <h2 style="float:left;padding:0px">{{$post->heading}}</h2>
                                        </a>
                                        <h6 style="margin-top: 46px !important;"><i>Published on {{$dd}}</i></h6>
                                        {{-- {{$post->content}} --}}
                                        @if(strlen($post->content) > 90)
                                            {{str_limit($post->content, 100, '....')}} <a href='/blod-details/{{$post->id}}' class=''>Read More</a>
                                        @else
                                            {{$post->content}}
                                        @endif
                                    </div>
                                </div>
                                <br>
                            @endforeach


                            {{$posts->appends(['sort' => 'votes'])->render()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <input type="hidden" value="{{$user->id}}" id="reviewable_id">


@endsection

@section('extra-JS')

    @include('partials.other_user_profile_js')


@endsection