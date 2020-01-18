@extends('layouts.app')
@section('custom-styles')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
    <div class="overlay-white" id="ajaxLoading">
        <i class="fa fa-spinner fa-spin sinningIcon" ></i>
    </div>
<div id="contentData">
<form method="POST" enctype="multipart/form-data" action="{{ route('AdvertisementAction') }}">
    <div class="container shadow mt-5" >
        <div class="row justify-content-center">
            <div class="col-md-11 md-offset-1 margin-bottom-20">
                <h3>Advertisement <?php //dd($rows); ?></h3>
                <hr/>
                <div class="row">
                    <div class="col-md-6">
                        <div class="ads-grid">
                            <div class="ads-grid-header">
                                Ads Name
                            </div>
                            @foreach($rows as $row)
                                <div class="ads-grid-row " style="cursor:pointer">
                                  <span class="ads-lis-cla"  id="ads_ist<?php echo $row -> id; ?>"> {{ $row->adds_name }} </span> <span class="delete" id="<?php echo $row -> id; ?>"><i class="fa fa-times" style="font-size:24px;color: grey;float: right;cursor:pointer;"></i></span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-5 section1">
                                <div class="ads-type-box">
                                    <div class="ads-type-box-title">Ads Type</div>
                                    <div class="ads-type-image">
                                        <div class="ads-type-option form-group">
                                            <input type="radio" name="ads_type" value="image" @if(!empty($rowData)) @if($rowData->adds_type != 'embed_code' && $rowData->adds_type != 'referral_code') checked @endif @else checked @endif   id="ads_type_image"> <label for="ads_type_image">Image</label>
                                        </div>
                                        <div id="drop-zone" class="form-group">
                                            @if(!empty($rowData)) @if(!empty($rowData->image))
                                                <img src="{{ asset('/uploads/adsImages/'.$rowData->image) }}" class="imageDisplay">
                                            @endif @else
                                                <img src="#" id="imagePreview" class="imageDisplay" style="display: none">
                                            @endif
                                            <div class="cameraIcon">
                                                <i class="fa fa-camera"></i>
                                            </div>
                                            <div id="clickHere">
                                                Drop file here or Click to Upload
                                            </div>
                                            <input type="file" class="form-control dragableinputfile" onchange="readURL(this);" name="file" id="file" />
                                        </div>
                                        <div class="ads-type-option form-group">
                                            <input type="text" class="form-control" placeholder="Link" name="link" id="link">
                                        </div>
                                        <div class="ads-type-option form-group">
                                            <input type="radio" name="ads_type" value="embed_code" @if(!empty($rowData)) @if($rowData->adds_type == 'embed_code') checked @endif @endif id="ads_type_embed_code"> <label for="ads_type_embed_code">Embed Code</label>
                                            <br>
                                            <textarea rows="3" name="ads_type_embed_code" id="ads_type_embed_code_in" class="form-control">@if(!empty($rowData)) {{ $rowData->embed_code }} @endif</textarea>
                                        </div>
                                        <div class="ads-type-option form-group">
                                            <input type="radio" name="ads_type" value="referral_code" @if(!empty($rowData)) @if($rowData->adds_type == 'referral_code') checked @endif @endif  id="ads_type_referral_code_code"> <label for="ads_type_referral_code">Referral Code</label>
                                            <br>
                                            <textarea rows="3" name="ads_type_referral_code" id="ads_type_referral_code_in" class="form-control">@if(!empty($rowData)) {{ $rowData->referral_code }} @endif</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7 section2 full-height">
                                <div class="form-group">
                                    <div class="row">
                                        <!-- <div class="col-md-2"><label class="formLabel">Serial</label></div>
                                        <div class="col-md-5"><input type="text" readonly name="serial" value="@if(!empty($rowData)) {{ $rowData->id }} @endif" class="form-control"></div>
                                        <div class="col-md-4" align="right" style="    line-height: 35px;">
                                            {{--<i class="fa fa-arrows-v custom-arrowDesign"></i>--}}
                                            <i title="Previous" class="fa fa-chevron-left pull-left navigate-icon navigate-icon-disabled" ></i>&nbsp;
                                            <i title="Next" class="fa fa-chevron-right pull-left navigate-icon" onclick="findNextAds(0,'next');"></i>
                                            <span class="gray-text"> @if($rows->count() > 0 ) out of {{ $rows->count() }} @endif</span>
                                        </div> -->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-2"><label class="formLabel">Name</label></div>
                                        <div class="col-md-10">
                                            <input type="text"id="ads_name" name="ads_name" value="@if(!empty($rowData)) {{ $rowData->adds_name }} @endif" required class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-2"><label class="formLabel">Date</label></div>
                                        <div class="col-md-5 bfh-datepicker">
                                            <input type="text" name="from_date" autocomplete="off" required id="datepicker1" value="@if(!empty($rowData)) {{ date('m/d/Y',strtotime($rowData->from_date)) }} @endif" class="form-control datepicker1 bfh-datepicker">
                                        </div>
                                        <div class="col-md-5 bfh-datepicker" align="right">
                                            <input type="text" name="to_date" autocomplete="off" required id="datepicker2" value="@if(!empty($rowData)) {{ date('m/d/Y',strtotime($rowData->to_date)) }} @endif" class="form-control datepicker2 bfh-datepicker">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="blue-Box blue-Box-query2">
                                            <div class="blue-Box-Title">Position</div>
                                            <div>
                                                <div class="ads-type-option">
                                                    <input type="radio" name="style" checked value="popup" id="popup" @if(!empty($rowData)) @if($rowData->style == 'popup') checked @endif @else checked @endif > <label for="popup">Pop-up</label>
                                                </div>
                                                <div class="ads-type-option">
                                                    <input type="radio" name="style" value="scroll" id="scroll" @if(!empty($rowData)) @if($rowData->style == 'scroll') checked @endif  @endif > <label for="scroll">Fix</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="blue-Box blue-Box-query1">
                                            <div class="blue-Box-Title">Position</div>
                                            <div>
                                                <div class="ads-type-option">
                                                    <input type="radio" name="position" value="top" @if(!empty($rowData)) @if($rowData->position == 'top') checked @endif @else checked @endif id="top"> <label for="top">Top</label>
                                                </div>
                                                <div class="ads-type-option">
                                                    <input type="radio" name="position" value="left" id="left" @if(!empty($rowData)) @if($rowData->position == 'left') checked @endif  @endif > <label for="left">Left</label>
                                                </div>
                                                <div class="ads-type-option">
                                                    <input type="radio" name="position" value="right" id="right" @if(!empty($rowData)) @if($rowData->position == 'right') checked @endif  @endif > <label for="right">Right</label>
                                                </div>
                                                <div class="ads-type-option">
                                                    <input type="radio" name="position" value="bottom" id="bottom" @if(!empty($rowData)) @if($rowData->position == 'bottom') checked @endif  @endif> <label for="bottom">Bottom</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 mr-lf-95">
                                        <div class="blue-Box no-borders blue-Box-query3">
                                        <div>
                                            <div class="ads-type-option  form-group">
                                                <input type="submit" name="adsActionBtn" class="btn btn-primary btn-custom-Width" value="ADD">
                                            </div>
                                            <div class="ads-type-option form-group">
                                                <input type="submit" name="adsActionBtn" class="btn btn-primary btn-custom-Width" value="DELETE">
                                            </div>
                                            <div class="ads-type-option">
                                                <input type="submit" name="adsActionBtn" class="btn btn-primary btn-custom-Width" value="EDIT">
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                
                               
                                <!-- <div class="blue-Box blue-Box-absolute-bottom no-borders blue-Box-query3">
                                    <div>
                                        <div class="ads-type-option  form-group">
                                            <input type="submit" name="adsActionBtn" class="btn btn-primary btn-custom-Width" value="ADD">
                                        </div>
                                        <div class="ads-type-option form-group">
                                            <input type="submit" name="adsActionBtn" class="btn btn-primary btn-custom-Width" value="DELETE">
                                        </div>
                                        <div class="ads-type-option">
                                            <input type="submit" name="adsActionBtn" class="btn btn-primary btn-custom-Width" value="EDIT">
                                        </div>
                                    </div>
                                </div> -->
                            </div>

                        </div>
                    </div>
                    @if($user->IsAdmin == 1)
                        <div class="col-md-4 admin-side-section">
                            <div class="admin-side-inner">
                                <label class="gray-text">Admin Side:</label>
                                <div class="row">
                                    <div class="col-md-5" align="right">
                                        <label class="font-weight-bold">Ads Post On</label>
                                    </div>
                                    <div class="col-md-7" align="left">
                                        <div class="form-group">
                                            <input type="radio" id="profile" name="ads_post_on" @if(!empty($rowData)) @if($rowData->ads_post_on == 'profile') checked @endif @else checked @endif checked value="profile">
                                            <label class="font-weight-bold">Profile</label>
                                            <br />
                                            <input type="radio" id="other_page" name="ads_post_on" @if(!empty($rowData)) @if($rowData->ads_post_on == 'otherpages') checked @endif  @endif value="otherpages">
                                            <label class="font-weight-bold">Other Page</label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                
                @else
                    <input type="radio" style="display: none;" readonly checked name="ads_post_on" value="profile">
                @endif
                @csrf
                </div>
            </div>
            
            <div class="p-t-27 w-56-p">
                <a href="{{ URL('/home') }}"><i class="fa fa-times-circle fl-r crs-pntr" style="font-size:27px;color:#6c757d;"></i></a>
            </div>
        </div>
        
        </div>
    </form>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
</script>
<script>
  
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(".ads-lis-cla").click(function(){
            var id = $(this).attr("id").replace("ads_ist","");
            $.ajax({
                    url: "getAdsData",
                    type: "POST",
                    data: {id:id},
                    dataType: "json",
                    success: function (data) 
                    {
                        if (!data) {
                            return;
                        }
                        $("#ads_name").val(data['response'][0]['adds_name']);
                        $("#datepicker1").val(formatDate(data['response'][0]['from_date']));
                        $("#datepicker2").val(formatDate(data['response'][0]['to_date']));
                        if(data['response'][0]['style'] == 'scroll')
                        {
                            $('#scroll').prop('checked', true);
                        }
                        else
                        {
                            $('#popup').prop('checked', true);
                        }
                        if(data['response'][0]['position'] == 'top')
                        {
                            $('#top').prop('checked', true);
                        }
                        if(data['response'][0]['position'] == 'left')
                        {
                            $('#left').prop('checked', true);
                        }
                        if(data['response'][0]['position'] == 'right')
                        {
                            $('#right').prop('checked', true);
                        }
                        if(data['response'][0]['position'] == 'bottom')
                        {
                            $('#bottom').prop('checked', true);
                        }
                        if(data['response'][0]['ads_post_on'] == 'profile')
                        {
                            $('#profile').prop('checked', true);
                        }
                        if(data['response'][0]['ads_post_on'] == 'otherpages')
                        {
                            $('#other_page').prop('checked', true);
                        }
                        if(data['response'][0]['adds_type'] == 'image')
                        {
                            $('#ads_type_image').prop('checked', true);
                            $("#link").val(data['response'][0]['image_link']);
                            $("#imagePreview").attr("src","{{asset('uploads/adsImages')}}/"+data['response'][0]['image']);
                            $("#imagePreview").css('display','block');
                            $('#ads_type_embed_code_in').val("");
                            $('#ads_type_referral_code_in').val("");
                        }
                        if(data['response'][0]['adds_type'] == 'embed_code')
                        {
                            $('#ads_type_embed_code').prop('checked', true);
                            $("#ads_type_embed_code_in").val(data['response'][0]['embed_code']);
                            $("#imagePreview").attr("src","");
                            $("#link").val();
                            $('#ads_type_referral_code_in').val("");
                        }
                        if(data['response'][0]['adds_type'] == 'referral_code')
                        {
                            $('#ads_type_referral_code_code').prop('checked', true);
                            $('#ads_type_referral_code_in').val(data['response'][0]['referral_code']);
                            $("#link").val();
                            $('#ads_type_embed_code_in').val("");
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) 
                    {
                        alert(errorThrown);
                    }
                });
        });
        $(".delete").click(function(){
            var elmnt  = $(this);
            var id = $(this).attr('id');
            $.ajax({
                    url: "deleteAdd",
                    type: "POST",
                    data: {id:id},
                    dataType: "json",
                    success: function (data) 
                    {
                        console.log(data);
                        Swal.fire("Deleted!","","success").then(function() {
                            elmnt.remove();
                            location.reload(true);
                        });
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) 
                    {
                        alert(errorThrown);
                    }
                });
        });
    });
</script>
<script>

    $(function () {
      
        var dropZoneId = "drop-zone";
        var buttonId = "clickHere";
        var mouseOverClass = "mouse-over";

        var dropZone = $("#" + dropZoneId);
        var ooleft = dropZone.offset().left;
        var ooright = dropZone.outerWidth() + ooleft;
        var ootop = dropZone.offset().top;
        var oobottom = dropZone.outerHeight() + ootop;
        var inputFile = dropZone.find("input");
        document.getElementById(dropZoneId).addEventListener("dragover", function (e) {
            e.preventDefault();
            e.stopPropagation();
            dropZone.addClass(mouseOverClass);
            var x = e.pageX;
            var y = e.pageY;

            if (!(x < ooleft || x > ooright || y < ootop || y > oobottom)) {
                inputFile.offset({ top: y - 15, left: x - 100 });
            } else {
                inputFile.offset({ top: -400, left: -400 });
            }

        }, true);

        if (buttonId != "") {
            var clickZone = $("#" + buttonId);

            var oleft = clickZone.offset().left;
            var oright = clickZone.outerWidth() + oleft;
            var otop = clickZone.offset().top;
            var obottom = clickZone.outerHeight() + otop;

            $("#" + buttonId).mousemove(function (e) {
                var x = e.pageX;
                var y = e.pageY;
                if (!(x < oleft || x > oright || y < otop || y > obottom)) {
                    inputFile.offset({ top: y - 15, left: x - 160 });
                } else {
                    inputFile.offset({ top: -400, left: -400 });
                }
            });
        }

        document.getElementById(dropZoneId).addEventListener("drop", function (e) {
            $("#" + dropZoneId).removeClass(mouseOverClass);
        }, true);
        $('.section2,.admin-side-section').height($('.ads-type-box').height());
        $('.blue-Box-query2').css("left",Number($('.blue-Box-query1').width())+25+"px");
        $('.blue-Box-query3').css('left',Number($('.blue-Box-query1').width() + $('.blue-Box-query2').width())+"px")
    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#imagePreview').attr('src', e.target.result);
                $('#imagePreview').show('slow');
            }

            reader.readAsDataURL(input.files[0]);
        }
    }


    function findNextAds(adsId,requestMode){
        document.getElementById('ajaxLoading').style.display = 'block';
        $.ajax({
            url:'{{ route('AdvertisementShow') }}',
            type:'GET',
            data:{id:adsId,mode:requestMode},
            success:function (response) {
                var bottomData = response.bottomData;
                var contentData = response.contentData;
                $('#contentData').html(contentData);
                $('.initDatePicker').html(bottomData);
                setTimeout(function(){

                    AB();
                },3000);
            }
        })
    }
    function formatDate (input) {
        var datePart = input.match(/\d+/g),
        year = datePart[0], 
        month = datePart[1], day = datePart[2];

        return day+'/'+month+'/'+year;
    }

    $(function () {
        var dateToday = new Date();
        $('#datepicker1').datepicker({
            format: 'mm/dd/yyyy',
            startDate: "today",
            autoClose: true,
        }).on('changeDate', function(ev){                 
                $('#datepicker1').datepicker('hide');
            });
        $('#datepicker2').datepicker({
            format: 'mm/dd/yyyy',
            startDate: "today",
            autoClose: true
        }).on('changeDate', function(ev){                 
                $('#datepicker2').datepicker('hide');
            });
    });

</script>
    </div>
@endsection

@section('extra-JS')
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <div class="initDatePicker" id="initDatePicker">

    </div>
    <script>

            function AB() {
                var a = $('div').find('.ads-type-box');
                var a1 = $('div').find('.section2');
                var a2 = $('div').find('.admin-side-section');
                var a3 = $('div').find('.blue-Box-query2');
                var a4 = $('div').find('.blue-Box-query3');
                var a5 = $('div').find('.blue-Box-query1');
                var a6 = document.getElementById('datepicker1');
                var a7 = document.getElementById('datepicker2');
                console.log(a6);

                a1.height(a.height());
                a2.height(a.height());
                a3.css("left", Number(a5.width()) + 25 + "px");
                a4.css('left', Number(a5.width() + a3.width()) + "px");

                $(a6).datepicker({
                    format: 'mm/dd/yyyy',
                    autoClose: true
                });
                $(a7).datepicker({
                    format: 'mm/dd/yyyy',
                    autoClose: true
                });
                document.getElementById('ajaxLoading').style.display = 'none';
            }

    </script>

@endsection
