@extends('layouts.app')

@section('content')

<section class="membership-pro">
		<div class="container">
			<div class="box-shadow-div">
				<form method="" id="membership_form" enctype="multipart/form-data">
					<div class="main-full-form">
						<div class="row">
							<div class="col-md-12">
								<div class="top-head">
									<div class="close-btn-pro">
										<a href="{{ URL('/home') }}" class="btn left-close"><i class="fa fa-close"></i></a>
									</div>
									<h3 class="text-center">Membership</h3>
									<div class="row">
										<div class="col-md-5">
											<div class="img-left-cont">
												<a href="{{url('userprofile')}}"><img src="{{ asset('/uploads/avatars/' . Auth::user()->avatar) }}" alt="Profile picture"/></a>
											</div>
										</div>
										<div class="col-md-7">
											<div class="content-input-right">
												<div class="row">
													<div class="col-md-6">
														<h5 class="top-two">Join Date</h5>
													</div>
													<div class="col-md-6">
														<input  value="<?php if(isset($details['join_date'])){ echo $details['join_date']; } ?>" class="datepicker" type="date" name="join_date" id="join_date" placeholder="<?php echo date("Y/m/d"); ?>"/>
													</div>
												</div>
											</div>
											<div class="content-input-right">
												<div class="row">
													<div class="col-md-6 col-sm-6">
														<h5 class="top-two">Total Share</h5>
													</div>
													<div class="col-md-6 col-sm-6">
														<h4><b>11</b></h4>
													</div>
												</div>
											</div>
											<div class="content-input-right">
												<div class="row">
													<div class="col-md-6 col-sm-6">
														<h5 class="grey"><span>*</span>Membership Type</h5>
													</div>
													<div class="col-md-6 col-sm-6">
														<select name="membership_type" id="membership_type">
															<option value="Presidium" <?php echo ($details['membership_type'] == "Presidium" ? "selected" : "")   ?>>Presidium</option>
															<option value="General" <?php echo ($details['membership_type'] == "General" ? "selected" : "") ?>>General</option>
														</select>
													</div>
												</div>
											</div>
											<div class="content-input-right">
												<div class="row">
													<div class="col-md-6 col-sm-6">
														<h5><span>*</span>Membership Category</h5>
													</div>
													<div class="col-md-6 col-sm-6">
														<select name="membership_category" id="membership_category">
															<option value= "">Select membership category</option>
															<option value= "*" <?php echo ($details['membership_category'] == "*" ? "selected" : "")   ?>>*</option>
                                                            <option  value= "**" <?php echo ($details['membership_category'] == "**" ? "selected" : "")   ?>>**</option>
                                                            <option  value= "***" <?php echo ($details['membership_category'] == "***" ? "selected" : "")   ?>>***</option>
														</select>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="name-input">
												<span>*</span><h4>{{$name}}</h4>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-10">
											<?php 
												if(isset($details['admin_code']))
												{    
													$admin_code_values = explode(",",$details['admin_code']);
												}   
											?>
											<table class="table table-bordered">
												<td><input  value="<?php  if(isset($details['admin_code'])) { echo $admin_code_values[0]; } ?>" name="admin_code[]"   type="text" class="w-50 h-36" <?php if($isAdmin != 1){ echo "disabled";} ?>></td>
												<td><input  value="<?php  if(isset($details['admin_code'])) { echo $admin_code_values[1]; } ?>" name="admin_code[]" type="text" class="w-50 h-36" <?php if($isAdmin != 1){ echo "disabled";} ?>></td>
												<td><input  value="<?php  if(isset($details['admin_code'])) { echo $admin_code_values[2]; } ?>" name="admin_code[]" type="text" class="w-50 h-36" <?php if($isAdmin != 1){ echo "disabled";} ?>></td>
												<td><input  value="<?php  if(isset($details['admin_code'])) { echo $admin_code_values[3]; } ?>" name="admin_code[]" type="text" class="w-50 h-36" <?php if($isAdmin != 1){ echo "disabled";} ?>></td>
												<td><input  value="<?php  if(isset($details['admin_code'])) { echo $admin_code_values[4]; } ?>" name="admin_code[]" type="text" class="w-50 h-36" <?php if($isAdmin != 1){ echo "disabled";} ?>></td>
												<td><input  value="<?php  if(isset($details['admin_code'])) { echo $admin_code_values[5]; } ?>" name="admin_code[]" type="text" class="w-50 h-36" <?php if($isAdmin != 1){ echo "disabled";} ?>></td>
												<td><input  value="<?php  if(isset($details['admin_code'])) { echo $admin_code_values[6]; } ?>" name="admin_code[]" type="text" class="w-50 h-36" <?php if($isAdmin != 1){ echo "disabled";} ?>></td>
												<td><input  value="<?php  if(isset($details['admin_code'])) { echo $admin_code_values[7]; } ?>" name="admin_code[]" type="text" class="w-50 h-36" <?php if($isAdmin != 1){ echo "disabled";} ?>></td>
												<td><input  value="<?php  if(isset($details['admin_code'])) { echo $admin_code_values[8]; } ?>" name="admin_code[]" type="text" class="w-50 h-36" <?php if($isAdmin != 1){ echo "disabled";} ?>></td>
												<td><input  value="<?php  if(isset($details['admin_code'])) { echo $admin_code_values[9]; } ?>" name="admin_code[]" type="text" class="w-50 h-36" <?php if($isAdmin != 1){ echo "disabled";} ?>></td>
												<td><input  value="<?php  if(isset($details['admin_code'])) { echo $admin_code_values[10];} ?>" name="admin_code[]" type="text" class="w-50 h-36" <?php if($isAdmin != 1){ echo "disabled";} ?>></td>
											</table>
										</div>
										<div class="col-md-2">
											<div class="status-drop">
												<select name="status" id="status" <?php if($isAdmin != 1){ echo "disabled";} ?>>
                                                    <option value="">Select Status</option>
													<option value="Applied"  <?php echo ($details['status'] == "Applied" ? "selected" : "") ?>>Applied</option>
                                                    <option value="Approved" <?php echo ($details['status'] == "Approved" ? "selected" : "") ?>>Approved</option>
                                                    <option value="Under Review" <?php echo ($details['status'] == "Under Review" ? "selected" : "") ?> >Under Review</option>
                                                    <option value="Blocked" <?php echo ($details['status'] == "Blocked" ? "selected" : "") ?> >Blocked</option>
                                                    <option value="Closed" <?php echo ($details['status'] == "Closed" ? "selected" : "") ?> >Closed</option>
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="second-part">
							<div class="row">
								<div class="col-md-5">
									<div class="content-second">
										<div class="row">
											<div class="col-md-5">
												<h5><span>*</span>Cell No.</h5>
											</div>
											<div class="col-md-7">
												<input type="number" class="half" id="cell_num" type="text" name="cell_num" value="<?php echo $details['cell_num']; ?>" />
											</div>
										</div>
									</div>
									<div class="content-second">
										<div class="row">
											<div class="col-md-5">
												<h5><span>*</span>Email</h5>
											</div>
											<div class="col-md-7">
												<input type="email" id="email" name="email" value="<?php echo $details['email']; ?>" />
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-2">
								</div>
								<div class="col-md-5">
									<div class="content-second">
										<div class="row">
											<div class="col-md-5">
												<h5>Ref. ID</h5>
											</div>
											<div class="col-md-7">
												<input class="right-border" type="text" name="reference_id" value="<?php echo $details['reference_id']; ?>"  />
											</div>
										</div>
									</div>
									<div class="content-second">
										<div class="row">
											<div class="col-md-5">
												<h5>Ref. Name</h5>
											</div>
											<div class="col-md-7">
												<input class="right-border" type="text" name="reference_name"  value="<?php echo $details['reference_name']; ?>" />
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<center><div class="line"></div></center>
						<div class="third-content">
							<div class="row">
                            <div class="col-md-7 show-ic" style="padding-right:154px;">
                        <div class="img-upload">
                            <img id="blah"  src="{{ asset('/images/' . $details['blah']) }}" name="blah" style="width:100%;height:100%;border-radius: 20px;"/>
                        </div>
                        <div class="clearfix"></div>
                        <div class="image-upload-icon p-abs t-36" style="opacity:0">
                                <i class="fas fa-camera fa-2x m-l-42"></i> <span class="name"></span>
                                {{ Form::file('buyer_featured_image',['id'=>'imgInp']) }}
                                <p>Drag and drop click to upload</p>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <h5><span>*</span>NID No.</h5>
                            </div>
                            <div class="col-md-5">
                                <input type="text" id="nid_no" name="nid_no" value="<?php echo $details['nid_no']; ?>" />
                            </div>
                        </div>
                    </div>
							
								<div class="col-md-5">
									<div class="main-right-social">
										<h4>Social Network ID</h4>
										<div class="row">
											<div class="col-md-5">
												<h5>Instagram</h5>
											</div>
											<div class="col-md-7">
												<div class="input-border">
													<input type="text" name="instagram" id="instagram" value="<?php echo $details['instagram']; ?>"/>
													<a id="instagram_link" target="_blank" href="<?php echo $details['instagram']; ?>"><i class="fa fa-edit fl-r cu-po"></i></a>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-5">
												<h5>Facebook</h5>
											</div>
											<div class="col-md-7">
												<div class="input-border">
													<input type="text" name="facebook" id="facebook" value="<?php echo $details['facebook']; ?>"/>
													<a id="facebook_l" target="_blank" href="<?php echo $details['facebook']; ?>"><i class="fa fa-edit fl-r cu-po"></i></a>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-5">
												<h5>LinkedIn</h5>
											</div>
											<div class="col-md-7">
												<div class="input-border">
													<input type="text" name="linkedin" id="linkedin" value="<?php echo $details['linkedin']; ?>" />
													<a id="linkedin_l" target="_blank" href="<?php echo $details['linkedin']; ?>"><i class="fa fa-edit fl-r cu-po"></i></a>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-5">
												<h5>Twitter</h5>
											</div>
											<div class="col-md-7">
												<div class="input-border">
													<input type="text" name="twitter" id="twitter" value="<?php echo $details['twitter']; ?>"/>
													<a id="twitter_l" target="_blank" href="<?php echo $details['twitter']; ?>"><i class="fa fa-edit fl-r cu-po"></i></a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<center><div class="line"></div></center>
						<div class="second-part">
							<div class="row">
								<div class="col-md-5">
									<div class="content-second">
										<div class="row">
											<div class="col-md-5">
												<h5><span>*</span>Gender</h5>
											</div>
											<div class="col-md-7">
												<select name="gender" id="gender">
                                                    <option value="">Select Gender</option>
													<option value="Male" <?php echo ($details['gender'] == "Male" ? "selected" : "") ?>>Male</option>
													<option value="Femle" <?php echo ($details['gender'] == "Femle" ? "selected" : "") ?>>Female</option>
												</select>
											</div>
										</div>
									</div>
									<div class="content-second">
										<div class="row">
											<div class="col-md-5">
												<h5><span>*</span>Nationality 1</h5>
											</div>
											<div class="col-md-7">
												<select id="nationality" name="nationality">
													<option value="">select nationality</option>
                                                    <?php foreach($countries as $key=>$value): ?>
                                                        <option value="<?php echo  $value['nationality'] ?>" <?php echo ($details['nationality'] == $value['nationality'] ? "selected" : "") ?>><?php echo $value['nationality']; ?></option>
                                                    <?php endforeach; ?>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-2">
								</div>
								<div class="col-md-5">
									<div class="content-second">
										<div class="row">
											<div class="col-md-5">
												<h5><span>*</span>DOB</h5>
											</div>
											<div class="col-md-7">
												<input id="date_of_birth"  value="<?php echo $details['date_of_birth']; ?>" class="half datepicker" type="date" name="date_of_birth" placeholder=""/>
											</div>
										</div>
									</div>
									<div class="content-second">
										<div class="row">
											<div class="col-md-5">
												<h5>Nationality 2</h5>
											</div>
											<div class="col-md-7">
                                                <select id="nationality_2" name="nationality_2">
                                                    <?php foreach($countries as $key=>$value): ?>
                                                        <option <?php echo ($details['nationality_2'] == $value['nationality'] ? "selected" : "") ?>><?php echo $value['nationality']; ?></option>
                                                    <?php endforeach; ?>
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<center><div class="line"></div></center>
						<div class="second-part">
							<div class="row">
								<div class="col-md-5">
									<div class="content-second">
										<div class="row">
											<div class="col-md-5">
												<h5>Yearly Income</h5>
											</div>
											<div class="col-md-7">
												<input type="number" id="yearly_income" value="<?php echo $details['yearly_income']; ?>" name="yearly_income" placeholder="$"/>
											</div>
										</div>
									</div>
									<div class="content-second">
										<div class="row">
											<div class="col-md-6">
												<select name="profession_name" id="profession_name">
                                                    <?php foreach($professions_name as $key=>$value): ?>
													    <option <?php echo ($details['profession_name'] == $value['profession_name'] ? "selected" : "") ?>><?php echo $value['profession_name']; ?></option>
                                                    <?php endforeach; ?>
												</select>
											</div>
											<div class="col-md-6">
												<select name="profession_type" id="profession_type">
                                                    <?php foreach($professions_types as $key=>$value): ?>
													    <option <?php echo ($details['profession_type'] == $value['profession_type'] ? "selected" : "") ?> ><?php echo $value['profession_type']; ?></option>
                                                    <?php endforeach; ?>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-2">
								</div>
								<div class="col-md-5">
									<div class="content-second">
										<div class="row">
											<div class="col-md-5">
												<h5><span>*</span>Account Detail</h5>
												<h6>(To Recieve Payment <span> without tax </span> )</h6>
											</div>
											<div class="col-md-7">
												<textarea name="account_detail" id="account_detail" ><?php echo $details['account_detail']; ?></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<center>
						<div class="main-button">
							<button id="membership_submit_button" class="btn btn-success" type="button">Submit</button>
							<button class="btn btn-success">Add Share</button>
							<a href="" class="btn"><i class="fa fa-file-o"></i></a>
						</div>
					</center>
				</form>
			</div>
		</div>
	</section>
	
	
@endsection

@section('extra-JS')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $(document).ready(function()
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var dateToday = new Date();
        $('.datepicker1').datepicker({
            autoClose: true,
        }).on('changeDate', function(ev){                 
                $('#datepicker1').datepicker('hide');
            });
			
        $(document).on('change', '#profession_name', function(e) {
            e.preventDefault();
            var profession_name = $("#profession_name").val();
            $.ajax({
                    url: "getProfessionOfType",
                    type: "POST",
                    data: {profession_name:profession_name},
                    dataType: "json",
                    success: function (data) 
                    {
                        var html = "";
                        jQuery.each(data['professions'], function(index, item) {
                            html += '<option>'+item['profession_type']+'</option>'
                        });

                        $("#profession_type").html(html);
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) 
                    {
                        alert(errorThrown);
                    }
                });
        });
    });
    $(".fa-camera").click(function () {
            $("#imgInp").trigger('click');
            });
            $('#imgInp').on('change', function() {
                readURL(this);
                //var src = $(this).val();
                //$("#inner-img-upload"). html("<img src="+ src+">");
            });

    function readURL(input) 
    {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<script>
	$(document).ready(function()
    {   
		$("#instagram").keyup(function(){
			$("#instagram_link").attr("href","https://"+$(this).val());
		});

		$("#facebook").keyup(function(){
			$("#facebook_l").attr("href","https://"+$(this).val());
		});

		$("#linkedin").keyup(function(){
			$("#linkedin_l").attr("href","https://"+$(this).val());
		});

		$("#twitter").keyup(function(){
			$("#twitter_l").attr("href","https://"+$(this).val());
		});


		$("#membership_submit_button").click(function(e){
			$('#membership_form').submit()
		});

		$('#membership_form').submit(function(e){
			e.preventDefault();
			var membership_type = $("#membership_type").val();
			var membership_category = $("#membership_category").val();
			var cell_num = $("#cell_num").val();
			var email = $("#email").val();
			var nid_no = $("#nid_no").val();
			var gender = $("#gender").val();
			var date_of_birth = $("#date_of_birth").val();
			var nationality  = $("#nationality").val();
			var account_detail	= $("#account_detail").val();
			var yearly_income  = $("#yearly_income").val();

			if(membership_type == "")
			{
				alert("please fill all required fields");
				return false;
			}	
			if(membership_category == "")
			{
				alert("please fill all required fields");
				return false;
			}	
			if(cell_num == "")
			{
				alert("please fill all fields");
				return false;
			}
			if(email == "")
			{
				alert("please fill all fields");
				return false;
			}	
			if(nid_no == "")
			{
				alert("please fill all fields");
				return false;
			}	
			if(gender == "")
			{
				alert("please fill all fields");
				return false;
			}	
			if(date_of_birth == "")
			{
				alert("please fill all fields");
				return false;
			}
			if(nationality == "")
			{
				alert("please fill all fields");
				return false;
			}
			if(account_detail == "")
			{
				alert("please fill all fields");
				return false;
			}
			if(!$.isNumeric(cell_num))
			{
				alert("please enter valid phone number");
				return false;
			}
			if(!validateEmail(email)){
				alert("please enter valid email");
				return false;
			}
			if(!$.isNumeric(yearly_income))
			{
				alert("please enter valid income");
				return false;
			}
			

			
			
			$.ajax({
					url: "submitMembershipForm",
					type: "POST",
					data:  new FormData(this),
					dataTyp: 'JSON',
					contentType: false,
					cache: false,
					processData: false,
					success: function (data) 
					{
						swal({
                            title: "Successfuly Updated!",
                            text: "",
                            icon: "success",
                            button: "OK",
                        }).then(function() {
                         
                        });
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) 
					{
						alert(errorThrown);
					}
				});
		});
	});
	function validateEmail($email) {
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		return emailReg.test( $email );
	}
</script>
@endsection