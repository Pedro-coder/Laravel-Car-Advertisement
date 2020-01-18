<!-- Modal -->
<div class="modal fade" id="sell_now" tabindex="-1" role="dialog" aria-labelledby="sell_now_modal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="sell_now_modal">Place your order</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!! Form::open(array('route' => ['buyerOrder', $buyer->id], 'method' => 'PUT', 'files' => true)) !!}
          @csrf
        <input type="hidden" name="buyer_status" value="1">
        <div class="col-md-12" id="sell_now">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="buyer_item_code">Item Code:</label>
                      <div class="input-group">
                          <input type="text" class="form-control{{ $errors->has('buyer_item_code') ? ' is-invalid' : '' }}"
                          placeholder="" name="buyer_item_code" value="{{ old('buyer_item_code') }}">
                      </div>
                      @if ($errors->has('buyer_item_code'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('buyer_item_code') }}</strong>
                          </span>
                      @endif
                  </div>
                </div>
                @if ($buyer->buyer_category === "physical_product")
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="buyer_pro_weight">Item Weight:</label>
                      <div class="input-group">
                          <input type="text" class="form-control{{ $errors->has('buyer_pro_weight') ? ' is-invalid' : '' }}"
                          placeholder="" name="buyer_pro_weight" value="{{ old('buyer_pro_weight') }}">
                      </div>
                      @if ($errors->has('buyer_pro_weight'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('buyer_pro_weight') }}</strong>
                          </span>
                      @endif
                  </div>
                </div>
                @endif
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
                <input type="submit" class="btn btn-success btn-lg btn-block" value="Place Order">
              </div>
            </div>
          </div>
        </div>
        {!! Form::close() !!}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
