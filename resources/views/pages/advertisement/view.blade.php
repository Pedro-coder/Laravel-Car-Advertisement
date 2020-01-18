<form method="POST" enctype="multipart/form-data" action="{{ route('AdvertisementAction') }}">
    <div class="container shadow mt-5">
        <div class="row justify-content-center">
            <div class="col-md-11 md-offset-1 margin-bottom-20">
                <h3>Advertisement</h3>
                <hr/>
                <div class="row">
                    <div class="col-md-6">
                        <div class="ads-grid">
                            <div class="ads-grid-header">
                                Ads Name
                            </div>
                            @foreach($rows as $row)
                                <div class="ads-grid-row">
                                    {{ $row->adds_name }}
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
                                            <input type="radio" name="ads_type" value="image"
                                                   @if(!empty($rowData)) @if($rowData->adds_type != 'embed_code' && $rowData->adds_type != 'referral_code') checked
                                                   @endif @else checked @endif   id="ads_type_image"> <label
                                                    for="ads_type_image">Image</label>
                                        </div>
                                        <div id="drop-zone" class="form-group">
                                            @if(!empty($rowData)) @if(!empty($rowData->image))
                                                <img src="{{ asset('/uploads/adsImages/'.$rowData->image) }}"
                                                     class="imageDisplay">
                                            @endif @else
                                                <img src="#" id="imagePreview" class="imageDisplay"
                                                     style="display: none">
                                            @endif
                                            <div class="cameraIcon">
                                                <i class="fa fa-camera"></i>
                                            </div>
                                            <div id="clickHere">
                                                Drop file here or Click to Upload
                                            </div>
                                            <input type="file" class="form-control dragableinputfile"
                                                   onchange="readURL(this);" name="file" id="file"/>
                                        </div>
                                        <div class="ads-type-option form-group">
                                            <input type="text" class="form-control" placeholder="Link" name="link">
                                        </div>
                                        <div class="ads-type-option form-group">
                                            <input type="radio" name="ads_type" value="embed_code"
                                                   @if(!empty($rowData)) @if($rowData->adds_type == 'embed_code') checked
                                                   @endif @endif id="ads_type_embed_code"> <label
                                                    for="ads_type_embed_code">Embed Code</label>
                                            <br>
                                            <textarea rows="3" name="ads_type_embed_code"
                                                      class="form-control">@if(!empty($rowData)) {{ $rowData->embed_code }} @endif</textarea>
                                        </div>
                                        <div class="ads-type-option form-group">
                                            <input type="radio" name="ads_type" value="referral_code"
                                                   @if(!empty($rowData)) @if($rowData->adds_type == 'referral_code') checked
                                                   @endif @endif  id="ads_type_referral_code_code"> <label
                                                    for="ads_type_referral_code">Referral Code</label>
                                            <br>
                                            <textarea rows="3" name="ads_type_referral_code"
                                                      class="form-control">@if(!empty($rowData)) {{ $rowData->referral_code }} @endif</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7 section2 full-height">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-2"><label class="formLabel">Serial</label></div>
                                        <div class="col-md-5"><input type="text" readonly name="serial"
                                                                     value="@if(!empty($rowData)) {{ $rowData->id }} @endif"
                                                                     class="form-control"></div>
                                        <div class="col-md-4" align="right" style="    line-height: 35px;">
                                            @php
                                            $nextId = !empty($next_id) ? $next_id[0]:0;
                                            $prevId = !empty($prev_id) ? $prev_id[0]:0;
                                           @endphp
                                            <i title="Previous"
                                               class="fa fa-chevron-left pull-left navigate-icon @if($prevId == 0) navigate-icon-disabled @endif" onclick="@if($prevId == 0) {{ 'return false;' }} @endif findNextAds('{{ $prevId }}','prev');"></i>&nbsp;
                                            <i title="Next" class="fa fa-chevron-right pull-left navigate-icon @if($nextId == 0) navigate-icon-disabled @endif"
                                               onclick=" @if($nextId == 0) {{ 'return false;' }} @endif findNextAds('{{ $nextId }}','next');"></i>
                                            <span class="gray-text"> @if($rows->count() > 0 ) out
                                                of {{ $rows->count() }} @endif</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-2"><label class="formLabel">Name</label></div>
                                        <div class="col-md-10">
                                            <input type="text" name="ads_name"
                                                   value="@if(!empty($rowData)) {{ $rowData->adds_name }} @endif"
                                                   required class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-2"><label class="formLabel">Date</label></div>
                                        <div class="col-md-5 bfh-datepicker">
                                            <input type="text" name="from_date" autocomplete="off" required
                                                   id="datepicker1"
                                                   value="@if(!empty($rowData)){{ date('m/d/Y',strtotime($rowData->from_date)) }}@endif"
                                                   class="form-control datepicker1 bfh-datepicker">
                                        </div>
                                        <div class="col-md-5 bfh-datepicker" align="right">
                                            <input type="text" name="to_date" autocomplete="off" required
                                                   id="datepicker2"
                                                   value="@if(!empty($rowData)){{ date('m/d/Y',strtotime($rowData->to_date)) }}@endif"
                                                   class="form-control datepicker2 bfh-datepicker">
                                        </div>
                                    </div>
                                </div>
                                <div class="blue-Box blue-Box-absolute-bottom blue-Box-query1">
                                    <div class="blue-Box-Title">Position</div>
                                    <div>
                                        <div class="ads-type-option">
                                            <input type="radio" name="position" value="top"
                                                   @if(!empty($rowData)) @if($rowData->position == 'top') checked
                                                   @endif @else checked @endif id="top"> <label for="top">Top</label>
                                        </div>
                                        <div class="ads-type-option">
                                            <input type="radio" name="position" value="left" id="left"
                                                   @if(!empty($rowData)) @if($rowData->position == 'left') checked @endif  @endif >
                                            <label for="left">Left</label>
                                        </div>
                                        <div class="ads-type-option">
                                            <input type="radio" name="position" value="right" id="right"
                                                   @if(!empty($rowData)) @if($rowData->position == 'right') checked @endif  @endif >
                                            <label for="right">Right</label>
                                        </div>
                                        <div class="ads-type-option">
                                            <input type="radio" name="position" value="bottom" id="bottom"
                                                   @if(!empty($rowData)) @if($rowData->position == 'bottom') checked @endif  @endif>
                                            <label for="bottom">Bottom</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="blue-Box blue-Box-absolute-bottom blue-Box-query2">
                                    <div class="blue-Box-Title">Position</div>
                                    <div>
                                        <div class="ads-type-option">
                                            <input type="radio" name="style" checked value="popup" id="popup"
                                                   @if(!empty($rowData)) @if($rowData->style == 'popup') checked
                                                   @endif @else checked @endif > <label for="popup">Pop-up</label>
                                        </div>
                                        <div class="ads-type-option">
                                            <input type="radio" name="style" value="scroll" id="scroll"
                                                   @if(!empty($rowData)) @if($rowData->style == 'scroll') checked @endif  @endif >
                                            <label for="scroll">Scroll</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="blue-Box blue-Box-absolute-bottom no-borders blue-Box-query3">
                                    <div>
                                        <div class="ads-type-option  form-group">
                                            <input type="submit" name="adsActionBtn"
                                                   class="btn btn-primary btn-custom-Width" value="ADD">
                                        </div>
                                        <div class="ads-type-option form-group">
                                            <input type="submit" name="adsActionBtn"
                                                   class="btn btn-primary btn-custom-Width" value="DELETE">
                                        </div>
                                        <div class="ads-type-option">
                                            <input type="submit" name="adsActionBtn"
                                                   class="btn btn-primary btn-custom-Width" value="EDIT">
                                        </div>
                                    </div>
                                </div>
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
                                            <input type="radio" name="ads_post_on"
                                                   @if(!empty($rowData)) @if($rowData->ads_post_on == 'profile') checked
                                                   @endif @else checked @endif checked value="profile">
                                            <label class="font-weight-bold">Profile</label>
                                            <br/>
                                            <input type="radio" name="ads_post_on"
                                                   @if(!empty($rowData)) @if($rowData->ads_post_on == 'otherpages') checked
                                                   @endif  @endif value="otherpages">
                                            <label class="font-weight-bold">Other Page</label>
                                        </div>

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
    </div>
    </div>
</form>

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
                inputFile.offset({top: y - 15, left: x - 100});
            } else {
                inputFile.offset({top: -400, left: -400});
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
                    inputFile.offset({top: y - 15, left: x - 160});
                } else {
                    inputFile.offset({top: -400, left: -400});
                }
            });
        }

        document.getElementById(dropZoneId).addEventListener("drop", function (e) {
            $("#" + dropZoneId).removeClass(mouseOverClass);
        }, true);

        $('.section2,.admin-side-section').height($('.ads-type-box').height());
        $('.blue-Box-query2').css("left", Number($('.blue-Box-query1').width()) + 25 + "px");
        $('.blue-Box-query3').css('left', Number($('.blue-Box-query1').width() + $('.blue-Box-query2').width()) + "px");
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
            dataType: "json",
            data:{id:adsId,mode:requestMode},
            success:function (response) {
                //response = $.parseJSON(response);
                console.log('Debugger Here');
                console.log(response);
                var contentData = response.contentData;
                var bottomData = response.bottomData;
                document.getElementById('contentData').innerHTML = contentData;
                document.getElementById('initDatePicker').innerHTML = bottomData;
                setTimeout(function(){
                    AB();
                },3000);

            }
        });
    }


</script>