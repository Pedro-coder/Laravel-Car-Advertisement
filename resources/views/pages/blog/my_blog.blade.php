@extends('layouts.app')

@section('content')

    @include('partials._user-profile')
    <section id="admin" class="admin-panel">
        <div class="container ">
            <div class="row justify-content-center user-profile-row">
                <div class="col-md-9 col-sm-12 col-xs-12">

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title pt-2"><i class="fab fa-blogger fa-2x" style="color:sandybrown"></i>
                                <strong>BLOG </strong>
                                {{--    <a href="{{ URL('/home') }}">
                                        <i class="fa fa-times-circle fl-r crs-pntr" style="font-size:27px;color:#6c757d;"></i>
                                    </a>--}}
                                <a href="{{route('add.blog')}}" class="add-blog btn btn-primary-blue lightbox pd10"><i class="fas
                                 fa-pencil-alt"></i> Add Blog </a>
                            </h5>

                        </div>
                        <div class="card-body">
                            {{--<div style="float:right">

                                --}}{{--<a href="/my-blog"> <i class="fas fa-spinner fa-pulse"></i> &nbsp My Blog &nbsp </a>
                                <a href="/public-blog"> <i class="fas fa-spinner fa-pulse"></i> &nbsp Public Blog &nbsp</a>--}}{{--
                                <a href="{{route('add.blog')}}"> <i class="fas fa-plus"></i> &nbsp Add Blog &nbsp</a>

                            </div>--}}

                            <br>


                            @foreach ($posts as $post)
                                <div class="row">
                                    <div class="col-md-5 col-sm-12 col-xs-12">

                                        <div class="card-img-top blog-post-image">
                                            <a href="/blod-details/{{$post->id}}">
                                                <img src="{{ asset('uploads/blog/' . $post->image) }}">
                                            </a>
                                        </div>

                                    </div>

                                    <div class="col-md-7 col-sm-12 col-xs-12 text-card ">

                                        <?php

                                        $d = explode(" ", $post->created_at);

                                        $dates = date_create($d[0]);

                                        $dd = date_format($dates, "j-M-Y");

                                        ?>
                                        <a href="{{route('blog.article.detail', $post->id)}}" class="blog-post-content-heading">
                                            <h3>{{$post->heading}}</h3>
                                        </a>
                                        <small>
                                            Published on: <i class="far fa-clock"></i> {{$dd}}
                                        </small>
                                        <br>

                                        @if(strlen($post->content) > 90)
                                            {{str_limit($post->content, 100, '....')}}
                                                <br>
                                            <a href="{{route('blog.article.detail', $post->id)}}"
                                               class='btn btn-primary-blue lightbox'>
                                                Read More
                                            </a>
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

@endsection

@section('extra-JS')
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

    <script>

        tinymce.init({
            selector: 'textarea',
            plugins: "link code wordcount",
            menubar: 'false'
        });
    </script>

@endsection
