@extends('layouts.app')

@section('content')
    <section id="admin" class="admin-panel">
        <div class="container ">
            <div class="row justify-content-center user-profile-row">
                <div class="col-md-9 col-sm-12 col-xs-12">
                    <div class="card-header">
                        <h5 class="card-title pt-2"><i class="fab fa-blogger fa-2x" style="color:sandybrown"></i>
                            <strong>BLOG </strong></h5>

                    </div>
                    <div class="card-body">
                        <div>
                            <a href="{{route('my.blog')}}"> <i class="fas fa-arrow-alt-circle-left fa-3x"></i> </a>

                        </div>


                        <div class="row justify-content-center">
                            <div class="col-md-12 text-center">

                                <h2>{{$post->heading}}</h2>

                            </div>
                        </div>
                        <br>
                        <div class="row">

                            <div class="col-md-12">

                                <div class="card-img-top">
                                    <a href="">
                                        <img src="{{ asset('uploads/blog/' . $post->image) }}" style="width: 100%;">
                                    </a>
                                </div>

                            </div>
                        </div>
                        <br>
                        <div class="row">

                            <div class="col-md-12">

                                <?php echo nl2br($post->content); ?>

                            </div>
                        </div>

                        <hr>
                          <?php
                        $Reaction = App\CommentReaction::where('user_id',Auth::user()->id)->where('post_id',$post->id)->first();
                        ?>

                        <div class="emojies">
                            <div class="row emojies-btn-row" data-post-id="{{$post->id}}">

                                <div class="like-emoji">
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-default btn-sm post-reaction like-btn"
                                                style="margin-top: 9px;" data-reaction-type="like"
                                                data-reaction-state="initial">
                                            <i class="fas fa-thumbs-up"></i> Like
                                        </button>
                                        <br>
                                        <span id="like">({{$post->total_likes}})</span>
                                    </div>
                                </div>

                                <div class="dislike-emoji">
                                    <div class="col-md-1" style="margin-right:2px">
                                        <button type="button" class="btn btn-default btn-sm post-reaction dislike-btn"
                                                style="margin-top: 9px;"
                                                data-reaction-type="dislike" data-reaction-state="initial">
                                            <i class="fas fa-thumbs-down"></i> Dislike
                                        </button>
                                        <br>
                                        <span id="dislike">({{$post->total_dislikes}})</span>
                                    </div>
                                </div>

                                <div class="hurt-emoji">
                                    <div class="col-md-1" style="margin-left:30px">
                                        <button type="button" class="btn btn-default btn-sm post-reaction love-btn"
                                                style="margin-top: 9px;" data-reaction-type="love"
                                                data-reaction-state="initial">
                                            <i class="em em-heart"></i>
                                        </button>
                                        <br>
                                        <span id="love">({{$post->total_loves}})</span>
                                    </div>
                                </div>

                                <div class="smiley-emoji">
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-default btn-sm post-reaction smiley-btn"
                                                style="margin-top: 9px;" data-reaction-type="happy"
                                                data-reaction-state="initial">
                                            <i class="em em-smiley"></i></button>
                                        <br>
                                        <span id="happy">({{$post->total_happy}})</span>
                                    </div>
                                </div>

                                <div class="angry-emoji">
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-default btn-sm post-reaction angry-emoji-btn"
                                                style="margin-top: 9px;" data-reaction-type="angry"
                                                data-reaction-state="initial">
                                            <i class="em em-angry"></i></button>
                                        <br>
                                        <span id="angry">({{$post->total_angry}})</span>
                                    </div>
                                </div>

                                <div class="disappointed-emoji">
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-default btn-sm post-reaction"
                                                style="margin-top: 9px;" data-reaction-type="sad"
                                                data-reaction-state="initial">
                                            <i class="em em-disappointed_relieved"></i></button>
                                        <br>
                                        <span id="sad">({{$post->total_sad}})</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <hr>

                        @if($comments != null)

                            @foreach($comments as $comment)
                                @foreach($users as $user)
                                    @if($comment->user_id == $user->id)
                                        <div class="row">
                                            <div class="col-md-10">
                                                <?php

                                                $d = explode(" ", $comment->created_at);

                                                $dates = date_create($d[0]);

                                                $dd = date_format($dates, "j-M-Y");

                                                ?>
                                                <a href="/userprofile">
                                                    <img id="user_avatar_img"
                                                         src="{{ asset('/uploads/avatars/' . $user->avatar) }}"
                                                         style="width:50px; height:50px; border-radius:50%;"></a>
                                                <p style="margin-top:-50px !important;margin-left:63px;">{{$user->name}}
                                                    &nbsp;<i class="fa fa-calendar" aria-hidden="true"></i>
                                                    <span>{{$dd}} </span> &nbsp;

                                                    @if(Auth::user()->id == $post->user_id || Auth::user()->IsAdmin == '1')

                                                        <span>
                                            <a href="/delete_comment/{{$comment->id}}"><i class="fa fa-trash"
                                                                                          aria-hidden="true"
                                                                                          style="color:red">Delete</i> &nbsp; </a>
                                        </span>
                                                    @else

                                                        @foreach ($menu_options as $menu)

                                                            @foreach ($user_menu as $user_m)

                                                                @if(Auth::user()->id == $user_m->user_id && $menu->id == $user_m->menu_options_id && $menu->name == "Blog Admin")

                                                                    <span>
                                                        <a href="/delete_comment/{{$comment->id}}"><i
                                                                    class="fa fa-trash" aria-hidden="true"
                                                                    style="color:red">Delete</i> &nbsp; </a>
                                                    </span>

                                                                    <?php break; ?>

                                                                @endif


                                                            @endforeach

                                                        @endforeach

                                                    @endif
                                                </p>

                                                <p style="margin-top:-10px;margin-left:60px;">
                                                    <?php echo nl2br($comment->content); ?>
                                                </p>

                                            </div>
                                            <div class="col-md-2">


                                            </div>

                                        </div>
                                    @endif
                                @endforeach
                            @endforeach
                        @endif
                        <br>
                        <div class="row">
                            <div class="col-md-12">

                                <h4 style="float:left;padding:0px">Leave a Reply</h4>

                            </div>
                        </div>
                    {{-- <div class="row">
                       <div class="col-md-12">

                           <h6 style="float:left;padding:0px"><i>Your Email address will not be published.<i></h6>

                       </div>
                   </div> --}}
                    <!-- Post Comment Form -->
                        <form action="/add_comment/{{$post->id}}/{{Auth::user()->id}}" method="POST">
                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}"/>
                            {{-- <div class="row">
                            <div class="col-md-6">

                                <input class="form-control" id="name" name="person_name" type="text" placeholder="Name" aria-label="Search">


                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">

                                <input class="form-control" id="email" name="person_email" type="email" placeholder="Email" aria-label="Search">


                            </div>
                        </div>

                        <br> --}}
                            <div class="row">
                                <div class="col-md-6">

                                    <textarea class="form-control" id="post_comment" name="content" rows="5"
                                              placeholder="Message"></textarea>


                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">

                                    <button class="btn btn-primary" type="submit">Post Comment</button>

                                    @if(Auth::user()->id == $post->user_id || Auth::user()->IsAdmin == '1')
                                        <a href="/delete_post/{{$post->id}}" class="btn btn-danger">Delete Post</a>
                                    @else

                                        @foreach ($menu_options as $menu)

                                            @foreach ($user_menu as $user_m)

                                                @if(Auth::user()->id == $user_m->user_id && $menu->id == $user_m->menu_options_id && $menu->name == "Blog Admin")

                                                    <a href="/delete_post/{{$post->id}}"
                                                       class="btn btn-danger">{{$menu->id}} {{$user_m->menu_options_id}} {{$menu->name}}
                                                        Delete
                                                        Post</a>

                                                    <?php break; ?>

                                                @endif


                                            @endforeach

                                        @endforeach


                                    @endif

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('extra-JS')
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

    <script>
        /* when a user clicks, toggle the 'is-animating' class */
        $(".heart").on('click touchstart', function () {
            $(this).toggleClass('is_animating');
        });

        /*when the animation is over, remove the class*/
        $(".heart").on('animationend', function () {
            $(this).toggleClass('is_animating');
        });

        $('.post-reaction').on('click', function () {

            var self = this;
            var reaction_type = $(this).data('reaction-type');
            var post_id = $(this).parent().parent().parent().data('post-id');

            var reaction_state = $(this).data('reaction-state');

            var span = $(this).parent().find('span')[0];
            var button_type = $(span).attr('id');

            // console.log(button_type);

            if (reaction_state == 'initial') {

                $(this).data('reaction-state', button_type);
                reaction_state = button_type;

            } else {

                $(this).data('reaction-state', 'initial');
                reaction_state = 'initial';
            }


            $.ajax({
                type: 'POST',
                url: "{{url('/blog/update/reaction')}}",
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                },
                data: "reaction_type=" + reaction_type + "&post_id=" + post_id + "&reaction_state=" + reaction_state,
                success: function (data) {

//console.log(data);


                    $('#like').text('(' + data.like + ')');
                    $('#dislike').text('(' + data.dislike + ')');
                    $('#happy').text('(' + data.happy + ')');
                    $('#sad').text('(' + data.sad + ')');
                    $('#angry').text('(' + data.angry + ')');
                    $('#love').text('(' + data.love + ')');

                },
                error: function (error) {
                    console.log(error);
                }
            });

        });


    </script>

@endsection
