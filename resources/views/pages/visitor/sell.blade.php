@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 offset-md-2 mt-3">
      <div class="card">
        <div class="card-header shadow-sm p-3 mb-1 bg-white rounded">
            <div class="float-left" id="user-profile-img">
              <img src="{{ asset('img/logo.png') }}" alt="User Profile"> {{ @$seller->user->name }}
            </div>
            <div class="float-right">
              <div class="col-md-12 mt-2">
                  <div class="review-block-rate-vistor">
                    <a href="#"><i class="fas fa-star" style="color:#ffc107;"></i></a>
                    <a href="#"><i class="fas fa-star" style="color:#ffc107;"></i></a>
                    <a href="#"><i class="fas fa-star" style="color:#ffc107;"></i></a>
                    <a href="#"><i class="fas fa-star" style="color:#ffc107;"></i></a>
                    <a href="#"><i class="fas fa-star" style="color:#ffc107;"></i></a>
                  </div>
              </div>
            </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-4">
              <div id="item-image">
                  <img src="{{ asset('uploads/seller/' . $seller->seller_featured_image) }}">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                  <div class="col-md-12">
                    <h6>Want to Sell</h6>
                    <h6>{{ $seller->seller_pro_title }}</h6>
                    <div class="d-inline-block">
                        <h6>Code: {{ $seller->seller_item_code }}</h6>
                    </div>
                    <div class="d-inline-block float-right">
                        <h6>{{ $seller->seller_pro_weight }}LB</h6>
                    </div>
                    <br>
                    <div class="d-inline-block">
                        <h5><strong><del>${{ $seller->seller_org_price }}.00</del></strong></h5>
                    </div>
                    <div class="d-inline-block ml-5">
                        <h5><strong>${{ $seller->seller_sale_price }}.00</strong></h5>
                    </div>
                    <a href="http://www.{{ $seller->seller_website }}" target="_blank" class="btn btn-secondary btn-block border-0">
                        <i class="fas fa-location-arrow mr-2"></i>  {{ $seller->seller_website }}
                    </a>
                  </div>
                  <div class="col-md-12 mt-2">
                      <h5>{{ $seller->seller_pro_title }}</h5>
                      <p><small><strong>{{ $seller->seller_pro_description }}</strong></small></p>
                  </div>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group row">
                <div class="col-md-12 text-center">
                  <a target="_blank" href="#">
                      <i class="fas fa-star fa-2x"></i>
                  </a>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-12 text-center">
                  <a target="_blank" href="#">
                      <i class="fas fa-comments fa-2x"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="col-md-8 offset-md-4">
                <p class="mt-3 float-left"><i class="fas fa-map-marker-alt"></i> Deliver to {{ $seller->seller_location }}</p>
                @guest
                <a href="{{ route('login') }}" target="_blank" class="btn btn-info btn-lg float-right">
                    <i class="fas fa-shopping-cart mr-2"></i>  Buy NOW
                </a>
                @else
                  @if(Auth::user()->id == $seller->user_id)
                    <button type="button" class="btn btn-info btn-lg float-right" disabled>
                      <i class="fas fa-shopping-cart mr-2"></i>  Sell NOW
                    </button>
                  @else
                    <a href="" class="btn btn-info btn-lg float-right" id="sell_now" disabled>
                        <i class="fas fa-shopping-cart mr-2"></i>  Sell NOW
                    </a>
                  @endif
                @endguest
            </div>
            <div class="col-md-12 text-center">
              <hr>
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
              <div class="col-md-8 offset-md-2">
                 <small><strong>{{ $seller->seller_commission_percentage }} referral </strong></small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('extra-JS')

@endsection
