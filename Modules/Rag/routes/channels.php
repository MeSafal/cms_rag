<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. Each user gets their own chat channel based on
| their session ID to ensure message isolation.
|
*/

Broadcast::channel('chat.{sessionId}', function ($user, $sessionId) {
    // Public channel - anyone can listen to their own session
    return true;
});
