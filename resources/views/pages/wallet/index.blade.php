@extends('layouts.app')
@section('custom-styles')
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-formhelpers.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
@endsection
@section('content')
    @include('partials._user-profile')
    <style>
        table td {
            padding: 8px 10px !important;
            border: none !important;
        }
        table.dataTable.dtr-inline.collapsed > tbody > tr[role="row"] > td:first-child, table.dataTable.dtr-inline.collapsed > tbody > tr[role="row"] > th:first-child {
            padding-left: 30px !important;
        }
    </style>
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
                                                       autocomplete="off" onkeyup="inputAmountPaypal(this.value)" required>
                                            </div>

                                        </form>

                                        <div>
                                            <!-- <button type="button" class="btn btn-primary btn-block"
                                                    id="">
                                                DEPOSIT REQUEST
                                                <i class="fas fa-download"></i>
                                            </button> -->
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                              DEPOSIT REQUEST
                                            <i class="fas fa-download"></i>
                                            </button>

                                        </div>
                                        <br>
                                        <br>
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
                        </div>
                        <div class="container" id="trans">
                            <div class="card">
                                <div class="card-header"><span class="card-title" style="font-size: 20px;">Pending Transactions</span></div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-sx-12">
                                            <table class="display dataTable" id="pending_transaction_tbl">
                                                <thead>
                                                    <tr>
                                                        <th class="all" >Date</th>
                                                        <th class="all" >Description</th>
                                                        <th class="all" >Debit</th>
                                                        <th class="all" >Credit</th>
                                                        <th class="none" >Transaction By</th>
                                                        <th class="none" >Dispute No.</th>            
                                                        <th class="none">Transaction ID</th>
                                                        <th class="none" >Detail</th>
                                                        <th class="none" >Actions</th>
                                                        <!-- <th>Withdrawals/Debits</th>
                                                        <th>Ending Daily Balance</th> -->
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($withdraw_requests as $key=>$value)
                                                        <tr>
                                                            <td>
                                                                {{$value['datwise']}}
                                                            </td>
                                                            <td>{{ ($value['is_freeze_or_refund']==1)?'Dispute':$value['description'] }}</td>
                                                            <td><?php echo($value['type'] == 'db' ? $value['withdraw'] : ''); ?></td>
                                                            <td><?php echo($value['type'] == 'cr' ? $value['amount'] : ''); ?></td>
                                                            <td>{{ $value['name'] }}</td>
                                                            <td>{{ ($value['is_freeze_or_refund']==1)?$value['description']:'N/A' }}</td>
                                                            <td>{{ $value['transaction_id']}}</td>
                                                            <td>{!! $value['details'] !!}</td>
                                                            <td>
                                                                <center>
                                                                    <!-- <i onClick="matulpost(this)" data-key="{{$key + 1}}" class="fas fa-plus-circle" style="margin-right: 5px;" data-detail="{!! $value['details'] !!}" ></i> -->
                                                                    @if($user_role_as_accountant == 9 && $ttm == 0)
                                                                        <button class="acceptedWithdrawRequest btn btn-success btn-sm" data-id="{{ $value['id'] }}">Approve <i class="glyphicon glyphicon-ok action-icon"></i></button>
                                                                        <button class="deleteRecord btn btn-danger btn-sm" data-id="{{ $value['id'] }}"> Cancel <i class="fa fa-close action-icon"></i>
                                                                        </button>
                                                                    @else
                                                                        N/A
                                                                    @endif
                                                                </center>
                                                            </td>
                                                            <!-- <td>N/A</td> -->
                                                        </tr>
                                                    @endforeach
                                                    <tfoot>
                                                        <tr>
                                                            <th class="all" >Date</th>
                                                            <th class="all" >Description</th>
                                                            <th class="all" >Debit</th>
                                                            <th class="all" >Credit</th>
                                                            <th class="none" >Transaction By</th>
                                                            <th class="none" >Dispute No.</th>            
                                                            <th class="none" >Transaction ID</th>
                                                            <th class="none" >Detail</th>
                                                            <th class="none" >Actions</th>
                                                        </tr>
                                                    </tfoot>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="card">
                                <div class="card-header"><span class="card-title" style="font-size: 20px;">Posted Transactions</span></div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-sx-12">
                                            <table class="display dataTable" id="posted_transaction_tbl">
                                                <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Description</th>
                                                        <th>Debit</th>
                                                        <th>Credit</th>
                                                        <th>Ending Daily Balance</th>
                                                        <th class="none" >Transaction By</th>
                                                        <th class="none" >Posted By</th>
                                                        <th class="none" >Dispute no</th>
                                                        <th class="none" >Transaction Id</th>
                                                        <th class="none" >Detail</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($posted_transactions as $key=>$value)
                                                        <tr>
                                                            <td>
                                                                {{$value['datwise']}}    
                                                            </td>
                                                            <td>{{ ($value['is_freeze_or_refund']==1)?'Dispute':$value['description'] }}
                                                            </td>
                                                            <td><?php echo($value['type'] == 'db' ? $value['withdraw'] : ''); ?></td>
                                                            <td><?php echo($value['type'] == 'cr' ? $value['amount'] : ''); ?></td>
                                                            <td>{{ $value['ending_daily_balance'] }}</td>
                                                            <td>{{ $value['transaction_by'] }}</td>
                                                            <td>{{ $value['posted_by'] }}</td>
                                                            <td>{{ ($value['is_freeze_or_refund']==1)?$value['description']:'N/A' }}</td>
                                                            <td>{{@$value['transaction_id']}}</td>
                                                            <td>{!! $value['details'] !!}</td>        
                                                        </tr>
                                                    @endforeach
                                                    <tfoot>
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Description</th>
                                                            <th>Debit</th>
                                                            <th>Credit</th>
                                                            <th>Ending Daily Balance</th>
                                                            <th class="none" >Transaction By</th>
                                                            <th class="none" >Posted By</th>
                                                            <th class="none" >Dispute no</th>
                                                            <th class="none" >Transaction Id</th>
                                                            <th class="none" >Detail</th>
                                                        </tr>
                                                    </tfoot>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>
                            <!-- done by Arindam -->
                            <!-- <div class="card">
                                <div class="card-header"><span class="card-title" style="font-size: 20px;">Deposit With</span></div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-sx-12">
                                            <div class="custom-control custom-radio">
                                              <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                                              <label class="custom-control-label" for="customRadio1">Credit or Debit Card</label>
                                            </div>
                                            <div class="card-images">
                                                <ul>
                                                    <li><img src="{{ URL::asset('images/card1.png') }}"></li>
                                                    <li><img src="{{ URL::asset('images/card-2.png') }}"></li>
                                                    <li><img src="{{ URL::asset('images/card-3.png') }}"></li>
                                                    <li><img src="{{ URL::asset('images/card-4.png') }}"></li>
                                                </ul>
                                                <div class="clr"></div>
                                            </div>
                                            <div class="heading-text">
                                                <p><span><i class="fa fa-lock" aria-hidden="true"></i></span> Your payment is secure . Your card details will not shared with sellers</p>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="input-icons"> 
                                            <span><i class="fa fa-credit-card icon"></i></span> 
                                            <input class="input-field" type="text" placeholder="Card Number"> 
                                            </div>
                                            <div class="input-icons edit-date"> 
                                            <span><i class="fa fa-calendar-o icon"></i></span> 
                                            <input class="input-field" type="text" placeholder="MM/YY"> 
                                            </div> 
                                            <div class="input-icons edit-date"> 
                                            <span><i class="fa fa-lock icon"></i></span> 
                                            <input class="input-field" type="text" placeholder="CVV/CVC"> 
                                            </div> 
                                            <div class="clr"></div>
                                            <div class="input-icons"> 
                                            <span><i class="fa fa-user icon"></i></span> 
                                            <input class="input-field" type="text" placeholder="Card Holder Name"> 
                                            </div> 
                                            </div>
                                            <div class="row crd-btn">
                                                <div class="col-md-5">
                                                    <div class="row">
                                                        <div class="col-md-6"><button type="button" class="btn btn-primary edit-done">Done</button></div>
                                                        <div class="col-md-6"><button type="button" class="btn btn-primary edit-cen">Cancel</button></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-7">
                                                <div class="trms-sec">By clicking you agree to our <span>Terms & Conditions</span></div> </div>
                                           </div>
                                            @if (Session::has('message'))
                                             <div class="alert alert-{{ Session::get('code') }}">
                                              <p>{{ Session::get('message') }}</p>
                                             </div>
                                            @endif
                                            <div class="row paypel-sec">
                                                <div class="col-md-12">
                                                   <div class="custom-control custom-radio">
                                                       <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input" onclick="visitPaypalPage()">
                                                       <label class="custom-control-label" for="customRadio2"><img src="{{ URL::asset('images/card5.png') }}"> </label>
                                                    </div>
                                               </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div id="excel" class="hide">

        </div>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header modal-edit-header">
                <!-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <!-- done by Arindam -->
                    <div class="card">
                        <div class="card-header"><span class="card-title" style="font-size: 20px;">Deposit With</span></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-sx-12">
                                    <div class="custom-control custom-radio">
                                      <input type="radio" id="customRadio1" name="card" class="custom-control-input" value="2">
                                      <label class="custom-control-label" for="customRadio1">Credit or Debit Card</label>
                                    </div>
                                    <div class="card-images">
                                        <ul>
                                            <li><img src="{{ URL::asset('images/card1.png') }}"></li>
                                            <li><img src="{{ URL::asset('images/card-2.png') }}"></li>
                                            <li><img src="{{ URL::asset('images/card-3.png') }}"></li>
                                            <li><img src="{{ URL::asset('images/card-4.png') }}"></li>
                                        </ul>
                                        <div class="clr"></div>
                                    </div>
                                    <div class="heading-text">
                                        <p><span><i class="fa fa-lock" aria-hidden="true"></i></span> Your payment is secure . Your card details will not shared with sellers</p>
                                    </div>
                                    <form action="{{ url('payments/with-credit-card') }}" method="post" name="paywithcard" id="paywithcard">
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input type="hidden" name="amount" value="" id="deposit_amount_paypal">
                                                <div class="input-icons"> 
                                                    <span><i class="fa fa-credit-card icon"></i></span> 
                                                    <input class="input-field" type="text" name="card_number" placeholder="Card Number"> 
                                                </div>
                                                <div class="input-icons edit-date"> 
                                                    <span><i class="fa fa-calendar-o icon"></i></span> 
                                                    <input class="input-field" type="text" name="duration" placeholder="MM/YY"> 
                                                </div> 
                                                <div class="input-icons edit-date"> 
                                                    <span><i class="fa fa-lock icon"></i></span> 
                                                    <input class="input-field" type="text" name="security" placeholder="CVV/CVC"> 
                                                </div> 
                                                <div class="clr"></div>
                                                <div class="input-icons"> 
                                                    <span><i class="fa fa-user icon"></i></span> 
                                                    <input class="input-field" type="text" name="holder_name" placeholder="Card Holder Name"> 
                                                </div> 
                                            </div>
                                        </div>
                                    </form>

                                    <form action="{{ url('payments/with-paypal') }}" method="post" name="frmTransaction" id="frmTransaction">
                                        {{ csrf_field() }}
                                        
                                        <input type="hidden" name="cmd" value="_xclick"> 
                                        <input type="hidden" name="item_name" value="transfer"> 
                                        <input type="hidden" name="item_number" value="order#01">
                                        <input type="hidden" name="amount" value="" id="payWithPaypal">   
                                        <input type="hidden" name="currency_code" value="USD">   
                                        
                                    </form>
                                   



                                    
                                    <div class="row paypel-sec">
                                        <div class="col-md-12">
                                           <div class="custom-control custom-radio">
                                               <input type="radio" id="customRadio2" name="card" class="custom-control-input" value="1">
                                               <label class="custom-control-label" for="customRadio2"><img src="{{ URL::asset('images/card5.png') }}"> </label>
                                            </div>
                                       </div>
                                    </div>

                                    <div class="row crd-btn">
                                        <div class="col-md-5">
                                            <div class="row">
                                                <div class="col-md-6"><button type="button" class="btn btn-primary edit-done" onclick="submitPaypalForm()">Done</button></div>
                                                <div class="col-md-6"><button type="button" class="btn btn-primary edit-cen" data-dismiss="modal">Cancel</button></div>
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-7">
                                            <div class="trms-sec">By clicking you agree to our <span>Terms & Conditions</span></div>
                                        </div> -->
                                    </div>
                                    

                                    <!-- <form class="w3-container w3-display-middle w3-card-4 w3-padding-16" method="POST" id="payment-form"
                                      action="{!! URL::to('paypal') !!}">
                                      <input type="hidden" name="amount" value="" id="deposit_amount_paypal"></p>
                                        <div class="row paypel-sec">
                                            <div class="col-md-12">
                                               <div class="custom-control custom-radio">
                                                   <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input" onclick="submitPaypalForm()">
                                                   <label class="custom-control-label" for="customRadio2"><img src="{{ URL::asset('images/card5.png') }}"> </label>
                                                </div>
                                           </div>
                                        </div>
                                        <input type="submit" style="display: none" value="submit" id="submit">
                                    </form> -->
                                    <div class="trms-sec" sty>By clicking you agree to our <span>Terms & Conditions</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> -->
            </div>
        </div>
    </div>
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
    <script type="text/javascript" src="{{ asset('js/datatables.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

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

        function matulpost(elem) {
            // $('#PendingDetails' + value).toggle();
            var detail = $(elem).attr('data-detail');
            $.dialog({
                title: 'Details',
                content: detail,
            });
        }

        function matulpostdetail(elem) {
            var detail = $(elem).attr('data-detail');
            $.dialog({
                title: 'Details',
                content: detail,
            });
            // console.log('elem',elem);
            // var detail = $(elem).attr('data-detail');
            // $(elem).parent().parent().parent().after('<tr><td colspan="6">'+detail+'</td></tr>');
            //attr('data-detail')
            // $('#PostedDetails' + value).toggle();
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        jQuery(document).ready(function ($) {
            // $('#pending_transaction_tbl,#posted_transaction_tbl').DataTable({
            //     responsive: true
            // });
            var table = $('#pending_transaction_tbl,#posted_transaction_tbl')
                .addClass( 'nowrap' )
                .dataTable( {
                order: [],
                responsive: true,
                columnDefs: [
                    { targets: [-1, -3], className: 'dt-body-right' }
                ]
            } );

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
                //console.log(transfer_form_data);
                $.ajax({
                    url: "transfer",
                    type: "POST",
                    data: {transfer_form_data: transfer_form_data, transfer_id: transfer_id},
                    dataType: "JSON",
                    success: function (data) {
                        //console.log(data);
                        $("#loader").addClass('hide');
                        $(".main-c").removeClass('hide');
                        if (data['error'] == 0) {

                            swal({
                                title: "Withdraw request submitted!",
                                text: "",
                                icon: "success",
                                buttons: true,
                            }).then((ok)=>{
                                window.location.reload();
                            });

                            //window.location.reload();
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
                                    buttons: true,
                                }).then((ok)=>{
                                    window.location.reload();
                                });
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

    function inputAmountPaypal(amount){
        if(amount != '') {
            $("#deposit_amount_paypal").val(amount);
            $("#payWithPaypal").val(amount);
        }
    }

    function submitPaypalForm(){
        
        var x = $('input[name=card]:checked').val();
        if(x == 1) {
            $("#frmTransaction").submit();
        } else {
            $("#paywithcard").submit();
        }
    }

    </script>
@endsection
