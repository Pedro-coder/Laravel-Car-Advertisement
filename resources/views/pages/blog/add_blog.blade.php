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
                    <a href="/my-blog"> <i class="fas fa-arrow-alt-circle-left fa-3x"></i>  </a> 
                    

            </div>
            <form method="POST" action="/blog/store" enctype="multipart/form-data">
            {{-- {!! Form::open(array('id'=>'blog_form' , 'route' => '/blog/store', 'files' => true)) !!} --}}
                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
              <div class="form-row">

                  <div class="form-group col-md-10 offset-md-1 mt-3" style="padding-left: 60%">
                      <div class="input-group">
                        <input type="checkbox" name="checkbox"  id ="cb" style="height: 35px;
        width: 14px;">
        &nbsp&nbsp&nbsp<label style="margin-top: 6px;">Free to read</label>
                        &nbsp&nbsp&nbsp
                        <input class="form-control" id="amount" name="read_amount" type="text" placeholder="Amount" aria-label="enter_amount">
                        
                     </div>
                    </div>
                
                <div class="form-group col-md-10 offset-md-1 mt-3">
                  <div class="input-group">
                    {{-- <div class="input-group-prepend">
                      <div class="input-group-text"><i class="fas fa-user"></i></div>
                    </div> --}}
                    
                    <input class="form-control" id="subject" name="heading" type="text" placeholder="Subject" aria-label="Search">
                    
                 </div>
                </div>
                
		            	<div class="col-md-10 offset-md-1 mt-3">
										<div class="img-upload " style="border-radius: 0px !important;height:100% !important">
											<img width="900" height="500" id="ImagePreview" src="/uploads/avatars/picture-01-512.png" alt="Image"  class="img-responsive"/>
											<span class="hide">
                      {{-- {!! Form::file('image', ['id'=>'examImage']) !!} --}}
                      
                      <input class="form-control" type="file" id="examImage" name="image" >
											</span>
										</div>
                  </div>
                  <div class="col-md-10 offset-md-1 mt-3">
                  <div class="form-group">
                      <textarea class="form-control" id="event_description" name="content" rows="5" placeholder="Type your Post content Here..."></textarea>
                    </div>
                  </div>
		          
                <div class="form-group col-md-10 offset-md-1 mt-2">
                  <button type="submit" class="btn btn-success float-right">
                     {{ __('Save') }}
                  </button>
                </div>
              </div>
              {{-- {!! Form::close() !!} --}}
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

  // tinymce.init({
  //   selector: 'textarea',
  //   plugins: "link code wordcount",
  //   menubar: 'false',
  //   forced_root_block : false
  // });
  $("#cb").click(function(){
    if($(this).prop("checked") == true){
      $("#amount").attr("disabled", "disabled");
    }else{
      $("#amount").removeAttr("disabled");
    }
});
  
$(document).ready(function(){
		function readURL(input) {
			  if (input.files && input.files[0]) {
			    var reader = new FileReader();
			    reader.onload = function(e) {
			      $('#ImagePreview').attr('src', e.target.result);
			    }
			    reader.readAsDataURL(input.files[0]);
			  }
		}
		$("#examImage").css('display','none'); 
		// var url = $("#you_link").val();
        // url = url.split('v=')[1];
        // $("#iframe_link")[0].src = "https://www.youtube.com/embed/" + url;
        // $("#iframe_link").show();

		$('#ImagePreview').click(function(){ 
			$('#examImage').trigger('click'); 
		});
		$('#examImage').on('change', function () {
	    	if (this.files && this.files[0]) {
			    var reader = new FileReader();
			    reader.onload = function(e) {
			      $('#ImagePreview').attr('src', e.target.result);
			    }
			    reader.readAsDataURL(this.files[0]);
			}	
	    });
	// 	$("#you_link").blur(function(){
  	// 		var url = $("#you_link").val();
    //     	url = url.split('v=')[1];
    //     	$("#iframe_link")[0].src = "https://www.youtube.com/embed/" + url;
    //     	$("#iframe_link").show();
	// 	});  
	 }); 
</script>

   
@endsection
