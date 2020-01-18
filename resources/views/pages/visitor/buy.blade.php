@extends('layouts.app')

@section('content')
<div class="container mt-3">
  <div class="form-row">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header shadow-sm p-3 mb-1 bg-white rounded">
              <div class="float-left" id="user-profile-img">
                <img src="{{ asset('img/logo.png') }}" alt="User Profile"> {{ $buyer->user->name }}
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
              <div class="col-md-8">
                <div class="container">
                  <div class="col-md-12">
                    <div class="row">
                      @guest
                      <div class="col-md-4"></div>
                      <div class="form-group row col-md-8">
                        <div class="col-sm-5">

                        </div>
                        <div class="col-sm-5">

                        </div>
                        <div class="col-sm-2">
                          <a target="_blank" href="#">
                              <i class="fas fa-shopping-cart fa-2x"></i>
                          </a>
                        </div>
                      </div>
                      @else
                      @if(Auth::user()->id == $buyer->user_id)
                      <div class="col-md-4"></div>
                      <div class="form-group row col-md-8">
                        <div class="col-sm-5">
                          {!! Html::linkRoute('buyer.edit', 'Edit', array($buyer->id), array('class' =>
                             'btn btn-success btn-block')) !!}
                        </div>
                        <div class="col-sm-5">
                          {!! Form::open(['route' => ['buyer.destroy', $buyer->id], 'method' => 'DELETE']) !!}
                          {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block']) !!}
                          {!! Form::close() !!}
                        </div>
                        <div class="col-sm-2">
                          <a target="_blank" href="#">
                              <i class="fas fa-shopping-cart fa-2x"></i>
                          </a>
                        </div>
                      </div>
                      @endif
                      @endguest
                    </div>
                  </div>
                  <div class="col-md-12">
                    <form class="" action="{{ route('OrderStore') }}" method="post">
                        @csrf
                      <div class="row">
                        <div class="col-md-4">
                          <div id="item-image">
                              <img src="{{ asset('uploads/buyer/' . $buyer->buyer_featured_image) }}">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="row">
                              <div class="col-md-12">
                                <h6>Want to Buy</h6>
                                <h6>{{ $buyer->buyer_pro_title }}</h6>
                                <div class="form-group row" id="sell_now_field">
                                    <label for="buyer_item_code" class="col-md-3 pt-1">Code:</label>
                                    <input type="text" name="buyer_item_code" class="form-control form-control-sm col-md-4">
                                    @if ($buyer->buyer_category === "physical_product")
                                    <input type="text" name="buyer_pro_weight" class="form-control form-control-sm col-md-4">
                                    <label for="buyer_pro_weight" class="pt-1 ml-1">LB</label>
                                    @endif
                                </div>
                                <br>
                                <div class="d-inline-block">
                                    <h5><strong>${{ $buyer->buyer_sale_price }}.00</strong></h5>
                                </div>
                                <a href="http://www.{{ $buyer->buyer_website }}" target="_blank" class="btn btn-secondary btn-block border-0">
                                    <i class="fas fa-location-arrow mr-2"></i>  {{ $buyer->buyer_website }}
                                </a>
                              </div>
                              <div class="col-md-12 mt-2">
                                  <h5>{{ $buyer->buyer_pro_title }}</h5>
                                  <p><small><strong>{{ $buyer->buyer_pro_description }}</strong></small></p>
                              </div>
                          </div>
                        </div>
                        <div class="col-md-2">
                          <div class="form-group row">
                            <div class="col-md-12 ml-3">
                              <a target="_blank" href="#">
                                  <i class="fas fa-star fa-2x"></i>
                              </a>
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="col-md-12 ml-3">
                              <a target="_blank" href="#">
                                  <i class="fas fa-comments fa-2x"></i>
                              </a>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-8 offset-md-4">
                            <p class="mt-3 float-left"><i class="fas fa-map-marker-alt" value="Deliver to {{ $buyer->buyer_location }}"></i> Deliver to {{ $buyer->buyer_location }}</p>
                            @guest
                            <a href="{{ route('login') }}" target="_blank" class="btn btn-info btn-lg float-right">
                                <i class="fas fa-shopping-cart mr-2"></i>  Buy NOW
                            </a>
                            @else
                              @if(Auth::user()->id == $buyer->user_id)
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
                          @if($buyer->buyer_commission_percentage)
                          <div class="col-md-8 offset-md-2">
                             <small><strong>{{ $buyer->buyer_commission_percentage }} referral </strong></small>
                          </div>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4" id="sell_now_note">
                  <div class="container">
                    <div class="row">
                      <div class="col-md-12">
                        <h5><small class="text-muted">My hidden note</small></h5>
                        <hr>
                          <div class="form-group row">
                              <div class="col-md-12">
                                  <label for="buyer_hidden_info">Info from:</label>
                                  <div class="input-group">
                                      <input type="text" class="form-control{{ $errors->has('buyer_hidden_info') ? ' is-invalid' : '' }}"
                                      placeholder="" name="buyer_hidden_info" value="{{ old('buyer_hidden_info') }}">
                                      <!-- <div class="input-group-append">
                                          <button class="btn btn-outline-secondary" type="button" id="buyer_hidden_info">Save site</button>
                                      </div> -->
                                  </div>
                                  @if ($errors->has('buyer_hidden_info'))
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('buyer_hidden_info') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div>
                          <div class="form-group row">
                              <div class="col-md-12">
                                  <label for="buyer_hidden_price">Buy price:</label>
                                  <div class="input-group">
                                      <div class="input-group-prepend">
                                          <span class="input-group-text" id="buyer_hidden_price">
                                              <i class="fas fa-dollar-sign"></i>
                                          </span>
                                      </div>
                                      <input type="text" class="form-control{{ $errors->has('buyer_hidden_price') ? ' is-invalid' : '' }}"
                                      placeholder="" name="buyer_hidden_price" value="{{ old('buyer_hidden_price') }}">
                                  </div>
                                  @if ($errors->has('buyer_hidden_price'))
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('buyer_hidden_price') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div>
                          <div class="form-group row">
                            <div class="col-md-12">
                                <label for="buyer_hidden_description">Description</label>
                                <div class="input-group">
                                    <textarea class="form-control{{ $errors->has('buyer_hidden_description') ? ' is-invalid' : '' }}"
                                    name="buyer_hidden_description" id="" rows="4" value="{{ old('buyer_hidden_description') }}" placeholder="Description"></textarea>
                                </div>
                                @if ($errors->has('buyer_hidden_description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('buyer_hidden_description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success btn-lg btn-block">Submit</button>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection

@section('extra-JS')
<script type="text/javascript">
  $('#sell_now_field').hide();
  $('#sell_now_note').hide();
  $("#sell_now").click(function (e) {
    e.preventDefault();
    $('#sell_now_field').toggle();
    $('#sell_now_note').toggle();
  });
</script>
@endsection
