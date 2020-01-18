@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
           	<div class="card">
	            <div class="card-header cop-h-f-weight">
	              	Coupons  <i class="fa fa-angle-left cop-left-angle"></i>{!! empty($coupon) ? ' Add' : ' Edit' !!} Coupon
	              <a href="{!! route('home') !!}">	<i class="fa fa-times-circle fl-r crs-pntr cop-cross-sign"></i></a>
	            </div>
            <div class="card-body">
            	{!! Form::open(['url' => $formUrl, 'method' => 'post', 'class' => 'form-horizontal', 'files' => true]) !!}

              <div class="row mar-b-10">
	              <div class="col-md-4">
	              	 
	              </div>
	              <div class="col-md-8 cop-text-a-r">
	              		@if (!empty(@$coupon->id))
	              			<a onclick="return confirm('Are you sure you want to delete?');" href="{!! route('coupon.delete', @$coupon->id) !!}" class="btn btn-md btn-default bg-gray">Delete Coupon</a>
	              		@endif
	              		<a href="{!! route('coupons') !!}" class="btn btn-md btn-default bg-gray">Cancel</a>
	              		<button type="submit" class="btn btn-md btn-primary">
	              			{!! empty($coupon) ? 'Save' : 'Update' !!}
	              		</button>
	              </div> 
          	  </div>
          	  <div class="row">
                <div class="col-md-12">
                	<div class="form-group">
                        <label for="coupon_code">Coupon Code</label>
                        {!! Form::text('coupon_code', @$coupon->coupon_code, ['class' => 'form-control', 'required']) !!}
		            </div>

		            <div class="form-group">
                        <label for="number_available">Number Available</label>
                        
                        @if(!empty(@$coupon->number_available))
                        
                        	@if(@$coupon->number_available != 'Unlimited')
		                        <span class="fl-r"><input id="unlimited" type="checkbox" name="unlimited"/> Unlimited</span>
		                        {!! Form::text('number_available', @$coupon->number_available, ['class' => 'form-control','id' => 'numberavailable']) !!}
		                    @else
		                    	<span class="fl-r"><input id="unlimited" checked="true" type="checkbox" name="unlimited"/> Unlimited</span>
		                        {!! Form::text('number_available', @$coupon->number_available, ['class' => 'form-control','readonly','id' => 'numberavailable']) !!}
		                    @endif    

                        @else
                        	<span class="fl-r"><input id="unlimited" checked="true" type="checkbox" name="unlimited"/> Unlimited</span>
                        	{!! Form::text('number_available','Unlimited', ['class' => 'form-control','readonly','id' => 'numberavailable']) !!}
                        @endif

		            </div>    
		            <div class="form-group row">
					    <div class="col-md-5">
					    <label for="start_date">Start date</label>
			        	<div class="input-group date">
			          		{!! Form::text('start_date', empty($coupon->start_date) ? null: date('m/d/Y', strtotime($coupon->start_date)), ['class' => 'form-control input-small', 'id' => 'datepicker']) !!}
						    <span class="cop-input-group-addon">
						    	<i class="fa fa-calendar"></i>
						    </span>
			        	</div>
			        	</div>
			        	<div class="col-md-2">
			        		<div class="cop-to">To</div>
			        	</div>
			        	<div class="col-md-5">
			        	<label for="start_date">Expiration date</label>
			        	<div class="input-group date">
			          		{!! Form::text('expiration_date', empty($coupon->expiration_date) ? null: date('m/d/Y', strtotime($coupon->expiration_date)), ['class' => 'form-control input-small', 'id' => 'datepicker1']) !!}
						    <span class="cop-input-group-addon">
						    	<i class="fa fa-calendar"></i>
						    </span>
			        	</div>
			        	</div>
					</div>
					<hr/>

					<div class="form-group">
						<label class="cop-h-f-weight">Discount Details</label>
					</div>

					<div class="form-group row">
						<div class="col-md-6">
	                        <label for="coupon_type">Coupon Type</label>
	                        {!! Form::select('coupon_type', $couponTypes, @$coupon->coupon_type, ['class' => 'form-control coptype', 'required']) !!}
                    	</div>
                    	<div class="col-md-6">
	                        <label for="criteria">What is discounted</label>
	                        {!! Form::select('criteria', $criteria, @$coupon->criteria, ['class' => 'form-control distype', 'required']) !!}
                    	</div>
		            </div>
		            <div class="form-group row">
						<div class="col-md-6"> 
							@if(@$coupon->coupon_type == 'Free')
				            <div class="inner-addon right-addon amt hide">
		           			<i class="glyphicon co-gray fas fa-percentage"></i>
		           			{!! Form::text('coupon_amount', @$coupon->coupon_amount, ['class' => 'form-control','id' => 'coupon_amt']) !!}
		         			</div>
		         			@else
		         			<div class="inner-addon right-addon amt">
		           			<i class="glyphicon co-gray fas fa-percentage"></i>
		           			{!! Form::text('coupon_amount', @$coupon->coupon_amount, ['class' => 'form-control','id' => 'coupon_amt']) !!}
		         			</div>
		         			@endif
		         			<div class="ship">
		         				<div id="users" >
	    							@if(!empty(@$coupon) &&  @$coupon->coupon_type == 'Free')
	    							<ul class="list-group mar-b-10">
										<li class="list-group-item list-group-item-secondary">Shipping Method</li>
										@foreach ($shipping as $key => $ship)
											<li class="list-group-item" id="row{{$key}}"><input type="hidden" name="ship[]" id="ship{{$key}}" value="{{$ship}}" />{{$ship}}<i class="fa fa-times-circle bt-re btn_remove" id="{{$key}}"></i></li>
										@endforeach
									</ul>
									<a href="javascript(0)"  data-toggle="modal" data-target="#ship-modal">+ Choose Shipping Method</a>
									@else
									<ul class="list-group addlist hide mar-b-10">
										<li class="list-group-item list-group-item-secondary">Shipping Method</li>
									</ul>
									<a class="link hide" href="javascript(0)"  data-toggle="modal" data-target="#ship-modal">+ Choose Shipping Method</a>
									@endif
								</div>
		         			</div>
                    	</div>
                    	<div class="col-md-6">
                    		<div class="prod">
                    			<div id="users1">
                    			@if(!empty(@$coupon) &&  @$coupon->criteria == '3')
                    				<ul class="list-group mar-b-10">
										@foreach ($products as $key => $product)
											<li class="list-group-item" id="row1{{$key}}"><input type="hidden" name="prod[]" id="prod{{$key}}" value="{{$product}}" /><img width="30" height="30" src="{{ asset('/uploads/seller/no-product.jpg') }}" />&nbsp;&nbsp;{{$product}}<i class="fa fa-times-circle bt-re btn_remove1" id="{{$key}}"></i></li>
										@endforeach
									</ul>
									<a href="javascript(0)"  data-toggle="modal" data-target="#product-modal">+ Choose Product</a>
                    			@else
                    				<ul class="list-group prodaddlist hide mar-b-10"></ul>
                    					<a class="link_product hide" href="javascript(0)"  data-toggle="modal" data-target="#product-modal">+ Choose Product</a>
                    			@endif
                    			</div>
                    		</div>
          	  {!! Form::close() !!}
            </div>
          </div>
        </div>
    </div>
    <div class="modal fade" id="ship-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-md">
	    <div class="modal-content">
	    	<div class="modal-header">
		        <h5 class="modal-title">Choose Shipping Method</h5>
		         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
      		</div>
	      <div class="modal-body">
	       		<label class="cop-h-f-weight">United States</label>
	       		<div class="row">
	       			<div class="col-md-12">
	       				<input type="checkbox" id="ck1" name="chk1" value="Priority Box Within USA (for up to 6 DVD Only)">&nbsp;&nbsp;Priority Box Within USA (for up to 6 DVD Only)
	       			</div>
	       			<div class="col-md-12">
	       				<input type="checkbox" id="ck2" name="chk2" value="Priority Box Within USA (more than 6 DVD Only)">&nbsp;&nbsp;Priority Box Within USA (more than 6 DVD Only)
	       			</div>
	       		</div>
	       		<label class="cop-h-f-weight">Rest Of World</label>
	       		<div class="row">
	       			<div class="col-md-12">
	       				<input type="checkbox" id="ck3" name="chk3" value="Small Envelope Outside USA (for up to 6 DVD Only)">&nbsp;&nbsp;Small Envelope Outside USA (for up to 6 DVD Only)
	       			</div>
	       			<div class="col-md-12">
	       				<input type="checkbox" id="ck4" name="chk4" value="Big Envelope Outside USA (more than 6 DVD Only)">&nbsp;&nbsp;Big Envelope Outside USA (more than 6 DVD Only)
	       			</div>
	       		</div>
	      </div>
	      <div class="modal-footer">
        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        		<button type="button" id="saveShipping" data-dismiss="modal" class="btn btn-primary">Save</button>
      	  </div>
	    </div>
	  </div>
	</div>

	<div class="modal fade" id="product-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-md">
	    <div class="modal-content">
	    	<div class="modal-header">
		        <h5 class="modal-title">Select Product</h5>
		         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
      		</div>
	      <div class="modal-body scr">
	       		<div class="row mar-b-10">
	       			<div class="col-md-1 pad-t-12">
	       				<input type="checkbox" id="ck5" name="chk5" value="New #8">
	       			</div>
	       			<div class="col-md-2">
	       				<img width="50" height="50" src="{{ asset('/uploads/seller/no-product.jpg') }}" />
	       			</div>
	       			<div class="col-md-9 pad-t-12">
	       				New #8
	       			</div>
	       		</div>
	       		<hr/>
	       		<div class="row mar-b-10">
	       			<div class="col-md-1 pad-t-12">
	       				<input type="checkbox" id="ck6" name="chk6" value="New #3">
	       			</div>
	       			<div class="col-md-2">
	       				<img width="50" height="50" src="{{ asset('/uploads/seller/no-product.jpg') }}" />
	       			</div>
	       			<div class="col-md-9 pad-t-12">
	       				New #3
	       			</div>
	       		</div>
	       		<hr/>
	       		<div class="row mar-b-10">
	       			<div class="col-md-1 pad-t-12">
	       				<input type="checkbox" id="ck7" name="chk7" value="206::How To Kill the ball (Book in Japanese)">
	       			</div>
	       			<div class="col-md-2">
	       				<img width="50" height="50" src="{{ asset('/uploads/seller/no-product.jpg') }}" />
	       			</div>
	       			<div class="col-md-9 pad-t-12">
	       				206::How To Kill the ball (Book in Japanese)
	       			</div>
	       		</div>
	       		<hr/>
	       		<div class="row mar-b-10">
	       			<div class="col-md-1 pad-t-12">
	       				<input type="checkbox" id="ck8" name="chk8" value="Item #204::How to kill the ball(Book in English)">
	       			</div>
	       			<div class="col-md-2">
	       				<img width="50" height="50" src="{{ asset('/uploads/seller/no-product.jpg') }}" />
	       			</div>
	       			<div class="col-md-9 pad-t-12">
	       				Item #204::How to kill the ball(Book in English)
	       			</div>
	       		</div>
	      </div>
	      <div class="modal-footer">
        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        		<button type="button" id="saveProduct" data-dismiss="modal" class="btn btn-primary">Save</button>
      	  </div>
	    </div>
	  </div>
	</div>

	
</div>
@endsection

@section('extra-JS')
<script type="text/javascript">
	$(document).ready(function(){      
      $('#datepicker').datepicker({
      	format: 'mm/dd/yyyy',
      });
      $('#datepicker1').datepicker({
      	format: 'mm/dd/yyyy',
      });
	    $("#unlimited").click(function () {
	        if ($(this).is(":checked")) {
	            $("#numberavailable").attr("readonly", "readonly");
	            $("#numberavailable").val('Unlimited');
	        } else {
	            $("#numberavailable").removeAttr("readonly");
	            $("#numberavailable").focus();
	            $("#numberavailable").val('0');
	        }
	    });
	    $('.coptype').on('change', function () {
     		var selectedValue = this.selectedOptions[0].value;
     		if(selectedValue == '$'){
     			$(".amt").css('display','block');
     			$(".amt").removeClass('right-addon');
     			$(".glyphicon").removeClass('fa-percentage');
     			$(".amt").addClass('left-addon');
     			$(".glyphicon").addClass('fa-dollar-sign');
     			$(".ship").css('display','none');
     		}else if(selectedValue == '%'){
     			$(".amt").css('display','block');
     			$(".amt").removeClass('left-addon');
     			$(".glyphicon").removeClass('fa-dollar-sign');
     			$(".amt").addClass('right-addon');
     			$(".glyphicon").addClass('fa-percentage');
     			$(".ship").css('display','none');
     		}else{
     			$(".amt").css('display','none');
     			$(".ship").css('display','block');
     			$(".link").removeClass('hide');
				$("#coupon_amt").val(0);
     		}
		});
	    $('.distype').on('change', function () {
	    	var selectedValue = this.selectedOptions[0].value;
     		if(selectedValue == '3'){
     		    $(".link_product").removeClass('hide');
     		}else{
     			$(".link_product").addClass('hide');
     		}
	    });		
		$("#saveShipping").click(function () {
	        var temp=[];	
	        if ($("#ck1").is(":checked")) {
	            temp.push($("#ck1").val());	
	        }
	        if ($("#ck2").is(":checked")) {
	         	temp.push($("#ck2").val());   
	        }
	        if ($("#ck3").is(":checked")) {
	         	temp.push($("#ck3").val());   
	        }
	        if ($("#ck4").is(":checked")) {
	         	temp.push($("#ck4").val());   
	        }
	        $(".addlist").removeClass('hide');
	        $.each(temp, function(index,value) {
		    	$('#users .list-group').append(  '<li class="list-group-item" id="row'+index+'"><input type="hidden" name="ship[]" id="ship'+index+'" value="'+ value +'" />'+value+'<i class="fa fa-times-circle bt-re btn_remove" id="'+index+'"></i></li>')
		  	});
	    });

		$("#saveProduct").click(function () {
	        var temp=[];	
	        if ($("#ck5").is(":checked")) {
	            temp.push($("#ck5").val());	
	        }
	        if ($("#ck6").is(":checked")) {
	         	temp.push($("#ck6").val());   
	        }
	        if ($("#ck7").is(":checked")) {
	         	temp.push($("#ck7").val());   
	        }
	        if ($("#ck8").is(":checked")) {
	         	temp.push($("#ck8").val());   
	        }
	        $(".prodaddlist").removeClass('hide');
	        $.each(temp, function(index,value) {
		    	$('#users1 .list-group').append( '<li class="list-group-item" id="row1'+index+'"><input type="hidden" name="prod[]" id="prod'+index+'" value="'+ value +'" /><img width="30" height="30" src="{{ asset('/uploads/seller/no-product.jpg') }}"/>&nbsp;&nbsp;'+value+'<i class="fa fa-times-circle bt-re btn_remove1" id="'+index+'"></i></li>')
		  	});
	    });

	    $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      	});
      	$(document).on('click', '.btn_remove1', function(){  
           var button_id = $(this).attr("id");   
           $('#row1'+button_id+'').remove();  
      	});
    });  
</script>
@endsection
