<div class="container-fluid">
  <div class="form-row">
   <div class="form-group col-md-8 offset-md-2 mt-3">
     <h3 class="display-4"><i class="fas fa-shopping-cart"></i> Order Details</h3>
     <hr>

   </div>
   <div class="form-group col-md-8 offset-md-2 mt-2">
     <nav>
      <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-sell-order-tab" data-toggle="tab" href="#nav-sell-order" role="tab" aria-controls="nav-sell-order" aria-selected="true">Sell Order</a>
        <a class="nav-item nav-link" id="nav-buy-order-tab" data-toggle="tab" href="#nav-buy-order" role="tab" aria-controls="nav-buy-order" aria-selected="false">Buy Order</a>
        <a class="nav-item nav-link" id="nav-want-to-buy-tab" data-toggle="tab" href="#nav-want-to-buy" role="tab" aria-controls="nav-want-to-buy" aria-selected="false">Want to Buy</a>
        <a class="nav-item nav-link" id="nav-want-to-sell-tab" data-toggle="tab" href="#nav-want-to-sell" role="tab" aria-controls="nav-want-to-sell" aria-selected="false">Want to Sell</a>
        <a class="nav-item nav-link" id="nav-closed-buy-tab" data-toggle="tab" href="#nav-closed-buy" role="tab" aria-controls="nav-closed-buy" aria-selected="false">Closed Buy</a>
        <a class="nav-item nav-link" id="nav-closed-sell-tab" data-toggle="tab" href="#nav-closed-sell" role="tab" aria-controls="nav-closed-sell" aria-selected="false">Closed Sell</a>
      </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="nav-sell-order" role="tabpanel" aria-labelledby="nav-sell-order-tab">
        <table class="table table-striped table-bordered table-hover">
          @foreach ($sellers as $seller)
          <tbody>
            <tr>
              <th scope="row">{{ date('F nS, Y', strtotime($seller->created_at)) }}</th>
              <td>{{ $seller->seller_pro_title }}</td>
              <td><a href="{{ route('seller.show', $seller->id) }}"></a></td>
            </tr>
          </tbody>
          @endforeach
        </table>
      </div>
      <div class="tab-pane fade" id="nav-buy-order" role="tabpanel" aria-labelledby="nav-buy-order-tab">
        Buy Order
      </div>
      <div class="tab-pane fade" id="nav-want-to-buy" role="tabpanel" aria-labelledby="nav-want-to-buy-tab">
        Want to Buy
      </div>
      <div class="tab-pane fade" id="nav-want-to-sell" role="tabpanel" aria-labelledby="nav-want-to-sell-tab">
        Want to Sell
      </div>
      <div class="tab-pane fade" id="nav-closed-buy" role="tabpanel" aria-labelledby="nav-closed-buy-tab">
        Closed Buy
      </div>
      <div class="tab-pane fade" id="nav-closed-sell" role="tabpanel" aria-labelledby="nav-closed-sell-tab">
        Closed Sell
      </div>
    </div>
   </div>
 </div>
</div>
