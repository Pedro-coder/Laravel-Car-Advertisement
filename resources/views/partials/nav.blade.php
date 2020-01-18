<?php
use Illuminate\Support\Facades\DB;
$site_info = DB::table('site_info')->get();
$info_element_array = array();
foreach ($site_info as $info_element) {
    $info_element_array[$info_element->attr_name] = $info_element->attr_value;
}
?>
<style>
.fixed-top {
    opacity:0.9;
    z-index: 2222222222;
    top: 0px;
    position: fixed;
    width: 100%;
    background:#000;
}
.fixed-top .bg-light{
    background:#000 !important;
}
.fixed-side-bar{
    top: 80px;
    position: fixed;
}
</style>
<script>

$( document ).ready(function() {
  console.log( "document ready!" );
  $(window).scroll(function(){ // scroll event
      var windowTop = $(window).scrollTop(); // returns number
      if (165 < windowTop) {
        $('.cls-top-navbar').addClass('fixed-top');
      } else {
        $('.cls-top-navbar').removeClass('fixed-top');
      }
    });
    
});
</script>
<nav class="navbar cls-top-navbar  navbar-expand-lg navbar-light bg-light" {{--style="background-image: url('/uploads/avatars/{{$info_element_array['header_right_pic']}}'); background-size: cover;"--}}>
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ URL::asset('uploads/avatars/'.$info_element_array['header_left_pic']) }}" alt="Brand Logo"
                 style="height: 50px;"> {{$info_element_array['site_name']}}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto" style="float:right">
                <li class="nav-item dropdown mt-4">
                    @auth
                    @if (Auth::user()->avatar)
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false" v-pre
                           style="position:relative; padding-left:50px;">
                            {{ Auth::user()->name }}
                            <a href="{{url('/userprofile')}}"> <img src="{{ asset('/uploads/avatars/' . Auth::user()->avatar) }}"
                                                                    style="width:32px; height:32px; position:absolute; top:0px; left:10px; border-radius:50%">
                            </a>
                            <span class="caret"></span>
                        </a>
                    @else
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false" v-pre
                           style="position:relative; padding-left:50px;">
                            {{ Auth::user()->name }}
                            <img src="{{ asset('img/default.png') }}"
                                 style="width:32px; height:32px; position:absolute; top:0px; left:10px; border-radius:50%">
                            <span class="caret"></span>
                        </a>
                    @endif
                    @endauth
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
<!-- 
                        <a class="dropdown-item" href="{{ route('trainuser') }}">
                            Training
                        </a>
                        <a class="dropdown-item" href="{{ route('examuser') }}">
                            Exam
                        </a> -->
                        <!-- <a class="dropdown-item" href="{{ route('settings') }}">
                            Settings
                        </a> -->
                        
                        <!-- <a class="dropdown-item" href="{{ route('faq.category.index') }}">
                            FAQ Category
                        </a> -->
                        <?php
                        if (Auth::user()) {
                        $login_user_id = Auth::user()->id;
                        $users_manus = DB::table('menu_options')
                            ->join('user_menu', 'user_menu.menu_options_id', '=', 'menu_options.id')
                            ->where('menu_options.id', "!=", 14)
                            ->where('menu_options.name', "!=", "Blog Admin")
                            ->where('menu_options.name', "!=", "Event Admin")
                            ->where('menu_options.name', "!=", "Category Setup")
                            ->where('menu_options.name', "!=", "More Admin")
                            ->where('menu_options.name', "!=", "Dispute Manager")
                            ->where('menu_options.name', "!=", "Bid Admin")
                            ->where('menu_options.name', "!=", "Training Setup")
                            ->where('menu_options.name', "!=", "Exam Setup")
                            ->where('menu_options.name', "!=", "Upcoming Services")
                            ->where('user_menu.user_id', $login_user_id)->get();
                            $help_desk_label = '';
                            $help_desk_link = '';
                             foreach ($users_manus as $users_manu){
                                    if($users_manu->name == 'HelpDesk'){
                                        $help_desk_label = $users_manu->name;
                                        $help_desk_link = $users_manu->link;
                                    }else{
                                        ?>
                                        <a class="dropdown-item" href="{{ url($users_manu->link) }}"><?php echo $users_manu->name; ?></a>
                                        <?php
                                    }
                                }
                            }
                            ?>
                           
                        <!-- <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a> -->

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                <!-- Authentication Links -->
                @guest
                   <!--  <li class="nav-item">
                        <a class="nav-link" href="{{ route('blog') }}">
                            <i class="fab fa-blogger fa-2x" style="color:sandybrown"></i>
                        </a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="far fa-user-circle fa-2x"></i>
                        </a>
                    </li>
                    <!-- <li>
                        <div class="dropdown" style="margin-top:9px;!important">
                            <button class="btn btn-default dropdown-toggle look-like-btn" type="button" data-toggle="dropdown">More
                                <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li><a href="#" style="text-decoration: none;">About Us</a></li>
                                
                                <li>
                                    Helps
                                    <ul class="list-group">
                                        <li class="list-group-item">Faq</li>
                                        <li class="list-group-item">Dispute</li>
                                    </ul>
                                </li>
                                <li><a href="{{ URL('/upcoming_services') }}" style="text-decoration: none;">Upcoming Services</a></li>
                            </ul>
                        </div>
                    </li> -->
                     <li class="nav-item mt-2">
                     <a href="{{ route('aboutus')}}" style="text-decoration: none;font-size: 17px;">&nbsp;&nbsp;&nbsp;About Us</a></li>
                            
                    </li>
                @else
                <!-- <li class="nav-item mt-4">
                                <a class="nav-link" href="{{ route('login') }}">
                                   <i class="fas fa-signal fa-1x"></i>
                                   Sort
                                </a>
                            </li> -->
                    <li class="nav-item mt-4">
                        <a class="nav-link" href="/public-blog">

                            <i class="fab fa-blogger fa-2x" style="color:sandybrown"></i>
                        </a>

                    </li>

                    <li class="nav-item mt-4">
                        <a class="nav-link" href="{{ route('chatdashboard') }}">
                            <i class="fas fa-comments fa-1x"></i>
                            Chat
                        </a>
                    </li>

                    

                    <li class="nav-item mt-4">
                        <a class="nav-link" href="{{ URL('/saved_posts') }}">
                            <i class="fas fa-star fa-1x"></i>
                            Saved
                        </a>
                    </li>
                    <li class="nav-item mt-4">
                        <a class="nav-link" href="#"  id="newpost"><i class="fas fa-plus-circle fa-1x"></i> Post</a>
                    </li>
                    

                    <li class="nav-item mt-4">
                        <div class="dropdown" >
                            <button class="btn btn-default dropdown-toggle look-like-btn nav-link" type="button" data-toggle="dropdown">More
                                <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li class="extras-item"><a class="dropdown-item" href="{{route('aboutus')}}" style="text-decoration: none;">About Us</a></li>
                                </li>
                                <li class="extras-item"><a class="dropdown-item" style="text-decoration: none;" href="{{ url('/privateChat/'.Auth::id().',55'.'/'.Auth::id().'/0') }}">Help Desk</a></li>
                                 <li class="extras-item"><a class="dropdown-item" href="{{ route('faquser') }}" style="text-decoration: none;">FAQ</a></li>
                                <li class="extras-item"><a class="dropdown-item" href="/dispute" style="text-decoration: none;">Dispute</a></li>
                                <li class="extras-item"><a class="dropdown-item" href="{{ URL('/upcoming_services') }}" style="text-decoration: none;">Upcoming Services</a></li>
                               <li class="extras-item ml-4">
                                    <a class="dropdown-item" href="{{ route('login') }}"
                                       data-toggle="modal" data-target="#filter-modal">
                                        <i class="fas fa-sliders-h fa-1x"></i>
                                        Filters
                                    </a>
                                </li>
                                <li class="extras-item ml-4 dropdown-submenu">
                                    <!-- <i class="fas fa-plus-circle fa-1x"></i> Post</span> -->
                                    <ul>
                                        <!-- <li class="extras-item"><a class="dropdown-item" href="{{ route('buyer.create') }}">
                                            Want to buy
                                        </a></li>
                                        <li class="extras-item"><a class="dropdown-item" href="{{ route('seller.create') }}">
                                            Want to Sell
                                        </a></li>
                                        <li class="extras-item"><a class="dropdown-item" href="{{ route('article.create') }}">
                                            Article Post
                                        </a></li>
                                        <li class="extras-item"><a class="dropdown-item" href="{{ route('AdvertisementPage') }}">
                                            Advertisement
                                        </a></li> -->
                                        <li class="extras-item"><a class="dropdown-item" href="{{ route('coupons') }}">
                                            Coupon
                                        </a></li>
                                        <li class="extras-item"><a class="dropdown-item" href="{{ url('CategorySetup') }}">
                                            Category Setup
                                        </a></li>
                                        
                                        <li class="extras-item">
                                            <a class="dropdown-item" href="{{ route('trainuser') }}">
                                                Training
                                            </a></li>
                                        <li class="extras-item">
                                            <a class="dropdown-item" href="{{ url('/trainsetup') }}">
                                                Training Setup
                                            </a></li>
                                        <li class="extras-item">
                                            <a class="dropdown-item" href="{{ route('examuser') }}">
                                                Exam
                                            </a></li>
                                            <li class="extras-item">
                                            <a class="dropdown-item" href="{{ url('/examsetup') }}">
                                                Exam Setup
                                            </a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>

                    </li>
                    <li class="nav-item mt-4">
                         <a class="dropdown-item nav-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i>
                            {{ __('Logout') }}
                        </a>
                    </li>


                @endguest
            </ul>
        </div>
        <!-- <div class="dropdown">
            <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">More
            <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li>About Us</li>
                <li>Help Us</li>
                <li>Upcoming Services</li>
            </ul>
        </div> -->
    </div>
</nav>
       
