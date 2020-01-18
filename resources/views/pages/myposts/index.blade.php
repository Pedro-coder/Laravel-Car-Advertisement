@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
    <a href="{{ URL('/home') }}"><i class="fa fa-times-circle fl-r crs-pntr" style="font-size:27px;color:#6c757d;"></i></a>
      <div id="columns">
        @foreach ($buyers as $buyer)
          @if(Auth::user()->id == $buyer->user_id)
            <figure class="share-save-icon">
            <img class="share-save-icon-buyr w-4"  style="" src="{{asset('img/' . 'referrer.png')}}">
            <img id="{{$buyer->id}}" data-value="{{$id}}" data-value1="buyer" data-value-2="blue" class="share-save-icon-buyr w-4 m-2-45 blue <?php if($buyer->buyer_saved_status == 1){ ?>  hide  <?php } ?>"  style="" src="{{asset('img/' . 'save2.png')}}">
            <img id="{{$buyer->id}}" data-value="{{$id}}" data-value1="buyer" data-value-2="yellow" class="share-save-icon-buyr w-4 m-2-45 yellow <?php if($buyer->buyer_saved_status == 0){ ?>  hide  <?php } ?>"  style="" src="{{asset('img/' . 'save3.jpg')}}">
            <?php 
                if($buyer->buyer_saved_status != 1 && $buyer->buyer_saved_status != 0)
                {
            ?>
                    <img id="{{$buyer->id}}" data-value="{{$id}}" data-value1="buyer" data-value-2="blue" class="share-save-icon-buyr w-4 m-2-45 blue"  style="" src="{{asset('img/' . 'save2.png')}}">
            <?php
                }
            ?>
            
            <a href="{{ route('buyer.show', $buyer->id) }}">
                    <img src="{{ asset('uploads/buyer/' . $buyer->buyer_featured_image) }}">
                    <figcaption><strong>{{ $buyer->buyer_pro_title }}</strong></figcaption>
                    <figcaption class="mt-2"><small class="text-muted">{{ date('M j, Y', strtotime($buyer->created_at)) }}</small></figcaption>
                    <figcaption class="float-left"><small class="text-muted"><strong>Buy</strong></small></figcaption>
                </a>
            </figure>
            @endif
          @endforeach
          @foreach ($sellers as $seller)
            @if(Auth::user()->id == $seller->user_id)
            <figure class="share-save-icon">
            <img class="share-save-icon-buyr w-4" src="{{asset('img/' . 'referrer.png')}}">
            <img id="{{$seller->id}}" data-value="{{$id}}" data-value1="seller" data-value-2="blue" class="share-save-icon-buyr w-4 m-2-45 blue <?php if($seller->seller_saved_status == 1){ ?>  hide  <?php } ?>"  style="" src="{{asset('img/' . 'save2.png')}}">
            <img id="{{$seller->id}}" data-value="{{$id}}" data-value1="seller" data-value-2="yellow" class="share-save-icon-buyr w-4 m-2-45 yellow <?php if($seller->seller_saved_status == 0){ ?>  hide  <?php } ?>"  style="" src="{{asset('img/' . 'save3.jpg')}}">
            <?php 
                if($buyer->buyer_saved_status != 1 && $buyer->buyer_saved_status != 0)
                {
            ?>
                    <img id="{{$buyer->id}}" data-value="{{$id}}" data-value1="buyer" data-value-2="blue" class="share-save-icon-buyr w-4 m-2-45 blue"  style="" src="{{asset('img/' . 'save2.png')}}">
            <?php
                }
            ?>
            <a href="{{ route('seller.show', $seller->id) }}">
                    <img src="{{ asset('uploads/seller/' . $seller->seller_featured_image) }}">
                    <figcaption><strong>{{ $seller->seller_pro_title }}</strong></figcaption>
                    <figcaption class="mt-2"><small class="text-muted">{{ date('M j, Y', strtotime($seller->created_at)) }}</small></figcaption>
                    <figcaption class="float-left"><small class="text-muted"><strong>Sell</strong></small></figcaption>
                </a>
            </figure>
            @endif
          @endforeach
          @foreach ($articles as $article)
            @if(Auth::user()->id == $article->user_id)
            <figure class="share-save-icon">
            <img class="share-save-icon-buyr w-4" src="{{asset('img/' . 'referrer.png')}}">
                          <img id="{{$article->id}}" data-value="{{$id}}" data-value1="article" data-value-2="blue" class="share-save-icon-buyr w-4 m-2-45 blue <?php if($article->article_saved_status == 1){ ?>  hide  <?php } ?>"  style="" src="{{asset('img/' . 'save2.png')}}">
                          <img id="{{$article->id}}" data-value="{{$id}}" data-value1="article" data-value-2="yellow" class="share-save-icon-buyr w-4 m-2-45 yellow <?php if($article->article_saved_status == 0){ ?>  hide  <?php } ?>"  style="" src="{{asset('img/' . 'save3.jpg')}}">
                          <?php 
                            if($article->article_saved_status != 1 && $article->article_saved_status != 0)
                            {
                        ?>
                                   <img id="{{$article->id}}" data-value="{{$id}}" data-value1="article" data-value-2="blue" class="share-save-icon-buyr w-4 m-2-45 blue"  style="" src="{{asset('img/' . 'save2.png')}}">
                        <?php
                            }
                        ?>
            <a href="{{ route('article.show', $article->id) }}">
                    <img src="{{ asset('uploads/article/' . $article->article_featured_image) }}">
                    <figcaption><strong>{{ $article->article_title }}</strong></figcaption>
                    <figcaption class="mt-2"><small class="text-muted">{{ date('M j, Y', strtotime($article->created_at)) }}</small></figcaption>
                    <figcaption class="float-left"><small class="text-muted"><strong>Article</strong></small></figcaption>
                </a>
            </figure>
            @endif
          @endforeach
      </div>
    </div>
  </div>
</div>
@endsection
@section('extra-JS')
<script>

    $( document ).ready(function() 
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
       $(".share-save-icon-buyr").click(function()
       {
            var user_id = $(this).attr("data-value");
            var post_id =  $(this).attr("id");
            var post_type =  $(this).attr("data-value1");
            var saved_cls = $(this).attr("data-value-2");
            var status = "";
            if(saved_cls == "blue"){
                $(this).addClass('hide');
                $(this).next().removeClass('hide');
                // $(".blue").addClass('hide');
                // $(".yellow").removeClass('hide');
                status = 1;
            }
            else
            {
                $(this).addClass('hide');
                $(this).prev().removeClass('hide');
                // $(".yellow").addClass('hide');
                // $(".blue").removeClass('hide');
                status = 0;
            }
           $.ajax({
                    url: "SavePost",
                    type: "POST",
                    data: {user_id : user_id, post_id:post_id, post_type:post_type,status:status},
                    dataType: "JSON",
                    success: function (data) {
                            console.log(data); 
                           
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                            alert('Something went wrong');
                        }
                });
       });
    });
</script>

@endsection
