@extends('layouts.app')

@section('content')

    <div class="jumbotron">
        <h1>Buyers
            <a href="{{route('buyers.create')}}" type="button" class="btn btn-success float-right">
                + Create A Bid
            </a>
        </h1>
    </div>
    <div class="row pb-5">
        <div class="col-12 d-flex justify-content-center">
            <i class="fa fa-plus" style="font-size:36px; padding-right: 10px"></i><h3 class="text-center"> Create A Bid</h3>
        </div>
    </div>

    <div class="container border" style="background-color: #e9ecef">
        <form action="">
            <div class="row" style="background-color: #f6f8ef; border-bottom: 2px; border-bottom-style: solid;">
                <div class="col-12 pt-3 pb-3">
                    <div class="media">
                        <img src="https://via.placeholder.com/64x64?text=Profile+Image" class="mr-3" alt="...">
                        <div class="media-body">
                            <a class="float-right" href="{{ URL('/home') }}"><i class="fa fa-times-circle fl-r crs-pntr" style="font-size:27px;color:#6c757d;"></i></a>
                            <h5 class="mt-0">Ela</h5>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
            <div class="col-lg-4">
                <div class="pt-3"><img src="https://via.placeholder.com/200x200?text=Profile+Image" class="rounded" alt="..."><br><br></div>
                <div class="row d-flex justify-content-center">
                    <div class="col-6">
                        <select class="form-control form-control-sm">
                            <option>Want to buy</option>
                            <option>Default select</option>
                            <option>Default select</option>
                        </select><br>
                    </div>
                    <div class="col-6">
                        <input class="form-check-input" type="checkbox" value="">
                        <label class="form-check-label" for="defaultCheck1">
                            <b>Auto Order</b>
                        </label>
                    </div>
                </div>

                <div class="pt-2 d-flex justify-content-center" style="background-color: gainsboro"><h3 class="border border-5">Time and Tru</h3></div>
                <br>
                <div class="row d-flex justify-content-center">
                    <div class="col-6">
                        <h5>Current Bid:  </h5>
                    </div>
                    <div class="col-6">
                        <h5>USD <b style="color: red;">$<span class="border border-dark">9.99</span></b></h5>
                    </div>
                </div>
                <div class="row d-flex justify-content-center">
                    <div class="col-7">
                        <h5>Time Left:  <b><span class="border border-dark" style="color: black">39m 32s</span></b></h5>
                    </div>
                    <div class="col-5">
                        <h5>Today 8:05PM</h5>
                    </div>
                </div>
                <div class="row d-flex justify-content-center">
                    <div class="col-7">
                        <h5><b><span class="border border-dark" style="color: #0ba93a">2.7%</span></b> Referral
                            <i class="fa fa-question-circle" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Referral Bonus by Hi5"></i>
                        </h5>
                    </div>
                    <div class="col-5">

                    </div>
                </div>
            </div>




            <div class="col-lg-8 pt-3">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Delivery address:</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Address:</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">City:</label>
                            <input type="text" class="form-control" placeholder="i.e: Apple Valley">
                        </div>
                    </div>
                    <div class="col-3">
                        <label for="exampleInputEmail1">Country:</label>
                        <select class="form-control pb-2">
                            <option>USA</option>
                            <option>Default select</option>
                            <option>Default select</option>
                        </select>
                    </div>
                    <div class="col-6"></div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <select class="form-control pb-2">
                            <option>Shirt</option>
                            <option>Jacket</option>
                            <option>Pant</option>
                        </select>
                    </div>
                    <div class="col-2">
                        <p class="pt-1">Delivery time: </p>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-3">
                        <select class="form-control pb-2">
                            <option>Hour</option>
                            <option>Day</option>
                            <option>Week</option>
                            <option>Month</option>
                        </select>
                    </div>
                    <div class="col-6"></div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="input-group" style="background-color: white">
                            <textarea class="form-control editor" aria-label="With textarea" placeholder="Enter Description"></textarea>
                        </div>
                    </div>
                </div>
                <br>
            </div>
        </div>

            <div class="row pb-3">
            <div class="col-12">
                <div>
                    <button class="btn btn-danger float-left" type="submit"><i class="fas fa-times" style="padding-right: 5px"></i>Cancel</button>
                </div>
                <div>
                    <button class="btn btn-success float-right" type="submit"><i class="far fa-save" style="padding-right: 5px"></i>Save</button>
                </div>
            </div>
        </div>
        </form>
    </div>

@endsection

@section('extra-JS')
    <script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript">
        $(document).ready(function () {
            $(".editor").editor({
                uiLibrary: 'bootstrap4'
            });
        });
    </script>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <style>
        .checked {
            color: orange;
        }
    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
@endsection