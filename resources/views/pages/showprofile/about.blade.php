@extends('layouts.app')
@section('custom-styles')

@endsection

@section('content')
    @include('partials._user-profile')
    <br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 col-sm-12 col-xs-12">
                <form method="post" action="{{url('about/userProfile')}}" about>
                    {{csrf_field()}}
                    <input type="hidden" name="userIdAbout" value="{{Auth::user()->id}}">

                    <div class="card-body">
                        <div class="form-group">
                        <textarea class="form-control form-control-lg " id="editor" name="about"
                                  rows="8">{{Auth::user()->about}}</textarea>
                        </div>
                        <div class="form-group mb-2">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success btn-lg float-right">
                                    Update
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('extra-JS')

@endsection