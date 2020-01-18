@extends('layouts.app')

@section('custom-styles')

	<style>
		/*query screen css*/

		.query .table .left-one {
			width: 119px;
			text-align: center;
			color: white;
			background-color: #3b5998;
		}

		.query-table {
			text-align: center;
			color: #fff;
			background-color: #3b5998;
		}

		.queryscreen .main-for-back {
			background-color: #3b5998 !important;
			padding: 8px 28px;
			border-top: none !important;
			border-bottom: none !important;
			color: #fff;
		}

		.play-store {
			color: #fff !important;
			vertical-align: -webkit-baseline-middle;
		}

		.download-icon {
			color: #fff !important;
			vertical-align: -webkit-baseline-middle;
		}

		.queryscreen .main-for-back .main-content-left a.btn {
			vertical-align: -webkit-baseline-middle !important;
		}

		.textarea-sec textarea {
			width: 100%;
			overflow-y: auto !important;
			overflow-x: auto !important;
			border-top: 3px solid #dcd9d9;
			border-left: 3px solid #dcd9d9;
			background-color: #d3d3d33b;
		}

		.table-dummy {
			background-color: #fff;
		}

		.table-dummy table {
			text-align: center;
			border-top: none !important;
			border-left: none !important;
		}

		tr.f-row {
			background-color: #3b5998 !important;
		}

		tr.f-row th {
			color: #fff !important;
		}

		.query tbody tr td.first-row {
			background-color: #fff;
		}

		.delete-btn {
			margin-right: 24px;
		}

		.m-l-79 {
			margin-left: 53px !important;
			margin-top: 8px;
			font-size: 16px;
		}

		.modal-body input {
			margin-left: 15px;
		}

		.top .tableexport-caption, .button-default.xlsx {
			color: #fff;
			background-color: #3b5998;
			border: none;
			padding: 10px;
			margin-left: 25px
		}

		.top .tableexport-caption, .button-default.xlsx:hover {
			color: #fff;
			background-color: #263961;
		}

		.top .tableexport-caption, .button-default.csv {
			color: #fff;
			background-color: #3b5998;
			border: none;
			padding: 10px;
			margin-left: 15px
		}

		.top .tableexport-caption, .button-default.csv:hover {
			color: #fff;
			background-color: #263961;
		}

		.top .tableexport-caption, .button-default.txt {
			color: #fff;
			background-color: #3b5998;
			border: none;
			padding: 10px;
			margin-left: 15px
		}

		.top .tableexport-caption, .button-default.txt:hover {
			color: #fff;
			background-color: #263961;
		}
	</style>
@endsection

@section('content')
	<section class="query m-t-12">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<table class="table table-bordered">
						<thead>
						<tr class="frst-one">
							<th class="left-one">Querry Name</th>
							{{--<a href="{{ URL('/home') }}"><i class="fa fa-times-circle fl-r crs-pntr" style="font-size:27px;color:#6c757d;"></i></a>--}}
							<th class="query-table">Querry</th>
						</tr>
						</thead>
						<tbody>
                        <?php foreach($query_list as $key=>$value){ ?>
						<tr>
							<td class="first-row"><span class="m-l-12"><?php echo $value['name'];  ?></span></td>
							<td class="first-row description"><span class="m-l-12"><?php echo $value['description'];  ?></span><img
										class="delete_query" id="<?php echo $value['id']; ?>" src="{{ asset('img/img.png') }}"/></td>
						</tr>
                        <?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>
	<section class="queryscreen">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="main-for-back">
						<div class="row">
							<div class="col-md-6 col-sm-6">
								<div class="main-content">
									<h3>Query Screen</h3>
								</div>
							</div>
							<div class="col-md-6 col-sm-6">
								<div class="main-content-left">
									<a href="javascript:void(0)" class="btn"><i id="play_query" class="fa fa-play play-store"></i></a>
									<a href="javascript:void(0)" class="btn"><i id="save_to_excel" class="fa fa-download download-icon"></i></a>
									<a href="#" class="btn "><img data-toggle="modal" data-target="#myModal" id="" src="{{ asset('img/save.png') }}"/></a>
								</div>
							</div>
						</div>
					</div>
					<div id="myModal" class="modal fade" role="dialog">
						<div class="modal-dialog">

							<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title"><a href=""><img src="{{ asset('img/save.png') }}"/></a> Save Query</h4>
								</div>
								<div class="modal-body">
									<div class="row">
										<div class="col-xs-2 m-l-79"><b>Query Name: </b></div>
										<div class="col-xs-4">
											<input type="text" class="form-control" name="query_name" id="query_name">
										</div>

									</div>
								</div>
								<div class="modal-footer">
									<button type="button" id="save_query_name_des" class="btn btn-primary w-40 m-r-35">SAVE</button>
									<button type="button" class="btn btn-danger w-40 delete-btn" data-dismiss="modal">CANCEL</button>
									<!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
								</div>
							</div>

						</div>
					</div>
					<div class="textarea-sec">
						<textarea rows="4" cols="100" id="query_command">  select * from users</textarea>
						<div class="table-dummy">
							<table class="table table-bordered excel-exp">
								<thead id="headings">
								<tr class="f-row">
									<th></th>
									<th>IndividualID</th>
									<th>FirstName</th>
									<th>LastName</th>
									<th>DateCreated</th>
								</tr>
								</thead>
								<tbody id="query_data">

								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

@endsection

@section('extra-JS')
	<script src="https://cdn.jsdelivr.net/npm/js-sql-parser@1.0.7/dist/parser/sqlParser.js"></script>
	<script src="{{ asset('js/FileSaver.js') }}"></script>
	<script src="{{ asset('js/Blob.js') }}"></script>
	<script src="{{ asset('js/xlsx.core.min.js') }}"></script>
	<script src="{{ asset('js/tableexport.js') }}"></script>
	<script>

        $(document).ready(function () {
            $(".csv").css("display", "none");
            $(".txt").css("display", "none");
            $(".xlsx").css("display", "none");
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#play_query").click(function () {
                var query_text = $("#query_command").val().trim();
                query_text = query_text.toLowerCase();
                if (query_text.indexOf('insert') > -1 || query_text.indexOf('update') > -1 || query_text.indexOf('delete') > -1) {
                    alert("query not allowed");
                }
                else {
                    $.ajax({
                        url: "TakeQuery",
                        type: "POST",
                        data: {query_command: query_text},
                        dataType: "JSON",
                        success: function (data) {

                            console.log(data['headings']);
                            $("#headings").html(data['headings']);
                            $("#query_data").html(data['tabular_data']);

                            $(".excel-exp").tableExport({
                                position: "top",
                            });

                        },
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            alert("Entered query is not valid");
                        }
                    });
                }
            });
            $("#save_to_excel").click(function () {
                $(".xlsx").trigger("click");
            });
            $("#save_query").click(function () {
                alert();
            });
            $("#save_query_name_des").click(function () {
                var query_text = $("#query_command").val().trim();
                query_text = query_text.toLowerCase();
                var query_name = $("#query_name").val();
                if (query_text == "") {
                    alert("Not any query availiable to save");
                    return false;
                }
                if (query_name == "") {
                    alert("please eneter name of query");
                    return false;
                }
                $.ajax({
                    url: "SaveQuery",
                    type: "POST",
                    data: {query_text: query_text, query_name: query_name},
                    dataType: "JSON",
                    success: function (data) {
                        console.log(data['success']);
                        location.reload();
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        alert("Query can't be saved");
                    }
                });


            });
            $(".delete_query").click(function () {
                var query_id = $(this).attr('id');
                $.ajax({
                    url: "DeleteQuery",
                    type: "POST",
                    data: {query_id: query_id},
                    dataType: "JSON",
                    success: function (data) {
                        console.log(data['success']);
                        if (data['success'] == 1) {
                            location.reload();
                        }
                        else {
                            alert("some thing went wrong");
                        }

                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        alert("Query can't be saved");
                    }
                });
            });
            $(document).on("click", ".description", function () {
                $("#query_command").text(($(this).children("span").text()));
            });
        });


	</script>


@endsection