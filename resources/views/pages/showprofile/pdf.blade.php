<!doctype html>
<head>
    <title>User Profile</title>
</head>
<body>
<img src="{{ asset('/uploads/avatars/' . $user->avatar) }}">
<p>
    {{strip_tags($user->about)}}
</p>

</body>
</html>   