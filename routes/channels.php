<?php

/*
|--------------------------------------------------------------------------
| Channels
|--------------------------------------------------------------------------
*/

Broadcast::channel('entries.{id}', function ($user, $id) {
    return true;
});
