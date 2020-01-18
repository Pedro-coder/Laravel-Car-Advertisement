@extends('layouts.app')
@section('custom-styles')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
           	<div class="card">
	            <div class="card-header cop-h-f-weight">
	              	Train Setup
	              	<a href="{!! route('home') !!}">	<i class="fa fa-times-circle fl-r crs-pntr cop-cross-sign"></i></a>
	            </div>
            <div class="card-body">
          	  <div class="row mar-b-10">
                <div class="col-md-12">
	              <table class="table">
	                <thead>
	                  <tr>
	                    <th>Title</th>
	                    <th>Image</th>
	                    <th>Youtube link</th>
	                  </tr>
	                </thead>
	                <tbody>
	                	 @foreach ($Trainees as $key => $item)
	                            <tr>
	                                <td><a href="{!! route("train.edit", $item->id) !!}">
	                                	{!! $item->title!!}</a></td>
	                                <td>{!! $item->image !!}</td>
	                                <td class="ic">{!! $item->youtube_link !!}
	                               <a onclick="return confirm('Are you sure you want to delete?');" href="{!! route('train.delete', @$item->id) !!}"><i  class="fa fa-times-circle icona fl-r crs-pntr cop-cross-sign"></i></a>
	                                	
	                                </td>
	                            </tr>
	                        @endforeach
	                </tbody>
	              </table>
          	    </div>
          	    <div class="col-md-12">
          	    	{!! $Trainees->render() !!}	
          	    </div> 
          	  </div>
          	  <hr/>
          	  <div class="row mar-b-10">
                <div class="col-md-12">
                	{!! Form::open(['url' => $formUrl, 'method' => 'post', 'class' => 'form-horizontal', 'files' => true]) !!}

                	<div class="form-group">
                        <label for="question">Title</label>
                        {!! Form::text('title', @$Trainee->title, ['class' => 'form-control', 'required']) !!}
		            </div>
		            
		            <div class="row mar-b-10">
		            	<div class="col-md-6">
										<div class="img-upload">
											<img width="500" height="300" id="ImagePreview" src="/uploads/avatars/picture-01-512.png" alt="Image"  class="img-responsive"/>
												<span class="hide">
												{!! Form::file('image', ['id'=>'TraineeImage']) !!}
												</span>
											</div>
		            	</div>
		            	<div class="col-md-6">
		            		{!! Form::text('youtube_link', @$Trainee->youtube_link, ['class' => 'form-control','id'=> 'you_link','placeholder'=>'Enter youtube link']) !!}
		            		<iframe id="iframe_link" width="520" height="255" frameborder="0" style="margin-top: 5px"  allowfullscreen></iframe>
		            	</div>
		            </div>+
		            
		            @if (!empty(@$Trainee))
		            <a class="btn btn-md btn-primary mar-l-15 pull-right" href="{!! route('trains') !!}">
		            	Cancel
		        	</a>
		            <a class="btn btn-md btn-danger mar-l-15 pull-right" onclick="return confirm('Are you sure you want to delete?');" href="{!! route('train.delete', @$Trainee->id) !!}">
		            	Delete
		        	</a>
		        	@endif
		            <button type="submit" class="btn btn-md btn-success pull-right">
	              			{!! empty($Trainee) ? 'Save' : 'Update' !!}
	              	</button>
                	{!! Form::close() !!}
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection

@section('extra-JS')
<script type="text/javascript">
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
		$("#TraineeImage").css('display','none'); 
		var url = $("#you_link").val();
        url = url.split('v=')[1];
        $("#iframe_link")[0].src = "https://www.youtube.com/embed/" + url;
        $("#iframe_link").show();

		$('#ImagePreview').click(function(){ 
			$('#TraineeImage').trigger('click'); 
		});
		$('#TraineeImage').on('change', function () {
	    	if (this.files && this.files[0]) {
			    var reader = new FileReader();
			    reader.onload = function(e) {
			      $('#ImagePreview').attr('src', e.target.result);
			    }
			    reader.readAsDataURL(this.files[0]);
			}	
	    });
		$("#you_link").blur(function(){
  			var url = $("#you_link").val();
        	url = url.split('v=')[1];
        	$("#iframe_link")[0].src = "https://www.youtube.com/embed/" + url;
        	$("#iframe_link").show();
		});  
	}); 
</script>
@endsection