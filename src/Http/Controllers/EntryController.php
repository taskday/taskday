<?php

namespace Taskday\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Taskday\Http\Requests\StoreEntryRequest;
use Taskday\Http\Requests\UpdateEntryRequest;
use Taskday\Models\Entry;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use Taskday\Http\Resources\EntryResource;
use Taskday\Http\Controllers\Concerns\HandlesEntriesRequests;

class EntryController extends Controller
{
    use HandlesEntriesRequests;

    /**
     * List all the resources.
     */
    public function index(): InertiaResponse
    {
        $entries = Entry::with('fields')
            ->latest()
            ->paginate(request('per_page', 10))
            ->through(fn ($entry) => EntryResource::make($entry));

        return Inertia::render('Entries/Index', [
            'title' => 'All Entries',
            'entries' => $entries,
        ]);
    }

    /**
     * Show the the resource.
     */
    public function show(Entry $entry): InertiaResponse
    {
        $entry->load(['fields', 'user', 'activities.user']);

        return Inertia::render('Entries/Show', [
            'title' => $entry->title,
            'entry' => EntryResource::make($entry),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEntryRequest $request): RedirectResponse
    {
        $entry = $this->storeFromRequest($request);

        return redirect()->back();
    }

    /**
     * Update the given resource in storage.
     */
    public function update(Entry $entry, UpdateEntryRequest $request): RedirectResponse
    {
        $this->updateFromRequest($entry, $request);

        return redirect()->back();
    }

    /**
     * Delete the given resource from storage.
     */
    public function destroy(Entry $entry): RedirectResponse
    {
        $entry->activities()->delete();

        $this->delete($entry);

        return redirect()->route('entries.index');
    }
}
