@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 offset-md-1">
      <div class="card">
        <h4 class="card-header"><i class="fas fa-shopping-cart fa-1x"></i> Sell order details</h4>
        <div class="card-body">
          {!! Form::open(array('route' => ['sellerStatus', $seller->id], 'method' => 'PUT')) !!}
            @csrf
          <div class="row">
            <div class="col-md-4">
                <div class="d-inline-block" id="user-profile-img">
                    <img src="{{ asset('/uploads/avatars/' . $user->avatar) }}" alt="User Profile">
                </div>
                <div class="d-inline-block">
                    <h6 class="mr-2">{{ $seller->user->name }}</h6>
                </div>
                <div class="d-inline-block">
                    <a href="#"><i class="fas fa-comments fa-1x"></i></a>
                </div>
                <footer class="blockquote-footer">{{ date('F nS, Y -g:iA', strtotime($seller->created_at)) }}</footer>
                <div id="item-image">
                    <img src="{{ asset('uploads/seller/' . $seller->seller_featured_image) }}">
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
            <div class="col-md-4">
                <div class="basic-pro-info w-100 mt-2 mb-4">
                    <h5>Code: {{ $seller->seller_item_code }}</h5>
                    <h6 class="float-left">Want to sell - {{ $seller->seller_pro_title }}</h6>
                    <h6 class="float-right">{{ $seller->seller_pro_weight }}LB</h6>
                </div>
                <div class="product-details w-100 mt-5">
                    <h2 class="mb-3">${{ $seller->seller_sale_price }} </h2>
                    <a href="http://www.{{ $seller->seller_website }}" target="_blank" class="btn btn-default btn-lg btn-block border-0">
                        <i class="fas fa-location-arrow mr-2"></i>  {{ $seller->seller_website }}
                    </a>
                    <h3 class="mt-5 mb-3">{{ $seller->seller_pro_title }} </h3>
                    <p>{{ $seller->seller_pro_description }}</p>
                </div>
                <p class="mb-0"><i class="fas fa-map-marker-alt"></i> {{ $seller->seller_location }}</p>
            </div>
            <div class="col-md-4 row">

              <input class="form-control col-md-8" type="search" placeholder="Order No:@foreach ($orders as $order) {{ $order->order_number }} @endforeach" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
                <div class="col-md-12 mt-3">
                    <div class="review-block-rate">
                        <button type="button" class="btn btn-warning btn-xs" aria-label="Left Align">
                            <i class="far fa-star"></i>
                        </button>
                        <button type="button" class="btn btn-warning btn-xs" aria-label="Left Align">
                            <i class="far fa-star"></i>
                        </button>
                        <button type="button" class="btn btn-warning btn-xs" aria-label="Left Align">
                            <i class="far fa-star"></i>
                        </button>
                        <button type="button" class="btn btn-default btn-grey btn-xs" aria-label="Left Align">
                            <i class="far fa-star"></i>
                        </button>
                        <button type="button" class="btn btn-default btn-grey btn-xs" aria-label="Left Align">
                            <i class="far fa-star"></i>
                        </button>
                    </div>
                </div>
                <div class="card mt-3 mb-3" style="width: 18rem;">
                  <div class="card-header">
                      Status
                  </div>
                  <select class="custom-select" name="seller_order_status">
                    <option>PROVIDED</option>
                    <option>SHIPPED</option>
                    <option>WORK IN PROCESS</option>
                    <option>CANCELLED</option>
                    <option>HELPDESK HELP REQUEST</option>
                    <option>SELLER REQUESTED CHANGE IN REQUIREMENT</option>
                  </select>
                </div>
                <div class="card mt-3 mb-3" style="width: 18rem;">
                  <div class="card-header">
                      <h5><small class="text-muted">My hidden note</small></h5>
                  </div>
                  <div class="card-body">
                    <span>
                      <strong>Buy From:</strong> <a href="#">{{ $seller->seller_info_from }}</a>
                    </span>
                    <hr>
                    <span>
                      <strong>Buy Price:</strong> ${{ $seller->seller_info_price }}
                    </span>
                    <hr>
                    <span>
                      <strong>Description:</strong><br>
                      {{ substr(strip_tags($seller->seller_info_description), 0, 50) }}
                      {{ strlen(strip_tags($seller->seller_info_description)) > 50 ? "..." : ""}}
                    </span>
                  </div>
                </div>
            </div>
            <div class="col-md-12 mb-3">
                <hr>
                <div class="row">
                    <div class="col-md-2 mt-2"></div>
                    <div class="col-md-8 mt-2"></div>
                    <div class="col-md-2 mt-2">
                      <input type="submit" class="btn btn-success btn-block float-right" value="Submit">
                    </div>
                </div>
            </div>
          </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('extra-JS')

@endsection
