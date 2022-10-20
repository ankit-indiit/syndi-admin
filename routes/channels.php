<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Auth;
use App\Models\Msg;

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

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chat-room', function ($sender_phone, $message) {
    return [
        "sender_phone" => $sender_phone,
        "message" => $message,
    ];
});

Broadcast::channel('Msg.{id}', function ($msg, $id) {
    return (int) $msg->id === (int) $id;
});

// this channel means only msgs from the msgs table can listen to it
Broadcast::channel('msgs.{msgId}', function ($user, $msgId) {
    // return (int) $msg->id === (int) $id;
    return $user->phone === Msg::findOrNew($msgId)->receiver_phone;
});
// },['guards' => ['msgs']]); // the guard here makes sure it authenticates from msgs table
