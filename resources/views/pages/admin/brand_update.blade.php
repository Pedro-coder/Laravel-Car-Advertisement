@extends('layouts.app')
<style>
    .sec1{
        border:4px solid #c7c7c7;
        border-bottom:none;
        border-top-left-radius:15px;
        border-top-right-radius:15px;
        padding:5px;
    }
    .sec2{
        border:4px solid #c7c7c7;
        border-bottom:none;
    }

    .sec3{
        border:4px solid #c7c7c7;
        border-bottom:none;
        height:45%;
    }

    .sec4{
        border:4px solid #c7c7c7;
        height:15%;
    }
    .site-label{
        background-color:#e7ecf0; margin-top:100px; text-align:center; width:15%; font-size:14pt;


    }
    .slider{
        width: 46% !important;
        float: right !important; 
    }
    @media(max-width:992px){
        .site-label{
            margin-top:0px; }
    }
</style>
@section('content')
    <section id="admin" class="admin-panel" style="margin-top: 20px;">
        <div class="">
            <div class="col-md-6 offset-md-3">
            <?php $var = 1; ?>
                <div class="container page_contents" style="opacity:<?php echo $var; ?>;">
                    <form id="brandupdate_form" action="" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                            <div class=" col-md-3 col-sm-3 col-xs-3 col-lg-3 col-xlg-3 sec1">
                                <img id="all_pic_general_class_1" class="all_pic_general_class" style="width:12%;" data-ref-id="pic1"  src="/uploads/avatars/Untitled.png">
                                <input type="file" name="logo_pic" id="pic1" style="display: none;" value="">
                                <input name="test_next_to_logo" style="width:80%" type="text" value="{{$info_element_array['test_next_to_logo']}}">

                            </div>

                        </div>
                        <div class="row sec2">
                            <div class="row col-md-12">
                                <div class="col-md-2 col-sm-2 col-xs-2 col-lg-2 col-xlg-2">
                                    <img id="all_pic_general_class_2" data-ref-id="pic2" class="all_pic_general_class" style="width:99%; margin-top:5px;margin-left:5px;margin-bottom:5px;" src="/uploads/avatars/Untitled.png">
                                <input name="header_left_pic" id="pic2" type="file" style="display: none;">
                                </div>

                                <div class="col-md-6" >

                                    <label class="site-label"> Site Name </label>
                                    <input style="width:60%" type="text" name="site_name" value="{{$info_element_array['site_name']}}">


                                </div>
                                
                              


                                <div class="col-md-1 col-sm-1 col-xs-1 col-lg-1 col-xlg-1">
                                    <img id="all_pic_general_class_3" class="all_pic_general_class" data-ref-id="pic3" src="/uploads/avatars/Untitled.png" style="width: 80px;">
                                    <input name="header_right_pic" id="pic3" type="file" style="display: none;">
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12 col-xlg-12">

                                    <label style="background-color:#e7ecf0; text-align:center; width:18%; font-size:14pt;"> Slogan </label>
                                    <input style="width:70%" type="text" name="site_slogan" value="{{$info_element_array['site_slogan']}}">

                                </div>
                            </div>

                        </div>
                        <div class="row sec3">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-right:0px !important">
                                <div class="row">
                                    <div class="col-md-10" style="margin-top:12px;">
                                        <div class="slider" id="slider"></div>
                                    </div>
                                    <div class="col-md-2">
                                        <img id="all_pic_general_class_4" class="all_pic_general_class" data-ref-id="pic4" style="width:3%; height:9%; margin:2px; float:right;" src="/uploads/avatars/Untitled.png">
                                        <input name="above_footer_pic" id="pic4" type="file" style="display: none;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row sec4">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-right:0px !important">
                                <img id="all_pic_general_class_5" class="all_pic_general_class" data-ref-id="pic5" style="width:3%; height:30%; margin:2px; float:right;" src="/uploads/avatars/Untitled.png">
                                <input name="footer_pic" id="pic5" type="file" style="display: none;">
                            </div>

                        </div>
                        <div class="col-md-offset-10 col-sm-offset-10 col-xs-offset-10 col-lg-offset-10 col-xlg-offset-10  col-md-2 col-sm-2 col-xs-2 col-lg-2 col-xlg-2 " style="padding-right:0px; float: right;">
                            <input type="submit" name="update" value="Update" style="background-color: #21a551; border-radius: 10px; color: white; font-weight: bold; font-size: 23pt; margin: 5px 5px 33px 5px; float: right; border: none; padding: 8px 50px;">
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </section>
@endsection

@section('extra-JS')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(document).ready(function(){
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }); 
        $( "#slider" ).slider({
            max: 100,
            min: 0,
            change: function(event,ui){
                console.log(ui.value);
                var data = ui.value/100;
                $('.page_contents').attr('style', 'opacity:' + ui.value/100);
                $.ajax({
                    url: "OpacityUpdate",
                    type: "POST",
                    data: {data : data},
                    dataType: "JSON",
                    success: function (data) {
                            console.log(data['success']); 							
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                           
                        }
                });
            },
        });
        var image_selected = "";
            $('.all_pic_general_class').on('click', function(){
                $("#"+$(this).attr('data-ref-id')).click();
                image_selected = $(this).attr('id');
            });
            $('#brandupdate_form :input[type="file"]').on('change', function() {
                console.log(image_selected);
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    console.log("in if");
                    reader.onload = function (e) {
                        $("#"+image_selected).attr('src', e.target.result);
                    }

                    reader.readAsDataURL(this.files[0]);
                }
            });
        });



  </script>
    
@endsection
