<div class="container-fluid">
    <div class="row justify-content-center user-profile-row">
        <div class="col-md-12 col-sm-12 col-xs-12">

            <img src="{{ asset('/uploads/covers/' . Auth::user()->cover_img) }}" width="100%" height="250"/>

            <div class="upload">
                <form action="{{route('updateImage')}}" method="post" enctype="multipart/form-data" id="img-form">
                    {{csrf_field()}}
                    <input type="file" name="cover_photo" hidden id="image_file">
                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                    <a href="" id="upload_cover" onclick="selectImage()"><i class="fas fa-camera"></i></a>
                </form>
            </div>

            <div class="search-box">
                <input type="text" placeholder="Search Users" class="search-in" id="search" name="search"
                       autocomplete="off">

                <table class="table table-bordered table-hover text-success user-search-table">
                    <tbody id="tbod">
                    </tbody>
                </table>
            </div>



            <div class="row">
                <div class="col user-profile-menu-bar">
                    <div class="row">
                        <div class="col-md-2 col-sm-12 col-xs-12">
                            <img class="profile-image" src="{{ asset('/uploads/avatars/' . Auth::user()->avatar) }}"
                                 id="avatar-img" height="140" width="140"/>
                        </div>


                        <div class="col-md-10 col-sm-12 col-xs-12 rating-share-mobile-view">
                            <div class="row">

                                <div class="col">
                                    <input id="ownRatingMobile" name="ownRating" class="rating rating-loading own-rating"
                                           value="{{averageReview(Auth::user()->id)}}" style="padding-top: 8px;">
                                </div>


                                <div class="col">
                                    <div class="caption">
                                        <span id="averageReview">{{averageReview(Auth::user()->id)}}</span>/<span
                                                id="totalReview">{{totalReview(Auth::user()->id)}}</span>
                                    </div>
                                </div>


                                <div class="col">
                                    <img src="{{ asset('img/icon.png') }}" width="30px" height="30px"
                                         onclick="share({{Auth::user()->id}})" style="float: right;"/>
                                </div>
                            </div>

                        </div> 


                        <div class="col-md-10 col-sm-12 col-xs-12">
                            <nav class="navbar navbar-expand-lg navbar-light user-profile-navbar">


                                {{-- <a class="navbar-brand" href="#">Navbar</a>--}}
                                <button class="navbar-toggler" type="button" data-toggle="collapse"
                                        data-target="#navbarNav"
                                        aria-controls="navbarNav"
                                        aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse" id="navbarNav">
                                    <ul class="navbar-nav user-profile-menu">
                                        <li class="nav-item r-l-no-border rating-share-desktop-view">
                                            <input id="ownRating" name="ownRating"
                                                   class="rating rating-loading own-rating"
                                                   value="{{averageReview(Auth::user()->id)}}"
                                                   style="padding-top: 8px;">
                                        </li>
                                        <li class="nav-item no-borders rating-share-desktop-view">
                                            <div class="caption">
                                                <span id="averageReview">{{averageReview(Auth::user()->id)}}</span>/<span
                                                        id="totalReview">{{totalReview(Auth::user()->id)}}</span>
                                            </div>
                                        </li>
                                        <li class="nav-item no-borders rating-share-desktop-view">
                                            <img src="{{ asset('img/icon.png') }}" width="30px" height="30px"
                                                 onclick="share()"/>

                                        </li>
                                        <li class="nav-item">
                                            <span class="nav-link" style=""><i style="border-left: 2px solid #b066b3;padding: 2px"></i><i class="fas fa-map-marker" style="color: #54545a"></i>&nbsp;<?php 
                                            if (Auth::user()->location === NULL) {
                                                echo 'Location not set';
                                            }
                                            else{
                                                $date = new DateTime("now", new DateTimeZone(Auth::user()->location)); echo $date->format('D M j, Y, g:i:s A');
                                                echo '&nbsp'.Auth::user()->location;
                                            }
                                            ?></span>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('timeline')}}">Timeline</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('about')}}">About</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('my.blog')}}">Blog</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('bids.user.index')}}">Bids</a>
                                        </li>
                                        <li class="nav-item">
                                            <!-- Dropdown Menu Design -->
                                            <style>
                                            .dropbtn {
                                              border: none;
                                            }

                                            .dropdown {
                                              position: relative;
                                              display: inline-block;
                                            }

                                            .dropdown-content {
                                              display: none;
                                              position: absolute;
                                              background-color: #f1f1f1;
                                              min-width: 160px;
                                              box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                                              z-index: 1;
                                            }

                                            .dropdown-content a {
                                              color: black;
                                              padding: 12px 16px;
                                              text-decoration: none;
                                              display: block;
                                            }

                                            .dropdown-content a:hover {background-color: #ddd;}

                                            .dropdown:hover .dropdown-content {display: block;}
                                            </style>
                                            <div class="dropdown">
                                            <a class="nav-link dropbtn" href="{{route('activeEvent')}}">Event</a>
                                              <div class="dropdown-menu user-profile-more-dropdown-menu dropdown-content" aria-labelledby="navbarDropdownMenuLink">
                                                <a href="{{route('goingEvent')}}" class="dropdown-item">Going event</a>
                                                <a href="{{route('pastEvent')}}" class="dropdown-item">Past event</a>
                                                <a href="{{route('closeEvent')}}" class="dropdown-item">Close event</a>
                                              </div>
                                            </div>
                                        </li>
                                        <!-- <li class="nav-item">
                                            <a class="nav-link" href="#">Promotions</a>
                                        </li> -->
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
