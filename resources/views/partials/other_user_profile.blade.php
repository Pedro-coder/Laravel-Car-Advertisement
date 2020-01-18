<div class="container-fluid">
    <div class="row justify-content-center user-profile-row">
        <div class="col-md-12 col-sm-12 col-xs-12">

            <img src="{{ asset('/uploads/covers/' . $user->cover_img) }}" width="100%" height="250"/>

            <div class="search-box">
                <input type="text" placeholder="Search Users" class="search-in" id="search" name="search" autocomplete="off">

                <table class="table table-bordered table-hover text-success user-search-table">
                    <tbody id="tbod">
                    </tbody>
                </table>
            </div>

            <ul class="fol-btn">

                <li>
                    <button type="button" class="more-options-btn-dots"><i class="fas fa-ellipsis-h"></i></button>
                </li>

                <li>
                    <a href="{{$chatRoute}}">
                        <button type="button" class="message-btn"><i class="fab fa-facebook-messenger"></i> Message</button>
                    </a>
                </li>

                <li>
                    <div class="dropdown following-dropdown">
                        <button class="btn btn-light dropdown-toggle following-button" type="button" id="dropdownMenu2" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-check" aria-hidden="true"></i> Following
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                            <button class="dropdown-item" type="button" onclick="followUser({{$user->id}}, 0)">Unfollow</button>

                        </div>
                    </div>

                    <div class="follow-btn">
                        <a href="javascript:void(0)" onclick="followUser({{$user->id}}, 1)" class="follow-link">
                            <i class="fa fa-rss" aria-hidden="true"></i> Follow
                        </a>
                    </div>
                </li>


            </ul>


            <div class="row">
                <div class="col user-profile-menu-bar">
                    <div class="row">
                        <div class="col-md-2 col-sm-12 col-xs-12">
                            <img class="profile-image other-user-profile-image" src="{{ asset('/uploads/avatars/' . $user->avatar) }}"
                                 id="avatar-img" height="140" width="140"/>
                        </div>
                        <div class="col-md-10 col-sm-12 col-xs-12 rating-share-mobile-view">
                            <div class="row">

                                <div class="col">
                                    <input id="input-2-mobile-view" name="input-2" class="rating rating-loading user-rating"
                                           value="{{userReview(Auth::user()->id, $user->id)}}">

                                </div>


                                <div class="col">
                                    <div class="caption" style="padding-top: 1em;">
                                        <span class="averageReview">{{averageReview($user->id)}}</span>/<span
                                                class="totalReview">{{totalReview($user->id)}}</span>

                                    </div>
                                </div>


                                <div class="col">
                                    <img src="{{ asset('img/icon.png') }}" width="30px" height="30px"
                                         onclick="share({{$user->id}})" style="float: right;"/>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-10 col-sm-12 col-xs-12">
                            <nav class="navbar navbar-expand-lg navbar-light user-profile-navbar">

                                {{-- <a class="navbar-brand" href="#">Navbar</a>--}}
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                                        aria-controls="navbarNav"
                                        aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse" id="navbarNav">
                                    <ul class="navbar-nav user-profile-menu">
                                        <li class="nav-item r-l-no-border rating-share-desktop-view">
                                            <input id="input-3" name="input-3" class="rating rating-loading user-rating"
                                                   value="{{averageReview($user->id)}}">
                                        </li>
                                        <li class="nav-item no-borders rating-share-desktop-view">
                                            <div class="caption">
                                                <span class="averageReview">{{averageReview($user->id)}}</span>/
                                                <span id="totalReview">{{totalReview($user->id)}}</span>
                                            </div>
                                        </li>
                                        <li class="nav-item no-borders rating-share-desktop-view">
                                            <img src="{{ asset('img/icon.png') }}" width="30px" height="30px"
                                                 onclick="share()"/>
                                        </li>
                                        <li class="nav-item">
                                            <span class="nav-link" style=""><i style="border-left: 2px solid #b066b3;padding: 2px"></i><i class="fas fa-map-marker" style="color: #54545a"></i>&nbsp;<?php 
                                            if($user->location === NULL) {
                                                echo 'Location Not set';
                                            }
                                            else{
                                                $date = new DateTime("now", new DateTimeZone($user->location)); 
                                                echo $date->format('D M j, Y, g:i:s A');
                                                echo '&nbsp'.$user->location;
                                            }


                                            ?></span>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('user.profile.timeline',$user->id)}}">Timeline</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('about.otherUserProfile',$user->id)}}">About</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('user.profile.blog', $user->id)}}">Blog</a>
                                        </li>
                                        <li>
                                            <a class="nav-link" href="{{route('bids.user.other',['id'=>$user->id])}}">Bids</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Event</a>
                                        </li>
                                        <!-- <li class="nav-item">
                                            <a class="nav-link" href="#">Promotions</a>
                                        </li> -->
                                        @if(getMoreMenuOptionActive($user->id) > 0)
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                                               data-toggle="dropdown"
                                               aria-haspopup="true" aria-expanded="false">
                                                More
                                            </a>
                                            <div class="dropdown-menu user-profile-more-dropdown-menu"
                                                 aria-labelledby="navbarDropdownMenuLink">
                                                <a class="dropdown-item" href="{{route('wallet')}}">Wallet</a>
                                                <a class="dropdown-item" href="#">Order Book</a>
                                                <a class="dropdown-item" href="{{route('post.bids')}}">Offer Book</a>
                                                <a class="dropdown-item" href="{{route('post.old')}}">Old Post</a>
                                                <a class="dropdown-item" href="{{route('profile')}}">Personal Info</a>
                                                <a class="dropdown-item" href="{{route('membership')}}">Membership</a>
                                                <a class="dropdown-item" onclick="accountstatusfun()" href="#">Account status</a>
                                            </div>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<input type="hidden" value="{{$user->id}}" id="reviewable_id">