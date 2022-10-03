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
use Taskday\Models\Filters\EntryFilter;
use Taskday\Services\EntryService;

class EntryController extends Controller
{
    public function __construct(
        protected EntryService $entryService
    ) {
    }

    public function index(EntryFilter $request): InertiaResponse
    {
        $this->authorize('viewAny', Entry::class);

        $entries = Entry::query()
            ->filter($request)
            ->with('board.category', 'fields')
            ->paginated();

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
        $entry = $this->entryService->store($request);

        return redirect()->back();
    }

    /**
     * Update the given resource in storage.
     */
    public function update(Entry $entry, UpdateEntryRequest $request): RedirectResponse
    {
        $this->entryService->update($entry, $request);

        return redirect()->back();
    }

    /**
     * Delete the given resource from storage.
     */
    public function destroy(Entry $entry): RedirectResponse
    {
        $this->authorize('delete', $entry);

        $this->entryService->delete($entry);

        return redirect()->route('boards.show', $entry->board);
    }
}
