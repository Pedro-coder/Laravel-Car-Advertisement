@extends('layouts.app')

@section('content')

    @include('partials._user-profile')

    <section class="membership-sec">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-9 col-sm-12 col-xs-12">


                    <div class="top-head-sec">
                        <div class="member-top-bar">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3 class="main-head-top">Membership</h3>
                                </div>
                                <div class="col-sm-6">
                                    <a href="{{ URL('/home') }}" style="margin-top:9px!important;"><i class="fa fa-close"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="reg-sec">
                            <div class="row">
                                <div class="col-md-6">

                                    <a href="downloadMemberPdfFile">
                                        <div class="row">
                                            <div class="col-md-12 justify-content-center">
                                                <img src="{{ URL::to('/') }}/img/circle-icon.png" alt="pdf image" height="150" width="150" style="margin-left: 8em;margin-top: 2em;margin-bottom: 1em;"/>
                                                <input id="file_name" type="hidden" value="">
                                                <div class="inner-button" id="downloadMemberPdfFile1" style="cursor:pointer;">
                                                    <h5>Download Blank Registration From Here</h5>
                                                </div>
                                            </div>

                                        </div>
                                    </a>

                                </div>
                                <div class="col-md-6">
                                    <div class="main-button-regis">
                                        <a href="{{url('userMembershipdetails', $user)}}">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <img src="{{ asset('/uploads/avatars/' . Auth::user()->avatar) }}" alt="pdf image"/>
                                                    <div class="inner-button main-sec">
                                                        <h5>My Membership Detail</h5>
                                                    </div>
                                                </div>

                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($isAdmin == 1)
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="member-admin-line">
                                        <h5 class="member-admin">Membership Admin</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="reg-sec">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="main-button-regis">
                                            <form id="upload_pdf_file_form" method="post" enctype="multipart/form-data">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <img src="{{ URL::to('/') }}/img/circle-icon.png" alt="pdf image"
                                                             onclick="$('#upload_pdf_file').click();"/>
                                                        <input class="form-control" type="file" name="upload_pdf_file" id="upload_pdf_file"
                                                               style="visibility:hidden">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="inner-button" onclick="$('#upload_pdf_file').click();" style="cursor:pointer;">
                                                            <h5>Upload Blank Registration From Here</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="main-button-regis image">
                                            <img id="member-image" src="{{ asset('/uploads/avatars/' . $avatar) }}" alt="Not Found"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="update-and-verify">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="main-update">
                                                <span class="inp-up">$</span>
                                                <input id="share_rate" type="number" value="<?php if (isset($share)) {
                                                    echo $share;
                                                } ?>" class="inp-up">
                                                <h5 id="update_share_rate" class="crs-pntr">UPDATE SHARE RATE</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="verify-content">
                                                <div class="input-div">
                                                    <i class="fa fa-user"></i>
                                                    <input id="member_id" type="hidden" val="">
                                                    <input id="member_email" name="member_email" type="text" style="width:69%;" name="verify_user"
                                                           placeholder=""/>
                                                    <i id="search_btn" class="fa fa-search srch" style="cursor:pointer"></i>
                                                    <h3 id="verify" style="cursor:pointer;">Verify</h3>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="add-prof">Add Profession List</h3>
                                    <div class="table-div">

                                        <table class="table">
                                            <thead>
                                            <tr class="head">
                                                <th>Profession</th>
                                                <th>Type</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($professions as $key=>$value): ?>
                                            <tr id="<?php echo $value['id']; ?>" style="cursor:pointer;" class="professionList">
                                                <td>{{$value['profession_name']}}</td>
                                                <td>{{$value['profession_type']}}<i class="fa fa-times profession-del"
                                                                                    style="font-size:24px;color: grey;float: right;cursor:pointer;"></i>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="sec-table">
                                        <table class="table">
                                            <tbody>
                                            <tr class="profession_id" id="">
                                                <td><input id="profession_name" name="profession_name" type="text" style="width:100%"></td>
                                                <td><input id="profession_type" name="profession_type" type="text" style="width:100%"></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="bottom-btns">
                                        <a href="#" id="add_profession" class="btn btn-success right">Add</a>
                                        <a href="#" id="update_profession" class="btn btn-success right">Update</a>
                                        <a href="#" id="delete_profession" class="btn btn-success">Delete</a>
                                    </div>
                                </div>
                            </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>


@endsection

@section('extra-JS')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#add_profession").click(function (e) {
                e.preventDefault();
                var profession_name = $("#profession_name").val();
                var profession_type = $("#profession_type").val();
                $.ajax({
                    url: "addProfession",
                    type: "POST",
                    data: {profession_name: profession_name, profession_type: profession_type},
                    dataType: "json",
                    success: function (data) {
                        swal({
                            title: "Successfully Added!",
                            text: "",
                            icon: "success",
                            button: "OK",
                        }).then(function () {
                            location.reload(true);
                        });

                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        alert(errorThrown);
                    }
                });
            });
            $(".professionList").click(function () {
                var profession_id = $(this).attr("id");
                $.ajax({
                    url: "getProfession",
                    type: "POST",
                    data: {profession_id: profession_id},
                    dataType: "json",
                    success: function (data) {
                        console.log(data);
                        console.log(data['res'][0]['id']);
                        $(".profession_id").attr("id", data['res'][0]['id']);
                        $("#profession_name").val(data['res'][0]['profession_name']);
                        $("#profession_type").val(data['res'][0]['profession_type']);
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        alert(errorThrown);
                    }
                });
            });
            $("#update_profession").click(function (e) {
                e.preventDefault();
                var id = $(".profession_id").attr("id");
                var profession_name = $("#profession_name").val();
                var profession_type = $("#profession_type").val();
                $.ajax({
                    url: "updateProfession",
                    type: "POST",
                    data: {id: id, profession_name: profession_name, profession_type: profession_type},
                    dataType: "json",
                    success: function (data) {
                        swal({
                            title: "Successfuly Updated!",
                            text: "",
                            icon: "success",
                            button: "OK",
                        }).then(function () {
                            location.reload(true);
                        });

                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        alert(errorThrown);
                    }
                });
            });
            $(".profession-del").click(function () {
                var id = $(this).closest('tr').attr("id");
                $.ajax({
                    url: "deleteProfession",
                    type: "POST",
                    data: {id: id},
                    dataType: "json",
                    success: function (data) {
                        swal({
                            title: "Successfuly Deleted!",
                            text: "",
                            icon: "success",
                            button: "OK",
                        }).then(function () {
                            location.reload(true);
                        });

                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        alert(errorThrown);
                    }
                });
            });
            $("#search_btn").click(function (e) {
                e.preventDefault();
                var email = $("#member_email").val();
                $.ajax({
                    url: "getEmailBasedData",
                    type: "POST",
                    data: {email: email},
                    dataType: "JSON",
                    success: function (data) {
                        $("#member_id").attr("data-val", data['res'][0]['id']);
                        $("#member-image").attr('src', "{{asset('uploads/avatars')}}/" + data['res'][0]['avatar']);

                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        alert(errorThrown);
                    }
                });
            });
            $(document).on('change', '#upload_pdf_file', function () {
                $('#upload_pdf_file_form').submit()

            });
            $('#upload_pdf_file_form').submit(function (e) {
                e.preventDefault();
                $.ajax({
                    url: "uploadMemberPdfFile",
                    type: "POST",
                    data: new FormData(this),
                    dataTyp: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        obj = JSON.parse(data);
                        $("#file_name").val(obj.file_name);
                        swal({
                            title: "Successfuly Updated!",
                            text: "",
                            icon: "success",
                            button: "OK",
                        }).then(function () {

                        });
                    },

                });
            });
            $("#update_share_rate").click(function () {
                var share = $("#share_rate").val();
                $.ajax({
                    url: "updateShareRate",
                    type: "POST",
                    data: {share: share},
                    dataTyp: 'JSON',
                    success: function (data) {
                        swal({
                            title: "Successfuly Updated!",
                            text: "",
                            icon: "success",
                            button: "OK",
                        }).then(function () {

                        });
                    },

                });
            });
            // $('#downloadMemberPdfFile').click(function(e){
            //     e.preventDefault();
            //     $.ajax({
            //         url: "downloadMemberPdfFile",
            //         type: "POST",
            //         data:  new FormData(this),
            //         dataTyp: 'JSON',
            //         contentType: false,
            //         cache: false,
            //         processData: false,
            //         success: function (data) {

            //         },

            //     });
            // });
            $("#verify").click(function () {
                var email = $("#member_email").val();
                $.ajax({
                    url: "getAndMoveVerifyDetails",
                    type: "POST",
                    data: {email: email},
                    dataTyp: 'JSON',
                    success: function (data) {
                        obj = JSON.parse(data);
                        if (obj.success != 0) {
                            window.location.href = "/getMemberDetailsUsingEmail?email=" + email;
                        }
                        else {
                            window.location.href = "/getMemberDetailsUsingEmail?email=" + email;
                        }
                    },

                });
            });
        });
    </script>
@endsection