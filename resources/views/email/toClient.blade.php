

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">



</head>
<body>
    <img src="">
<?php 
    $user = App\User::find($msg->sender);
    if ($msg->sender > $msg->receiver) {
        $chatRoomId = $msg->receiver.','.$msg->sender;
    } else {
        $chatRoomId = $msg->sender.','.$msg->receiver;

    }    
?>


<style>
    .emailmessage{
        font-size: .90rem;
        background: rgb(201, 202, 239);
        border:1px solid rebeccapurple;
        border-radius: 10% ;
        width:100%;

    }
</style>
<h1> hello, there is  unread message for you from <b class="chtbxusername">{{$user->name}}</b> </h1><br>
<h4>The last unseen message was : 
    <div class="emailmessage card">
       <h5>  {{$msg->message}}</h5>
    </div>
</h4>
<h5 class="time">At the time of (GMT) {{$msg->created_at}}</h5><br>
<p class="alink">Please check the message</p>
<a href="{{route('privateChat',$chatRoomId)}}">here</a>
   
</body>
</html>