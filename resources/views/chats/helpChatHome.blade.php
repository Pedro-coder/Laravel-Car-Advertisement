<!DOCTYPE html>
<?php
use Illuminate\Support\Facades\DB;
use App\Chatroom;
$site_info = DB::table('site_info')->get();
$info_element_array = array();
foreach ($site_info as $info_element){
    $info_element_array[$info_element->attr_name] = $info_element->attr_value;
}
?>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if ($setting = \App\Setting::first())
        <meta name="pusher_app_key" content='{{ $setting->pusher_app_key }}'>
        <meta name="pusher_app_cluster" content='{{ $setting->pusher_app_cluster }}'>
    @endif


    <link rel="shortcut icon" type="image/png" href="/uploads/avatars/{{$info_element_array['logo_pic']}}"/>
    <title>{{$info_element_array['test_next_to_logo']}}</title>
    @include('partials.JS')
<!-- Styles -->
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script> --}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> --}}

    <link href="{{ asset('chat/app.css') }}" rel="stylesheet">
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
            'user' =>  auth()->user()
        ]) !!};
        var fetchChatURL = null;
    </script>


</head>
<body >

<script>
    var roomid="{{  $roomId }}";
</script>
@include('partials.nav')
<div class="partialnavinchat">
    @include('partials.second_nav')
</div>

<div class="container divbox"  id="appchat">
    {{--<div>--}}

    {{--<a style="float:right" href="{{url('/home')}}"><i class="fas fa-times"></i></a>--}}
    {{--</div>--}}

    <div style="float:letf" class="col-md-4 float-left chatdashboard" id="reg">

        <div class="topleftchatdiv" >
            <input type="text" placeholder="Search with name" class="form-control search-box" id="search" name="search" autocomplete="off">

            <a class="btn dropdown-toggle alink" href="#" role="button" id="drop" data-toggle="dropdown" aria-expanded="true">
                All conversation
            </a>

            <div class="dropdown-menu">

                <ul>
                    <li class="dropdown-item "  id="unrea" aria-expanded="true" >Unread</li>

                    <li class="dropdown-item" href="#">Archive</li>
                    <li  class="dropdown-item "  aria-expanded="true" id="sss">Spam</li>

                    <li class="dropdown-item" id="report" aria-expanded="true">Report</li>
                </ul>


                <div id="lll">

                </div>
            </div>



            {{-- spam body --}}
            <div id="spambody" >

            </div >
            {{-- unread body --}}
            <div id="unread" >

            </div>
            {{--report body --}}
            <div id="reportbody" >

            </div>
            {{-- level --}}
            {{--<div id="indeviduallevelsearch">

            </div>--}}

            {{-- <table class="table table-bordered table-hover text-success" >


                <tbody id="tbod">

                </tbody>

            </table> --}}

        </div>



        <div class="chat-members">
            <ul class="table" >

                @foreach($receivers as $receiver)


                    @php


                        //$userid = Auth::user()->id;
                        
                        $userid = 55;

                        $receiverid = $receiver->id;
                        //echo $receiverid;

                        if($userid == $receiverid){
                            continue;
                        }

                        if($receiverid > $userid){
                            
                            $chatRoomId = $userid.','.$receiver->id;
                            //$chatRoomId = $userid.','.$receiverid;
                        }
                        else{
                            $chatRoomId = $receiver->id.','.$userid;
                            //$chatRoomId = $receiverid.','.$userid;
                        } 

                        

                        $romid=App\Chatroom::where('chatRoomId',$chatRoomId)->first();
                        
                        
                   // echo $receiver; continue;
                        $romid=$romid->id;
                   //  echo $romid; continue;

                           $messagecont=App\Message::where('RoomId',$romid)
                                                    ->where('readWriteStatus','!=',1)
                                                    ->where('sender','!=',$userid)
                                                    ->count();
                            $message='';
                            if($messagecont>0){
                                $messageunread = App\Message::where('RoomId',$romid)
                                                    ->where('readWriteStatus','!=',1)
                                                    ->where('sender','!=',$userid)
                                                    ->orderBy('created_at','DESC')
                                                    ->first();
                            }
                            else{
                                $message = App\Message::where('RoomId',$romid)->orderBy('created_at','DSEC')->first();
                                $messageunread=0;
                            }

                       $timestring=' ';
                       //dd($message);
                        if($message!=''){
                             $time = strtotime($message->created_at);
                            $date= date('Y-m-d H:i:s', $time);
                            $date = date_create($date);
                            $nowdate = date("Y-m-d H:i:s");
                            $nowdate = date_create($nowdate);
                            $diff = date_diff($nowdate, $date);

                            if($diff->s > 0 && $diff->i <1  && $diff->h <= 0 && $diff->d <=0 && $diff->m <=0 && $diff->y <=0){
                                $timestring='just now';
                            }elseif ($diff->i >=1  && $diff->h <= 0 && $diff->d <=0 && $diff->m <=0 && $diff->y <=0) {
                            $timestring=$diff->i.'m  ago';
                            }elseif ($diff->i >=1  && $diff->h >= 0 && $diff->d <=0 && $diff->m <=0 && $diff->y <=0) {
                                $timestring=$diff->h.'h    '.$diff->i.'m ago';
                            }elseif($diff->h >= 0 && $diff->d >=0 && $diff->m <=0 && $diff->y <=0){
                                $timestring=$diff->d.'d  '.$diff->h.'h ago';
                            }elseif($diff->d >=0 && $diff->m >=0 && $diff->y <=0){
                                $timestring=$diff->m.'months  '.$diff->d.'days ago';
                            }
                            elseif ($diff->m >=0 && $diff->y >=0) {
                            $timestring=$diff->y.' year '.$diff->m.' months ago';
                            }
                        }

                        if($messageunread){
                             $time = strtotime($messageunread->created_at);
                            $date= date('Y-m-d H:i:s', $time);
                            $date = date_create($date);
                            $nowdate = date("Y-m-d H:i:s");
                            $nowdate = date_create($nowdate);
                            $diff = date_diff($nowdate, $date);

                            if($diff->s > 0 && $diff->i <1  && $diff->h <= 0 && $diff->d <=0 && $diff->m <=0 && $diff->y <=0){
                                $timestring='just now';
                            }elseif ($diff->i >=1  && $diff->h <= 0 && $diff->d <=0 && $diff->m <=0 && $diff->y <=0) {
                            $timestring=$diff->i.'m  ago';
                            }elseif ($diff->i >=1  && $diff->h >= 0 && $diff->d <=0 && $diff->m <=0 && $diff->y <=0) {
                                $timestring=$diff->h.'h  '.$diff->i.'m ago';
                            }elseif($diff->h >= 0 && $diff->d >=0 && $diff->m <=0 && $diff->y <=0){
                                $timestring=$diff->d.' days  '.$diff->h.'h ago';
                            }elseif($diff->d >=0 && $diff->m >=0 && $diff->y <=0){
                                $timestring=$diff->m.' months '.$diff->d.' days ago';
                            }
                            elseif ($diff->m >=0 && $diff->y >=0) {
                            $timestring=$diff->y.' year '.$diff->m.' months ago';
                            }
                        }

                                           $starlevel=App\Level::where('userleveler',$userid)
                                                         ->where('userbeenleveled',$receiver->id)
                                                         ->where('value','Star')->count();
                        //echo $timestring;
                    @endphp


                    @if( $messageunread)
                        <li class="chatliststyle"  style="overflow: auto;background:lightgray;">
                            <img class="receiver-profile-image float-left" style="display:inline" src="{{asset('/uploads/avatars/'.$receiver->avatar)}}" height="50px" width="50px"  alt="{{asset('uploads/avatars/defaultpic.jpg')}}"  >
                            @if($receiver->onlineStatus==1)
                                <sub class="badge badge-success" style="position: relative; right: 0%; top: 35px; color: rgb(255, 255, 255);display:inline;float:left">.</sub>

                            @else
                                <sub class="badge badge-warning" style="position: relative; right: 0%; top: 35px; color: rgb(255, 255, 255);display:inline;float:left">.</sub>
                            @endif
                           
                            <a  href="{{url('privateChat/'.$chatRoomId.'/'.$userid.'/'.$helpDeskUser)}}">
                                <div class="chatlistname" style="float:left">
                                    <h3 class="alink"  style="display:inline" >  {{$receiver->name}}  </h3>
                                    @if($starlevel !=0)
                                        <i class="far fa-star time staryellow"></i><span class="time">{{$timestring}}</span>
                                    @else
                                        <i class="far fa-star time ">{{$timestring}}</i>
                                    @endif
                                </div><br>
                                <h5 class="col-md-10 well-sm message_font" style="display:inline;" ><b>{{ $messageunread->message}}</b></h5>
                                <span class="badge badge-success">{{$messagecont}}</span>

                            </a>


                        </li>
                    @elseif($message)
                        <li class="chatliststyle" style="overflow: auto;">
                            <img class="receiver-profile-image float-left" style="display:inline" src="{{asset('/uploads/avatars/'.$receiver->avatar)}}" height="50px" width="50px" alt="{{asset('uploads/avatars/defaultpic.jpg')}}"  >
                            @if($receiver->onlineStatus==1)
                                <sub class="badge badge-success" style="position: relative; right: 0%; top: 35px; color: rgb(255, 255, 255);display:inline;float:left">.</sub>

                            @else
                                <sub class="badge badge-warning" style="position: relative; right: 0%; top: 35px; color: rgb(255, 255, 255);display:inline;float:left">.</sub>
                            @endif
                            <a  href="{{url('privateChat/'.$chatRoomId.'/'.$userid.'/'.$helpDeskUser)}}">

                                <div class="chatlistname" style="float:left">
                                    <h3 class="alink" style="display:inline" >   {{$receiver->name}}</h3>

                                    @if($starlevel !=0)
                                        <i class="far fa-star time staryellow"></i><span class="time">{{$timestring}}</span>
                                    @else
                                        <i class="far fa-star time ">{{$timestring}}</i>
                                    @endif
                                </div><br>
                                <h5 class="message_font col-md-10 " style= "display:inline;text-align: left;overflow:auto;" >{{ $message->message}}</h5>
                            </a>
                        </li>

                    @endif

                @endforeach


            </ul>
        </div>


    </div>

    @php
        $fullurl=url()->full();
        $dashurl= url('/').'/'.'chatdashboard';
        //echo $fullurl.'<br>'.$dashurl;

    @endphp
    @if($fullurl == $dashurl)
        <div class="jumbotron col-md-8 text-justify float-right message_font welcomemgs"><h2>Hi..  You don't start chat yet... Let's find someone and start talking <i class="far fa-smile"></i> </h2> </div>

    @endif


    @yield('content')


    <div style="position:fixed; right:0%; bottom:0%;" id="messagepop" >

    </div>


</div>

<!-- Scripts -->
<script type="text/javascript">
    @yield('routes')

</script>






<script src="{{ asset('chatjs/app.js') }}"></script>
@yield('script')

{{-- <script src="https://code.jquery.com/jquery-3.3.1.min.js" ></script> --}}

{{-- <script>
      $(document).ready(function(){
         $.ajax({
            type:'get',
            url:'{{url('/getmessagepopup')}}',

            success:function(data){
                console.log(data);
                $('#messagepop').html(data);
                $('.ketamoti').hide();

            }
        });
      }) ;

        function messagepo(data){
           var data1='m'+data;
           var imgdata='msgimg'+data;
           var onlyimg='i'+data;
           console.log(data);
           console.log(imgdata);
             $('#'+data1).show(1000);
             $('#cross'+data).hide();


        }
        function messagepo2(data){
             var data1='m'+data;
              $('#'+data1).hide(1000);
              $('#cross'+data).show(1010);
        }
       function messagecross(data){
           var imgdata='msgimg'+data;
            $('#'+imgdata).hide(1000);
           $.ajax({
                type:'get',
                data:{'messagecrossid':data},
                url:'{{url('/getmessagepopup')}}',

                success:function(data){
                    console.log(data);
                    $('#messagepop').html(data);
                    $('.ketamoti').hide();

                }
          });
        }


</script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script> --}}
{{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script> --}}
<script type="text/javascript">

    

    $('#search').on('keyup',function(){

        $value=$(this).val();

        $.ajax({

            type : 'get',

            url : '{{URL::to('agentchatsearch')}}',

            data:{'search':$value},

            success:function(data){

                //console.log(data);
                $('#tbod').html(data);

            }

        });

    })

</script>
<script type="text/javascript">
    function closeall(){

        location.reload();
    };
    $(document).ready(function(){
        
        $.ajax({

            type : 'get',

            url : '{{URL::to('agentchatsearch')}}',

            success:function(data){

                $('#tbod').html(data);

            }

        });
        $("#sss").click(function(){
            $.ajax({
                type: 'get',
                data:{'value':'Spam'},
                url : '{{URL::to('defaullevelsearch')}}',
                // data:{'authid':$userid},
                success:function(data){
                    console.log(data);
                    $('#spambody').html(data);

                }
            })
        });
        $("#report").click(function(){
            $.ajax({
                type: 'get',
                data:{'value':'Report'},
                url : '{{URL::to('defaullevelsearch')}}',
                // data:{'authid':$userid},
                success:function(data){
                    console.log(data);
                    $('#reportbody').html(data);

                }
            })
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#drop").click(function(){
            $.ajax({
                type: 'get',
                url : '{{URL::to('levelsearch')}}',
                //data:{'authid':roomid },
                success:function(data){
                    $('#lll').html(data);
                    //  console.log('success');
                }
            })
        });
    });
</script>
<script>

    function indeviduallevelsearch(id){
        console.log(id);
        $.ajax({
            type:'get',
            url:'{{url('indeviduallevelsearch')}}',
            data:{'levelid':id},
            success:function(data){
                console.log('success');
                console.log(data);
                $('#indeviduallevelsearch').html(data);
            }
        })
    };
</script>
<script type="text/javascript">
    $(document).click(function(){
        $("#spamclose").click(function(){
            $.ajax({
                type: 'get',
                url : '{{URL::to('spamsearch')}}',
                data:{'close':'close'},
                success:function(data){
                    $('#spambody').html(data);
                    //  console.log('success');
                }
            })
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#unrea").click(function(){
            //console.log('unread isie');
            $.ajax({
                type: 'get',
                url : '{{URL::to('unreadsearch')}}',
                data:{'authid':roomid },
                success:function(data){

                    $('#unread').html(data);
                    // console.log('success');
                }
            })
        });
    });
</script>
<script>

    {{--@php--}}
    {{--$a=Auth::user()->id;--}}
    {{--@endphp--}}
    {{--var loginuser = {{$a}};--}}

    {{--window.Echo.private('messagesent-'+ loginuser)--}}
    {{--.listen('Messagesent',e=>{--}}
    {{--console.log(e);--}}
    {{--var m=e.messageid;--}}
    {{--$.ajax({--}}
    {{--type:'get',--}}
    {{--data:{'echomessageid':m},--}}
    {{--url:'{{url('/getmessagepopup')}}',--}}

    {{--success:function(data){--}}
    {{--console.log(data);--}}
    {{--$('#messagepop').html(data);--}}
    {{--$('.ketamoti').hide();--}}

    {{--}--}}
    {{--})--}}
    {{--});--}}



</script>


</body>
</html>
