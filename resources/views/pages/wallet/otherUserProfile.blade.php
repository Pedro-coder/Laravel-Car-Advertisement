@extends('layouts.app')
@section('custom-styles')
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-formhelpers.min.css') }}">
@endsection
@section('content')

    @include('partials.other_user_profile')
    <section id="wallet">
        <div class="container">
            <div class="row justify-content-center user-profile-row">
                <div class="col-md-9 col-sm-12 col-xs-12">
                    <div class="card shadow-lg">
                        <div class="card-title">

                            <h5 class="card-title pt-3 ml-3"><span><i class="fas fa-wallet"></i></span>
                                <strong>Wallet </strong> <span><i class="fas fa-times-circle"></i></span>
                            </h5>


                            <div class="row col-md-12 p-r-0">
                                <div class="col-md-6">
                                    <div class="card mt-3">
                                        <div class="card-content">
                                            <div class="media align-items-stretch">

                                                <div class="p-2 media-body text-center">
                                                    <h5> Current Balance </h5>
                                                    <h5 class="text-bold-400 mb-0">
                                                        <strong>${{$total_balance_remained}}</strong></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card mt-3">
                                        <div class="card-content">
                                            <div class="media align-items-stretch">
                                                <div class="p-2 media-body text-center">
                                                    <h5> Available Balance</h5>
                                                    <h5 class="text-bold-400 mb-0"><strong>
                                                            ${{$total_available_balance}}</strong></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <div class="form-group row">

                                    <div class="col-md-6 mb-2">
                                        <form id="transfer_form" action="">

                                            <input class="form-control" data-val="{{@$user_id}}" id="transfer_id"
                                                   name="transfer_id" type="hidden">
                                            <input type="hidden" class="form-control" placeholder="Description"
                                                   id="transfer_description" name="transfer_description"
                                                   value="Withdraw Request" autocomplete="off" required>
                                            <input type="hidden" class="form-control" placeholder="Description"
                                                   id="transfer_details" name="transfer_details"
                                                   value="Withdraw Request" autocomplete="off" required>

                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id=""><i
                                                                class="fas fa-dollar-sign"></i></span>
                                                </div>
                                                <input type="number" class="form-control" placeholder=""
                                                       id="transfer_amount" name="transfer_amount" value=""
                                                       autocomplete="off" required>
                                            </div>

                                        </form>

                                        <div>
                                            <button type="button" class="btn btn-primary btn-block"
                                                    id="transfer_btn">
                                                WITHDRAW REQUEST
                                                <i class="fas fa-upload"></i>
                                            </button>

                                        </div>

                                    </div>

                                    <div class="col-md-6">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text calendar-icon"><span><i class="fas fa-calendar-alt"></i></span></div>
                                            <input type="date" class="form-control" id="start_date">
                                        </div>
                                        <br>
                                        <div class="input-group-prepend">
                                            <div class="input-group-text calendar-icon"><span><i class="fas fa-calendar-alt"></i></span></div>
                                            <input type="date" class="form-control" id="end_date">
                                        </div>
                                        <div>
                                            <button type="submit" class="btn btn-success mt-2" id="apply">
                                                {{ __('Apply') }}
                                            </button>
                                            <a href="#" id="print"><i class="fas fa-print fa-2x"></i></a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-12 mt-5" id="trans">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination pagination-sm">
                                        <li class="page-item">
                                            <a class="page-link" href="#" aria-label="Previous" id="first">
                                                <span aria-hidden="true">&laquo;</span>
                                                <span>First</span>
                                            </a>
                                        </li>
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" aria-label="Next">
                                                <span aria-hidden="true">&laquo;</span>
                                                <span>Previous</span>
                                            </a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#" aria-label="Next">
                                                <span>Next</span>
                                                <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                                <hr>
                            </div>
                            <div class="old-trans">
                                <!-- transaction heading row -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table wallet-transaction-table">
                                            <thead>
                                            <tr>
                                                <th scope="col">Date <i class="fas fa-caret-down"></i></th>
                                                <th scope="col">Transaction <i class="fas fa-caret-down"></i></th>
                                                <th scope="col">Description <i class="fas fa-caret-down"></i></th>
                                                <th scope="col">Desposits/Credits <i class="fas fa-caret-down"></i></th>
                                                <th scope="col">Withdrawals/Debits <i class="fas fa-caret-down"></i></th>
                                                <th scope="col">Ending Daily Balance <i class="fas fa-caret-down"></i></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- pending transaction row -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card border-0 mb-0 p-0">
                                            <div class="card-header card-header pl-4 pb-0">
                                                <p>
                                                    <small><strong>Pending Transactions</strong></small>
                                                </p>
                                            </div>
                                            <div class="card-body">
                                                @foreach($withdraw_requests as $key=>$value)
                                                    <div class="row">
                                                        <div class="col-md-3 col-sm-3 col-3">
                                                            @if($user_role_as_accountant == 9 && $ttm == 0)
	                                                            <button class="deleteRecord text-secondary" style="float: left; padding-right: 5px; border: 0; margin-right: 5px;" data-id="{{ $value['id'] }}">
	                                                                <small><i class="fa fa-close action-icon"></i>
	                                                                </small>
	                                                            </button>
                                                                <button class="acceptedWithdrawRequest text-secondary"
                                                                        style="float: left; padding-right: 5px; border: 0; margin-right: 5px;"
                                                                        data-id="{{ $value['id'] }}">
                                                                    <small>
                                                                        <i class="glyphicon glyphicon-ok action-icon"></i>
                                                                    </small>
                                                                </button>
                                                            @endif
                                                            <a class="text-secondary someclass" href="#" role="button" aria-expanded="false" aria-controls="collapseDetails">
                                                                <small>
                                                                    <i onClick="matulpost({{$key + 1}})" class="fas fa-plus-circle" style="margin-right: 5px;"></i>{{$value['datwise']}}
                                                                </small>
                                                            </a>
                                                        </div>
                                                        <div class="col-md-2 col-sm-2 col-2">
                                                            <a class="text-secondary" href="#">
                                                                <small>{{@$value['transaction_id']}}</small>
                                                            </a>
                                                        </div>
                                                        <div class="col-md-3 col-sm-3 col-3">
                                                            <a class="text-secondary" href="#">
                                                                <small>{{$value['description']}}</small>
                                                            </a>
                                                        </div>
                                                        <div class="col-md-1 col-sm-1 col-1">
                                                            <p class="text-secondary">
                                                                <small><?php echo($value['type'] == 'cr' ? $value['amount'] : ''); ?></small>
                                                            </p>
                                                        </div>
                                                        <div class="col-md-1 col-sm-1 col-1">
                                                            <p class="text-secondary">
                                                                <small><?php echo($value['type'] == 'db' ? $value['withdraw'] : ''); ?></small>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div style="display:none" id="PendingDetails{{$key + 1}}">
                                                                <div class="card ">
                                                                    <div class="card-header pt-4">
                                                                        <h6 class="card-title"><strong>Details</strong>
                                                                        </h6>
                                                                    </div>
                                                                    <div class="card-body">{!! $value['details'] !!}</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- posted transaction row -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card border-0 mb-0 p-0">
                                            <div class="card-header card-header pl-4 pb-0">
                                                <p>
                                                    <small><strong>Posted Transactions</strong></small>
                                                </p>
                                            </div>
                                            <div class="card-body">
                                                @foreach($posted_transactions as $key=>$value)
                                                    <div class="row">
                                                        <div class="col-md-2 col-sm-2 col-2">
                                                            <a class="text-secondary someclass" role="button" aria-expanded="false" aria-controls="collapseDetails">
                                                                <small>
                                                                    <i id="matulmyelement" onClick="matulpostdetail({{$key + 1}})" class="fas fa-plus-circle"></i> {{$value['datwise']}}
                                                                </small>
                                                            </a>
                                                        </div>
                                                        <div class="col-md-2 col-sm-2 col-2">
                                                            <a class="text-secondary" href="#">
                                                                <small>{{@$value['transaction_id']}}</small>
                                                            </a>
                                                        </div>
                                                        <div class="col-md-3 col-sm-3 col-3">
                                                            <a class="text-secondary" href="#">
                                                                <small>{{ $value['description'] }}</small>
                                                            </a>
                                                        </div>
                                                        <div class="col-md-1 col-sm-1 col-1">
                                                            <p class="text-secondary">
                                                                <small><?php echo($value['type'] == 'cr' ? $value['amount'] : ''); ?></small>
                                                            </p>
                                                        </div>
                                                        <div class="col-md-1 col-sm-1 col-1">
                                                            <p class="text-secondary">
                                                                <small><?php echo($value['type'] == 'db' ? $value['withdraw'] : ''); ?></small>
                                                            </p>
                                                        </div>
                                                        <div class="col-md-2 col-sm-2 col-2">
                                                            <p class="text-secondary">
                                                                <small>{{ $value['ending_daily_balance'] }}</small>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div style="display:none" id="PostedDetails{{$key+1}}">
                                                                <div class="card ">
                                                                    <div class="card-header pt-4">
                                                                        <h6 class="card-title"><strong>Details</strong></h6>
                                                                    </div>
                                                                    <div class="card-body">{!! $value['details'] !!}</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div id="excel" class="hide">

        </div>
    </section>
@endsection

@section('extra-JS')
    <script type="text/javascript" src="{{ asset('js/bootstrap-datepicker.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap-formhelpers.min.js')}}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.js"></script>
    <script src="{{ asset('js/FileSaver.js') }}"></script>
    <script src="{{ asset('js/Blob.js') }}"></script>
    <script src="{{ asset('js/xlsx.core.min.js') }}"></script>
    <script src="{{ asset('js/tableexport.js') }}"></script>
    <script type="text/javascript">
        $('.bfh-datepicker').bfhdatepicker('toggle');
    </script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('a.someclass').click(function (e) {
            // Special stuff to do when this link is clicked...

            // Cancel the default action
            e.preventDefault();
        });

        function matulpost(value) {
            console.log("tushar");
            $('#PendingDetails' + value).toggle();
        }

        function matulpostdetail(value) {
            $('#PostedDetails' + value).toggle();
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        jQuery(document).ready(function ($) {
            $("#apply").click(function () {
                var start_date = $("#start_date").val();
                var end_date = $("#end_date").val();

                $.ajax({
                    url: "getTransByDateRange",
                    type: "POST",
                    data: {start_date: start_date, end_date: end_date},
                    success: function (data) {
                        console.log(data);
                        $("#trans").html(data);
                        $(".old-trans").html('');
                        // console.log(data.trans.first_page_url);
                        // $("#first").attr("href",data.trans.first_page_url);
                        // swal({
                        //     title: "Successfull Recieved!",
                        //     text: "",
                        //     icon: "success",
                        //     button: "OK",
                        // });

                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        alert(errorThrown);
                    }
                });


            });


            $("#transfer_btn").click(function () {

                $("#loader").removeClass('hide');
                $(".main-c").addClass('hide');
                var transfer_id = $("#transfer_id").attr("data-val");
                var amount = $("#transfer_amount").val();
                var description = $("#transfer_description").val();
                var details = $("#transfer_details").val();
                if (transfer_id == "" || amount == "" || description == "" || details == "") {
                    $("#loader").addClass('hide');
                    $(".main-c").removeClass('hide');
                    alert("please enter the values");
                    return false;
                }
                if (amount <= 0) {
                    $("#loader").addClass('hide');
                    $(".main-c").removeClass('hide');
                    alert("please enter amount greater than zero");
                    return false;
                }
                var transfer_form_data = $("#transfer_form").serializeArray();
                console.log(transfer_form_data);
                $.ajax({
                    url: "transfer",
                    type: "POST",
                    data: {transfer_form_data: transfer_form_data, transfer_id: transfer_id},
                    dataType: "JSON",
                    success: function (data) {
                        $("#loader").addClass('hide');
                        $(".main-c").removeClass('hide');
                        if (data['error'] == 0) {

                            swal({
                                title: "Withdraw request submitted!",
                                text: "",
                                icon: "success",
                                button: "OK",
                            });

                            window.location.reload();
                        }
                        else {
                            swal({
                                title: "Withdraw Request Submited Failure!",
                                text: "",
                                icon: "error",
                                button: "OK",
                            });
                        }

                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        alert(errorThrown);
                    }
                });
            });
            $(document).on('click', 'button.deleteRecord', function (event) {
                event.preventDefault();

                $("#loader").removeClass('hide');
                $(".main-c").addClass('hide');
                var id = $(this).data("id");

                $.ajax(
                    {
                        url: "cancelWithdrawRequest",
                        type: "POST",
                        data: {
                            "id": id,
                        },
                        dataType: "JSON",
                        success: function (data) {
                            $("#loader").addClass('hide');
                            $(".main-c").removeClass('hide');
                            if (data['error'] == 0) {

                                swal({
                                    title: "You have canel withdraw request successfull!",
                                    text: "",
                                    icon: "success",
                                    button: "OK",
                                });

                                window.location.reload();
                            }
                            else {
                                swal({
                                    title: "Sorry!! due to some reasons your request is not accepted. Please try again",
                                    text: "",
                                    icon: "error",
                                    button: "OK",
                                });
                            }

                        },
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            //alert(errorThrown);
                        }
                    });
            });

            $(document).on('click', 'button.acceptedWithdrawRequest', function (event) {

                event.preventDefault();
                $("#loader").removeClass('hide');
                $(".main-c").addClass('hide');
                var id = $(this).data("id");

                $.ajax(
                    {
                        url: "approveWithdrawRequest",
                        type: "POST",
                        data: {
                            "id": id,
                        },
                        dataType: "JSON",
                        success: function (data) {
                            $("#loader").addClass('hide');
                            $(".main-c").removeClass('hide');
                            if (data['error'] == 0) {

                                swal({
                                    title: "Your withdraw request is accepted. Thanks!",
                                    text: "",
                                    icon: "success",
                                    button: "OK",
                                });

                                window.location.reload();
                            }
                            else {
                                swal({
                                    title: "Please try again later",
                                    text: "",
                                    icon: "error",
                                    button: "OK",
                                });
                            }

                        },
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            //alert(errorThrown);
                        }
                    });

            });

            $("#print").click(function (e) {
                e.preventDefault();
                var start_date = $("#start_date").val();
                var end_date = $("#end_date").val();
                $.ajax({
                    url: "moveToExcel",
                    type: "POST",
                    data: {start_date: start_date, end_date: end_date},
                    success: function (data) {
                        $("#excel").html(data);
                        $("#excel").tableExport();
                        $(".xlsx").trigger("click");
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        // alert(errorThrown);
                    }
                });
            });
            $("#first").click(function (e) {
                e.preventDefault();
                var url = $(this).attr("href");
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {},
                    dataType: "JSON",
                    success: function (data) {

                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        alert(errorThrown);
                    }
                });
            });
        });

    </script>
@endsection
