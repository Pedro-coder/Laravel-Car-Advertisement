 @extends('layouts.app')
@section('content')
<div>
    <style>
        .modal-content {
            position: relative;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            width: 70%;
            pointer-events: auto;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid rgba(0,0,0,.7);
            border-radius: .5rem;
            outline: 10px;
            padding:10px;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
    <div>
      
        @php
          $allEmailMessage=Session::get('sendemail');  
         // echo $allEmailMessage;
          if($allEmailMessage !=""){
              $flagemail=1;
          }else{
              $flagemail=0;
          }
        @endphp
        @if($flagemail==0)
         <h3 class="modal-content" style="color:green;font-size:.99rem">Send unread message notification to the users via email</h3>
        @elseif($flagemail==1)
         <h3 class="modal-content" style="color:green;font-size:.99rem">All the email has been sent to corresponding users....</h3>
           
        @endif   
         @php
             Session::flash('sendemail');
         @endphp 
    </div>
    <div class="card modal-content">
        <div>
            
            <a style="float:right" href="{{url('/home')}}"><i class="fas fa-times"></i></a>
        </div> 
       <form method="POST" action="{{url('/sendmail')}}">
        {{ csrf_field() }}
            <div class="form-group col-md-3">
                <label for="email">Set Interval</label>
                <input type="number" class="form-control" id="email" placeholder="HH:MM" style="display:inline">
                {{-- <input type="submit" class="btn btn-success"> --}}
               
            </div>
            <button class="btn btn-success float-left" style="display:inline;margin-left:10px">Save</button>
            
            <button type="submit" class="btn btn-primary col-md-2 float-right" style="display:inline" >Send Now</button>
        </form>
    </div>
</div>
@endsection
  