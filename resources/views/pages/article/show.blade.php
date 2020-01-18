@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <div class="row">
        <div class="col-md-8">
            <h3><i class="fas fa-rss"></i> {{ $article->article_title }} </h3>
        </div>
        @if(Auth::user()->id == $article->user_id)
        <div class="col-md-4">
          <div class="row">
            <div class="col-sm-6">
              {!! Html::linkRoute('article.edit', 'Edit', array($article->id), array('class' =>
                 'btn btn-success btn-block')) !!}
            </div>
            <div class="col-sm-6">
              {!! Form::open(['route' => ['article.destroy', $article->id], 'method' => 'DELETE']) !!}
              {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block']) !!}
              {!! Form::close() !!}
            </div>
          </div>
        </div>
        @endif
        <div class="col-md-12">
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="d-inline-block" id="user-profile-img">
                <img src="{{ asset('/uploads/photoId/' . $user->photo_id) }}" alt="User Profile">
            </div>
            <div class="d-inline-block">
                <h6 class="mr-2">{{ $article->user->name }}</h6>
            </div>
            <div class="d-inline-block">
                <a href="#"><i class="fas fa-comments fa-1x"></i></a>
            </div>
            <footer class="blockquote-footer">{{ date('M j, Y', strtotime($article->created_at)) }}</footer>
            <div id="item-image">
                <img src="{{ asset('uploads/article/' . $article->article_featured_image) }}">
            </div>
            <div class="social-links">
                <ul class="list-inline mt-3">
                    <li class="list-inline-item"><a class="social-icon text-xs-center" target="_blank" href="#">
                        <i class="fab fa-facebook-square fa-3x"></i>
                    </a></li>
                    <li class="list-inline-item"><a class="social-icon text-xs-center" target="_blank" href="#">
                        <i class="fab fa-twitter-square fa-3x"></i>
                    </a></li>
                    <li class="list-inline-item"><a class="social-icon text-xs-center" target="_blank" href="#">
                        <i class="fab fa-linkedin fa-3x"></i>
                    </a></li>
                    <li class="list-inline-item"><a class="social-icon text-xs-center" target="_blank" href="#">
                        <i class="fab fa-pinterest-square fa-3x"></i>
                    </a></li>
                    <li class="list-inline-item"><a class="social-icon text-xs-center" target="_blank" href="#">
                        <i class="fab fa-google-plus-square fa-3x"></i>
                    </a></li>
                    <li class="list-inline-item"><a class="social-icon text-xs-center" target="_blank" href="#">
                        <i class="fab fa-instagram fa-3x"></i>
                    </a></li>
                    <li class="list-inline-item"><a class="social-icon text-xs-center" target="_blank" href="#">
                        <i class="fas fa-envelope fa-3x"></i>
                    </a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-6">
            <div class="product-details w-100 mt-5">
                <h5 class="mb-3">Article Category: {{ $article->article_category }} </h5>
                <a href="http://www.{{ $article->article_website }}" target="_blank" class="btn btn-default btn-lg btn-block border-0">
                    <i class="fas fa-location-arrow mr-2"></i>  {{ $article->article_website }}
                </a>
                <h3 class="mt-5 mb-3">{{ $article->article_title }} </h3>
                <p>{{ $article->article_description }}</p>
            </div>
        </div>
        <div class="col-md-12">
            <hr>
            <div class="row">
              <div class="col-md-2 mt-2"></div>
              <div class="col-md-8 mt-2"></div>
                <div class="col-md-2 mt-2">
                    <a href="#" class="btn btn-success btn-block float-right">Submit</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-JS')

@endsection
