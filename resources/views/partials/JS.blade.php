<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="{{asset('vendors/DataTables/datatables.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
<!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>


<!-- Dropzone -->
@include('partials.chat')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment-with-locales.min.js"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.21/moment-timezone-with-data-2012-2022.min.js"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="{{asset('vendors/bootstrap-star-rating/js/star-rating.min.js')}}"></script>
<script src="{{asset('vendors/bootstrap-star-rating/themes/krajee-fa/theme.min.js')}}"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="{{asset('vendors/sweetalert2/sweetalert2.8.js')}}"></script>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>

<!-- FB Script -->
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0&appId=2223725464559470";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

@yield('extra-JS')


<script type="text/javascript">

    //Filter Modal hide and show.
    $("input[name=myPost]").click(function () {
        if ($("input[name=myPost]").prop('checked')) {
            $('#postBy').hide();
            $('#online-checkbox').hide();
            $('#status').css('visibility', '');
            //Removing bootstrap classes
            // $("#myPost").removeClass('col-md-2').addClass('col-md-3');
            // $("#postFor").removeClass('col-md-2').addClass('col-md-3');
            // $("#categories").removeClass('col-md-2').addClass('col-md-3');
            // $("#status").removeClass('col-md-2').addClass('col-md-3');
            //adding bootstrap classes
        }
        else {
            $('#postBy').show();
            $('#online-checkbox').show();
            $('#status').hide();
            //Removing bootstrap classes
            // $("#myPost").addClass('col-md-2').removeClass('col-md-3');
            // $("#postFor").addClass('col-md-2').removeClass('col-md-3');
            // $("#categories").addClass('col-md-2').removeClass('col-md-3');
            // $("#status").addClass('col-md-2').removeClass('col-md-3');
            //adding bootstrap classes
        }
    });
</script>
<script>
    // $(".fa-camera").click(function () {
    // $("input[type='file']").trigger('click');
    // });

    // $('input[type="file"]').on('change', function() {
    // var val = $(this).val();
    // $(this).siblings('span').text(val);
    // })
    $("#event_checked").change(function () {
        $("#schedule_checked").prop("checked", false);
    });
    $("#schedule_checked").change(function () {
        $("#event_checked").prop("checked", false);
    });

</script>


<!-- Rating Script START-->
<script>
    $('#input-3').rating({
        displayOnly: true,
        containerClass: 'is-star',
        showCaption: false,
        showCaptionAsTitle: true,
        hoverChangeCaption: true,
        size: 'sm',
        showClear: false,
        disabled:true

    });
    $('#input-2').rating({
        step: 0.5,
        containerClass: 'is-star',
        showCaption: false,
        showCaptionAsTitle: true,
        hoverChangeCaption: true,
        size: 'sm',
        showClear: false

    });
    $('#input-2-mobile-view').rating({
        step: 0.5,
        containerClass: 'is-star',
        showCaption: false,
        showCaptionAsTitle: true,
        hoverChangeCaption: true,
        size: 'sm',
        showClear: false

    });

    $('#ownRating,#ownRatingPopup').rating({
        displayOnly: true,
        size: 'sm',
        showCaption: true,
        hoverChangeCaption: false,
        showCaptionAsTitle: true,
        disabled: true

    });
    $('#ownRatingMobile').rating({
        displayOnly: true,
        size: 'sm',
        showCaption: false

    });
    $('.ownRatingMobileCard').rating({
        displayOnly: true,
        size: 'xs',
        showCaption: false

    });
    $('#filter-form').on('submit', function (e) {
        e.preventDefault()
        var d = {}
        d._token = "{{csrf_token()}}"
        d.input_search = $('#search_input').val()
        d.post_for = $('#postFor').val()
        d.sort = $('#filter_category').val()
        d.min = $('#filter_budget_min').val()
        d.max = $('#filter_budget_max').val()
        var name = $('#postByinp').val()
        var checkonline = $('input[name="online-checkbox-filter"]:checked').length > 0
        var checkmypost = $('input[id="myPostinp"]:checked').length > 0
        if ($('#filter_user_location').val() != "") {
            d.lat = $('#filter_user_location').attr('data-lat')
            d.lng = $('#filter_user_location').attr('data-lng')
            d.miles = $('#filter_within_miles').val()
        }
        if (checkonline) {
            d.online = 1
        }
        if (checkmypost) {
            d.mypost = 1;
        }
        if (name != "") {
            d.user = $('#postByinp').attr('data-id')
        }
        var latvar = d.lat != undefined ? d.lat : '';
        var lngvar = d.lng != undefined ? d.lng : '';
        var milesvar = d.miles != undefined ? d.miles : '';
        var onlinevar = d.online != undefined ? d.online : '';
        var mypostvar = d.mypost != undefined ? d.mypost : '';
        var uservar = d.user != undefined ? d.user : '';
        window.location = "/filter?input_search=" + d.input_search + "&post_for=" + d.post_for + "&sort=" + d.sort + "&min=" + d.min +
            "&max=" + d.max + "&user=" + uservar + "&mypost=" + mypostvar + "&online=" + onlinevar + "&lat=" + latvar + "&lng=" + lngvar + "&miles=" + milesvar;
    })

    $('#input-2').on('rating:change', function (event, value, caption) {
        console.log(value);
        var reviewableId = $("#reviewable_id").val();
        $.ajax({
            url: "{{route('review.user')}}",
            type: 'post',
            data: {
                'reviewable_id': reviewableId,
                'review_number': value,
                '_token': "{{csrf_token()}}"
            },
            dataType: 'json',
            success: function (response) {

                if (response.status == "200") {

                    getAverageTotalReview(reviewableId);
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

    });

    function getAverageTotalReview(userId) {

        $.ajax({
            url: "{{route('get.average.total.review')}}",
            type: 'post',
            data: {
                'user_id': userId,
                '_token': "{{csrf_token()}}"
            },
            dataType: 'json',
            success: function (response) {
                $('#input-3').rating('update', response.data.average_review).val();
                $(".averageReview").html(response.data.average_review);
                $(".totalReview").html(response.data.total_review);
                $('#ratingmodel').modal('hide');
            },
            error: function (error) {
                console.log(error);
            }
        });
    }
    
    $('#navbarNav .rating-stars').on('click', function (event, value){
        $('#ratingmodel').modal('show');
        //$('#input-3').rating('update', $('#input-3').val()).val();
    });
    
</script>
<!-- Rating Script END-->

@auth
    <!-- FB Share Script START-->
    <script>
        function share(userId) {
            var url = "{{ route('otherUserProfile', ['USER_ID' => "USER_ID"]) }}".replace("USER_ID", userId);
            FB.ui({
                method: 'share',
                href: url,
                app_id: "367338140128186"
            }, function (response) {
            });
        }
    </script>
    <!-- FB Share Script END -->
@endauth

{{--upload user cover photo--}}
<script type="text/javascript">
    function selectImage() {
        event.preventDefault();
        var field = document.getElementById("image_file");
        field.click();
        field.setAttribute("name", "cover");
    }

    document.getElementById('image_file').onchange = function () {
        document.getElementById('img-form').submit();
    }

    document.getElementById('avatar-img').onclick = function () {
        var field = document.getElementById("image_file");
        field.click();
        field.setAttribute("name", "profile");
    }

    function closeall() {
        $('#tbod').html('');
    };

</script>

<script type="text/javascript">
    $('#search').on('keyup', function () {

        $value = $(this).val();
        $checkSearch = "0";
        $user_screen_type = $("#user_screen_type").val();

        $.ajax({

            type: 'get',

            url: '{{URL::to('user-search')}}',

            data: {
                'search': $value,
                'checkSearch': $checkSearch,
                'user_screen_type': $user_screen_type
            },

            success: function (data) {
                $('#tbod').html(data);

            }

        });

    });

    function videoFunction() {
        var url = $("#videoId").val();
        url = url.split('v=')[1];
        $("#iframe_link")[0].src = "https://www.youtube.com/embed/" + url;
        $("#iframe_link").show();
        $('#iframe_link').val(id)
    }
</script>

<script type="text/javascript">
    tinymce.init({
        selector: '#editor',
        plugins: "link code wordcount colorpicker",
        menubar: 'false'
    });
</script>


<script>
    $('#postByinp').on('keyup', function (e) {
        $value = this.value;
        $checkSearch = "0";

        $.ajax({

            type: 'get',

            url: '{{URL::to('user-search-filter')}}',

            data: {'search': $value, 'checkSearch': $checkSearch},

            success: function (data) {
                $('#postBytbod').html(data);
                $('#postBytbod tr').on('click', function (e) {
                    var tr = this;
                    $('#postByinp').val($(tr).attr('data-name'))
                    $('#postByinp').attr('data-id', $(tr).attr('data-id'))
                    $('#postBytbod').html('')
                })

            }

        });

    });

    function initAutocomplete() {
        var input = document.getElementById('filter_user_location');
        var searchBox = new google.maps.places.SearchBox(input);
        searchBox.addListener('places_changed', function () {
            var places = searchBox.getPlaces()[0];
            $('#filter_user_location').attr('data-lat', places.geometry.location.lat())
            $('#filter_user_location').attr('data-lng', places.geometry.location.lng())
            console.log(places.geometry.location.lng())
        })
    }
</script>
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyADz6E23AjwmwfAKvIFJOnxhA6cRRF_2CM&libraries=places&callback=initAutocomplete"></script> -->