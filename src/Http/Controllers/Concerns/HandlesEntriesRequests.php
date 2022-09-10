<?php

namespace Taskday\Http\Controllers\Concerns;

use Illuminate\Support\Facades\Auth;
use Taskday\Http\Requests\StoreEntryRequest;
use Taskday\Models\Entry;

trait HandlesEntriesRequests
{
    protected function storeFromRequest(StoreEntryRequest $request): Entry
    {
        $data = $request->validated();

        return Auth::user()->createEntry($data['title']);
    }
}
