<?php

namespace Taskday\Http\Controllers;

use Taskday\Http\Requests\StoreEntryRequest;
use Illuminate\Http\RedirectResponse;

class EntryController extends Controller
{
    use \Taskday\Http\Controllers\Concerns\HandlesEntriesRequests;

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEntryRequest $request): RedirectResponse
    {
        $entry = $this->storeFromRequest($request);

        return redirect()->back();
    }
}
