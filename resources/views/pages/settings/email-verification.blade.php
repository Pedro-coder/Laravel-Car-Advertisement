<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="application-name" content="">
    <meta name="description" content="">
    <title>Account Verification</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- <link rel="stylesheet" href="{{ asset('main/Home_files/responsive.css') }}"> -->

</head>

<body>
  <section >
                <div class="container">
                <h2>Account Verification</h2>
                @if($error = session("error"))
                <div class="alert alert-danger alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <i class="fa fa-check-circle"></i> {{$error}}
                </div>
                @endif
                <p>Please check email to verfiy your account</p>
  <form method="post" >
  {{ csrf_field() }}
    <div class="form-group">
      <label for="email">Email Verification Code:</label>
      <input type="text" class="form-control" style="width:30%" id="email" placeholder="Enter Here!" name="email_code">
    </div>

    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>
                </div>
            </section>

   <!--  <script src="{{ asset('main/Home_files/jquery.themepunch.tools.min.js') }}"></script>
    <script src="{{ asset('main/Home_files/jquery.themepunch.revolution.min.js') }}"></script>
    <script src="{{ asset('main/Home_files/revolution.extension.actions.min.js') }}"></script>
    <script src="{{ asset('main/Home_files/revolution.extension.carousel.min.js') }}"></script>
    <script src="{{ asset('main/Home_files/revolution.extension.kenburn.min.js') }}"></script>
    <script src="{{ asset('main/Home_files/revolution.extension.layeranimation.min.js') }}"></script>
    <script src="{{ asset('main/Home_files/revolution.extension.migration.min.js') }}"></script>
    <script src="{{ asset('main/Home_files/revolution.extension.navigation.min.js') }}"></script>
    <script src="{{ asset('main/Home_files/revolution.extension.parallax.min.js') }}"></script>
    <script src="{{ asset('main/Home_files/revolution.extension.slideanims.min.js') }}"></script>
    <script src="{{ asset('main/Home_files/revolution.extension.video.min.js') }}"></script>
    <script src="{{ asset('main/Home_files/tether.min.js') }}"></script>
    <script src="{{ asset('main/Home_files/popper.min.js') }}"></script>
    <script src="{{ asset('main/Home_files/bootstrap.min.js') }}"></script>
    <script src="{{ asset('main/Home_files/pop-up.js') }}"></script> -->

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- <script src="{{ asset('main/Home_files/lock.js') }}"></script>
    <script src="http://thememom.com/marketplace/js/analytics.js"></script> -->

</body>

</html>
