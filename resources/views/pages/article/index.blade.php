@extends('layouts.app')

@section('content')
<div id="columns">
    @foreach ($articles as $article)
    <figure>
       <a href="{{ route('article.show', $article->id) }}">
            <img src="{{ asset('uploads/article/' . $article->article_featured_image) }}">
            <figcaption><strong>{{ $article->article_title }}</strong></figcaption>
            <figcaption><small class="text-muted">{{ date('M j, Y', strtotime($article->created_at)) }}</small></figcaption>
        </a>
    </figure>
    @endforeach
</div>

    @include('partials.cal-modal')
@endsection

@section('extra-JS')

@endsection
