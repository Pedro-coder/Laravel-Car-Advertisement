@extends('layouts.app')

@section('content')
    

    
    <section class="membership-sec">
        <input type="hidden" value="{{$dispute_maker_email}}" id="log_email">
        <input type="hidden" value="{{$user_id}}" id="user_id">
        <input type="hidden" value="{{$type}}" id="whattype">
        <input type="hidden" value="{{$isDisputeAdmin}}" id="dispute_manager_C">
        <input type="hidden" value="<?php if(isset($disputes[0]['avatr1'])) { echo $disputes[0]['avatr1'];  } ?>" id="dispute_maker_avatar">
        
 		<div class="container">
			<div class="top-head-sec">
				<div class="member-top-bar">
					<div class="row">
						<div class="col-sm-6" style="
    padding-top: 13px;                
">
							<h3 class="main-head-top">Dispute </h3>
						</div>
						<div class="col-sm-6" style="
    padding-bottom: 12px;
">
							<a href="/home"><i class="fa fa-close"></i></a>
						</div>
					</div>
				</div>
				<div class="reg-sec">
					<div class="row">
						
					</div>
				</div>
				<div class="reg-sec">
					<div class="row">
						<div class="col-md-6">
						
						</div>
						<div class="col-md-6">
						
						</div>	
					</div>
					<div class="update-and-verify">
						<div class="row">

						</div>
					</div>
				</div>	
				<div class="">
					<div class="col-md-12" style="
    height: 900px;
">
						<div class="radio-div">
						<div class="m-t-12"></div>
						<label class="radio-inline"><input value="myrecord" type="radio" name="optradio" checked>My Record</label>
						<label class="radio-inline"><input value="otherrecord" type="radio" name="optradio">Others Open Record</label>
						<label class="radio-inline"><input value="clodedrecord" type="radio" name="optradio">All Closed Record</label>
                        <?php if($isDisputeAdmin == 1){  ?>
                        <label class="radio-inline"><input value="managerrecord" type="radio" name="optradio">Dispute Manager Record</label>
                        <?php } ?>
                        <div class="m-b-12"></div>
					</div>
						<div class="table-div">
						
							<table class="table">
								<thead>
								  <tr class="head">
										<th>Dispute No</th>
										<th>Datetime</th>
										<th>Dispute Note</th>
										<th>Dispute Maker</th>
										<th>Status</th>
										<th>Open With</th>
										<th>Conversation Record</th>
								  </tr>
								</thead>
								<tbody id="disputes_table">
                                <?php 
                                   
                                    $i = 0;
                                    foreach($disputes as $key=>$value): 
                                ?>
								  <tr id="<?php echo $i; ?>" style="cursor:pointer;" class="get-dispute" data-open-with-pic<?php echo $i; ?>="<?php echo $value['avatr2']; ?>" data-maker-pic<?php echo $i; ?> ="<?php echo $value['avatr1']; ?>">
										<td id="dispute_no<?php echo $i; ?>"><?php echo $value['d_dispute_no']; ?></td>
										<td id="created_at<?php echo $i; ?>"><?php echo $value['d_created_at']; ?></td>
										<td id="dispute_subject<?php echo $i; ?>"><?php echo $value['dispute_subject']; ?></td>
										<td  id="dispute_maker<?php echo $i; ?>"><?php echo $value['d_dispute_maker']; ?></td>
										<td class="status" id="status<?php echo $i; ?>"><?php echo $value['d_status']; ?></td>
										<td  id="open_with<?php echo $i; ?>"><?php echo $value['d_open_with']; ?></td>
										<td id="dispute_no<?php echo $i; ?>"><?php echo "From: ".$value['d_dispute_maker']." To: ".$value['d_open_with'] ."<br>". $value['r_notes']; ?></td>
								  </tr>
                                <?php 
                                    $i++;
                                    endforeach;  
                                ?>
								</tbody>
							  </table>
						</div>
						<div class="col-xs-12">
							<span data-dispute-no="<?php echo rand(); ?>" data-dispute-maker="{{$dispute_maker_email}}" class="f-l-r m-r-90" id="add_new" style="cursor:pointer;">+ Add a new dispute</span>
                        </div>
                        <div class="clearfix"></div>
                        <form id="dispute_details" method="POST">
                        <div class="row" style="
    margin-top: 22px;
">
                                <div class="col-xs-6" style="
    margin-left: 407px;
">
                                    <div class="img-left-cont">
                                        <img id="dispute_maker_img" class="h-82-p b-r-38" src="{{ asset('/uploads/avatars/' . $user->avatar) }}" alt="Profile picture"/>
                                    </div>
                                </div>
                                <div class="col-xs-6" style="
    margin-left: 407px;
">
                                    <div class="img-left-cont f-r open_with_img_dv">
                                        <img id="open_with_img" class="h-82-p b-r-38" src="{{ asset('/uploads/avatars/defaultpic.jpg') }}" alt="No Picture"/>
                                    </div>
                                </div>
                        </div>
                        <!-- <div class="clearfix"></div> -->
                        <div class="row">
                            <div class="col-xs-3 m-l-81">	
                                <div class="input-group">
                                    <input name="dispute_unique_no" id="dispute_unique_no" type="text" class="form-control" placeholder="Dispute No">
                                    <div class="input-group-btn">
                                        <button class="btn btn-default" type="button" id="searc_dis">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="m-t-12">
								    <span class="f-s-18"><?php echo  date("F j, Y, H:i:s"); ?></span>
							    </div>
                            </div>	
                            <div class="col-xs-3">
                                <div class="">
                                    <div class="input-group">
                                        <input name="dispute_maker_email" id="dispute_maker_email" type="text" class="form-control" placeholder="dispute maker" readonly>
                                        <!-- <div class="input-group-btn">
                                            <button id="search_maker_user" class="btn btn-default" type="button" <?php echo ($isAdmin > 0 ? "" : "disabled"); ?>>
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div> -->
                                    </div>
							    </div>
                            </div> 
                            <div class="col-xs-3">
                                <div class="">
                                </div>
                                <div class="">
                                    <select name="dispute_opts" class="form-control" id="dispute_opts">
                                        <option>Select any option</option>
                                    </select>
							    </div>
                            </div>	
                            <div class="col-xs-3">
                                
                                <div class="">
                                    <div class="input-group dispute_onpen_with_dv">
                                        <input id="dispute_onpen_with" name="dispute_onpen_with" type="email" class="form-control" placeholder="open with">
                                        <input id="replyer_id" name="replyer_id" type="hidden" value="">
                                        <div class="input-group-btn">
                                            <button class="btn btn-default search_user" type="button">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
							    </div>
                            </div> 	
                        </div>	
						<div class="row">
                            <div class="col-xs-2 m-t-12 m-div"  style="padding:6px;">
                                <span id="dis-sub"><?php echo (!empty($dispute_subject) ? $dispute_subject : ""); ?></span>
                            </div>
                            <div class="col-xs-10 m-t-12 text-center sub-div">
                                <input type="text" placeholder="subject" id="dispute_subject" name="dispute_subject" class="form-control input-lg" value="" style="border-radius: 0px;" disabled="disabled">
                            </div>
                        </div>
						<div class="col-xs-10 m-l-86">
								<div class="form-group">
								    <div  class="form-control editable"   id="comment" style="
    height: 131px;overflow:scroll
">
                                        <?php foreach($replies as $key => $value): ?>
                                            <span><?php 
                                                    $email = App\User::where('id',$value['note_id'])->get()->toArray();
                                                    echo "From:   ".$email[0]['email'];
                                                    $email2 = App\User::where('id',$value['replyer_id'])->get()->toArray();

                                                    if(isset($email2[0]['email']))
                                                    {
                                                        $email_with = $email2[0]['email']; 
                                                    }
                                                    else
                                                    {
                                                        $email_with = "Dispute Manager"; 
                                                    }

                                                    echo "    To:  ".  $email_with;
                                                ?>
                                            </span>
                                            <span><?php echo date("F j, Y, H:i:s",strtotime($value['created_at'])); ?></span>
                                            <p>{{$value['notes']}}</p>
                                        <?php endforeach; ?>
                                    </div>
							    </div>
						</div>
						<div class="col-xs-10 m-l-86 m-t-12">
								<div class="form-group">
										<textarea placeholder="Details here...." name="notes" class="form-control" rows="5" id="comment2" style="background-color: #fcfbfb;"></textarea>
									  </div>
                        </div>
                        <div class="m-b-12">
                        </div>
						<div class="col-xs-12 m-t-12">
							<button id="submit_dispute" type="button" class="btn btn-success f-l-r">Submit</button>
                        </div>
                        </form>
					</div>
				</div>
			</div>
        </div>
   
	</section>
	
@endsection

@section('extra-JS')
    <script src="https://cdn.jsdelivr.net/npm/js-sql-parser@1.0.7/dist/parser/sqlParser.js"></script>
    <script src="{{ asset('js/FileSaver.js') }}"></script>
    <script src="{{ asset('js/Blob.js') }}"></script>
    <script src="{{ asset('js/xlsx.core.min.js') }}"></script>
    <script src="{{ asset('js/tableexport.js') }}"></script>
    <script>
        $(document).ready(function(){    

            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $("#add_new").click(function(){
//yyyy
                
                $("#dispute_subject").val("");
                $("#dis-sub").text("");

                $("#dispute_subject").removeAttr('disabled');
                $("#comment").addClass("hide");
                $("#dispute_subject").focus();
                $("#dispute_opts").prop("disabled",false);


               $("#dispute_maker_email").val($(this).attr("data-dispute-maker"));
               $("#dispute_unique_no").val($(this).attr("data-dispute-no"));

               if($("#whattype").val() == "replier")
                {
                    $html =    '<option value="action_request">Action Request</option>'
                                        + '<option value="to_dispute_manager">To Dispute Manager</option>'
                                        + '<option value="under_review">Under Review</option>'
                                        + '<option value="closed">Close Request</option>';

                }
                else{

                    
                $html =    '<option value="action_request">Action Request</option>'
                                        + '<option value="to_dispute_manager">To Dispute Manager</option>';
                                      
                }
                
                //test
                $("#dispute_opts").html($html);
            });
            $("#submit_dispute").click(function(){

                if($("#replyer_id").val() == "" || $("#comment2").val() == "")
                {
                    alert("please fill all mandatory fields");
                    return false;
                } 

                $.ajax({
                    url: "add_dispute",
                    type: "POST",
                    data: {dispute : $("#dispute_details").serializeArray()},
                    dataType: "JSON",
                    success: function (data) 
                    {
                        $res1 = data['res1'];	
                        $res2 = data['res2'];
                        console.log( $res2 );
                        if (typeof value === "undefined") 
                        {
                            //$html   = "From:"+$("#log_email").val()+"To:"+$("#dispute_onpen_with")+"   "+data['date_to_show']+"\n\n";
                        }
                        else
                        {
                           // $html   = "From:"+$res1.dispute_maker+"To:"+"   "+data['date_to_show']+"\n\n";
                        }
                        // $html1  = $res2.notes;
                        // $("#comment").append($html);
                        // $("#comment").append($html1);
                        location.reload();
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                       
                    }
                });
            });
        });
    </script>
    <script>
            $('.search_user').on('click', function(e)
            {
                e.preventDefault();
                $.ajax({
                    url: "{{url('/findmenu_options')}}",
                    type: "GET",
                    data:{
                    email: $("#dispute_onpen_with").val(),
                    },
                    success: function (msg) {
                        if(msg != 1){
                            var obj = jQuery.parseJSON( msg );
                            $("#open_with_img").attr('src', '/uploads/avatars/'+obj[0].avatar);
                            $("#replyer_id").val(obj[0].id);
                        }
                    },
                    error: function (data) {
                    }
                });
            });

            $("#search_maker_user").on('click', function(e)
            {
                e.preventDefault();
                $.ajax({
                    url: "{{url('/findmenu_options')}}",
                    type: "GET",
                    data:{
                    email: $("#dispute_maker_email").val(),
                    },
                    success: function (msg) {
                        if(msg != 1){
                            var obj = jQuery.parseJSON( msg );
                            $("#dispute_maker_img").attr('src', '/uploads/avatars/'+obj[0].avatar);
                            // $("#replyer_id").val(obj[0].id);
                        }
                    },
                    error: function (data) {
                    }
                });
            });

            $(document).on("click",".get-dispute",function() {

                var  id = $(this).attr("id");

                if($(this).find('#status'+id).text()== "closed")
                {
                    $(".dispute_onpen_with_dv").addClass('hide');
                    $(".open_with_img_dv").addClass("hide");
                    $("#dispute_opts").prop( "disabled", true );
                }
                else
                {
                    $(".dispute_onpen_with_dv").removeClass('hide');
                    $(".open_with_img_dv").removeClass("hide");
                    $("#dispute_opts").prop( "disabled", false);
                }

                $("#comment").removeClass("hide");


                var log_email = $("#log_email").val();
                var dispute_no = $("#dispute_no"+id).text();
                $("#dispute_unique_no").val(dispute_no);
                var dispute_maker = $("#dispute_maker"+id).text();
                $("#dispute_maker_email").val(dispute_maker);
                var open_with = $("#open_with"+id).text();
                $("#dispute_onpen_with").val(open_with);
                var user_id = $("#user_id").val();
                $("#replyer_id").val(user_id);

                var dispute_subject = $("#dispute_subject"+id).text();
                $("#dis-sub").text(dispute_subject);

                var dispute_manager_check = $("#dispute_manager_C").val();

                if(log_email == dispute_maker && dispute_manager_check == 0)
                {
                    var html = "<option value=''>Select any option</option><option value='action_request'>Action Request</option><option value='to_dispute_manager'>To Dispute Manager</option><option value='under_review'>Under Review</option><option value='closed'>Closed</option>";
                    $("#dispute_opts").html(html);
                    $("#dispute_maker_img").attr('src', "{{ URL::asset('uploads/avatars/') }}"+"/"+$(this).attr("data-maker-pic"+id));
                $("#open_with_img").attr('src', "{{ URL::asset('uploads/avatars/') }}"+"/"+$(this).attr("data-open-with-pic"+id));
                }
                else if(log_email == dispute_maker && dispute_manager_check == 1)
                {
                    var html = "<option value=''>Select any option</option><option value='action_request'>Action Request</option><option value='to_dispute_manager'>To Dispute Manager</option><option value='under_review'>Under Review</option><option value='closed'>Closed</option><option value='close_request'>Close Request</option><option value='payment_request'>Payment Request</option><option value='refund_request'>Refund Request</option>";
                    $("#open_with_img").attr('src', "{{ URL::asset('uploads/avatars/') }}"+"/"+'defaultpic.jpg');
                    $("#dispute_opts").html(html);
                }
                else if(log_email == open_with && dispute_manager_check == 0)
                {
                    var html = "<option value=''>Select any option</option><option value='action_request'>Action Request</option><option value='to_dispute_manager'>To Dispute Manager</option><option value='under_review'>Under Review</option><option value='close_request'>Close Request</option>";
                    $("#dispute_opts").html(html);
                    $("#dispute_maker_img").attr('src', "{{ URL::asset('uploads/avatars/') }}"+"/"+$(this).attr("data-maker-pic"+id));
                $("#open_with_img").attr('src', "{{ URL::asset('uploads/avatars/') }}"+"/"+$(this).attr("data-open-with-pic"+id));
                }
                else if(log_email == open_with && dispute_manager_check == 1)
                {
                    var html = "<option value=''>Select any option</option><option value='action_request'>Action Request</option><option value='to_dispute_manager'>To Dispute Manager</option><option value='under_review'>Under Review</option><option value='closed'>Closed</option><option value='close_request'>Close Request</option><option value='payment_request'>Payment Request</option><option value='refund_request'>Refund Request</option>";
                    $("#dispute_opts").html(html);
                    $("#dispute_maker_img").attr('src', "{{ URL::asset('uploads/avatars/') }}"+"/"+$(this).attr("data-maker-pic"+id));
                $("#open_with_img").attr('src', "{{ URL::asset('uploads/avatars/') }}"+"/"+$(this).attr("data-open-with-pic"+id));
                }

                $.ajax({
                    url: "get_note_of_record",
                    type: "POST",
                    data: {record : dispute_no},
                    dataType: "JSON",
                    success: function (data) 
                    {
                        var comments = "";
                        $.each(data['response'], function( index, value ) {
                            comments += "from:  "+value.dispute_maker+"   To:  "+value.open_with + "  " + value.created_at + "<br>" + value.notes + "<br>";
                            $("#comment").html("");
                            $("#comment").html(comments);
                        });
                    }
                }); 
                




                console.log($(this).attr("data-open-with-pic"+id));
               
            });
    </script>

    <script>
            $('input[type=radio][name=optradio]').change(function() {
                $.ajax({
                    url: "get_records",
                    type: "POST",
                    data: {record : this.value},
                    dataType: "JSON",
                    success: function (data) 
                    {
                        var html=""
                        var obj  = data['response'];
                        console.log(obj);
                        $("#disputes_table").html("");
                        var i = 0;
                        $.each( obj, function( key, value ) {
                            html += "<tr id='"+i+"' data-open-with-pic"+i+"='"+value.avatr2+"'  data-maker-pic"+i+"='"+value.avatr1+"'  style='cursor:pointer;' class='get-dispute'><td id='dispute_no"+i+"'>"+value.d_dispute_no+"</td><td id='created_at"+i+"'>"+value.d_created_at+"</td><td id='dispute_subject"+i+"'>"+value.dispute_subject+"</td><td id='dispute_maker"+i+"'>"+value.d_dispute_maker+"</td><td id='status"+i+"'>"+value.d_status+"</td><td id='open_with"+i+"'>"+value.d_open_with+"</td><td id='dispute_no"+i+"'>"+value.r_notes+"</td></tr>";
                            i++;
                        });
                        $("#disputes_table").html(html);
                    }
                });   
            });

    </script>

    <script>

        $("#comment").prop("disabled", true).off('click');

        $("#dispute_opts").change(function(){
            if($("#dispute_opts").val() == "to_dispute_manager")
            {
                $("#dispute_onpen_with").val("Dispute Manager");
                $("#dispute_onpen_with").prop("readonly", true);
                $(".dispute_onpen_with_dv").removeClass('hide');
                $(".open_with_img_dv").removeClass("hide");
                $("#replyer_id").val(0);
                $("#open_with_img").attr('src', "{{ URL::asset('uploads/avatars/') }}"+"/"+'defaultpic.jpg');
            }
            else if($("#dispute_opts").val() == "under_review")
            {
                $("#dispute_onpen_with").val($("#log_email").val());
                $("#replyer_id").val($("#user_id").val());
                $("#dispute_onpen_with").prop("readonly", true);
                $(".dispute_onpen_with_dv").removeClass('hide');
                $(".open_with_img_dv").removeClass("hide");
                $("#open_with_img").attr('src', "{{ URL::asset('uploads/avatars/') }}"+"/"+$("#dispute_maker_avatar").val());
            }
            else if($("#dispute_opts").val() == "closed")
            {
                $(".dispute_onpen_with_dv").addClass('hide');
                $(".open_with_img_dv").addClass("hide");
            }
            else
            {
                $("#dispute_onpen_with").val("");
                $("#dispute_onpen_with").prop("readonly", false);
                $(".dispute_onpen_with_dv").removeClass('hide');
                $(".open_with_img_dv").removeClass("hide");
            }
        });

        $("#searc_dis").click(function(){
            dispute_no_val =  $("#dispute_unique_no").val();
            $.ajax({
                    url: "get_all_dis_rec",
                    type: "POST",
                    data: {dispute_no_val : dispute_no_val},
                    dataType: "JSON",
                    success: function (data) 
                    {
                        console.log(data.response[0]);

                        if(data.response == "")
                        {
                            alert("you are not authorized to search!")
                            return false;
                        }

                        var resp = data.response[0];
                        var dispute_manager_check = $("#dispute_manager_C").val();
                        $("#dispute_maker_email").val(resp.d_dispute_maker);
                        $("#dispute_onpen_with").val(resp.d_open_with);
                        var log_email = $("#log_email").val();
                        if(log_email == resp.d_dispute_maker && dispute_manager_check == 0)
                        {
                            var html = "<option value=''>Select any option</option><option value='action_request'>Action Request</option><option value='to_dispute_manager'>To Dispute Manager</option><option value='under_review'>Under Review</option><option value='closed'>Closed</option>";
                            $("#dispute_opts").html(html);
                        }
                        else if(log_email == resp.d_dispute_maker && dispute_manager_check == 1)
                        {
                            var html = "<option value=''>Select any option</option><option value='action_request'>Action Request</option><option value='to_dispute_manager'>To Dispute Manager</option><option value='under_review'>Under Review</option><option value='closed'>Closed</option><option value='close_request'>Close Request</option><option value='payment_request'>Payment Request</option><option value='refund_request'>Refund Request</option>";
                            $("#dispute_opts").html(html);
                        }


                        else if(log_email == resp.d_open_with && dispute_manager_check == 0)
                        {
                            var html = "<option value=''>Select any option</option><option value='action_request'>Action Request</option><option value='to_dispute_manager'>To Dispute Manager</option><option value='under_review'>Under Review</option><option value='close_request'>Close Request</option>";
                            $("#dispute_opts").html(html);
                        }
                        else if(log_email ==resp.d_open_with && dispute_manager_check == 1)
                        {
                            var html = "<option value=''>Select any option</option><option value='action_request'>Action Request</option><option value='to_dispute_manager'>To Dispute Manager</option><option value='under_review'>Under Review</option><option value='closed'>Closed</option><option value='close_request'>Close Request</option><option value='payment_request'>Payment Request</option><option value='refund_request'>Refund Request</option>";
                            $("#dispute_opts").html(html);
                        }


                            
                        $("#dis-sub").text(resp.dispute_subject);
                        $("#comment").removeClass("hide");

                        var texts = ""

                        $.each(data.response , function(index, val) { 
                  
                            texts += "from:  "+val.d_dispute_maker+"   To:  "+val.d_open_with + "  " + val.d_created_at + "<br>" + val.r_notes + "<br>";
                        });


                       
            
                        $("#comment").html(texts);

                        $("#dispute_maker_img").attr('src', "{{ URL::asset('uploads/avatars/') }}"+"/"+resp.avatr1);
                        $("#open_with_img").attr('src', "{{ URL::asset('uploads/avatars/') }}"+"/"+resp.avatr2);



                    }
                });
        });

</script>





@endsection