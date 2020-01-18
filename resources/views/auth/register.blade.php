@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header" style="background-color: #e3f2fd;">
                 <h4 class="mt-1">{{ __('Sign Up') }}</h4>
                </div>
                <div class="register-profile text-center mt-5 mb-3">
                    <i class="fas fa-smile fa-4x"></i>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <div class="col-md-8 offset-md-2">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="">
                                            <i class="fas fa-user"></i>
                                        </span>
                                    </div>
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="Name" required autofocus>
                                </div>


                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-8 offset-md-2">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="">
                                            <i class="far fa-envelope fa-1x"></i>
                                        </span>
                                    </div>
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email" required>

                                </div>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-8 offset-md-2">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="">
                                            <i class="fas fa-unlock"></i>
                                        </span>
                                    </div>
                                       <input type="hidden" value="<?php if(!empty($_REQUEST['fbId'])){ echo $_REQUEST['fbId']; } ?>" name="fbId">
                                    <input type="hidden" value="<?php if(!empty($_REQUEST['event_id'])){ echo $_REQUEST['event_id']; } ?>" name="event_id">
                                    <input type="hidden" value="<?php if(!empty($_REQUEST['user_id'])){ echo $_REQUEST['user_id']; } ?>" name="user_id">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>
                                </div>


                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-8 offset-md-2">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="">
                                            <i class="fas fa-unlock"></i>
                                        </span>
                                    </div>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  placeholder="Confirm password" required>
                                </div>

                            </div>
                        </div>

                        <div class="form-group row mb-2">
                            <div class="col-md-10">
                                <button type="submit" class="btn btn-success float-right">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>

                        <hr style="border: 1px solid black">
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-2">
                                Already have an account ?
                                <a class="btn btn-link" href="{{ route('login') }}">
                                    {{ __('Sign in') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
