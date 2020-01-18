<!DOCTYPE html>
<html>
<head>
	 <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>verify email</title>
</head>
<body>
<h2>To verify the email
 <a  href="{{route('verified_email',["email"=> $user->email, "verify_tokekn" => $user->verify_tokekn])}}">click here</a></h2>
</body>
</html>