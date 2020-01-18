@extends('layouts.app')

@section('content')
<section id="admin" class="admin-panel">
  <div class="container ">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title pt-2"><i class="fab fa-blogger fa-2x" style="color:sandybrown"></i><strong>BLOG </strong><a href="{{ URL('/home') }}"><i class="fa fa-times-circle fl-r crs-pntr" style="font-size:27px;color:#6c757d;"></i></a></h5>
         
        </div>
        <div class="card-body">
                <div>
                        <a href="/blog"> <i class="fas fa-arrow-alt-circle-left fa-3x"></i>  </a> 
                  
                </div>

            <br><br><br>
            
              <div class="row" style="padding-left:360px">
                  <div class="col-md-12" >

                    <h2 style="float:left;padding:0px">{{$post->heading}}</h2>

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

                <div class="col-md-12" >

                  <?php echo nl2br($post->content); ?>

                </div>
              </div>
                  <br>
             <hr>

             @if($comments != null)

             @foreach($comments as $comment)
                @foreach($users as $user)
                    @if($comment->user_id == $user->id)
                        <div class="row">
                            <div class="col-md-10">
                                <?php 
                  
                                    $d = explode(" ",$comment->created_at);
                                    
                                    $dates=date_create($d[0]);
                                    
                                    $dd = date_format($dates,"j-M-Y");
                                      
                                ?>

                                <img id="user_avatar_img" src="{{ asset('/uploads/avatars/' . $user->avatar) }}"
                                style="width:50px; height:50px; border-radius:50%;">
                                <p style="margin-top:-50px !important;margin-left:63px;">{{$user->name}} 
                                    &nbsp;<i class="fa fa-calendar" aria-hidden="true"></i> 
                                    <span>{{$dd}} </span> &nbsp; 
                    
                                </p>

                                <p style="margin-top:-10px;margin-left:60px;">
                                  <?php echo nl2br($comment->content); ?>
                                </p>

                            </div>
                            
                      
                        </div>
                    @endif
                @endforeach
             @endforeach
            @endif
            <br>
            
         
           
        </div>
      </div>
    </div>
  </div>
</section>
 
@endsection

@section('extra-JS')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

<script>


</script>
   
@endsection
