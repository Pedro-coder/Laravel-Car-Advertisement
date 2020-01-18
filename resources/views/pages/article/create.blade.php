@extends('layouts.app')

@section('content')
    <section id="article">
        <div class="container shadow p-b-1">
            <h2 class="text-center mt-4 mb-4 p-l-r">Article Post <i class="fas fa-plus-circle"></i><a href="{{ URL('/home') }}"><i class="fa fa-times-circle fl-r crs-pntr" style="font-size:27px;color:#6c757d;"></i></a></h2>
            <hr>
            {!! Form::open(array('id'=>'article_form','route' => 'article.store', 'files' => true)) !!}
                @csrf
                <div class="row" style="opacity:<?php echo $opacity; ?>;">
                    <div class="col-md-3 show-ic">
                        <div class="img-upload">
                            <img id="blah" src="#" style="width:100%;height:100%;border-radius: 20px;"/>
                            <!-- <div id="inner-img-upload">
                                <i class="fas fa-camera fa-2x"></i> <span class="name"></span>
                                {{ Form::file('article_featured_image') }}
                                <p>Drag nd drop click to upload</p>
                            </div> -->
                        </div>
                        <div class="clearfix"></div>
                        <div class="image-upload-icon p-abs t-36" style="opacity:0;">
                                <i class="fas fa-camera fa-2x m-l-12"></i> <span class="name"></span>
                                {{ Form::file('article_featured_image',['id'=>'imgInp']) }}
                                <p style="margin-left:-40px;">Drag and drop click to upload</p>
                        </div>
                        @if ($errors->has('article_featured_image'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('article_featured_image') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-md-5 mt-1">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="sell-type">Post for</span>
                                    </div>
                                    <select class="form-control" id="sell-type" name="sell-type" readonly>
                                        <option readonly>Article</option>
                                    </select>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="article_category">Category</span>
                                    </div>
                                    <select class="form-control{{ $errors->has('article_category') ? ' is-invalid' : '' }}" id="article_category"
                                    name="article_category" value="{{ old('article_category') }}" >
                                        <option value="Local News" <?php if (old('article_category') == 'Local News') { ?> selected="true" <?php } ?>>Local News</option>
                                        <option value="Creative Writing" <?php if (old('article_category') == 'Creative Writing') { ?> selected="true" <?php } ?>>Creative Writing</option>
                                        <option value="Business Writing"  <?php if (old('article_category') == 'Business Writing') { ?> selected="true" <?php } ?>>Business Writing</option>
                                        <option value="Educational Writing" <?php if (old('article_category') == 'Educational Writing') { ?> selected="true" <?php } ?>>Educational Writing</option>
                                        <option value="Advertising" <?php if (old('article_category') == 'Advertising') { ?> selected="true" <?php } ?>>Advertising</option>
                                        <option value="Others" <?php if (old('article_category') == 'Others') { ?> selected="true" <?php } ?>>Others</option>
                                    </select>
                                </div>
                                @if ($errors->has('article_category'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('article_category') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text" id="article_website">My Website</span>
                                  </div>
                                    <input type="text" id="article_website_f" class="form-control{{ $errors->has('article_website') ? ' is-invalid' : '' }}"
                                    placeholder="example.com" name="article_website"  value="{{ old('article_website') }}" >
                                </div>
                                @if ($errors->has('article_website'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('article_website') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text" id="article_title">Title</span>
                                  </div>
                                    <input type="text" class="form-control{{ $errors->has('article_title') ? ' is-invalid' : '' }}"
                                    placeholder="Title" id="article_title" name="article_title"
                                    value="{{ old('article_title') }}" >
                                </div>
                                @if ($errors->has('article_title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('article_title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="article_description">Description</label>
                                <div class="input-group">
                                    <textarea class="form-control{{ $errors->has('article_description') ? ' is-invalid' : '' }}" name="article_description"
                                    id="article_description" rows="6" value="{{ old('article_description') }}" placeholder="Description">{{ old('article_description') }}</textarea>
                                </div>
                                @if ($errors->has('article_description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('article_description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mt-1">
                      <h5><small class="text-muted">My hidden note</small></h5>
                      <hr>
                        <div class="form-group row">
                            <div class="col-md-12 mt-3">
                                <label for="article_info_from">Info from:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control{{ $errors->has('article_info_from') ? ' is-invalid' : '' }}"
                                    placeholder="www.example.com/product" name="article_info_from" value="{{ old('article_info_from') }}" >
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="article_info_from">Save from site</button>
                                    </div>
                                </div>
                                @if ($errors->has('article_info_from'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('article_info_from') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="article_info_description">Description</label>
                                <div class="input-group">
                                    <textarea class="form-control{{ $errors->has('article_info_description') ? ' is-invalid' : '' }}"
                                    name="article_info_description" id="" rows="6" value="{{ old('article_info_description') }}" placeholder="Description">{{ old('article_info_description') }}</textarea>
                                </div>
                                @if ($errors->has('article_info_description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('article_info_description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row mb-2">
                    <div class="col-md-12">
                        <div id="form-footer">
                            <div class="form-footer-right float-right">
                                <a href="#">
                                    <i class="fas fa-download fa-2x"></i>
                                </a>
                                <a href="#">
                                    <i class="fas fa-copy fa-2x"></i>
                                </a>
                                <a href="#">
                                    <i class="fas fa-trash-alt fa-2x"></i>
                                </a>
                                <a href="#">
                                    <i class="fas fa-plus-square fa-2x"></i>
                                </a>
                                <a href="#">
                                    <i class="fas fa-edit fa-2x"></i>
                                </a>
                                <button type="button" class="btn btn-success float-right m-b-12" id="article_form_btn">
                                    {{ __('DONE') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </section>
    @include('partials.cal-modal')
@endsection

@section('extra-JS')
<script>
$(document).ready(function() {
        var allow_form_submission = "";
        $("#article_website_f").on("keyup", function(){
            var email =  $("#article_website_f").val();
            if(!validateEmail(email))
            {
                $("#article_website_f").addClass("is-invalid");
                allow_form_submission = false;
            }
            else
            {
                $("#article_website_f").removeClass("is-invalid");
                allow_form_submission = true;
            }
        });
        $("#article_form_btn").click(function(event){
            event.preventDefault();
            if(!allow_form_submission)
            {
                alert('please enter correct values to submit form');
            }
            else
            {
                $("#article_form").submit();
            }
        });
        $(".fa-camera").click(function () {
            $("#imgInp").trigger('click');
            });
            $('#imgInp').on('change', function() {
                readURL(this);
                //var src = $(this).val();
                //$("#inner-img-upload"). html("<img src="+ src+">");
            })
      
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
    function validateEmail(str) 
    {
        var regex = str.match(/(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/g);
        if (regex == null)
        {
            return false;
        }
        else
        {
            return true;
        }
    }
</script>
@endsection
