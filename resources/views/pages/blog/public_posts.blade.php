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
           

            <br><br><br>
            

              @foreach ($posts as $post)
              @if($post->read_amount == 0)

              <div class="row">
                <div class="col-md-4">

                  <div class="card-img-top">
                    <a href="/visitors-details/{{$post->id}}">
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

                <a href="/visitors-details/{{$post->id}}">
                <h2 style="float:left;padding:0px">{{$post->heading}}</h2>
                </a>
              <h6 style="margin-top: 46px !important;"><i>Published on {{$dd}} {{$d[1]}}</i></h6>
                @if(strlen($post->content) > 90)
                  {{str_limit($post->content, 100, '....')}} <a href="/visitors-details/{{$post->id}}" class=''>Read More</a>
                @else
                  {{$post->content}}  
                @endif

                </div>
              </div><br>
              @else
              <div class="row">
                  <div class="col-md-4">
  
                    <div class="card-img-top">
                      <a href="javascript:;" onclick='showMsg()'>
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
  
                  <a href="javascript:;" onclick='showMsg()'>
                  <h2 style="float:left;padding:0px">{{$post->heading}}</h2>
                  </a>
                  
                <h6 style="margin-top: 46px !important;"><i>Published on {{$dd}} {{$d[1]}}</i></h6>
                  @if(strlen($post->content) > 90)
                    {{str_limit($post->content, 100, '....')}} <a href="javascript:;" onclick='showMsg()' class=''>Read More</a>
                  @else
                    {{$post->content}}  
                  @endif
  
                  </div>
                </div>
                  <br>
                  @endif
              @endforeach
            

              {{$posts->appends(['sort' => 'votes'])->render()}}
        </div>
      </div>
    </div>
  </div>
</section>
 
@endsection

@section('extra-JS')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

<script>

function showMsg(){

  Swal.fire({

    title: 'Please Login to read More.',
    animation: false,
    customClass: 'animated tada'

  });
}
  tinymce.init({
    selector: 'textarea',
    plugins: "link code wordcount",
    menubar: 'false'
  });
</script>
   
@endsection
