<?php

namespace Taskday\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Request;
use Taskday\Facades\Taskday;
use Taskday\Http\Requests\StoreEntryRequest;
use Taskday\Http\Requests\UpdateEntryRequest;
use Taskday\Models\Board;
use Taskday\Models\Entry;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use Taskday\Http\Resources\EntryResource;
use Taskday\Models\Filter;
use Taskday\Models\Filters\EntryFilter;
use Taskday\Services\EntryService;

class EntryController extends Controller
{
    public function __construct(
        protected EntryService $entryService
    ) {
    }

    public function index(EntryFilter $filters, \Illuminate\Http\Request $request): InertiaResponse
    {
        $this->authorize('viewAny', Entry::class);

        $entries = Entry::query()
            ->filter($filters)
            ->withFilters()
            ->with('board.category', 'fields')
            ->paginated();

        return Inertia::render('Entries/Index', [
            'title' => 'All Entries',
            'query' => [
                'filters' => Filter::all()->map(function (Filter $filter) {
                    return [
                        'id' => $filter->id,
                        'type' => $filter->type,
                        'operator' => $filter->operator,
                        'column' => $filter->column,
                        'value' => $filter->value,
                        'operators' => $filter->getFilterType()->operators()
                    ];
                })
            ],
            'filters' => Taskday::filters(),
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
            ['name' => $entry->board->category->title, 'href' => route('categories.show', $entry->board->category) ],
            ['name' => $entry->board->title, 'href' => route('boards.show', $entry->board) ],
        ];

        return Inertia::render('Entries/Show', [
            'title' => $entry->title,
            'breadcrumbs' => $breadcrumbs,
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
