<?php

namespace Taskday\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Taskday\Http\Controllers\Concerns\HandlesEntriesRequests;
use Taskday\Http\Requests\StoreEntryRequest;
use Taskday\Http\Requests\UpdateEntryRequest;
use Taskday\Http\Resources\EntryResource;
use Taskday\Models\Entry;
use Taskday\Models\Filters\EntryFilter;
use Taskday\Services\EntryService;

class EntryApiController extends Controller
{
    public function __construct(
        protected EntryService $entryService
    ) {
    }

    /**
     * List all the resources.
     */
    public function index(EntryFilter $request): JsonResponse
    {
        $this->authorize('viewAny', Entry::class);

        $entries = Entry::query()
            ->filter($request)
            ->with('board.category', 'fields')
            ->paginated();

        return response()->json($entries);
    }

    /**
     * Return the requested resource from storage.
     */
    public function show(Entry $entry): JsonResource
    {
        $this->authorize('view', $entry);

        $entry->load('fields');

        return EntryResource::make($entry);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEntryRequest $request): JsonResponse
    {
        $entry = $this->entryService->store($request);

        return response()->json($entry, JsonResponse::HTTP_CREATED);
    }

    /**
     * Update a resource in storage.
     */
    public function update(Entry $entry, UpdateEntryRequest $request): Response
    {
        $this->entryService->update($entry, $request);

        return response()->noContent();
    }

    /**
     * Delete the given resource from storage.
     */
    public function destroy(Entry $entry): Response
    {
        $this->authorize('delete', $entry);

        $this->entryService->delete($entry);

        return response()->noContent();
    }
}
