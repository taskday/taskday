<?php

namespace Taskday\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Taskday\Http\Requests\StoreEntryRequest;
use Taskday\Http\Requests\UpdateEntryRequest;
use Taskday\Models\Board;
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
        $entries = $this->entries();

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
        $this->authorize('view', $entry);

        $entry->load(['fields', 'user', 'activities.user', 'board.fields']);

        $breadcrumbs = [
            ['name' => $entry->board->title, 'href' => route('boards.show', $entry->board) ],
        ];

        return Inertia::render('Entries/Show', [
            'title' => $entry->title,
            'breadcrumbs' => array_reverse($breadcrumbs),
            'entry' => EntryResource::make($entry),
        ]);
    }

    public function showWithModal(Board $board, Entry $entry)
    {
        $this->authorize('view', $entry);

        $entry->load(['fields', 'user', 'activities.user', 'board.fields']);

        $breadcrumbs = [
            ['name' => $entry->board->title, 'href' => route('boards.show', $entry->board) ],
        ];

        return Inertia::modal('Entries/Show', [
            'title' => $entry->title,
            'breadcrumbs' => array_reverse($breadcrumbs),
            'entry' => EntryResource::make($entry),
        ])
        ->baseRoute('boards.show', $board);
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
        $this->authorize('delete', $entry);

        $this->delete($entry);

        return redirect()->back();
    }
}
