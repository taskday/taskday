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

class EntryApiController extends Controller
{
    use HandlesEntriesRequests;

    /**
     * List all the resources.
     */
    public function index(): JsonResponse
    {
        $entries = $this->entries();

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
        $entry = $this->storeFromRequest($request);

        return response()->json($entry, JsonResponse::HTTP_CREATED);
    }

    /**
     * Update a resource in storage.
     */
    public function update(Entry $entry, UpdateEntryRequest $request): Response
    {
        $this->authorize('update', $entry);

        $this->updateFromRequest($entry, $request);

        return response()->noContent();
    }

    /**
     * Delete the given resource from storage.
     */
    public function destroy(Entry $entry): Response
    {
        $this->authorize('delete', $entry);

        $this->delete($entry);

        return response()->noContent();
    }
}
