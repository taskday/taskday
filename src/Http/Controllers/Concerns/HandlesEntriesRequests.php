<?php

namespace Taskday\Http\Controllers\Concerns;

use Illuminate\Support\Facades\Auth;
use Taskday\Http\Requests\StoreEntryRequest;
use Taskday\Http\Requests\UpdateEntryRequest;
use Taskday\Models\Entry;
use Taskday\Http\Resources\EntryResource;
use Taskday\Models\Filters\EntryFilter;

trait HandlesEntriesRequests
{
    protected function entries(EntryFilter $request)
    {
        return Entry::query()
            ->filter($request)
            ->with('board', 'fields')
            ->owned()
            ->latest()
            ->paginate(request('per_page', 10))
            ->through(fn ($entry) => EntryResource::make($entry));
    }

    protected function storeFromRequest(StoreEntryRequest $request): Entry
    {
        $entry = Auth::user()->createEntry(
            $request->only(['title', 'board_id'])
        );

        foreach ($request->input('fields', []) as $key => $value) {
            $entry->setFieldValue($key, $value);
        }

        return $entry;
    }

    protected function updateFromRequest(Entry $entry, UpdateEntryRequest $request): void
    {
        $entry->update($request->validated());
    }

    protected function delete(Entry $entry): void
    {
        $entry->activities()->delete();

        $entry->delete();
    }
}
