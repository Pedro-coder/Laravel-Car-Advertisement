@extends('layouts.app')

@section('content')

    <div style="float:letf" class="col-md-5 float-left" id="reg">
       <div class="panel-body" >
            <div class="form-group">
    
                <input type="text" placeholder="Search with name" class="form-controller" id="search" name="search"></input>
    
            </div> 
            <table class="table table-bordered table-hover text-success">
              
            <tbody>
    
            </tbody>
              
            </table>

        </div>

        <h1 class="textstyle">Recently Chat with</h1>
        <ul class="list-group hover">
             
                @foreach($receivers as $receiver)
                @php
                $userid = Auth::user()->id;
                $receiverid = $receiver->id;
                 if($userid==$receiverid){
                    continue;
                }
                
                if($receiverid > $userid){
                $chatRoomId = Auth::user()->id.','.$receiver->id;
                }
                else{
                $chatRoomId = $receiver->id.','.$userid;
                }
                $romid=App\Chatroom::where('chatRoomId',$chatRoomId)->first();
                $romid=$romid->id;
                @endphp
                <li style="bg-info" class="list-group-item" @keyup.enter='dataset{{($romid)}}'><a href="{{url('privateChat/'.$chatRoomId)}}"><h2> {{$receiver->name}}</h2></a>

                    <small>
                        <sub>
                            @php
                            // $str = Auth::user()->id.','.$receiver->id;
                            
                            $message = App\Message::where('RoomId',$romid)->first();
                            @endphp
                            @if($message)
                            {{$message->message}}
                            @endif
                    
                        </sub>
                    </small>
                </li>
                @endforeach 
        </ul>

    </div>
    <div style="float:right" class=" col-md-7 panel divbox">
       
            <h2 class="text-center bg-danger">Let's start a chat</h2>
                <div class="panel bg-success text-center" >
                    <li class="jumbotron">
                            <h1>Select Someone to Enter a Chatroom</h1>
                    </li>
                </div>
            
       
    </div>


@endsection

@section('script')
        <script type="text/javascript">
 
        $('#search').on('keyup',function(){
        
        $value=$(this).val();
        
        $.ajax({
        
        type : 'get',
        
        url : '{{URL::to('search')}}',
        
        data:{'search':$value},
        
        success:function(data){
        
        $('tbody').html(data);
        
        }
        
        });
        
        
        
        })
        
        </script>
        <script type="text/javascript">
        
        // $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
 
        </script>
@endsection
 



