<?php

use Illuminate\Support\Facades\Broadcast;
use Taskday\Models\Entry;
use Taskday\Models\Comment;

/*
|--------------------------------------------------------------------------
| Channels
|--------------------------------------------------------------------------
*/

Broadcast::channel('entries.{id}', function ($user, $id) {
    return true;
});

Broadcast::channel('entries.{entry}.comments.{comment}', function ($user, Entry $entry, Comment $comment) {
    return true;
});
