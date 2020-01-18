<script>
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
</script>

<script>
    function share() {
        FB.ui({
            method: 'share',
            href: "{{route('otherUserProfile', $user->id)}}",
            app_id: "367338140128186"
        }, function (response) {
        });
    }
</script>