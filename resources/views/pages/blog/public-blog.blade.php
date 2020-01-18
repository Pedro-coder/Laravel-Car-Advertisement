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
          <div style="float:right">

            {{--<a href="/my-blog"> <i class="fas fa-spinner fa-pulse"></i>   &nbsp My Blog &nbsp </a>
            <a href="/public-blog"> <i class="fas fa-spinner fa-pulse"></i> &nbsp Public Blog &nbsp</a> 
            <a href="/add-blog"> <i class="fas fa-plus"></i> &nbsp Add Blog &nbsp</a> --}}

          </div>

          <br><br><br>


          @foreach ($posts as $post)
          @if($post->read_amount == 0)
          <div class="row">
            <div class="col-md-4">
              <div class="card-img-top">
                <a href="/blod-details/{{$post->id}}">
                  <img src="{{ asset('uploads/blog/' . $post->image) }}" style="width: 100%;">
                </a>
              </div>
            </div>
            <div class="col-md-8" >
              <?php         
              $d = explode(" ",$post->created_at);
              $dates=date_create($d[0]);
              $dd = date_format($dates,"j-M-Y");
              ?>
              <a href="/blod-details/{{$post->id}}">
                <h2 style="float:left;padding:0px">{{$post->heading}}</h2>
              </a>
              @foreach($users as $user)
              @if($user->id == $post->user_id)
                <a href="/userprofile">  <img src="{{ asset('/uploads/avatars/' . $user->avatar) }}" style="margin-top: 40px !important;width:32px; height:32px; position:absolute; top:0px; left:10px; border-radius:50%">
                </a>
              @endif
            @endforeach
              <h6 style="margin-top: 46px !important;margin-left:50px !important"><i>Published on {{$dd}} {{$d[1]}}</i></h6>
              @if(strlen($post->content) > 90)
              {{str_limit($post->content, 100, '....')}} <a href='/blod-details/{{$post->id}}' class=''>Read More</a>
              @else
              {{$post->content}}  
              @endif
              
            </div>
          </div>
          @else
          <div class="row">
            <div class="col-md-4">
              <div class="card-img-top">
                <a onclick='checkReferral(<?php echo json_encode($post->heading); ?>,<?php echo json_encode($post->read_amount); ?>,<?php echo json_encode($post->user_id); ?>,<?php echo json_encode($post->id); ?>)'>
                  <img src="{{ asset('uploads/blog/' . $post->image) }}" style="width: 100%;">
                </a>
              </div>
            </div>
            <div class="col-md-8" >
              <?php         
              $d = explode(" ",$post->created_at);
              $dates=date_create($d[0]);
              $dd = date_format($dates,"j-M-Y");
              ?>
              <a href="javascript:;" onclick='checkReferral(<?php echo json_encode($post->heading); ?>,<?php echo json_encode($post->read_amount); ?>,<?php echo json_encode($post->user_id); ?>,<?php echo json_encode($post->id); ?>)'>
                <h2 style="float:left;padding:0px">{{$post->heading}}</h2>
              </a>
              @foreach($users as $user)
                @if($user->id == $post->user_id)
                  <a href="/userprofile">  <img src="{{ asset('/uploads/avatars/' . $user->avatar) }}" style="margin-top: 40px !important;width:32px; height:32px; position:absolute; top:0px; left:10px; border-radius:50%">
                  </a>
                @endif
              @endforeach
              <h6 style="margin-top: 46px !important;margin-left:50px !important"><i>Published on {{$dd}} {{$d[1]}}</i></h6>
              @if(strlen($post->content) > 90)
              {{str_limit($post->content, 100, '....')}} <a href="javascript:;" onclick='checkReferral(<?php echo json_encode($post->heading); ?>,<?php echo json_encode($post->read_amount); ?>,<?php echo json_encode($post->user_id); ?>,<?php echo json_encode($post->id); ?>)' class=''>Read More</a>
              @else
              {{$post->content}}  
              @endif
             
            </div>
          </div>
          @endif
          <br>
          @endforeach

          {{$posts->appends(['sort' => 'votes'])->render()}}
          {{-- <div class="col-sm-12">
            <div class="card">
              <div class="card-block">
                <nav class="f-right">
                  {{ $posts->appends(request()->query())->links("pagination::bootstrap-4") }}
                </nav>
              </div>
            </div>
          </div> --}}

        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@section('extra-JS')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

<script>

  tinymce.init({
    selector: 'textarea',
    plugins: "link code wordcount",
    menubar: 'false'
  });
</script>
<script type="text/javascript">
   $("#referralBlogYes").click(function () {
    document.getElementById("enterBlogReferral").style.display = "block";
  });
  $("#referralBlogNo").click(function () {
    document.getElementById("enterBlogReferral").style.display = "none";
  });
  function checkReferral(heading, amount,owner_id,id)
  {
      $("#checkBlogReferral").modal('show');
      $("#submitBlogReferralYes").click(function () {
            var refStatus = $("input[name='blogreferralStatus']:checked").val();
            if (refStatus === undefined) {
                alert('please choose one');
            }
            else
            {
                var enterReferral = $('#enterBlogReferral').val();
                if(refStatus == 'No')
                {
                    enterReferral = 0;
                }
                $.ajax({
                    url: '/blog/insertBlogReferral/'  + owner_id + '/' + id + '/' + enterReferral,
                    type: 'GET',
                    success: function (response) 
                    {
                        //alert('Done')
                        $("#checkBlogReferral").modal('hide'); 
                        showMsg(heading, amount,owner_id,id);    
                    }
                });      
            }
        });
  }
  function showMsg(heading, amount,owner_id,id){
    Swal.fire({
      title: 'Pay To Read?',
  text: "You have to pay $"+amount+ " to read!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: 'green',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Pay'
}).then((result) => {
  if (result.value) {
    $.ajax({
      
      url: '/blog/pay-to-read/'+amount+'/'+owner_id+'/'+id,
      type: 'GET',
                                            
         success: function (response) {

          console.log(response);
          Swal.fire(
            'Payment Done!',
            'You can now read blog.',
            'success'
          ).then((result) => {
              if (result.value) {
                window.location = '/blod-details/'+id;
              }
          });
            
        }
      });
  }
     });
  }
</script>

@endsection
