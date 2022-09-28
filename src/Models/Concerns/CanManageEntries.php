<?php

namespace Taskday\Models\Concerns;

use Taskday\Models\Entry;
use Illuminate\Support\Facades\Auth;

trait CanManageEntries
{
    public function createEntry(array $data): Entry
    {
        $data['user_id'] = Auth::id();

        $entry = Entry::create($data);

        return $entry;
    }
}
