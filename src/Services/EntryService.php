<?php

namespace Taskday\Services;

use Illuminate\Support\Facades\Auth;
use Taskday\Http\Requests\StoreEntryRequest;
use Taskday\Http\Requests\UpdateEntryRequest;
use Taskday\Models\Entry;

class EntryService
{
    public function store(StoreEntryRequest $request): Entry
    {
        // @phpstan-ignore-next-line
        $entry = Auth::user()->createEntry(
            $request->only(['title', 'board_id', 'content'])
        );

        foreach ($request->input('fields', []) as $key => $value) {
            $entry->setFieldValue($key, $value);
        }

        return $entry;
    }

    public function update(Entry $entry, UpdateEntryRequest $request): void
    {
        $entry->update($request->validated());
    }

    public function delete(Entry $entry): void
    {
        $entry->activities()->delete();

        $entry->delete();
    }
}
