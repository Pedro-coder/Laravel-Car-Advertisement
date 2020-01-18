@extends('layouts.app')

@section('content')
<section id="admin" class="admin-panel">
  <div class="container mt-5 mb-3">
    <div class="col-md-6 offset-md-3">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title pt-2">HomePage Setup <a href="{{ URL('/home') }}"><i class="fa fa-times-circle fl-r crs-pntr" style="font-size:27px;color:#6c757d;"></i></a></h5>
         
        </div>
        <div class="card-body">
          <form id="user_manu_add" action="/sethomepage" method="POST">
            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
          <div class="form-row">
            
            <div class="form-group col-md-10 offset-md-1 mt-3">
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-user"></i></div>
                </div>
                <input class="form-control" id="homepage_link" name="homepage_link" type="text" placeholder="Home page" aria-label="Search">
                
             </div>
            </div>
           
            <div class="form-group col-md-10 offset-md-1 mt-2">
              <button type="submit" class="btn btn-success float-right">
                 {{ __('Save') }}
              </button>
            </div>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@section('extra-JS')
  
   
@endsection
