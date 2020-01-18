@extends('layouts.app')
@section('custom-styles')
<link rel="stylesheet" href="{!! asset('css/jquery.dataTables.min.css') !!}">
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
           	<div class="card">
	            <div class="card-header cop-h-f-weight">
	              	Coupons
	              	<a href="{!! route('home') !!}">	<i class="fa fa-times-circle fl-r crs-pntr cop-cross-sign"></i></a>
	            </div>
            <div class="card-body">
              <div class="row mar-b-10">
	              <div class="col-md-4">
	              	 {{-- <div class="inner-addon left-addon">
			           <i class="glyphicon co-gray fa fa-search"></i>
			           <input class="form-control" id="search" type="search" placeholder="Search" aria-label="Search">
			         </div> --}}
	              </div>
	              <div class="col-md-8 cop-text-a-r">
	              		<a href="{!! route('coupon.create') !!}" class="btn btn-md btn-primary">Add Coupon</a>
	              </div> 
          	  </div>
          	  <div class="row">
                <div class="col-md-12">
	              <table class="table" id="OrderTable">
	                <thead>
	                  <tr>
	                    <th><input type="checkbox" /></th>
	                    <th>Code</th>
	                    <th>Criteria</th>
	                    <th>Data Availablity</th>
	                    <th>Used</th>
	                  </tr>
	                </thead>
	                <tbody>
	                </tbody>
	              </table>
          	    </div>
          	  </div>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection

@section('extra-JS')
<script src="{!! asset('js/jquery.dataTables.min.js') !!}"></script>
<script type="text/javascript">
	$(document).ready(function(){
     	var oTable =  $('#OrderTable').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            ajax:'{!! route('coupon.action') !!}',
            columns: [
	            { data: 'action', name: 'action','orderable': false,searchable: false},
	            { data: 'coupon_code', name: 'coupon.coupon_code','orderable': true,searchable: true},
	            { data: 'coupon_criteria', name: 'criteria','orderable': false,searchable: false},
	            { data: 'availablity', name: 'availablity','orderable': false,searchable: false},  
	            { data: 'used', name: 'used','orderable': false,searchable: false}
	        ]
        });
    });  
</script>
@endsection