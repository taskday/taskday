<?php

namespace Taskday\Models\Concerns;

use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use NotificationChannels\WebPush\HasPushSubscriptions;
use Taskday\Models\Board;
use Taskday\Models\Entry;
use Illuminate\Support\Facades\Auth;
use Taskday\Models\Member;

trait CanManageEntries
{
    use HasPushSubscriptions;

    public function createEntry(array $data): Entry
    {
        $data['user_id'] = Auth::id();

        $entry = Entry::create($data);

        return $entry;
    }

    public function sharedBoards(): HasManyThrough
    {
        return $this->hasManyThrough(Board::class, Member::class, 'user_id', 'id', 'id', 'memberable_id')
            ->where('memberable_type', Board::class)->distinct();
    }
}
