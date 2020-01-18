@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 offset-md-1">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-md-4"><a href="#"><i class="fas fa-shopping-cart fa-2x"></i></a></div>
            <div class="col-md-8 mt-1">
              <span>Order List for item code
                <strong>
                  @foreach ($buyers as $buyer)
                  {{ $buyer->buyer_item_code}}
                  @endforeach
                </strong>
              </span>
            </div>
          </div>
        </div>
        <div class="card-body">
          <table class="table table-hover">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Item Code</th>
                <th scope="col">Order No</th>
                <th scope="col">Order Date</th>
                <th scope="col">Buyer</th>
                <th scope="col">Seller</th>
                <th scope="col">Price</th>
                <th scope="col">Name</th>
                <th scope="col">Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($orders as $order)
                <tr>
                  @foreach ($buyers as $buyer)
                  <th scope="row"><a href="{{ route('buyerSingle', $buyer->id) }}">{{ $buyer->buyer_item_code }}</a></th>
                  @endforeach
                  <td>{{ $order->order_number}}</td>
                  <td>{{ date('M j, Y', strtotime($order->created_at)) }}</td>
                  <td>{{ $order->user->email }}</td>
                  @foreach ($sellers as $seller)
                    <td>{{ $seller->user->email }}</td>
                  @endforeach
                  <td>{{ $buyer->buyer_sale_price}}</td>
                  <td>{{ $buyer->buyer_pro_title}}</td>
                  <td>Mark</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
