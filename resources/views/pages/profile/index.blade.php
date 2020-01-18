@extends('layouts.app')

@section('content')
    <!--- image style -->

    <style>


        #myImgm {
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        #myImgm:hover {
            opacity: 0.7;
        }

        /* The Modal (background) */
        .modalmatul {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0, 0, 0); /* Fallback color */
            background-color: rgba(0, 0, 0, 0.9); /* Black w/ opacity */
        }

        /* Modalmatul Content (image) */
        .modalmatul-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
        }

        /* Caption of Modalmatul Image */
        #caption {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
            text-align: center;
            color: #ccc;
            padding: 10px 0;
            height: 150px;
        }

        /* Add Animation */
        .modalmatul-content, #caption {
            -webkit-animation-name: zoom;
            -webkit-animation-duration: 0.6s;
            animation-name: zoom;
            animation-duration: 0.6s;
        }

        @-webkit-keyframes zoom {
            from {
                -webkit-transform: scale(0)
            }
            to {
                -webkit-transform: scale(1)
            }
        }

        @keyframes zoom {
            from {
                transform: scale(0)
            }
            to {
                transform: scale(1)
            }
        }

        /* The Close Button */
        #close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
        }

        #close:hover,
        #close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        #close2 {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
        }

        #close2:hover,
        #close2:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        /* 100% Image Width on Smaller Screens */
        @media only screen and (max-width: 700px) {
            .modalmatul-content {
                width: 100%;
            }
        }
    </style>





    @include('partials._user-profile')
    <!--end of image style -->
    <div class="container  mt-1 wd-80-pr">
        <div class="row justify-content-center ">
            <div class="col-md-9 col-sm-12 col-xs-12 shadow pt-4">
                <div class="card mb-5">
                    <div class="card-header text-center">
                        <div class="row pt-4">
                            <div class="col-sm-4 mb-2">
                                <img src="{{ asset('/uploads/avatars/' . $user->avatar) }}"
                                     style="width:150px; height:150px;border-radius:5%;">
                                <h6 class="card-title mt-3 mb-3">{{ $user->name }}'s Profile</h6>
                                <a class="btn btn-primary-blue" data-toggle="modal" href='#updateProfilePicture'>Update
                                    Photo</a>

                            </div>
                            <div class="col-sm-4 mb-2">
                                <img id="myImgm" src="{{ asset('/uploads/photoId/' . $user->photo_id) }}"
                                     style="width:150px; height:150px;border-radius:5%;">
                                <h6 class="card-title mt-3 mb-3">Photo ID</h6>
                                <a class="btn btn-primary-blue lightbox" data-toggle="modal" href='#updateProfilePhotoId'>Update
                                    Photo</a>


                                <!-- The Modal -->
                                <div id="myModal" class="modalmatul">
                                    <span id="close">&times;</span>
                                    <img class="modalmatul-content" id="img01">
                                    <div id="caption"></div>
                                </div>


                            </div>
                            <div class="col-sm-4 p-r-8 mb-2">

                                <img id="myImgm2" src="{{ asset('/uploads/webcam/' . $user->webcam_image) }}"
                                     style="width:150px; height:150px;border-radius:5%;">
                                <h6 class="card-title mt-3 mb-3">&nbsp;</h6>
                                <a class="btn btn-primary-blue" data-toggle="modal" href='#uploadWebCamImage'>Take Picture
                                    with ID</a>

                                <div id="myModal2" class="modalmatul">
                                    <span id="close2">&times;</span>
                                    <img class="modalmatul-content-content" id="img02">
                                    <div id="caption"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12 pt-3">
                        </div>
                        <form action="{{ route('updateUser') }}" method="POST">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <label for="phone_no" class="col-md-6">Mobile No.</label>
                                        <div class="col-md-6">
                                            <input id="phone_no" type="number"
                                                   class="form-control form-control {{ $errors->has('phone_no') ? ' is-invalid' : '' }}"
                                                   name="phone_no" value="{{ $user->phone_no }}"
                                                   placeholder="Enter your phone no...">
                                        </div>
                                    </div>

                                    @if ($errors->has('phone_no'))
                                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('phone_no') }}</strong>
                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <label for="location" class="col-md-6">Where are you now ?</label>
                                        <div class="col-md-6">
                                            <input id="location" type="location"
                                                   class="form-control{{ $errors->has('location') ? ' is-invalid' : '' }}"
                                                   name="location" value="{{ $user->location }}"
                                                   placeholder="Enter your location...">
                                        </div>
                                    </div>

                                    @if ($errors->has('location'))
                                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('location') }}</strong>
                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <label for="paypal_email" class="col-md-6">PayPal Email</label>
                                        <div class="col-md-6">
                                            <input id="paypal_email" type="paypal_email"
                                                   class="form-control{{ $errors->has('paypal_email') ? ' is-invalid' : '' }}"
                                                   name="paypal_email" value="{{ $user->paypal_email }}"
                                                   placeholder="Enter your paypal email...">
                                        </div>
                                    </div>

                                    @if ($errors->has('paypal_email'))
                                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('paypal_email') }}</strong>
                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <div class="col-md-6 offset-md-6">
                                    <button type="submit" class="btn btn-primary-blue-right">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateProfilePicture">
        <div class="modal-dialog">
            <div class="modal-content">
                <form enctype="multipart/form-data" action="{{ route('updatePic') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <img src="{{ asset('/uploads/avatars/' . $user->avatar) }}"
                             class="img-responsive center-block profile1-img"
                             style=" margin: 0px auto !important; display: block; width:150px; height:150px;border-radius:5%;">
                        <hr>
                        <label>Profile Picture</label>
                        <input type="file" name="avatar" class="form-control" id="profile">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateProfilePhotoId">
        <div class="modal-dialog">
            <div class="modal-content">
                <form enctype="multipart/form-data" action="{{ route('updatePic') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <img src="{{ asset('/uploads/photoId/' . $user->photo_id) }}"
                             class="img-responsive center-block 2nd-img-app"
                             style=" margin: 0 auto !important; display: block; width:150px; height:150px;border-radius:5%;">
                        <hr>
                        <label>Profile Picture</label>
                        <input type="file" name="photo_id" class="form-control" id="photo_id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="uploadWebCamImage">
        <div class="modal-dialog">
            <div class="modal-content">
                <form enctype="multipart/form-data" action="{{ route('updatePic') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div id="my_camera"></div>
                        <input type="hidden" value="" id="webcam_image" name="webcam_image">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-default" id="take_picture">Take Picture</button>
                        {{-- <button type="submit" class="btn btn-success">Upload</button> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
    <script src="https://pixlcore.com/demos/webcamjs/webcam.min.js"></script>

    <script language="JavaScript">
        Webcam.set({
            width: 320,
            height: 240,
            image_format: 'jpeg',
            jpeg_quality: 90
        });
        Webcam.attach('#my_camera');
        $(document).ready(function () {

            $('#take_picture').click(function () {
                Webcam.snap(function (data_uri) { // display results in page document.getElementById('results').innerHTML = '
                    $('#webcam_image').val(data_uri);
                    $('#my_camera').html(
                        '<img src="' + data_uri + '" />');
                });

                $("#profile").on('click', function () {
                    readURL(this);
                    var src = $(this).val();
                    $("#inner-img-upload").html("<img src=" + src + ">");
                });

            });
            $(document).on("change", "#profile", function (event) {
                var imgToApp = 'profile1-img';
                readURL(this, imgToApp);
            });
            $(document).on("change", "#photo_id", function (event) {
                var imgToApp = '2nd-img-app';
                readURL(this, imgToApp);
            });

            function readURL(input, imgtToApp) {
                console.log(imgtToApp);
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('.' + imgtToApp).attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }
        });
    </script>
    <script>
        // Get the modal
        var modalma = document.getElementById('myModal');
        var modalma2 = document.getElementById('myModal2');

        // Get the image and insert it inside the modal - use its "alt" text as a caption
        var img = document.getElementById('myImgm');
        var img2 = document.getElementById('myImgm2');
        var modalImg = document.getElementById("img01");
        var modalImg2 = document.getElementById("img02");
        // var captionText = document.getElementById("caption");
        img.onclick = function () {
            modalma.style.display = "block";
            modalImg.src = this.src;
            // captionText.innerHTML = this.alt;
        }
        img2.onclick = function () {
            modalma2.style.display = "block";
            modalImg2.src = this.src;
            // captionText.innerHTML = this.alt;
        }

        // Get the <span> element that closes the modal
        var span = document.getElementById("close");
        var span2 = document.getElementById("close2");

        // When the user clicks on <span> (x), close the modal
        span.onclick = function () {
            console.log('spam1');
            modalma.style.display = "none";

        }
        span2.onclick = function () {
            console.log('spam2');
            modalma2.style.display = "none";
        }
    </script>

@endsection
