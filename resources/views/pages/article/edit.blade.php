@extends('layouts.app')

@section('content')
<section id="article">
    <div class="container">
        <h2 class="text-center mt-4 mb-4">Edit {{ $article->article_title }} <i class="fas fa-plus-circle"></i></h2>
        <hr>
        {!! Form::open(array('route' => ['article.update', $article->id], 'method' => 'PUT', 'files' => true)) !!}
            @csrf
            <div class="row">
                <div class="col-md-3">
                  <div class="img-upload">
                    @if( $article->article_featured_image)
                      <div id="uploaded-image" class="col-md-8 offset-md-2 mt-5">
                          <img src="{{ asset('uploads/article/' . $article->article_featured_image) }}">
                      </div>
                      <div id="update_image" class="col-md-8 offset-md-2 pt-5">
                          <i class="fas fa-camera fa-2x"></i> <span class="name"></span>
                          {{ Form::file('article_featured_image') }}
                          <p>Drag nd drop click to upload</p>
                      </div>
                    @else
                      <div id="inner-img-upload">
                          <i class="fas fa-camera fa-2x"></i> <span class="name"></span>
                          {{ Form::file('article_featured_image') }}
                          <p>Drag nd drop click to upload</p>
                      </div>
                    @endif
                  </div>
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
                              name="article_category" value="{{ $article->article_category }}" >
                                  <option>{{ $article->article_category }}</option>
                                  <option>-----------------</option>
                                  <option>Local News</option>
                                  <option>Creative Writing</option>
                                  <option>Business Writing</option>
                                  <option>Educational Writing</option>
                                  <option>Advertising</option>
                                  <option>Others</option>
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
                              <input type="text" id="article_website" class="form-control{{ $errors->has('article_website') ? ' is-invalid' : '' }}"
                              placeholder="{{ $article->article_website }}" name="article_website"  value="{{ $article->article_website }}" >
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
                              placeholder="{{ $article->article_title }}" id="article_title" name="article_title"
                              value="{{ $article->article_title }}" >
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
                              id="article_description" rows="6" value="{{ $article->article_description }}" placeholder="{{ $article->article_description }}">
                                {{ $article->article_description }}
                              </textarea>
                          </div>
                          @if ($errors->has('article_description'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('article_description') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <h5><small class="text-muted">My hidden note</small></h5>
                  <hr>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="article_info_from">Info from:</label>
                            <div class="input-group">
                                <input type="text" class="form-control{{ $errors->has('article_info_from') ? ' is-invalid' : '' }}"
                                placeholder="{{ $article->article_info_from }}" name="article_info_from" value="{{ $article->article_info_from }}" >
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
                                name="article_info_description" id="" rows="6" value="{{ $article->article_info_description }}"
                                placeholder="{{ $article->article_info_description }}">{{ $article->article_info_description }}</textarea>
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
            <hr>
            <div class="row mb-5">
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
                            <button type="submit" class="btn btn-success float-right">
                                {{ __('Update') }}
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
<script src="{{ asset('js/dropzone-config.js') }}"></script>
@endsection
