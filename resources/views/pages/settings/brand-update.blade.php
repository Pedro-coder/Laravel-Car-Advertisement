@extends('layouts.app') @section('content')
<div class="container shadow mt-5">
    <div class="row">
        <div class="col-md-10 md-offset-4">
            <div class="form-group col-md-10 ">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Site Name</div>
                    </div>
                    <input class="form-control" type="search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-success" type="button" id="button-addon2">
                 Update
               </button>
                    </div>
                </div>
            </div>



            <div class="form-group col-md-12 ">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Slogan</div>
                    </div>
                    <input class="form-control" type="search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-success" type="button" id="button-addon2">
                 Update
               </button>
                    </div>
                </div>
            </div>

            <div class="col-md-12 ">
                    <div class="row">
                        <div class="col-md-4 ">
                            Background
                        </div>
                        <div class="col-md-4 ">
                            Logo
                        </div>
                        <div class="col-md-4 ">
                            Favicon
                        </div>
                    </div>
            </div>

        </div>
    </div>
</div>
@endsection
