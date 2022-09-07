<?php

namespace Taskday\Models\Concerns;

use Taskday\Models\Entry;
use Illuminate\Support\Facades\Auth;

trait CanManageEntries
{
    public function createEntry(string $title): Entry
    {
        return Entry::create([
            'title' => $title,
            'user_id' => Auth::id(),
        ]);
    }
}
