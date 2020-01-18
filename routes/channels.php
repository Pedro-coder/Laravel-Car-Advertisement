<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/
Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int)$user->id === (int)$id;
});
Broadcast::channel('chat', function ($user) {
    return ['name' => $user->name];
});
Broadcast::channel('chat-roomId-{chatRoomId}', function ($user, $chtroom) {
    $chtroom = App\Chatroom::find($chtroom);
    if (in_array(auth()->user()->id, explode(',', $chtroom->chatRoomId))) {
        return true;
    } else {
        return false;
    }
});

Broadcast::channel('online-{roomId}', function ($user, $roomId) {
    return true;
});
Broadcast::channel('messagesent-{receiver}', function ($user, $receiver) {


    return true;

});