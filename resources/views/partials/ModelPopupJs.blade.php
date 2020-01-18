<script type="text/javascript">
    $(document).ready(function () {
        var option = 0;
        var iwantbuy = 0;
        var iwantsell = 0;
        var buyservice = 0;
        var sellservice = 0;
        $("#newpost").click(function () {
            $(".modal-backdrop").modal('hide');
            $('#newpostmodel').modal('show');
        });

        $('.rating-from-seller').rating({
            size: 'sm',
            showCaption: false,
            clearButton: '',
        }).on('rating:change', function(event, value, caption) {
            var userid = $(this).attr('data-bid-user');
            var bidid = $(this).attr('data-bid-id');
            $.ajax({
                method: 'post',
                url: '{{route('review.user')}}',
                data: {reviewable_id: userid,status:'closed', review_number: value, bid_id: bidid, _token: '{{csrf_token()}}'},
                success: function (res) {

                }
            })
        });

        $('.iwant').click(function () {
            option = this.id;
        });

        $('#finalpriviewpost').click(function () {
            $('#postbuydone').modal('hide');
        });

        $("#continue1").click(function () {
            if (option == 0) {
                alert('Please select any option');
                return;
            }
            if (option == 1) {
                $.ajax({
                    type: 'post',
                    url: '/maincategory/',
                    data: {'category': 'Buy'},
                    success: function (data) {
                        $("#buyServicMainCategoryName").html(data);
                        $("#newpostmodel").modal('hide');
                        $("#iwanttobuy").modal('show');
                        $("#checkBackbutton").val(1);
                }
                });
            }
            if (option == 2) {
                $.ajax({
                    type: 'post',
                    url: '/maincategory/',
                    data: {'category': 'Sell'},
                    success: function (data) {
                        $("#sellServicMainCategoryName").html(data);
                        $("#newpostmodel").modal('hide');
                        $("#iwanttosell").modal('show');
                }
                });
            }
            if (option == 3) {
                $.ajax({
                    type: 'post',
                    url: '/maincategory/',
                    data: {'category': 'Blog'},
                    success: function (data) {
                        $("#blogMainCategoryName").html(data);
                        $("#newpostmodel").modal('hide');
                        $("#selectblogpostname").modal('show');
                        // $("#iwanttopostblog").modal('show');
                        //window.location = '/add-blog';
                }
                });
            }
            if (option == 4) {
                $.ajax({
                    type: 'post',
                    url: '/maincategory/',
                    data: {'category': 'Event'},
                    success: function (data) {
                        $("#eventMainCategoryName").html(data);
                        $("#newpostmodel").modal('hide');
                        $("#editStatus").val(0);
                        $("#mapSearchCheck").html('');
                        $("#checkUpdate").val(0);
                        $("#checkBackbutton").val(0);
                        document.getElementById("checkVisiblebutton").style.display = "block";
                        $("#selecteventgpostname").modal('show');
                        // $("#iwanttopostevent").modal('show');
                }
                });

                //$("#datetimeforevent").modal('show');
            }
        });
        //Buy Service jQuery
        $('.iwantbuy').click(function () {
            iwantbuy = this.id;
        });
        $('#iwantbuycoun').click(function () {
            option = 1;
            var cat = $('#iwantbuy').val();
            if (cat == '') {
                alert('Please select any option');
                return
            }  else {
                 $.ajax({
                    type: 'post',
                    url: '/sell/getpostcategory',
                    data: {'category': cat,'main_cat': 'Buy'},
                    success: function (data) {
                        $("#buySubCategoryName").html(data);
                        $("#iwanttobuy").modal('hide');
                        $("#iwanttobuyservice").modal('show');
                }
                });
            }
        });
        $(".buyservice").click(function () {
            buyservice = $(this).attr('data-id');
        });
        $(".buyproduct").click(function () {
            buyservice = $(this).attr('data-id');
        });
        $("#takephotophtocoun").click(function () {
            buyservice = document.getElementById('service_id').value;
            if (buyservice == 0) {
                alert('Please select any option');
                return
            } else {
                if (option == 1) {
                    $("#iwanttobuyproduct").modal('hide');
                    $("#iwanttobuyservice").modal('hide');
                    $("#takeaphotoforpost").modal('show');
                }
                if (option == 2) {
                    $("#iwanttosellservice").modal('hide');
                    $("#iwanttosellproduct").modal('hide');
                    $("#takeaphotoforpost").modal('show');
                }
            }
        });
        $("#producttakephotophtocoun").click(function () {
            console.log(buyservice);
            buyservice = document.getElementById('product_id').value;
            if (buyservice == 0) {
                alert('Please select any option');
                return
            } else {
                if (option == 1) {
                    $("#iwanttobuyproduct").modal('hide');
                    $("#iwanttobuyservice").modal('hide');
                    $("#takeaphotoforpost").modal('show');
                }
                if (option == 2) {
                    $("#iwanttosellservice").modal('hide');
                    $("#iwanttosellproduct").modal('hide');
                    $("#takeaphotoforpost").modal('show');
                }
            }
        });
        $('.sellservice').click(function () {
            sellservice = this.id;
        })
        $("#takephotophtosellcoun").click(function () {
            sellservice = document.getElementById('service_id').value;
            if (sellservice == 0) {
                alert('Please select any option');
                return
            } else {
                if (option == 1) {
                    $("#iwanttobuyproduct").modal('hide');
                    $("#iwanttobuyservice").modal('hide');
                    $("#takeaphotoforpost").modal('show');
                }
                if (option == 2) {
                    $("#iwanttosellservice").modal('hide');
                    $("#iwanttosellproduct").modal('hide');
                    $("#takeaphotoforpost").modal('show');
                }
            }
        });
        $("#takephotophtosellcoun1").click(function () {
             if (option == 1) {
                    $("#iwanttobuyproduct").modal('hide');
                    $("#iwanttobuyservice").modal('hide');
                    $("#takeaphotoforpost").modal('show');
                }
                if (option == 2) {
                    $("#iwanttosellservice").modal('hide');
                    $("#iwanttosellproduct").modal('hide');
                    $("#takeaphotoforpost").modal('show');
                }
        });
        $(".takeaphotoforpost").click(function () {
            $("#takeaphotoforpostfile").click();
        });

        $('#povidedetailcoun').click(function () {
            $("#takeaphotoforpost").modal('hide');
            if (option == 1) {
                $("#providedetailbuy").modal('show');
            } else {
                $("#providedetailsell").modal('show');
            }
        });
        $("#takeaphotoflicensecon").click(function () {
            $("#providedetailsell").modal('hide');
            $("#takeaphotoflicense").modal('show');
        });
        $("#takephotolicense").click(function () {
            $("#licensefile").click();
        });
        $("#takeaphotofcaregistrationcon").click(function () {
            $("#takeaphotoflicense").modal('hide');
            $("#takeaphotofcaregistration").modal('show');
        });
        $("#takephotoofcaregistraion").click(function () {
            $("#regdocfile").click();
        });
        $("#comisioncoun").click(function () {
            $("#takeaphotofcaregistration").modal('hide');
            $("#comision").modal('show');
        });
        $("#upnextcoun").click(function () {
            $("#comision").modal('hide');
            $("#upnextmodel").modal('show');
        });
        $("#backgroundcheckcoun").click(function () {
            $("#upnextmodel").modal('hide');
            $("#backgroundcheck").modal('show');
        });
        $("#authenticationpurposescoun").click(function () {
            $("#backgroundcheck").modal('hide');
            $("#authenticationpurposes").modal('show');
        })
        $("#uploadphotocoun").click(function () {
            $("#authenticationpurposes").modal('hide');
            $("#uplaodphoto").modal('show');
        });
        $("#uplaodphotofun").click(function () {
            $("#uplaodphototri").click();
        });
        $("#uploadidphotocun").click(function () {
            $("#uplaodphoto").modal('hide');
            $("#uplaodidcardphoto").modal('show');
        });
        $("#uplaodidphotofun").click(function () {
            $("#uplaodidphototri").click();
        });
        $("#alldonecoun").click(function () {
            $("#uplaodidcardphoto").modal('hide');
            $("#alldone").modal('show');
        });
        $('#eventlocationCon').click(function () {
            $("#providedetailbuy").modal('hide');
            $("#eventlocation").modal('show');
        });
        $('#eventlocationConSell').click(function () {
            $('#checkBackbutton').val(12);
            $("#providedetailsell").modal('hide');
            $("#eventlocation").modal('show');
        });

        //Sell Services Jquery
        $(".iwantsell").click(function () {
            iwantsell = this.id;
            console.log(iwantsell);
        });
        $("#iwanttosellcon").click(function () {
            option = 2;
            var sell_cat = $('#iwantsell').val();
            if (sell_cat == 0) {
                alert('Please select any option');
                return
            }  else {
                $.ajax({
                    type: 'post',
                    url: '/sell/getpostcategory',
                    data: {'category': sell_cat,'main_cat': 'Sell'},
                    success: function (data) {
                        $("#sellSubCategoryName").html(data);
                        $("#iwanttosell").modal('hide');
                        $("#iwanttosellservice").modal('show');
                }
                });
                
            }
        });
        $("#submiteventpostname").click(function () {
            $("#selecteventgpostname").modal('hide');
            $("#iwanttopostevent").modal('show');

        });
        //want to post event
        $("#submiteventfor").click(function () {

            //eventfor = this.id;
            var eventfor = document.getElementById('eventfor').value;
            if (eventfor == '' || eventfor == null) {
                alert('Please enter event for');
                return
            } else {
                $("#iwanttopostevent").modal('hide');
                //$("#datetimeforevent").modal('show');
                $("#uploadeventbanner").modal('show');
            }
        });
        $("#backeventfor").click(function () {
            $("#newpostmodel").modal('show');
            $("#iwanttopostevent").modal('hide');

        });
        $("#submituploadevent").click(function () {
            var image = document.getElementById('eventuploadphoto').value;
            if (image == '' || image == null) {
                if ($("#editStatus").val() == 1) {
                    $("#uploadeventbanner").modal('hide');
                    $("#aboutevent").modal('show');
                } else {
                    alert('please select image');
                }
            } else {
                $("#uploadeventbanner").modal('hide');
                $("#aboutevent").modal('show');
            }


        });
        $("#backuploadevent").click(function () {

            $("#uploadeventbanner").modal('hide');
            $("#iwanttopostevent").modal('show');

        });
        $("#skipuploadevent").click(function () {

            $("#uploadeventbanner").modal('hide');
            $("#aboutevent").modal('show');

        });
        $(".uploadeventbanner").click(function () {
            $("#eventuploadphoto").click();
        });
        $("#backabpotevent").click(function () {

            $("#aboutevent").modal('hide');
            $("#uploadeventbanner").modal('show');

        });
        $("#submitabpotevent").click(function () {
            $("#aboutevent").modal('hide');
            $("#eventlocation").modal('show');
        });
        $(document).on("click", "#backeventlocation", function () {
            var mapBackLocation = $("#checkBackbutton").val();
            console.log(mapBackLocation);
            if (mapBackLocation == 0) {
                $("#eventlocation").modal('hide');
                $("#aboutevent").modal('show');
            } else if (mapBackLocation == 1) {
                $('#eventlocation').modal('hide');
                $('#referralcomission').modal('hide');
                $('#providedetailbuy').modal('show');
            } else if (mapBackLocation == 11) {
                $('#eventlocation').modal('hide');
                $('#buySellDetails').modal('show');
            }else if (mapBackLocation == 12) {
                $('#eventlocation').modal('hide');
                $('#providedetailsell').modal('show');
            } else {
                $("#eventlocation").modal('hide');
                $("#eventAllDetails").modal('show');
            }


        });

        $(document).on('click', '.place-order', function (e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            $('#buyBidParticipantList').modal('hide');
            $('#dueDateModal').modal('show');
            $('#dueDateContinue').attr('data-id', id);

        });

        $(document).on('click', '.place-in-process', function (e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
           $.ajax({
               method:'post',
               url:'{{route('post.buy.bid.order.inprocess')}}',
               data:{id},
               success:function(res){
                   if (res.status == 'success') {
                       Swal.fire(
                            'Congratulation',
                            'Request completed Successfully',
                            'success'
                        );
                       window.location.reload();

                   } else {
                       Swal.fire(
                           'Failed',
                           res.message,
                           'error'
                       );
                   }
               }
           })

        });

        $(document).on('click', '.place-received', function (e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            var user_id = $(this).attr('data-user-id');
            $(this).closest('.actionButtons').html('');
            $('.bid-status_' + id).text('Paid');
            var review = `<input class="ownRating bid-rating rating-loading own-rating"
                                       value=""
                                       style="padding-top: 5px;">`;
            $('.rate_profile_' + id).html(review);
            $('.bid-rating').rating({
                size: 'sm',
                showCaption: false,
                clearButton: '',
            });
            $.ajax({
                method: 'post',
                url: '{{route('post.buy.bid.order.receive')}}',
                data: {id, _token: '{{csrf_token()}}'},
                success: function (res) {
                    console.log(res);
                }
            });

            $('.bid-rating').on('rating:change', function (event, value, caption) {
                $.ajax({
                    method: 'post',
                    url: '{{route('review.user')}}',
                    data: {reviewable_id: user_id, review_number: value, bid_id: id, _token: '{{csrf_token()}}'},
                    success: function (res) {
                        console.log(res);
                    }
                })
            });


        });

        $(document).on('click', '.rate', function (e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            $(this).closest('.actionButtons').html('');
            $('.bid-status_' + id).text('Paid');

        });

        $(document).on('click', '.place-delivered', function (e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            $.ajax({
                method: 'post',
                url: '{{route('post.buy.bid.order.deliver')}}',
                data: {id, _token: $('[name=_token]').val()},
                success: function (res) {
                    if (res.status == 'success') {
                        Swal.fire(
                            'Order Delivered',
                            'You Request Successfully Completed',
                            'success'
                        ).then(function () {
                            setTimeout(function () {
                                window.location.reload()
                            }, 500)
                        });
                    } else {
                        Swal.fire(
                            'Order Delivered',
                            res.message,
                            'error'
                        );
                    }
                }

            });

        });
        $(document).on('click', '.normal-dispute', function (e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            var type = $(this).attr('data-type');

            $.ajax({
                method: 'post',
                url: '{{route('post.buy.bid.order.dispute')}}',
                data: {id,type, _token: $('[name=_token]').val()},
                success: function (res) {
                    if (res.status == 'success') {
                        Swal.fire(
                            'Order Dispute',
                            'You Request Successfully Completed',
                            'success'
                        ).then(function () {
                            setTimeout(function () {
                                window.location.reload()
                            }, 500)
                        });
                    } else {
                        Swal.fire(
                            'Order Dispute',
                            res.message,
                            'error'
                        );
                    }
                }

            });

        });

        $(document).on('click', '.normal-accept', function (e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            var type = $(this).attr('data-type');
            var change = 'accept';

            $.ajax({
                method: 'post',
                url: '{{route('post.buy.bid.order.disputeChange')}}',
                data: {id,type, change,_token: $('[name=_token]').val()},
                success: function (res) {
                    if (res.status == 'success') {
                        Swal.fire(
                            'Order Dispute',
                            'You Request Successfully Completed',
                            'success'
                        ).then(function () {
                            setTimeout(function () {
                                window.location.reload()
                            }, 500)
                        });
                    } else {
                        Swal.fire(
                            'Order Dispute',
                            res.message,
                            'error'
                        );
                    }
                }

            });

        });

        $(document).on('click', '.normal-withdraw', function (e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            var type = $(this).attr('data-type');
            var change = 'withdraw';
            $.ajax({
                method: 'post',
                url: '{{route('post.buy.bid.order.disputeChange')}}',
                data: {id,type,change,_token: $('[name=_token]').val()},
                success: function (res) {
                    if (res.status == 'success') {
                        Swal.fire(
                            'Order Dispute',
                            'You Request Successfully Completed',
                            'success'
                        ).then(function () {
                            setTimeout(function () {
                                window.location.reload()
                            }, 500)
                        });
                    } else {
                        Swal.fire(
                            'Order Dispute',
                            res.message,
                            'error'
                        );
                    }
                }

            });

        });

        var today = new Date();

        var dd = today.getDate();
        var mm = today.getMonth() + 1;
        var yyyy = today.getFullYear();
        if (dd < 10) {
            dd = '0' + dd;
        }
        if (mm < 10) {
            mm = '0' + mm;
        }
        var today = mm + '/' + dd + '/' + yyyy;
        $('#dueDateSelect').datepicker({
            format: 'mm/dd/yyyy',
            startDate: today,
        });

        $('#dueDateSelect1').datepicker({
            format: 'mm/dd/yyyy',
            startDate: today,
        });

        $('#dueDateContinue').on('click', function (e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            var date = $('#dueDateSelect').val();
            $.ajax({
                method: 'post',
                url: '{{route('post.buy.bid.order.create')}}',
                data: {id, date, _token: $('[name=_token]').val()},
                success: function (res) {
                    if (res.status == 'success') {
                        $('#dueDateModal').modal('hide');
                        Swal.fire(
                            'Order Created',
                            'You Request Successfully Completed',
                            'success'
                        );
                    }else{
                        Swal.fire(
                            'Order Create Error',
                            res.message,
                            'error'
                        );
                    }
                }

            });
        });

        $('#referenceContinue').on('click', function (e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            var current = $(this).attr('data-amount');
            var email = $('#referenceUserForInProcess').val();
            var radioButton=$('input[name=is_reference]:checked').val();
            if(radioButton=='yes' && !email){
                return;
            }

            $.ajax({
                method: 'post',
                url: '{{route('post.buy.bid.store')}}',
                data: {id,bid_amount:current, email,check:radioButton, _token: $('[name=_token]').val()},
                success: function (res) {
                    if (res.status == 'success') {
                        $('#dueDateModal').modal('hide');
                        Swal.fire(
                            'Order Bid',
                            'You Request Successfully Completed',
                            'success'
                        ).then(function () {
                            setTimeout(function () {
                                window.location.reload()
                            }, 500)
                        });
                        $('#referenceModal').modal('hide');
                    } else {
                        $('#dueDateModal').modal('hide');
                        Swal.fire(
                            'Order Bid',
                            res.message,
                            'error'
                        );
                    }
                }

            });
        });

        $("#submiteventlocation").click(function () {
            var location = $("#searchInput").val();
            if (location == '' || location == null) {
                alert('please enter address');
            } else {
                if (option == 1) {
                    $("#eventlocation").modal('hide');
                    $("#referralcomission").modal('show');
                    $('#submitfereffalcom').text('Submit');
                }else if (option == 2) {
                    $("#eventlocation").modal('hide');
                    $("#referralcomission").modal('show');
                    $('#submitfereffalcom').text('Submit');
                } else {
                    $("#eventlocation").modal('hide');
                    $("#freejoin").modal('show');
                }
            }
        });

        $("#submitfreejoin").click(function () {
            var chaeckFree = $("input[name='eventJoinType']:checked").val();
            if (chaeckFree === undefined) {
                alert('please choose one');
            } else {
                //alert(chaeckFree);
                if (chaeckFree == 'Not Free') {
                    var eventFee = $("#eventFee").val();
                    if (eventFee == '' || eventFee == null) {
                        alert('please Enter event fee');
                    } else {
                        $("#freejoin").modal('hide');
                        $("#referralcomission").modal('show');
                    }
                } else {
                    $("#freejoin").modal('hide');
                    $("#referralcomission").modal('show');
                }

            }

        });
        $("#backfreejoin").click(function () {
            $("#eventlocation").modal('show');
            $("#freejoin").modal('hide');

        });
        $("#freeJoin").click(function () {
            document.getElementById("joinType").style.display = "none";
        });
        $("#notFreeJoin").click(function () {
            document.getElementById("joinType").style.display = "block";
        });
        $("#submitfereffalcom").click(function () {
            var refPer = $("#referralPer").val();
            //alert(refPer);
            if (refPer == '' || refPer == null) {
                alert('please enter referral percentage');
            } else {
                if (option == 1) {
                    saveBuyData();
                }else if (option == 2) {
                    saveSellData();
                } else {
                    $("#referralcomission").modal('hide');
                    $("#needtoapprovalforevent").modal('show');
                }
            }

        });
        $("#backreffalcom").click(function () {
            if (option == 1) {
                $("#referralcomission").modal('hide');
                $('#eventlocation').modal('show');
            } else {
                $("#freejoin").modal('show');
                $("#referralcomission").modal('hide');
            }

        });
        $("#submitneedapprovalevent").click(function () {
            var needApproval = $("input[name='eventApproval']:checked").val();
            if (needApproval === undefined) {
                alert('please choose one');
            } else {
                $("#needtoapprovalforevent").modal('hide');
                if ($("#editStatus").val() == 1) {
                    var eventId = $("#eventId").val();
                    var userId = $("#userId").val();
                    showEventDateTime(eventId, userId)
                } else {
                    // $("#datetimeforevent").modal('show');
                    $("#eventTickets").modal('show');
                }

            }

        });
         $("#submiteventtickets").click(function () {

            //eventfor = this.id;
            var eventTicket = document.getElementById('eventTicket').value;
            if (eventTicket == '' || eventTicket == null) {
                alert('Please enter total tickets');
                return
            } else {
                $("#eventTickets").modal('hide');
                //$("#datetimeforevent").modal('show');
                $("#datetimeforevent").modal('show');
            }
        });
        $("#backneedapprovalevent").click(function () {
            $("#referralcomission").modal('show');
            $("#needtoapprovalforevent").modal('hide');

        });
        $("#backdatetimeevent").click(function () {
            $("#needtoapprovalforevent").modal('show');
            $("#datetimeforevent").modal('hide');

        });
        var tempEventId = 0;
        $("#submitdatetimeevent").click(function () {
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth() + 1;
            var yyyy = today.getFullYear();
            if (dd < 10) {
                dd = '0' + dd;
            }
            if (mm < 10) {
                mm = '0' + mm;
            }
            var today = mm + '/' + dd + '/' + yyyy;
            var checkDateUpdate = $("#checkUpdate").val();
            var startDate = $("#eventStartDate").val();
            var endDate = $("#eventEndDate").val()
            if (startDate == '' || startDate == null) {
                alert('please select start date');
            } else if (endDate == '' || endDate == null) {
                alert('please select end date');
            } else if (today > startDate) {
                alert('please select valid start date');
            } else if (startDate > endDate) {
                alert('please select start date lower the end date')
            } else {
                if (checkDateUpdate == 0) {
                    if (tempEventId == 0) {
                        tempEventId = random(1000, 999999);
                    }
                    var ajaxDisplay = document.getElementById("main_result");
                    document.getElementById("main_result").style.display = "block";
                    $("#main_result").empty().html('<img src="images/loading.gif" style="height: 100px;"/>');
                    $.ajax({
                        type: 'post',
                        url: '{{route('events.datetimeInsert')}}',
                        data: {
                            '_token': $('input[name=_token]').val(),
                            'tempEventId': tempEventId,
                            'eventStartDate': $("#eventStartDate").val(),
                            'eventEndDate': $('#eventEndDate').val(),
                            'start_house': $("#start_house").val(),
                            'start_minit': $('#start_minit').val(),
                            'startTimeType': $("#startTimeType").val(),
                            'end_house': $('#end_house').val(),
                            'end_minit': $("#end_minit").val(),
                            'end_time_type': $('#end_time_type').val()
                        },
                        success: function (data) {
                            // swal("Successfully", "Edit Event Fee Successfully", "success");
                            //$('.error').addClass('hidden');
                            document.getElementById("main_result").style.display = "none";
                            $('#table').append('<div class="raw' + data.id + '"><br/><div class="col-sm-6 col-md-12"><div class="row"><div class="col-sm-12 col-md-5"><div class="input-group date"><input type="hidden" id="tempEventId" value="' + tempEventId + '" ><input type="text" class="form-control" name="" value="' + data.start_date + '" id="eventStartDate"><span class="cop-input-group-addon"><i class="fa fa-calendar"></i></span></div></div><div class="col-sm-12 col-md-5"><div class="input-group date"><input type="text" name="" value="' + data.end_date + '" class="form-control" id="eventEndDate"><span class="cop-input-group-addon"><i class="fa fa-calendar"></i></span></div></div><div class="col-sm-12 col-md-2"><a href="#" style="color: blue" onclick="chengeSelectedDateTime(' + data.id + ')">Edit</a> <br/><a href="#" style="color: red" onclick="deleteSelectedDateTime(' + data.id + ')">Delete</a></div> <br/><div class="col-sm-12 col-md-6"><br/><div class="row"><div class="col-md-2"><i class="fa fa-clock-o" style="width: 10px;padding: 10px" aria-hidden="true"></i></div><div class="col-md-3"><select style="padding: 5px" id="start_house"><option value="' + data.start_hours + '">' + data.start_hours + '</option></select></div><div class="col-md-3"><select style="padding: 5px" id="start_minit"><option value="' + data.start_minit + '">' + data.start_minit + '</option></select></div><div class="col-md-3"><select style="padding: 5px" id="startTimeType"><option>' + data.start_type + '</option></select></div><div class="col-md-3"></div></div></div><div class="col-sm-12 col-md-6"><br/><div class="row"><div class="col-md-2"><i class="fa fa-clock-o" style="width: 10px;padding: 10px" aria-hidden="true"></i></div><div class="col-md-3"><select style="padding: 5px" id="end_house"><option value="' + data.end_hours + '">' + data.end_hours + '</option></select></div><div class="col-md-3"><select style="padding: 5px" id="end_minit"><option value="' + data.end_minit + '">' + data.end_minit + '</option></select></div><div class="col-md-3"><select style="padding: 5px" id="end_time_type"><option>' + data.end_type + '</option></select></div><div class="col-md-3"></div></div></div><div class="col-sm-12 col-md-6"><div class="row"><div class="col-md-6"><span style="color: blue">0 going </span></div><div class="col-md-6"><span style="color: blue">0 waiting </span></div></div></div><div class="col-sm-12 col-md-6"><div class="row"><div class="col-md-6"></div><div class="col-md-6" ><center><b style="font-size: 20px;color: blue" > <a href="#" id="' + data.id + '" onclick="changeGoing(' + data.id + ')"><div id="goingImage' + data.id + '"><img = src="/images/notgoing.png"   style="width: 80px"></div></a><input type="hidden" name="" value="not going" id="goingStatus"></b></center></div></div></div></div></div></div>');

                            $("#datetimeforevent").modal('hide');
                            $("#participentlist").modal('show');
                        }
                    });
                } else {
                    var ajaxDisplay = document.getElementById("main_result");
                    document.getElementById("main_result").style.display = "block";
                    $("#main_result").empty().html('<img src="images/loading.gif" style="height: 100px;"/>');
                    $.ajax({
                        type: 'post',
                        url: '/events/updateSelectedDateTime',
                        data: {
                            '_token': $('input[name=_token]').val(),
                            'updateId': checkDateUpdate,
                            'eventStartDate': $("#eventStartDate").val(),
                            'eventEndDate': $('#eventEndDate').val(),
                            'start_house': $("#start_house").val(),
                            'start_minit': $('#start_minit').val(),
                            'startTimeType': $("#startTimeType").val(),
                            'end_house': $('#end_house').val(),
                            'end_minit': $("#end_minit").val(),
                            'end_time_type': $('#end_time_type').val()
                        },
                        success: function (data) {
                            // swal("Successfully", "Edit Event Fee Successfully", "success");
                            //$('.error').addClass('hidden');
                            document.getElementById("main_result").style.display = "none";
                            $('.raw' + data.id).replaceWith('<div class="raw' + data.id + '"><br/><div class="col-sm-6 col-md-12"><div class="row"><div class="col-sm-12 col-md-5"><div class="input-group date"><input type="hidden" id="tempEventId" value="' + tempEventId + '" ><input type="text" class="form-control" name="" value="' + data.start_date + '" id="eventStartDate"><span class="cop-input-group-addon"><i class="fa fa-calendar"></i></span></div></div><div class="col-sm-12 col-md-5"><div class="input-group date"><input type="text" name="" value="' + data.end_date + '" class="form-control" id="eventEndDate"><span class="cop-input-group-addon"><i class="fa fa-calendar"></i></span></div></div><div class="col-sm-12 col-md-2"><a href="#" style="color: blue" onclick="chengeSelectedDateTime(' + data.id + ')">Edit</a> <br/><a href="#" style="color: red" onclick="deleteSelectedDateTime(' + data.id + ')">Delete</a></div> <br/><div class="col-sm-12 col-md-6"><br/><div class="row"><div class="col-md-2"><i class="fa fa-clock-o" style="width: 10px;padding: 10px" aria-hidden="true"></i></div><div class="col-md-3"><select style="padding: 5px" id="start_house"><option value="' + data.start_hours + '">' + data.start_hours + '</option></select></div><div class="col-md-3"><select style="padding: 5px" id="start_minit"><option value="' + data.start_minit + '">' + data.start_minit + '</option></select></div><div class="col-md-3"><select style="padding: 5px" id="startTimeType"><option>' + data.start_type + '</option></select></div><div class="col-md-3"></div></div></div><div class="col-sm-12 col-md-6"><br/><div class="row"><div class="col-md-2"><i class="fa fa-clock-o" style="width: 10px;padding: 10px" aria-hidden="true"></i></div><div class="col-md-3"><select style="padding: 5px" id="end_house"><option value="' + data.end_hours + '">' + data.end_hours + '</option></select></div><div class="col-md-3"><select style="padding: 5px" id="end_minit"><option value="' + data.end_minit + '">' + data.end_minit + '</option></select></div><div class="col-md-3"><select style="padding: 5px" id="end_time_type"><option>' + data.end_type + '</option></select></div><div class="col-md-3"></div></div></div><div class="col-sm-12 col-md-6"><div class="row"><div class="col-md-6"><span style="color: blue">0 going </span></div><div class="col-md-6"><span style="color: blue">0 waiting </span></div></div></div><div class="col-sm-12 col-md-6"><div class="row"><div class="col-md-6"></div><div class="col-md-6" ><center><b style="font-size: 20px;color: blue" > <a href="#" id="' + data.id + '" onclick="changeGoing(' + data.id + ')"><div id="goingImage' + data.id + '"><img = src="/images/notgoing.png"   style="width: 80px"></div></a><input type="hidden" name="" value="not going" id="goingStatus"></b></center></div></div></div></div></div></div>');
                            $("#checkUpdate").val(0);
                            $("#datetimeforevent").modal('hide');
                            $("#participentlist").modal('show');
                        }
                    });
                }

            }
        });

        $("#backdateselect").click(function () {
            //alert(startDate);

            $("#participentlist").modal('hide');
            $("#datetimeforevent").modal('show');

        });
        $("#submitpasticipentlist").click(function () {
            $("#participentlist").modal('hide');
            $("#eventdone").modal('show');
        });
        $("#addMore").click(function () {
            $("#eventStartDate").val('');
            $("#eventEndDate").val('');
            $("#participentlist").modal('hide');
            $("#datetimeforevent").modal('show');

        });
        //event published (in tempEventId is reference id for event start and end date time)
        $("#eventpublish").click(function () {
            eventStatus = this.id;
            eventData = new FormData();
            eventData.append('_token', $('input[name=_token]').val());
            eventData.append('uploadBanner', $("#eventuploadphoto").get(0).files[0]);
            eventData.append('eventfor', $("#eventfor").val());
            eventData.append('post_category', $("#post_category").val());
            eventData.append('tempEventId', $("#tempEventId").val());
            eventData.append('event_description', tinymce.get("event_description").getContent());
            eventData.append('address', $("#searchInput").val());
            eventData.append('lat', $("#lat").val());
            eventData.append('lng', $("#lng").val());
            eventData.append('eventJoinType', $("input[name='eventJoinType']:checked").val());
            eventData.append('referralPer', $("#referralPer").val());
            eventData.append('eventFee', $("#eventFee").val());
            eventData.append('eventStatus', eventStatus);
            eventData.append('eventApproval', $("input[name='eventApproval']:checked").val());
            eventData.append('eventTicket', $("#eventTicket").val());
            var ajaxDisplay = document.getElementById("main_result");
            document.getElementById("main_result").style.display = "block";
            $("#main_result").empty().html('<img src="images/loading.gif" style="height: 100px;"/>');
            $.ajax({
                type: 'post',
                url: '{{route('event.insert')}}',
                processData: false,
                contentType: false,
                data: eventData,
                success: function (data) {
                    document.getElementById("main_result").style.display = "none";
                    $("#successEventId").val(data['eventId']);
                    $("#successUserId").val(data['userId']);
                    $("#participentlist").modal('hide');
                    $("#eventdone").modal('show');
                }
            });
        });
        $("#submitsaveindraft").click(function () {
            eventStatus = this.id;
            eventData = new FormData();
            eventData.append('_token', $('input[name=_token]').val());
            eventData.append('uploadBanner', $("#eventuploadphoto").get(0).files[0]);
            eventData.append('eventfor', $("#eventfor").val());
            eventData.append('post_category', $("#post_category").val());
            eventData.append('tempEventId', $("#tempEventId").val());
            eventData.append('event_description', tinymce.get("event_description").getContent());
            eventData.append('address', $("#searchInput").val());
            eventData.append('eventJoinType', $("input[name='eventJoinType']:checked").val());
            eventData.append('referralPer', $("#referralPer").val());
            eventData.append('eventFee', $("#eventFee").val());
            eventData.append('eventStatus', eventStatus);
            eventData.append('eventApproval', $("input[name='eventApproval']:checked").val());
            var ajaxDisplay = document.getElementById("main_result");
            document.getElementById("main_result").style.display = "block";
            $("#main_result").empty().html('<img src="images/loading.gif" style="height: 100px;"/>');
            $.ajax({
                type: 'post',
                url: '{{route('event.insert')}}',
                processData: false,
                contentType: false,
                data: eventData,
                success: function (data) {
                    document.getElementById("main_result").style.display = "none";
                    $("#successEventId").val(data['eventId']);
                    $("#successUserId").val(data['userId']);
                    $("#participentlist").modal('hide');
                    $("#eventdone").modal('show');
                    //         	swal({
                    //     title: "Successfully!",
                    //     text: "Event Save Successfully",
                    //     type: "success"
                    // })
                }
            });

        });
        $("#submitpostmore").click(function () {
            if (option == 1) {
                $("#postbuydone").modal('hide');
                $("#newpostmodel").modal('show');
            }else if(option == 2){
                $("#postbuydone").modal('hide');
                $("#newpostmodel").modal('show');
            } else {
                $("#eventdone").modal('hide');
                $("#newpostmodel").modal('show');
            }

        });
        $("#eventpreview").click(function () {
            window.location = "/home";
        });
        $("#backeditdatetimeevent").click(function () {
            $("#editEventDateTime").modal('hide');
            $("#eventEditDateTimeList").modal('show');
        });
        $("#submiteditdatetimeevent").click(function () {
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth() + 1;
            var yyyy = today.getFullYear();
            if (dd < 10) {
                dd = '0' + dd;
            }
            if (mm < 10) {
                mm = '0' + mm;
            }
            var today = mm + '/' + dd + '/' + yyyy;
            var editcheckUpdate = $("#editcheckUpdate").val();
            //alert(editcheckUpdate);
            var startDate = $("#editeventStartDate").val();
            var endDate = $("#editeventEndDate").val()
            if (startDate == '' || startDate == null) {
                alert('please select start date');
            } else if (endDate == '' || endDate == null) {
                alert('please select end date');
            } else if (today > startDate) {
                alert('please select valid start date');
            } else if (startDate > endDate) {
                alert('please select start date lower the end date')
            } else {
                if (editcheckUpdate == 0) {
                    if (tempEventId == 0) {
                        tempEventId = random(1000, 999999);
                    }
                    var ajaxDisplay = document.getElementById("main_result");
                    document.getElementById("main_result").style.display = "block";
                    $("#main_result").empty().html('<img src="images/loading.gif" style="height: 100px;"/>');
                    $.ajax({
                        type: 'post',
                        url: '{{route('events.datetimeInsert')}}',
                        data: {
                            '_token': $('input[name=_token]').val(),
                            'tempEventId': tempEventId,
                            'eventStartDate': $("#editeventStartDate").val(),
                            'eventEndDate': $('#editeventEndDate').val(),
                            'start_house': $("#editstart_house").val(),
                            'start_minit': $('#editstart_minit').val(),
                            'startTimeType': $("#editstartTimeType").val(),
                            'end_house': $('#editend_house').val(),
                            'end_minit': $("#editend_minit").val(),
                            'end_time_type': $('#editend_time_type').val()
                        },
                        success: function (data) {
                            document.getElementById("main_result").style.display = "none";
                            $('#table1').append('<div class="raw' + data.id + '" style="background : lightblue"><br/><div class="col-sm-6 col-md-12"><div class="row"><div class="col-sm-12 col-md-5"><div class="input-group date"><input type="hidden" id="tempEventId" value="' + tempEventId + '" ><input type="text" class="form-control" name="" value="' + data.start_date + '" id="eventStartDate"><span class="cop-input-group-addon"><i class="fa fa-calendar"></i></span></div></div><div class="col-sm-12 col-md-5"><div class="input-group date"><input type="text" name="" value="' + data.end_date + '" class="form-control" id="eventEndDate"><span class="cop-input-group-addon"><i class="fa fa-calendar"></i></span></div></div><div class="col-sm-12 col-md-2"><a href="#" style="color: blue" onclick="chengeEditSelectedDateTime(' + data.id + ')">Edit</a> <br/><a href="#" style="color: red" onclick="deleteEditSelectedDateTime(' + data.id + ')">Delete</a></div><br/><div class="col-sm-12 col-md-6"><br/><div class="row"><div class="col-md-2"><i class="fa fa-clock-o" style="width: 10px;padding: 10px" aria-hidden="true"></i></div><div class="col-md-3"><select style="padding: 5px" id="start_house"><option value="' + data.start_hours + '">' + data.start_hours + '</option></select></div><div class="col-md-3"><select style="padding: 5px" id="start_minit"><option value="' + data.start_minit + '">' + data.start_minit + '</option></select></div><div class="col-md-3"><select style="padding: 5px" id="startTimeType"><option>' + data.start_type + '</option></select></div><div class="col-md-3"></div></div></div><div class="col-sm-12 col-md-6"><br/><div class="row"><div class="col-md-2"><i class="fa fa-clock-o" style="width: 10px;padding: 10px" aria-hidden="true"></i></div><div class="col-md-3"><select style="padding: 5px" id="end_house"><option value="' + data.end_hours + '">' + data.end_hours + '</option></select></div><div class="col-md-3"><select style="padding: 5px" id="end_minit"><option value="' + data.end_minit + '">' + data.end_minit + '</option></select></div><div class="col-md-3"><select style="padding: 5px" id="end_time_type"><option>' + data.end_type + '</option></select></div><div class="col-md-3"></div></div></div><div class="col-sm-12 col-md-6"><div class="row"><div class="col-md-6"><span style="color: blue">0 going </span></div><div class="col-md-6"><span style="color: blue">0 waiting </span></div></div></div><div class="col-sm-12 col-md-6"><div class="row"><div class="col-md-6"></div><div class="col-md-6" ><center><b style="font-size: 20px;color: blue" > <a href="#" id="' + data.id + '" onclick="changeGoing(' + data.id + ')"><div id="goingImage' + data.id + '"><img = src="/images/notgoing.png"   style="width: 80px"></div></a><input type="hidden" name="" value="not going" id="goingStatus"></b></center></div></div></div></div></div></div>');

                            $("#editEventDateTime").modal('hide');
                            $("#eventEditDateTimeList").modal('show');
                        }
                    });
                } else {
                    var ajaxDisplay = document.getElementById("main_result");
                    document.getElementById("main_result").style.display = "block";
                    $("#main_result").empty().html('<img src="images/loading.gif" style="height: 100px;"/>');
                    $.ajax({
                        type: 'post',
                        url: '/events/updateSelectedDateTime',
                        data: {
                            '_token': $('input[name=_token]').val(),
                            'updateId': editcheckUpdate,
                            'eventStartDate': $("#editeventStartDate").val(),
                            'eventEndDate': $('#editeventEndDate').val(),
                            'start_house': $("#editstart_house").val(),
                            'start_minit': $('#editstart_minit').val(),
                            'startTimeType': $("#editstartTimeType").val(),
                            'end_house': $('#editend_house').val(),
                            'end_minit': $("#editend_minit").val(),
                            'end_time_type': $('#editend_time_type').val()
                        },
                        success: function (data) {
                            // swal("Successfully", "Edit Event Fee Successfully", "success");
                            //$('.error').addClass('hidden');
                            document.getElementById("main_result").style.display = "none";
                            $('.raw' + data.id).replaceWith('<div class="raw' + data.id + '" style="background : lightblue"><br/><div class="col-sm-6 col-md-12"><div class="row"><div class="col-sm-12 col-md-5"><div class="input-group date"><input type="hidden" id="tempEventId" value="' + tempEventId + '" ><input type="text" class="form-control" name="" value="' + data.start_date + '" id="eventStartDate"><span class="cop-input-group-addon"><i class="fa fa-calendar"></i></span></div></div><div class="col-sm-12 col-md-5"><div class="input-group date"><input type="text" name="" value="' + data.end_date + '" class="form-control" id="eventEndDate"><span class="cop-input-group-addon"><i class="fa fa-calendar"></i></span></div></div><div class="col-sm-12 col-md-2"><a href="#" style="color: blue" onclick="chengeEditSelectedDateTime(' + data.id + ')">Edit</a> <br/><a href="#" style="color: red" onclick="deleteEditSelectedDateTime(' + data.id + ')">Delete</a></div><br/><div class="col-sm-12 col-md-6"><br/><div class="row"><div class="col-md-2"><i class="fa fa-clock-o" style="width: 10px;padding: 10px" aria-hidden="true"></i></div><div class="col-md-3"><select style="padding: 5px" id="start_house"><option value="' + data.start_hours + '">' + data.start_hours + '</option></select></div><div class="col-md-3"><select style="padding: 5px" id="start_minit"><option value="' + data.start_minit + '">' + data.start_minit + '</option></select></div><div class="col-md-3"><select style="padding: 5px" id="startTimeType"><option>' + data.start_type + '</option></select></div><div class="col-md-3"></div></div></div><div class="col-sm-12 col-md-6"><br/><div class="row"><div class="col-md-2"><i class="fa fa-clock-o" style="width: 10px;padding: 10px" aria-hidden="true"></i></div><div class="col-md-3"><select style="padding: 5px" id="end_house"><option value="' + data.end_hours + '">' + data.end_hours + '</option></select></div><div class="col-md-3"><select style="padding: 5px" id="end_minit"><option value="' + data.end_minit + '">' + data.end_minit + '</option></select></div><div class="col-md-3"><select style="padding: 5px" id="end_time_type"><option>' + data.end_type + '</option></select></div><div class="col-md-3"></div></div></div><div class="col-sm-12 col-md-6"><div class="row"><div class="col-md-6"><span style="color: blue">0 going </span></div><div class="col-md-6"><span style="color: blue">0 waiting </span></div></div></div><div class="col-sm-12 col-md-6"><div class="row"><div class="col-md-6"></div><div class="col-md-6" ><center><b style="font-size: 20px;color: blue" > <a href="#" id="' + data.id + '" onclick="changeGoing(' + data.id + ')"><div id="goingImage' + data.id + '"><img = src="/images/notgoing.png"   style="width: 80px"></div></a><input type="hidden" name="" value="not going" id="goingStatus"></b></center></div></div></div></div></div></div>');
                            $("#editcheckUpdate").val(0);
                            $("#editEventDateTime").modal('hide');
                            $("#eventEditDateTimeList").modal('show');
                        }
                    });
                }

            }
        });
        //Hide event details model
        $("#hideEventDetails").click(function () {
            //alert('Done');
            $("#eventAllDetails").modal('hide');
        });
        $("#finalpriviewevent").click(function () {
            var successEventId = $("#successEventId").val();
            var successUserId = $("#successUserId").val();
            viewEventDetails(successEventId, successUserId);
        });
        $("#backtoalldetailswitinglist").click(function () {
            $("#waitingparticipentlist").modal('hide');
            $("#eventAllDetails").modal('show');
        });
        $("#backtoalldetailsgoinglist").click(function () {
            $("#goingparticipentlist").modal('hide');
            $("#eventAllDetails").modal('show');
        });
        $("#backtoalldetailsbuyorderlist").click(function () {
            $("#buyOrderParticipantList").modal('hide');
            $("#buySellDetails").modal('show');
        });
        $("#backtoalldetailsbuybidlist").click(function () {
            $("#buyBidParticipantList").modal('hide');
            $("#buySellDetails").modal('show');
        });
    });

    //referral change function
    function ReferralOnchange() {
        var refPer1 = document.getElementById("referralPer").value;
        refPer1 = refPer1 * 1;
        fValue = refPer1 / 2;
        $("#refPer").html(fValue);
        $("#bidWin").html(fValue);
    }

    function ReferralMouseUp() {
        var refPer1 = document.getElementById("referralPer").value;
        refPer1 = refPer1 * 1;
        fValue = refPer1 / 2;
        $("#refPer").html(fValue);
        $("#bidWin").html(fValue);
    }

    //get random number
    function random(min, max) {
        return Math.floor(Math.random() * (max - min + 1)) + min;
    }

    //event edit function
    function eventEdit(id, userId) {
        $("#mapSearchCheck").html('<input id="searchInput" class="input-controls" type="text" placeholder="Enter a location">');
        $("#checkBackbutton").val(0);
        document.getElementById("checkVisiblebutton").style.display = "block";
        $.ajax({
            type: 'post',
            url: '/events/eventModelEdit',
            data: {'id': id, 'userId': userId},
            success: function (data) {
                //alert(data['event_fee_type']);
                $("#editStatus").val(1);
                $("#userId").val(data['user_id']);
                $("#eventId").val(id);
                $("#eventfor").val(data['event_title']);
                if (data['event_modal_image'] != null && data['event_modal_image'] != '/uploads/event/') {
                    document.getElementById("uploadBanner").src = data['event_modal_image'];
                }
                tinyMCE.get('event_description').setContent(data['event_description']);
                $("#searchInput").val(data['event_address']);
                $("#lat").val(data['latitude']);
                $("#lng").val(data['longitude']);
                initialize();
                if (data['event_fee_type'] == 'Free') {
                    //$("#freeJoin:checked").val();
                    $(':radio[name=eventJoinType][value="Free"]').prop('checked', true);
                } else {
                    //$("#notFreeJoin:checked").val();
                    $(':radio[name=eventJoinType][value="Not Free"]').prop('checked', true);
                    $("#eventFee").val(data['event_fee']);
                    document.getElementById("joinType").style.display = "block";
                }
                $("#referralPer").val(data['event_referral_commission']);
                ReferralOnchange();
                if (data['need_approval'] == 'Yes') {
                    $(':radio[name=eventApproval][value="Yes"]').prop('checked', true);
                } else {
                    $(':radio[name=eventApproval][value="No"]').prop('checked', true);
                }
                $("#eventAllDetails").modal('hide');
                $("#iwanttopostevent").modal('show');

            }
        });
    }

    //event saved list
    function savedPost(eventId, userId) {
        $.ajax({
            type: 'post',
            url: '/events/eventModelsaved',
            data: {'eventId': eventId, 'userId': userId},
            success: function (data1) {
                if (data1 == "exist") {
                    //alert('You are already saved event');
                    if (confirm('are you sure you want to unsaved post')) {
                        $.ajax({
                            type: 'post',
                            url: '/events/eventModelUnsaved',
                            data: {'eventId': eventId, 'userId': userId},
                            success: function (data1) {
                                if (data1 == "success") {
                                    document.getElementById("savedImage" + eventId).src = '/images/rating_blank.png';
                                    document.getElementById("saveddetailsImage" + eventId).src = '/images/rating_blank.png';
                                }
                            }
                        });
                    }
                } else {
                    document.getElementById("savedImage" + eventId).src = '/images/rating.png';
                    document.getElementById("saveddetailsImage" + eventId).src = '/images/rating.png';
                }
            }
        });
    }

    //event saved list
    function unSavedPost(eventId, userId) {
        if (confirm('are you sure you want to unsaved post')) {
            $.ajax({
                type: 'post',
                url: '/events/eventModelUnsaved',
                data: {'eventId': eventId, 'userId': userId},
                success: function (data1) {
                    if (data1 == "success") {
                        //alert('Post Unsaved Successfully');
                        window.location = "/saved_posts";
                    }
                }
            });
        }
    }


    //post saved list
    function saveBuySell(post_id, user_id, post_type) {
        $.ajax({
            type: 'post',
            url: '{{route('post.save')}}',
            data: {post_id, user_id, post_type, _token: $('input[name=_token]').val()},
            success: function (res) {
                if (res == "exist") {
                    //alert('You are already saved event');
                    if (confirm('are you sure you want to unsaved post')) {
                        $.ajax({
                            type: 'post',
                            url: '{{route('post.unsave')}}',
                            data: {post_id, user_id, post_type, _token: $('input[name=_token]').val()},
                            success: function (data1) {
                                if (data1 == "success") {
                                    document.getElementById("savedBuy" + post_id).src = '/images/rating_blank.png';
                                    document.getElementById("savedBuyDetails" + post_id).src = '/images/rating_blank.png';
                                }
                            }
                        });
                    }
                } else {
                    document.getElementById("savedBuy" + post_id).src = '/images/rating.png';
                    document.getElementById("savedBuyDetails" + post_id).src = '/images/rating.png';
                }
            }
        });
    }


    //delete buy
    function deleteBuy(buyId) {
        //alert(eventId);
        if (confirm('Are you sure you want to delete this post !')) {
            $.ajax({
                type: 'post',
                url: '{{route('post.buy.delete')}}',
                data: {buyId: buyId, _token: $('input[name=_token]').val()},
                success: function (data) {
                    console.log(data);
                    setTimeout(function () {
                        swal({
                            title: "Successfully",
                            text: "Buy Delete Successfully",
                            type: "success"
                        }, function () {
                            window.location = "/home";
                        });
                    }, 1000);

                    Swal.fire(
                        'Successfully',
                        'Buy Delete Success',
                        'success'
                    ).then((data) => {
                        window.location = "/home";
                    });
                }
            });
        }

    }
    //sell delete
    function deleteSell(sellId) {
        //alert(eventId);
        if (confirm('Are you sure you want to delete this post !')) {
            $.ajax({
                type: 'post',
                url: '{{route('post.sell.delete')}}',
                data: {sellId: sellId, _token: $('input[name=_token]').val()},
                success: function (data) {
                    console.log(data);
                    setTimeout(function () {
                        swal({
                            title: "Successfully",
                            text: "Sell Delete Successfully",
                            type: "success"
                        }, function () {
                            window.location = "/home";
                        });
                    }, 1000);

                    Swal.fire(
                        'Successfully',
                        'Sell Delete Success',
                        'success'
                    ).then((data) => {
                        window.location = "/home";
                    });
                }
            });
        }

    }

    //buy edit function
    function buyEdit(id, userId) {
        option = 1;
        $('#buySellDetails').modal('hide');
        if ($("#searchInput").length == 0) {
            $("#mapSearchCheck").html('<input id="searchInput" class="input-controls" type="text" placeholder="Enter a location">');
        }
        $("#checkBackbutton").val(1);
        document.getElementById("checkVisiblebutton").style.display = "block";

        $('#eventlocation h5').html(`<span style="top: 20px !important;" class="overlay_badge_buy">Buy</span> <span style="padding-left: 60px;">Post location </span>

                <a href="#" id="backeventlocation"><i class="fa fa-arrow-circle-o-left" style="font-size:48px;color:red;float: right"></i></a>
            `);

        $('#referralcomission h5').html(`<span style="top: 20px !important;" class="overlay_badge_buy">Buy</span> <span style="padding-left: 60px;">Post location </span>

                <a href="#" id="backeventlocation"><i class="fa fa-arrow-circle-o-left" style="font-size:48px;color:red;float: right"></i></a>
            `);

        $.ajax({
            type: 'get',
            url: '{{route('post.buy.info')}}',
            data: {id, userId},
            success: function (res) {
                if (res.status == 'success') {
                    data = res.data;
                    //alert(data['event_fee_type']);
                    $("#userId").val(res.data.user_id);
                    $("#buyId").val(res.data.id);

                    if (data.buyer_featured_image != null && data.buyer_featured_image != '') {
                        document.getElementById("podtimage").src = "/uploads/buyer/" + data.buyer_featured_image;
                    } else {
                        document.getElementById("podtimage").src = "/images/photo.png";
                    }

                    $("#searchInput").val(data.buyer_location);
                    $("#lat").val(data.latitude);
                    $("#lng").val(data.longitude);
                    initialize();
                    $("#referralPer").val(data.buyer_commission_percentage);
                    ReferralOnchange();
                    $("input[name=iwantbuy][value=" + data.buyer_category + "]").attr('checked', 'checked').click();
                    if (data.buyer_category == 1) {
                        $("input[name=buy_service][value=" + data.buyer_category_option + "]").attr('checked', 'checked').click();
                    } else {
                        $("input[name=buy_product][value=" + data.buyer_category_option + "]").attr('checked', 'checked').click();
                    }


                    $("[name=bidrate]").val(data.rate);
                    $("[name=serviceoptionbuy]").val(data.service_option);
                    $("[name=bidhours]").val(data.hour);
                    $("[name=buysubject]").val(data.buyer_pro_title);
                    $("[name=buydetails]").val(data.buyer_pro_description);
                    $("#postAllDetails").modal('hide');
                    $("#iwanttobuy").modal('show');

                }
            }
        });
    }

    //delete event
    function deleteEvent(eventId) {
        //alert(eventId);
        if (confirm('Are you sure you want to delete this event !')) {
            $.ajax({
                type: 'post',
                url: '/events/eventDelete',
                data: {'eventId': eventId},
                success: function (data) {
                    setTimeout(function () {
                        swal({
                            title: "Successfully",
                            text: "Event Delete Successfully",
                            type: "success"
                        }, function () {
                            window.location = "/home";
                        });
                    }, 1000);

                    Swal.fire(
                        'Successfully',
                        'Event Delete Success',
                        'success'
                    ).then((data) => {
                        window.location = "/home";
                    });
                }
            });
        }

    }

    //Event More details function
    $('.ownRating').rating({
        displayOnly: true,
        size: 'sm',
        showCaption: false

    });

    //event saved list
    function viewEventDetails(eventId, userId) {

        $.ajax({
            type: 'post',
            url: '/events/eventModelEdit',
            data: {'id': eventId, 'userId': userId},
            success: function (data) {
                //alert(data['event_fee_type']);
                var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                var d = new Date(data['event_date']);
                var dayName = days[d.getDay()];
                var finaDate = d.toDateString();
                //var d=new Date("October 13, 1975 11:13:00");
                //var finalDate = d.getTime() + " milliseconds since 1970/01/01";
                $("#eventDetailsTitle").html("" + data['event_title'] + "<br/><span style='color: black;font-size: 18px;background: lightgray;padding: 3px'> " + finaDate + "</span>&nbsp;<span style='color: black;font-size: 15px;background: lightgray;padding: 3px'> 8:00 AM</span>");
                // $("#eventfor").val(data['event_title']);
                if (data['event_modal_image'] != null && data['event_modal_image'] != '/uploads/event/') {
                    document.getElementById("eventDetailsImage").src = data['event_modal_image'];
                } else {
                    document.getElementById("eventDetailsImage").src = '/images/image_not_found.jpg';
                }

                $('#eventlocation h5').html(`<img src="/images/eventLogo.png" style="height: 50px" id="" class="img-thumbnail">Event location

                <a href="#" id="backeventlocation"><i class="fa fa-arrow-circle-o-left" style="font-size:48px;color:red;float: right"></i></a>

            `);

                if (data['userGoingStatus'] == 'pending') {
                    document.getElementById("goingStatusImage").src = '/images/pending.png';
                } else if (data['userGoingStatus'] == 'rejected') {
                    document.getElementById("goingStatusImage").src = '/images/rejected.jpg';
                } else if (data['userGoingStatus'] == 'approved') {
                    document.getElementById("goingStatusImage").src = '/images/going.png';
                } else {
                    if (data['need_approval'] == 'Yes') {
                        var needApproval = 1;
                    } else {
                        var needApproval = 0;
                    }
                    if (data['event_fee_type'] == 'Not Free') {
                        $("#allGoingChangeDesign").html('<img = src="/images/notgoing.png"  onclick="eventPay(' + data['event_fee'] + ',' + data['user_id'] + ',' + eventId + ',' + data['modelId'] + ',' + needApproval + ')" style="width: 80px;height: 30px"/>');
                    } else {
                        $("#allGoingChangeDesign").html('<img = src="/images/notgoing.png"  onclick="freeJoinEvent(' + data['user_id'] + ',' + eventId + ',' + data['modelId'] + ',' + needApproval + ')" style="width: 80px;height: 30px"/>');
                    }

                }
                //alert(data['user_id']);

                var url = "'" + data['url'] + "'";
                var title = "'" + data['event_title'] + "'";
                var follow_user_id = data['user_id'];
                var loginId = <?php if (!empty(Auth::user()->id)) {
                    echo Auth::user()->id;
                } ?>
                    //alert(loginId);
                    // tinyMCE.get('event_description').setContent(data['event_description']);


                    //$("#checkVisiblebutton").html();
                    $("#checkBackbutton").val(99);
                document.getElementById("checkVisiblebutton").style.display = "none";
                $("#eventDetailsAddress").html(data['event_address']);
                $("#userProfile").html(data['user_location']);
                $("#userProfileImage").html('<a href="userprofile/' + data['user_id'] + '"><img = src="' + data['user_image'] + '"  id="profilePhoto" style="width: 50px;height: 50px"/></a>');
                //document.getElementById("profilePhoto").src = data['user_image'];
                if (data['checkSaved'] == 1) {
                    $("#savedItem").html(' <a href="#" onclick="savedPost(' + eventId + ',' + loginId + ')" ><img src="/images/rating.png" style="height: 30px;" id="saveddetailsImage' + eventId + '"  class="img-thumbnail"></a>');
                } else {
                    $("#savedItem").html(' <a href="#" onclick="savedPost(' + eventId + ',' + loginId + ')" ><img src="/images/rating_blank.png" style="height: 30px;" id="saveddetailsImage' + eventId + '"  class="img-thumbnail"></a>');
                }

                $("#going").html('<a href="#" onclick="goingParticipent(' + data['modelId'] + ',' + data['going'] + ')" style="text-decoration: none">' + data['going'] + ' going</a>');
                $("#waiting").html('<a href="#" onclick="waitingParticipent(' + data['modelId'] + ',' + data['waiting'] + ')" style="text-decoration: none">' + data['waiting'] + ' waiting</a>');
                if (userId == follow_user_id) {
                    $("#eventMultDate").html("<a href='#' onclick='showEventDateTime(" + eventId + "," + userId + ");' ><i class='fa fa-calendar fa-2x' style='font-size:48px;color:red;float: right'></i></a>");
                } else {
                    $("#eventMultDate").html("<a href='#' onclick='showEventDateTime(" + eventId + "," + userId + ");'><i class='fa fa-calendar fa-2x' style='font-size:48px;color:red;float: right'></i></a>");
                }

                $("#eventDetailsDescription").html(data['event_description']);
                $("#mapAddress").html('<a href="#" onclick="eventAddtress(' + eventId + ',' + data['latitude'] + ',' + data['longitude'] + ')"><i class="fa fa-map-marker fa-2x" aria-hidden="true" style="color: red;"></i></a>');
                if (loginId != '' && loginId != '') {
                    $("#followingDesignStyle").html("@section('custom-styles')@if(isFollowing("+loginId+", "+data['user_id']+"))<style>.following-dropdown {display: block;}.follow-btn {display: none;}</style>@else<style>.following-dropdown {display: none; }.follow-btn {display: 	block;}</style>@endif @endsection");
                }

                $("#followingValue").html("<div class='dropdown following-dropdown'><button class='btn btn-light dropdown-toggle following-button' type='button' id='dropdownMenu2' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i class='fa fa-check' aria-hidden='true'></i> Following </button> <div class='dropdown-menu' aria-labelledby='dropdownMenu2'> <button class='dropdown-item' type='button' onclick='followUser(" + follow_user_id + " , 0)'>Unfollow</button></div></div> <div class='follow-btn'><a href='javascript:void(0)' onclick='followUser(" + data['user_id'] + ", 1)'' class='follow-link'><i class='fa fa-rss' aria-hidden='true'></i> Follow </a></div>");

                if (userId == loginId) {
                    $("#editUserEvent").html("<button class='continue' style='width: 100%;background: lightblue;border-color: blue' onclick='eventEdit(" + eventId + "," + userId + ")' type='button'>Edit</button><br><br><button class='continue' style='background: red' id='#' type='button' onclick='deleteEvent(" + eventId + ")' >Delete</button><br><br><button class='cancel' onclick='cancelAllDetails()' id='hideEventDetails'  type='button'>CANCEL</button>");
                } else {
                    $("#editUserEvent").html("");
                }


                $("#eventdone").modal('hide');
                $("#eventAllDetails").modal('show');


            }
        });

    }

    Date.prototype.addHours = function (h) {
        this.setTime(this.getTime() + (h * 60 * 60 * 1000));
        return this;
    };

    function startCoundownTimer(datetime, el) {
        // console.log(datetime,new Date());
        el = el ? el : null;
        var countDownDate = new Date(datetime.toLocaleString('en-US'));
        countDownDate = countDownDate.getTime();
        var x = setInterval(function () {

            // Get today's date and time
            var now = new Date(new Date().toLocaleString('en-US')).getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Display the result in the element
            if (el) {
                var text = '';
                if (days) text += days + "d ";
                if (hours) text += hours + "h ";
                if (minutes) text += minutes + "m ";
                if (seconds) text += seconds + "s ";
                el.text(text + " left");
            }

            // If the count down is finished, write some text
            if (distance < 0) {
                clearInterval(x);
                if (el) {
                    el.text("Expired");
                }
            }
        }, 1000);
    }

    $(document).ready(function () {
        $('.countDownTimer').each(function (index, value) {
            var date = new Date($(this).attr('data-time'));
            var userTimezoneOffset = date.getTimezoneOffset() * 60000;
            var d = new Date(date.getTime() - userTimezoneOffset);
            // var newDate = d.addHours(data.hour);
            startCoundownTimer(d, $(this));
        })
    });

    //buyer post details
    function showPostDetails(postid, userid, e) {
        if (!userid) {
            window.location.href = '/login';
            return;
        }
        var data = JSON.parse(e.getAttribute('data-all'));
        var orders = e.getAttribute('data-orders');
        var avatar = e.getAttribute('data-avatar');
        var name = e.getAttribute('data-user-name');
        var bids = e.getAttribute('data-bids');
        var isSaved = e.getAttribute('data-bidsdata-isSaved');
        option = 1;

        if ($("#searchInput").length == 0) {
            $("#mapSearchCheck").html('<input id="searchInput" class="input-controls" type="text" placeholder="Enter a location">');
        }

        document.getElementById("checkVisiblebutton").style.display = "block";

        $('#eventlocation h5').html(`<span style="top: 20px !important;" class="overlay_badge_buy">Buy</span> <span style="padding-left: 60px;">Post location </span>`);

        $('#referralcomission h5').html(`<span style="top: 20px !important;" class="overlay_badge_buy">Buy</span> <span style="padding-left: 60px;">Post location </span>`);
        var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

        var date = new Date(data.created_at);
        var userTimezoneOffset = date.getTimezoneOffset() * 60000;
        var d = new Date(date.getTime() - userTimezoneOffset);
        var newDate = d.addHours(data.hour);
        var dayName = days[newDate.getDay()];
        var time = newDate.toLocaleTimeString(navigator.language, {
            hour: '2-digit',
            minute: '2-digit'
        });
        var finaDate = newDate.toDateString();

        $("#buySellDetailsTitle").html("" + data.buyer_pro_title + "<br/>" + dayName + "<span style='color: black;font-size: 18px;background: lightgray;padding: 3px'> " + finaDate + "</span>&nbsp;<span style='color: black;font-size: 15px;background: lightgray;padding: 3px'> " + time + "</span></br><span id='timeText'></span>");
        startCoundownTimer(newDate, $('#timeText'));
        $("#checkBackbutton").val('11');
        $('#buySellLogo').html('<span class="overlay_badge_buy">Buy</span>');
        $('#buySellDetailsImage').attr('src', data.buyer_featured_image ? "/uploads/buyer/" + data.buyer_featured_image : "/images/image_not_found.jpg");
        $('#buySellDetailsAddress').text(data.buyer_location);
        $('#buySellDetailsDescription').text(data.buyer_pro_description);
        if (userid == data.user_id) {
            $('#buySellDetailsOrders').html("<a href='#' onclick='buySellOrder(" + data.id + "," + orders + ")'>" + orders + " Orders</a>");
            $('#buySellDetailsBids').html("<a href='#' onclick='buySellBids(" + data.id + "," + bids + ")'>" + bids + " Bids</a>");
        } else {
            $('#buySellDetailsOrders').html(orders + " Orders");
            $('#buySellDetailsBids').html(bids + " Bids");
        }
        $('#buySellDetailsUserProfile').text(name);
        $('#buySellDetailsUserProfileImage').html("<a href='/userprofile/" + data.user_id + "'><img src=\"/uploads/avatars/" + avatar + "\" id=\"buySellDetailsProfilePhoto\" style=\"width: 50px;height: 50px\"></a>");
        $("#buySellDetailsMapAddress").html('<a href="#" onclick="eventAddtress(' + postid + ',' + data.latitude + ',' + data.longitude + ')"><i class="fa fa-map-marker fa-2x" aria-hidden="true" style="color: red;"></i></a>');

        if (isSaved == 'true') {
            $("#buySellDetailsSavedItem").html(` <a href="#" onclick="saveBuySell(${data.id},${userid},'buy')" ><img src="/images/rating.png" style="height: 30px;" id="savedBuyDetails${postid}"  class="img-thumbnail"></a>`);
        } else {
            $("#buySellDetailsSavedItem").html(` <a href="#" onclick="saveBuySell(${data.id},${userid},'buy')" ><img src="/images/rating_blank.png" style="height: 30px;" id="savedBuyDetails${postid}"  class="img-thumbnail"></a>`);
        }
        $('#buySellDetails').modal('show');
        $("#buySellFollowingValue").html("<div class='dropdown following-dropdown'><button class='btn btn-light dropdown-toggle following-button' type='button' id='dropdownMenu2' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i class='fa fa-check' aria-hidden='true'></i> Following </button> <div class='dropdown-menu' aria-labelledby='dropdownMenu2'> <button class='dropdown-item' type='button' onclick='followUser(" + data.user_id + " , 0)'>Unfollow</button></div></div> <div class='follow-btn'><a href='javascript:void(0)' onclick='followUser(" + data.user_id + ", 1)'' class='follow-link'><i class='fa fa-rss' aria-hidden='true'></i> Follow </a></div>");

        var html = '';
        if (userid == data.user_id) {
            html = `<button class="continue" style="width: 100%;background: lightblue;border-color: blue" onclick="buyEdit(${data.id},${userid})" type="button">Edit</button><br><br>
                   <button class="continue" style="background: red" type="button" onclick="deleteBuy(${data.id})">Delete</button><br><br>
<button class="cancel" onclick="cancelAllDetails()" type="button">CANCEL</button>`;
        }


        $('#eidtbuySellDetails').html(html);
    }

    //cancel all details
    function cancelAllDetails() {
        $("#eventAllDetails").modal('hide');
        $("#buySellDetails").modal('hide');
    }

    //event saved list
    function editeventpublish(eventId, eventStatus) {
        var editStatusFinal = $("#editStatus").val();
        if (editStatusFinal == 1) {
            eventData = new FormData();
            eventData.append('_token', $('input[name=_token]').val());
            eventData.append('uploadBanner', $("#eventuploadphoto").get(0).files[0]);
            eventData.append('eventfor', $("#eventfor").val());
            eventData.append('tempEventId', $("#tempEventId").val());
            eventData.append('event_description', tinymce.get("event_description").getContent());
            eventData.append('address', $("#searchInput").val());
            eventData.append('lat', $("#lat").val());
            eventData.append('lng', $("#lng").val());
            eventData.append('eventJoinType', $("input[name='eventJoinType']:checked").val());
            eventData.append('referralPer', $("#referralPer").val());
            eventData.append('eventFee', $("#eventFee").val());
            eventData.append('eventStatus', eventStatus);
            eventData.append('eventId', eventId);
            eventData.append('eventApproval', $("input[name='eventApproval']:checked").val());
            $.ajax({
                type: 'post',
                url: '/events/editEventDateTime',
                processData: false,
                contentType: false,
                data: eventData,
                success: function (data) {
                    $("#eventEditDateTimeList").modal('hide');

                    window.location = "/home";

                }
            });
        } else {
            var editCheck = 'onlyDateTime';
            var tempId = document.getElementById('tempEventId').value
            $.ajax({
                type: 'post',
                url: '/events/editEventDateTime',
                data: {id: eventId, 'eventId': tempId, 'editCheck': editCheck},
                success: function (data) {
                    //alert(data);
                    $("#eventEditDateTimeList").modal('hide');
                    $("#eventdone").modal('show');
                }
            });
        }

    }

    //buy save data
    function saveBuyData() {
        var reff = $('#referralPer').val();
        var id = $('#buyId').val();
        var eventData = new FormData();
        if (id) {
            eventData.append('buy_id', id);
        }
        eventData.append('_token', $('input[name=_token]').val());
        eventData.append('postphoto', $("#takeaphotoforpostfile").get(0).files[0]);
        eventData.append('address', $("#searchInput").val());
        eventData.append('lat', $("#lat").val());
        eventData.append('lng', $("#lng").val());
        eventData.append('buytype', $('input[name=iwantbuy]:checked').val());
        console.log($('input[name=iwantbuy]:checked').val());
        if ($('input[name=iwantbuy]:checked').val() == 1) {
            eventData.append('service', $('input[name=buy_service]:checked').val());
        } else {
            eventData.append('service', $('input[name=buy_product]:checked').val());

        }
        eventData.append('bidrate', $('#bidrate').val());
        eventData.append('serviceoption', $('select[name=serviceoptionbuy]').val());
        eventData.append('bidhours', $('#bidhours').val());
        eventData.append('buysubject', $('#buysubject').val());
        eventData.append('buydetails', $('#buydetails').val());
        eventData.append('referral', reff);
        $.ajax({
            method: 'post',
            url: '{{route('post.buy.store')}}',
            processData: false,
            contentType: false,
            data: eventData,
            success: function (res) {
                if (res.status == 'success') {
                    $('#referralcomission').modal('hide');
                    $('#postbuydone').modal('show');
                }
            }
        })
    }

    $(document).on('keyup', '.bidinput', function (e) {
        this.value = this.value.replace(/\D/g, '');

        // $(this).parent().find('.closebidinput').addClass('typing');

    });
    $(document).on('click', '.closebidinput', function (e) {
        $(this).removeClass('typing');
        $(this).parent().find('.bidinput').val('');
        var id = $(this).attr('data-id');
        var post_type = $(this).attr('data-post-type');
        $.ajax({
            method: 'post',
            url: '{{route('post.bid.delete')}}',
            data: {id, post_type, _token: $('input[name=_token]').val()},
            success: function (res) {
                if (res.status == 'success') {
                    /* Swal.fire(
                         'Successfully',
                         'Bid Delete Successfully',
                         'success'
                     );*/
                    alert("Bid Delete Successfully");
                    window.location.reload();

                } else {
                    Swal.fire(
                        'Failed',
                        'Bid can not be deleted',
                        'error'
                    );
                }
            }

        })

    });
    $(document).on('click', '.triggerBid', function (e) {
        e.preventDefault();
        var userid = '{{auth()->id()}}';
        if (!userid) {
            window.location.href = "/login";
            return;
        }
        var that = $(this);
        var max = parseInt($(this).attr('data-max'));
        var id = $(this).attr('data-id');

        var current = parseInt($(this).parent().find('.bidinput').val());
        if (current >= max) {
            alert("Bid must be lower than current rate");
            return;
        }

        $('#referenceModal').modal('show');
        $('#referenceContinue').attr('data-id', id).attr('data-amount', current);

      /*  var bidData = new FormData();
        bidData.append('_token', $('input[name=_token]').val());
        bidData.append('id', id);
        bidData.append('bid_amount', current);
        $.ajax({
            method: 'post',
            url: '{{route('post.buy.bid.store')}}',
            processData: false,
            contentType: false,
            data: bidData,
            success: function (res) {
                if (res.status == 'success') {
                    alert('Bid successful');
                    window.location.reload();
                }
            }
        })*/
    });
</script>
<script>
    function editEventAddMore(eventId) {
        //alert(eventId);
        $("#editeventStartDate").val('');
        $("#editeventEndDate").val('');
        $("#eventEditDateTimeList").modal('hide');
        $("#editEventDateTime").modal('show');
    }

    function followUser(followable_id, status) {

        $.ajax({
            url: "{{route('follow.user')}}",
            type: 'post',
            data: {
                'followable_id': followable_id,
                'follow_status': status,
                '_token': "{{csrf_token()}}"
            },
            dataType: 'json',
            success: function (response) {

                if (status == 1) {
                    $(".follow-btn").css("display", "none");
                    $(".following-dropdown").css("display", "block");
                } else {
                    $(".follow-btn").css("display", "block");
                    $(".following-dropdown").css("display", "none");
                }
                if (response.status == "200") {

                    Swal.fire({
                        toast: true,
                        /* title: 'Success',*/
                        text: response.message,
                        type: 'success',
                        showConfirmButton: false,
                        timer: 2000,
                        position: 'top-end',

                    });


                } else {
                    Swal.fire({
                        toast: true,
                        title: 'Oops...',
                        text: response.message,
                        type: 'warning',
                        showConfirmButton: false,
                        timer: 2000,
                        position: 'top-end',
                    });
                }
            },
            error: function (error) {
                Swal.fire({
                    toast: true,
                    title: 'Oops...',
                    text: error.message,
                    type: 'error',
                    showConfirmButton: false,
                    timer: 2000,
                    position: 'top-end',
                });
            }
        });
    }

    //show event date time
    function showEventDateTime(eventId, userId) {
        //alert(eventId);
        $.ajax({
            type: 'post',
            url: '/events/eventEditDateTime',
            data: {'id': eventId, 'userId': userId},
            success: function (data) {
                //alert(data);
                $("#eventDateTime").html(data);
                $("#eventAllDetails").modal('hide');
                $("#eventEditDateTimeList").modal('show');

            }
        });
    }

    //event going participent list
    function goingParticipent(modelId, countGoing) {
        $.ajax({
            type: 'post',
            url: '/events/goingParticipentList',
            data: {'modelId': modelId},
            success: function (data) {
                //alert(data);
                $("#countGoingShow").html(countGoing + ' going');
                $("#eventParticepentGoingList").html(data);
                $("#eventAllDetails").modal('hide');
                $("#goingparticipentlist").modal('show');

            }
        });
    }

    // buy sell post order list
    function buySellOrder(id, countGoing) {
        $('#buyBidParticipantList').modal('hide');
        $.ajax({
            type: 'get',
            url: '{{route('post.buy.bid.get')}}',
            data: {id, type: 'orders', _token: $('input[name=_token]').val()},
            success: function (res) {
                var html = `<a href='#' onclick="buySellOrder(${id},${res.orders})" class="ordersCount" >[${res.orders} Orders]</a> <a href='#' onclick="buySellBids(${id},${res.bids})" class='bidsCount' >[${res.bids} Bids]</a>`;
                $("#countBuyOrderShow").html(html);
                if (res.status == 'success') {
                    $('#buyParticipantOrderList').html(res.data);
                    $("#buySellDetails").modal('hide');
                    $('#buyOrderParticipantList h5 img').replaceWith('<span class="overlay_badge_buy">Buy</span>');
                    $('.participantlisttitle').css('padding-left', '60px');
                    $("#buyOrderParticipantList").modal('show');
                    if ($('#checkBackbutton').val() != 11) {
                        $('#backtoalldetailsbuyorderlist').hide();
                    } else {
                        //   window.location.reload();
                    }
                }
                $('.rating').rating('refresh', {
                    displayOnly: true,
                    size: 'sm',
                    showCaption: false
                });
                $('.bid-rating').rating({
                    size: 'sm',
                    showCaption: false,
                    clearButton: '',
                });

                $('.bid-close-rating').rating({
                    size: 'sm',
                    showCaption: false,
                    displayOnly: true,
                });
                $('.bid-rating').on('rating:change', function (event, value, caption) {
                    var userid = $(this).attr('data-bid-user');
                    var bidid = $(this).attr('data-bid-id');
                    $.ajax({
                        method: 'post',
                        url: '{{route('review.user')}}',
                        data: {reviewable_id: userid, review_number: value, bid_id: bidid, _token: '{{csrf_token()}}'},
                        success: function (res) {
                            console.log(res);
                        }
                    })
                });
            }
        });

    }

    // buy sell post bid list
    function buySellBids(id, countGoing) {
        $('#buyOrderParticipantList').modal('hide');
        $.ajax({
            type: 'get',
            url: '{{route('post.buy.bid.get')}}',
            data: {id, type: 'bids', _token: $('input[name=_token]').val()},
            success: function (res) {
                var html = `<a href='#' onclick="buySellOrder(${id},${res.orders})" class="ordersCount" >[${res.orders} Orders]</a> <a href='#' onclick="buySellBids(${id},${res.bids})" class='bidsCount' >[${res.bids} Bids]</a>`;
                $("#countBuyBidShow").html(html);
                if (res.status == 'success') {
                    $('#buyParticipantBidList').html(res.data);
                    $("#buySellDetails").modal('hide');
                    $("#buyBidParticipantList").modal('show');
                    $('#buyBidParticipantList h5 img').replaceWith('<span class="overlay_badge_buy">Buy</span>');
                    $('.participantlisttitle').css('padding-left', '60px');
                    if ($('#checkBackbutton').val() != 11) {
                        $('#backtoalldetailsbuybidlist').hide();
                    }
                    $('.rating').rating('refresh', {
                        displayOnly: true,
                        size: 'sm',
                        showCaption: false
                    });
                    $('.bid-rating').rating({
                        size: 'sm',
                        showCaption: false,
                        clearButton: '',
                    });

                    $('.bid-close-rating').rating({
                        size: 'sm',
                        showCaption: false,
                        displayOnly: true,
                    });
                    $('.bid-rating').on('rating:change', function (event, value, caption) {
                        var userid = $(this).attr('data-bid-user');
                        var bidid = $(this).attr('data-bid-id');
                        $.ajax({
                            method: 'post',
                            url: '{{route('review.user')}}',
                            data: {reviewable_id: userid, review_number: value, bid_id: bidid, _token: '{{csrf_token()}}'},
                            success: function (res) {
                                console.log(res);
                            }
                        })
                    });

                }
            }
        });

    }

    //event waiting participent list
    function waitingParticipent(modelId, countWaiting) {
        $.ajax({
            type: 'post',
            url: '/events/waitingParticipentList',
            data: {'modelId': modelId},
            success: function (data) {
                //alert(data);
                $("#countWaitingShow").html(countWaiting + ' waiting');
                $("#eventParticepentWaitingList").html(data);
                $("#eventAllDetails").modal('hide');
                $("#waitingparticipentlist").modal('show');

            }
        });
    }

    //approve event requiest
    function eventApproveUser(visitorId, modelId) {
        $.ajax({
            type: 'post',
            url: '/events/updateEventRequest',
            data: {'Id': visitorId, 'modelId': modelId},
            success: function (data) {
                Swal.fire(
                    'Successfully',
                    'Event Approval Update Success',
                    'success'
                ).then((data1) => {
                    waitingParticipent(modelId, data);
                });

                //
                //waitingParticipent(50,1);
                //$("#waitingparticipentlist").modal('show');

            }
        });
    }

    //Reject event requiest
    function eventRejectUser(modelId, visitorId, ownerId, userId, amount) {
        $.ajax({
            type: 'post',
            url: '/events/rejectEventRequest',
            data: {'modelId': modelId, 'visitorId': visitorId, 'ownerId': ownerId, 'userId': userId, 'amount': amount},
            success: function (data) {
                Swal.fire(
                    'Successfully',
                    'Request Update Success',
                    'success'
                ).then((data1) => {
                    goingParticipent(modelId, data);
                });

                //waitingParticipent(50,1);
                //$("#waitingparticipentlist").modal('show');

            }
        });
    }


    //event map show
    function eventAddtress(eventId, lat, lon) {
        //alert(lat);
        $("#lat").val(lat);
        $("#lng").val(lon);
        $("#mapSearchCheck").html('');
        $("#checkVisiblebutton").html('');
        initialize();
        $("#buySellDetails").modal('hide');
        $("#eventAllDetails").modal('hide');
        $("#eventlocation").modal('show');
    }

    function freeJoinEvent(owner_id, id, modelId, needApproval) {
        //alert(needApproval);
        if (needApproval == 1) {
            var title = '<span ><span style="font-size: 23px">Need To Approve By Owner for Joining...</span> <br/> <span style="color: blue">Free Event</span></span>';
            var btnText = 'Apply';

        } else {
            var title = 'Free Join Event';
            var btnText = 'Join';
        }
        Swal.fire({
            title: title,
            text: "Are you sure to join this event",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'green',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Pay'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '/events/freeJoinToPay/' + owner_id + '/' + id + '/' + modelId + '/' + needApproval,
                    type: 'GET',
                    success: function (response) {
                        Swal.fire(
                            'Event Join Done!',
                            'You are join event.',
                            'success'
                        ).then((result) => {
                            if (result.value) {
                                window.location = '/home';
                            }
                        });

                    }
                });
            }
        });
    }

      function eventPay(amount, owner_id, id, modelId, needApproval,ticketBook) {
        //alert(needApproval);
        if (needApproval == '1') {
            var title = '<span ><span style="font-size: 23px">Need To Approve By Owner for Joining...</span> <br/> <span style="color: blue">Want to Pay for Joining?</span></span>';
            var btnText = 'Apply';
        } else {
            var title = 'Want to Pay for Joining?';
            var btnText = 'Pay';
        }
        Swal.fire({
            title: title,
            text: "You have to pay $" + amount + " to read!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'green',
            cancelButtonColor: '#d33',
            confirmButtonText: btnText
        }).then((result) => {
            if (result.value) {
                $.ajax({

                    url: '/events/joinToPay/' + amount + '/' + owner_id + '/' + id + '/' + modelId + '/' + needApproval+ '/' + ticketBook,
                    type: 'GET',

                    success: function (response) {

                        //console.log(response);

                        if (response == 'Done') {
                            Swal.fire(
                                'Request Done!',
                                'You are join event.',
                                'success'
                            ).then((result) => {
                                if (result.value) {
                                    window.location = '/home';
                                }
                            });

                        } else {
                            Swal.fire(
                                'Request Cancel!',
                                'Low Balance.',
                                'error'
                            ).then((result) => {
                                if (result.value) {
                                    window.location = '/home';
                                }
                            });
                        }

                    }
                });
            }
        });
    }

    $("#referralYes").click(function () {
            document.getElementById("enterReferral").style.display = "block";
    });
     $("#referralNo").click(function () {
            document.getElementById("enterReferral").style.display = "none";
    });

     function ticketBook()
     {
        var numberOfticket = $('#numberOfticket').val();
        var enterTicketBook = $("#enterTicketBook").val();
        var ticketEventPrice = $("#ticketEValue").val();
        $("#enterTicketBook").html(numberOfticket);
        var totalTicketBook = numberOfticket * ticketEventPrice;
         $("#totalTaount").html(totalTicketBook);

     }
     
    //event check referel
    function eventPay1(amount, owner_id, id, modelId, needApproval) {
       // alert(amount);
        $("#checkReferral").modal('show'); 
        
        $("#submitReferralYes").click(function () {
            $("#ticketEventPrice").html(amount);
            $("#totalTaount").html(amount);
            $("#ticketEValue").val(amount);
            $("#checkReferral").modal('hide'); 
            $("#bokkingTicket").modal('show'); 
        });


        
        $("#submitTicketBokking").click(function () {
            var amount = document.getElementById("totalTaount").innerText;
            var ticketBook = $("#numberOfticket").val();
            var refStatus = $("input[name='referralStatus']:checked").val();
            if (refStatus === undefined) {
                alert('please choose one');
            }
            else
            {
                var enterReferral = $('#enterReferral').val();
                if(refStatus == 'No')
                {
                    enterReferral = 0;
                }
                $.ajax({
                    url: '/events/insertReferral/'  + owner_id + '/' + id + '/' + enterReferral,
                    type: 'GET',
                    success: function (response) 
                    {
                        //alert('Done')
                        $("#bokkingTicket").modal('hide'); 
                        eventPay(amount, owner_id, id, modelId, needApproval,ticketBook) ;    
                    }
                });      
            }
            
            
        });   
    }
    
    //cancel join evnt
    function cancelRequest(userId, eventId, eventModelId, amount) {
        if (confirm("Are you sure you want to cancel this request")) {
            $.ajax({
                url: '/events/cancelToJoin/' + userId + '/' + eventId + '/' + eventModelId + '/' + amount,
                type: 'GET',

                success: function (response) {
                    Swal.fire(
                        'Request Cancel',
                        'You Request Cancel Successfully',
                        'success'
                    ).then((result) => {
                        if (result.value) {
                            window.location = '/home';
                        }
                    });

                }
            });
        }
    }

    //shere event
    function share(userId) {
        FB.ui({
            method: 'share',
            href: "{{route('otherUserProfile',"+userId+")}}",
            app_id: "367338140128186"
        }, function (response) {
        });
    }

    //update datetime selected
    function chengeSelectedDateTime(changeId) {
        $.ajax({
            type: 'post',
            url: '/events/selectChangeDateTime',
            data: {'changeId': changeId},
            success: function (data) {
                $("#eventStartDate").val(data.start_date);
                $("#eventEndDate").val(data.end_date);

                start_house = $("#start_house"), options = '';
                start_house.empty();
                for (var i = 1; i < 13; i++) {
                    if (i < 10) {
                        i = '0' + i;
                    }
                    options += "<option value='" + i + "' " + (i == data.start_hours ? "selected" : "") + ">" + i + "</option>";
                }
                start_house.append(options);

                start_minit = $("#start_minit"), options = '';
                start_minit.empty();
                for (var i = 0; i < 60; i++) {
                    if (i < 10) {
                        i = '0' + i;
                    }
                    options += "<option value='" + i + "' " + (i == data.start_minit ? "selected" : "") + ">" + i + "</option>";
                }
                start_minit.append(options);

                startTimeType = $("#startTimeType"), options = '';
                startTimeType.empty();
                options += "<option value='AM' " + ('AM' == data.start_type ? "selected" : "") + ">AM</option>";
                options += "<option value='PM' " + ('PM' == data.start_type ? "selected" : "") + ">PM</option>";
                startTimeType.append(options);


                end_house = $("#end_house"), options = '';
                end_house.empty();
                for (var i = 1; i < 13; i++) {
                    if (i < 10) {
                        i = '0' + i;
                    }
                    options += "<option value='" + i + "' " + (i == data.end_hours ? "selected" : "") + ">" + i + "</option>";
                }
                end_house.append(options);

                end_minit = $("#end_minit"), options = '';
                end_minit.empty();
                for (var i = 0; i < 60; i++) {
                    if (i < 10) {
                        i = '0' + i;
                    }
                    options += "<option value='" + i + "' " + (i == data.end_minit ? "selected" : "") + ">" + i + "</option>";
                }
                end_minit.append(options);

                end_time_type = $("#end_time_type"), options = '';
                end_time_type.empty();
                options += "<option value='AM' " + ('AM' == data.end_type ? "selected" : "") + ">AM</option>";
                options += "<option value='PM' " + ('PM' == data.end_type ? "selected" : "") + ">PM</option>";
                end_time_type.append(options);

                $("#checkUpdate").val(data.id);


                $("#participentlist").modal('hide');
                $("#datetimeforevent").modal('show');
            }
        });
    }

    //update datetime selected
    function chengeEditSelectedDateTime(changeId) {
        $.ajax({
            type: 'post',
            url: '/events/selectEditChangeDateTime',
            data: {'changeId': changeId},
            success: function (data) {
                $("#editeventStartDate").val(data.start_date);
                $("#editeventEndDate").val(data.end_date);

                start_house = $("#editstart_house"), options = '';
                start_house.empty();
                for (var i = 1; i < 13; i++) {
                    if (i < 10) {
                        i = '0' + i;
                    }
                    options += "<option value='" + i + "' " + (i == data.start_hours ? "selected" : "") + ">" + i + "</option>";
                }
                start_house.append(options);

                start_minit = $("#editstart_minit"), options = '';
                start_minit.empty();
                for (var i = 0; i < 60; i++) {
                    if (i < 10) {
                        i = '0' + i;
                    }
                    options += "<option value='" + i + "' " + (i == data.start_minit ? "selected" : "") + ">" + i + "</option>";
                }
                start_minit.append(options);

                startTimeType = $("#editstartTimeType"), options = '';
                startTimeType.empty();
                options += "<option value='AM' " + ('AM' == data.start_type ? "selected" : "") + ">AM</option>";
                options += "<option value='PM' " + ('PM' == data.start_type ? "selected" : "") + ">PM</option>";
                startTimeType.append(options);


                end_house = $("#editend_house"), options = '';
                end_house.empty();
                for (var i = 1; i < 13; i++) {
                    if (i < 10) {
                        i = '0' + i;
                    }
                    options += "<option value='" + i + "' " + (i == data.end_hours ? "selected" : "") + ">" + i + "</option>";
                }
                end_house.append(options);

                end_minit = $("#editend_minit"), options = '';
                end_minit.empty();
                for (var i = 0; i < 60; i++) {
                    if (i < 10) {
                        i = '0' + i;
                    }
                    options += "<option value='" + i + "' " + (i == data.end_minit ? "selected" : "") + ">" + i + "</option>";
                }
                end_minit.append(options);

                end_time_type = $("#editend_time_type"), options = '';
                end_time_type.empty();
                options += "<option value='AM' " + ('AM' == data.end_type ? "selected" : "") + ">AM</option>";
                options += "<option value='PM' " + ('PM' == data.end_type ? "selected" : "") + ">PM</option>";
                end_time_type.append(options);

                $("#editcheckUpdate").val(data.id);


                $("#eventEditDateTimeList").modal('hide');
                $("#editEventDateTime").modal('show');
            }
        });
    }

    //delete selected datetime
    function deleteSelectedDateTime(deleteId) {
        if (confirm("Are you sure you want to delete this record")) {
            $.ajax({
                type: 'post',
                url: '/events/deleteEventDateTime',
                data: {'deleteId': deleteId},
                success: function (data) {
                    $('.raw' + deleteId).remove();
                }
            });
        }
    }

    //delete selected datetime
    function deleteEditSelectedDateTime(deleteId) {
        if (confirm("Are you sure you want to delete this record")) {
            $.ajax({
                type: 'post',
                url: '/events/deleteEventDateTime',
                data: {'deleteId': deleteId},
                success: function (data) {
                    $('.raw' + deleteId).remove();
                }
            });
        }
    }

    //delete view more datetime list datetime
    function deleteListEditSelectedDateTime(deleteId) {
        if (confirm("Are you sure you want to delete this record")) {
            $.ajax({
                type: 'post',
                url: '/events/deleteListEventDateTime',
                data: {'deleteId': deleteId},
                success: function (data) {
                    $('.raw' + deleteId).remove();
                }
            });
        }
    }

    // schedule Cancel function for redirect
    function scheduleCancel() {
        $("#eventEditDateTimeList").modal('hide');
        $("#eventAllDetails").modal('show');
    }

    // Blog Functions Start
    $("#submitblogpostname").click(function () {
        
        $("#selectblogpostname").modal('hide');
        $("#iwanttopostblog").modal('show');
        
    });

    // Blog Functions Start
    $("#submitblogsubject").click(function () {
        option = 3
        var blogSub = $('#blogSubject').val();
        if (blogSub == '' || blogSub == null) {
            alert('Please enter blog subject');
            return
        }
        else{
            $("#iwanttopostblog").modal('hide');
            $("#bloguploadimage").modal('show');
        }
    });

    $("#submitblogimage").click(function () {
        var blogImage = $('#bloguploadphoto').val();
        if (blogImage == '' || blogImage == null) {
            if ($("#editStatus").val() == 1) {
                $("#bloguploadimage").modal('hide');
                $("#bloginformation").modal('show');
            }
            else
            {
                alert('Please select image');
                return 
            }
            
        }
        else{
            $("#bloguploadimage").modal('hide');
            $("#bloginformation").modal('show');
        }
    });
    $(".bloguploadimage").click(function () {
            $("#bloguploadphoto").click();
    });
    $("#skipblogimage").click(function () {
        $("#bloguploadimage").modal('hide');
        $("#bloginformation").modal('show');
    });

    $("#submitbloginfo").click(function () {
        $("#bloginformation").modal('hide');
        $("#blogfees").modal('show');
    });
    $("#blogfreeJoin").click(function () {
        document.getElementById("blogJoinType").style.display = "none";
    });
    $("#blognotFreeJoin").click(function () {
        document.getElementById("blogJoinType").style.display = "block";
    });
    $("#submitblogfees").click(function () {
        var blogFeeType = $("input[name='blogFeeType']:checked").val();
        if (blogFeeType === undefined) {
            alert('please choose one');
        }
        else
        {
            if (blogFeeType == 'Not Free') {
                    var blogFee = $("#blogFee").val();
                    if (blogFee == '' || blogFee == null) {
                        alert('please Enter blog fee');
                    } else {
                        $("#blogfees").modal('hide');
                        $("#blogrefferal").modal('show');
                    }
                } else {
                    $("#blogfees").modal('hide');
                    $("#blogrefferal").modal('show');
                }
        }
       
    });
    $("#submitblogrefferal").click(function () {
        saveBlog();
    });

    $("#finalblogpreview").click(function () {
        $('#postblogdone').modal('hide');
        window.location = "/home";
    });

    //buy save data
    function saveBlog() {
        var reff = $('#blogreferralPer').val();
        var id = $('#blogId').val();
        var eventData = new FormData();
        if (id) {
            eventData.append('blog_id', id);
        }
        eventData.append('_token', $('input[name=_token]').val());
        eventData.append('blogSubject', $('#blogSubject').val());
        eventData.append('blog_post_category', $('#blog_post_category').val());
        eventData.append('blogphoto', $("#bloguploadphoto").get(0).files[0]);
        eventData.append('bloginformation', tinymce.get("blog_information").getContent());
        eventData.append('blogfeetype', $('input[name=blogFeeType]:checked').val());
        if ($('input[name=blogFeeType]:checked').val() == 'Not Free') {
            eventData.append('blogfee', $('#blogFee').val());
        }
        eventData.append('referral', reff);
        $.ajax({
            method: 'post',
            url: '{{route('blog.storeModelBlog')}}',
            processData: false,
            contentType: false,
            data: eventData,
            success: function (res) {
                if (res.status == 'success') {
                    $('#blogrefferal').modal('hide');
                    $('#postblogdone').modal('show');
                }
            }
        })
    }

    //referral change function
    function blogReferralOnchange() {
        var refPer1 = document.getElementById("blogreferralPer").value;
        refPer1 = refPer1 * 1;
        fValue = refPer1 / 2;
        $("#blogrefPer").html(fValue);
        $("#blogbidWin").html(fValue);
    }

    function blogReferralMouseUp() {
        var refPer1 = document.getElementById("blogreferralPer").value;
        refPer1 = refPer1 * 1;
        fValue = refPer1 / 2;
        $("#blogrefPer").html(fValue);
        $("#blogbidWin").html(fValue);
    }

    function deleteBlog(blogId)
    {
        if (confirm('Are you sure you want to delete this blog !')) {
            $.ajax({
                type: 'post',
                url: '/blog/blogDelete',
                data: {'blogId': blogId},
                success: function (data) {
                    setTimeout(function () {
                        swal({
                            title: "Successfully",
                            text: "Blog Delete Successfully",
                            type: "success"
                        }, function () {
                            window.location = "/home";
                        });
                    }, 1000);

                    Swal.fire(
                        'Successfully',
                        'Blog Delete Success',
                        'success'
                    ).then((data) => {
                        window.location = "/home";
                    });
                }
            });
        }
    }

    //blog edit function
    function blogEdit(id, userId) {
        $.ajax({
            type: 'post',
            url: '/blog/blogModelEdit',
            data: {'id': id, 'userId': userId},
            success: function (data) {
                
                $("#blogId").val(id);
                $("#blogSubject").val(data['heading']);
                if (data['image'] != null && data['image'] != '/uploads/blog/') {
                    document.getElementById("uploadBlogImage").src = data['image'];
                }
                $("#editStatus").val(1)
                tinyMCE.get('blog_information').setContent(data['content']);
                if (data['read_amount'] == 0) {
                    //$("#freeJoin:checked").val();
                    $(':radio[name=blogFeeType][value="Free"]').prop('checked', true);
                } else {
                    //$("#notFreeJoin:checked").val();
                    $(':radio[name=blogFeeType][value="Not Free"]').prop('checked', true);
                    $("#blogFee").val(data['read_amount']);
                    document.getElementById("blogJoinType").style.display = "block";
                }
                $("#blogreferralPer").val(data['referral_per']);
                blogReferralOnchange();
                
                $("#eventAllDetails").modal('hide');
                $("#iwanttopostblog").modal('show');

            }
        });
    }

    // Blog Functions End

    //Sell Function Start
    //sell save data
    function saveSellData() {
        var reff = $('#referralPer').val();
        var id = $('#sellId').val();
        var eventData = new FormData();
        if (id) {
            eventData.append('sell_id', id);
        }
        eventData.append('_token', $('input[name=_token]').val());
        eventData.append('postphoto', $("#takeaphotoforpostfile").get(0).files[0]);
        eventData.append('address', $("#searchInput").val());
        eventData.append('lat', $("#lat").val());
        eventData.append('lng', $("#lng").val());
        eventData.append('selltype', $('input[name=iwantsell]:checked').val());

        if ($('input[name=iwantsell]:checked').val() == 1) {
            eventData.append('service', $('input[name=sell_service]:checked').val());
        } else {
            eventData.append('service', $('input[name=sell_product]:checked').val());

        }
        eventData.append('bidrate', $('#sellrate').val());
        eventData.append('serviceoption', $('select[name=serviceoptionsell]').val());
        eventData.append('bidhours', $('#sellhours').val());
        eventData.append('sellsubject', $('#sellsubject').val());
        eventData.append('selldetails', $('#selldetails').val());
        eventData.append('referral', reff);
        $.ajax({
            method: 'post',
            url: '{{route('post.sell.store')}}',
            processData: false,
            contentType: false,
            data: eventData,
            success: function (res) {
                if (res.status == 'success') {
                    $('#referralcomission').modal('hide');
                    $('#postselldone').modal('show');
                }
            }
        })
    }

    $(document).on('click', '.triggerSellBid', function (e) {
        e.preventDefault();
        var userid = '{{auth()->id()}}';
        if (!userid) {
            window.location.href = "/login";
            return;
        }
        var that = $(this);
        var max = parseInt($(this).attr('data-max'));
        var id = $(this).attr('data-id');

        var current = parseInt($(this).parent().find('.sellinput').val());
        if (current <= max) {
            alert("Bid must be upper than current rate");
            return;
        }

        $('#referenceSellModal').modal('show');
        $('#sellReferenceContinue').attr('data-id', id).attr('data-amount', current);
    });

    $('#sellReferenceContinue').on('click', function (e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            var current = $(this).attr('data-amount');
            var email = $('#referenceUserForInProcess').val();
            var radioButton=$('input[name=is_reference]:checked').val();
            if(radioButton=='yes' && !email){
                return;
            }

            $.ajax({
                method: 'post',
                url: '{{route('post.sell.bid.store')}}',
                data: {id,bid_amount:current, email,check:radioButton, _token: $('[name=_token]').val()},
                success: function (res) {
                    if (res.status == 'success') {
                        $('#dueDateModal').modal('hide');
                        Swal.fire(
                            'Order Bid',
                            'You Request Successfully Completed',
                            'success'
                        ).then(function () {
                            setTimeout(function () {
                                window.location.reload()
                            }, 500)
                        });
                        $('#referenceSellModal').modal('hide');
                    } else {
                        $('#dueDateModal').modal('hide');
                        Swal.fire(
                            'Order Bid',
                            res.message,
                            'error'
                        );
                    }
                }

            });
    });

    function SellBids(id, countGoing) {
        $('#buyOrderParticipantList').modal('hide');
        $.ajax({
            type: 'get',
            url: '{{route('post.sell.bid.get')}}',
            data: {id, type: 'bids', _token: $('input[name=_token]').val()},
            success: function (res) {
                var html = `<a href='#' onclick="sellOrder(${id},${res.orders})" class="ordersCount" >[${res.orders} Orders]</a> <a href='#' onclick="SellBids(${id},${res.bids})" class='bidsCount' >[${res.bids} Bids]</a>`;
                $("#countBuyBidShow").html(html);
                if (res.status == 'success') {
                    $('#buyParticipantBidList').html(res.data);
                    $("#buySellDetails").modal('hide');
                    $("#buyBidParticipantList").modal('show');
                    $('#buyBidParticipantList h5 img').replaceWith('<span class="overlay_badge_sell">Sell</span>');
                    $('.participantlisttitle').css('padding-left', '60px');
                    if ($('#checkBackbutton').val() != 11) {
                        $('#backtoalldetailsbuybidlist').hide();
                    }
                    $('.rating').rating('refresh', {
                        displayOnly: true,
                        size: 'sm',
                        showCaption: false
                    });
                    $('.bid-rating').rating({
                        size: 'sm',
                        showCaption: false,
                        clearButton: '',
                    });

                    $('.bid-close-rating').rating({
                        size: 'sm',
                        showCaption: false,
                        displayOnly: true,
                    });
                    $('.bid-rating').on('rating:change', function (event, value, caption) {
                        var userid = $(this).attr('data-bid-user');
                        var bidid = $(this).attr('data-bid-id');
                        $.ajax({
                            method: 'post',
                            url: '{{route('review.user')}}',
                            data: {reviewable_id: userid, review_number: value, bid_id: bidid, _token: '{{csrf_token()}}'},
                            success: function (res) {
                                console.log(res);
                            }
                        })
                    });

                }
            }
        });

    }

     $(document).on('click', '.sellplace-order', function (e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            $('#buyBidParticipantList').modal('hide');
            $('#sellDueDateModal').modal('show');
            $('#sellDueDateContinue').attr('data-id', id);

    });

    $('#sellDueDateContinue').on('click', function (e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        var date = $('#dueDateSelect').val();
        $.ajax({
            method: 'post',
            url: '{{route('post.sell.bid.order.create')}}',
            data: {id, date, _token: $('[name=_token]').val()},
            success: function (res) {
                if (res.status == 'success') {
                    $('#sellDueDateModal').modal('hide');
                    Swal.fire(
                        'Order Created',
                        'You Request Successfully Completed',
                        'success'
                    );
                }else{
                    Swal.fire(
                        'Order Create Error',
                        res.message,
                        'error'
                    );
                }
            }

        });
    });

    function sellOrder(id, countGoing) {
        $('#buyBidParticipantList').modal('hide');
        $.ajax({
            type: 'get',
            url: '{{route('post.sell.bid.get')}}',
            data: {id, type: 'orders', _token: $('input[name=_token]').val()},
            success: function (res) {
                var html = `<a href='#' onclick="sellOrder(${id},${res.orders})" class="ordersCount" >[${res.orders} Orders]</a> <a href='#' onclick="SellBids(${id},${res.bids})" class='bidsCount' >[${res.bids} Bids]</a>`;
                $("#countBuyOrderShow").html(html);
                if (res.status == 'success') {
                    $('#buyParticipantOrderList').html(res.data);
                    $("#buySellDetails").modal('hide');
                    $('#buyOrderParticipantList h5 img').replaceWith('<span class="overlay_badge_sell">Sell</span>');
                    $('.participantlisttitle').css('padding-left', '60px');
                    $("#buyOrderParticipantList").modal('show');
                    if ($('#checkBackbutton').val() != 11) {
                        $('#backtoalldetailsbuyorderlist').hide();
                    } else {
                        //   window.location.reload();
                    }
                }
                $('.rating').rating('refresh', {
                    displayOnly: true,
                    size: 'sm',
                    showCaption: false
                });
                $('.bid-rating').rating({
                    size: 'sm',
                    showCaption: false,
                    clearButton: '',
                });

                $('.bid-close-rating').rating({
                    size: 'sm',
                    showCaption: false,
                    displayOnly: true,
                });
                $('.bid-rating').on('rating:change', function (event, value, caption) {
                    var userid = $(this).attr('data-bid-user');
                    var bidid = $(this).attr('data-bid-id');
                    $.ajax({
                        method: 'post',
                        url: '{{route('review.user')}}',
                        data: {reviewable_id: userid, review_number: value, bid_id: bidid, _token: '{{csrf_token()}}'},
                        success: function (res) {
                            console.log(res);
                        }
                    })
                });
            }
        });

    }

    $(document).on('click', '.sell-place-received', function (e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            var user_id = $(this).attr('data-user-id');
            $(this).closest('.actionButtons').html('');
            $('.bid-status_' + id).text('Paid');
            var review = `<input class="ownRating bid-rating rating-loading own-rating"
                                       value=""
                                       style="padding-top: 5px;">`;
            $('.rate_profile_' + id).html(review);
            $('.bid-rating').rating({
                size: 'sm',
                showCaption: false,
                clearButton: '',
            });
            $.ajax({
                method: 'post',
                url: '{{route('post.sell.bid.order.receive')}}',
                data: {id, _token: '{{csrf_token()}}'},
                success: function (res) {
                    console.log(res);
                }
            });
        });

    //Sell Function End

</script>

<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
    }

    .takephoto {
        background-color: #fff;
        border-color: #000;
        border-width: 1px solid;
        padding: 10px;
        width: 100%;
        text-align: center;
        border-radius: 5px;
    }

    .continue {
        background-color: #006dbc;
        border-color: #006dbc;
        box-shadow: gray;
        padding: 10px;
        width: 100%;
        text-align: center;
        border-radius: 5px;
        color: #fff;
    }

    .cancel {
        background-color: #f47d2b;
        border-color: #f47d2b;
        box-shadow: gray;
        padding: 10px;
        width: 100%;
        text-align: center;
        border-radius: 5px;
        color: #fff;
    }

    .skip {
        background-color: #ef4726;
        border-color: #ef4726;
        box-shadow: gray;
        padding: 10px;
        width: 100%;
        text-align: center;
        border-radius: 5px;
        color: #fff;
    }

    .button-blue {
        box-shadow: gray;
        padding: 20px;
        width: 100%;
        text-align: left;
        border-radius: 3px;
        color: #000;
    }

    .button-blue:hover {
        background-color: #006dbc;
        border-color: #006dbc;
    }

    .button-blue:focus {
        background-color: #006dbc;
        border-color: #006dbc;
    }

    /* The Modal (background) */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0, 0, 0); /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
    }

    /* Modal Content */
    .modal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
    }

    /* The Close Button */
    .close {
        color: #aaaaaa;
        float: right ! import;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }
</style>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script type="text/javascript">
    tinymce.init({
        selector: '#event_description',
        fontsize_formats: '8pt 10pt 12pt 14pt 18pt 24pt 36pt',

        toolbar: 'fontsizeselect',

        height: 200,
        width: 600,
        content_css: '/assets/tinymce/custom_add.css',
        plugins: [
            'advlist table autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code'
        ],
        toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | table',

    });
         tinymce.init({
        selector: '#blog_information',
        fontsize_formats: '8pt 10pt 12pt 14pt 18pt 24pt 36pt',

        toolbar: 'fontsizeselect',

        height: 200,
        width: 600,
        content_css: '/assets/tinymce/custom_add.css',
        plugins: [
            'advlist table autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code'
        ],
        toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | table',

    });
</script>