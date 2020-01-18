
<!-- <div class="container"> -->
    <div class="card">
        <div class="card-header"><span class="card-title" style="font-size: 20px;">Pending Transactions</span></div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-sx-12">
                    <table class="display dataTable" id="pending_transaction_tbl">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Debit</th>
                                <th>Credit</th>
                                <th class="none" >Transaction By</th>
                                <th class="none" >Dispute No.</th>            
                                <th class="none" >Transaction ID</th>
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
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th>Debit</th>
                                    <th>Credit</th>
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
<!-- </div> -->

<script type="text/javascript">

    var table = $('#pending_transaction_tbl,#posted_transaction_tbl')
                .addClass( 'nowrap' )
                .dataTable( {
                order: [],
                responsive: true,
                columnDefs: [
                    { targets: [-1, -3], className: 'dt-body-right' }
                ]
            });

    $(document).on('click', 'button.deleteRecord', function(event){
        event.preventDefault();

        $("#loader").removeClass('hide');
        $(".main-c").addClass('hide');
        var id = $(this).data("id");

        $.ajax({
            url: "cancelWithdrawRequest",
            type: "POST",
            data: {
                "id": id,
            },
            dataType: "JSON",
            success: function (data)
            {
                $("#loader").addClass('hide');
                $(".main-c").removeClass('hide');
                if(data['error'] == 0)
                {

                    swal({
                        title: "You have canel withdraw request successfull!",
                        text: "",
                        icon: "success",
                        button: "OK",
                    });

                    window.location.reload();
                }
                else
                {
                    swal({
                        title: "Sorry!! due to some reasons your request is not accepted. Please try again",
                        text: "",
                        icon: "error",
                        button: "OK",
                    });
                }

            },
            error: function(XMLHttpRequest, textStatus, errorThrown)
            {
                //alert(errorThrown);
            }
        });
    });

    $(document).on('click', 'button.acceptedWithdrawRequest', function(event){

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
                success: function (data)
                {
                    $("#loader").addClass('hide');
                    $(".main-c").removeClass('hide');
                    if(data['error'] == 0)
                    {

                        swal({
                            title: "Your withdraw request is accepted. Thanks!",
                            text: "",
                            icon: "success",
                            button: "OK",
                        });

                        window.location.reload();
                    }
                    else
                    {
                        swal({
                            title: "Please try again later",
                            text: "",
                            icon: "error",
                            button: "OK",
                        });
                    }

                },
                error: function(XMLHttpRequest, textStatus, errorThrown)
                {
                    //alert(errorThrown);
                }
            });

    });
</script>