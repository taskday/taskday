<?php

namespace Taskday\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Taskday\Http\Controllers\Concerns\HandlesEntriesRequests;
use Taskday\Http\Requests\StoreEntryRequest;
use Illuminate\Http\Request;
use Taskday\Models\Entry;
use Taskday\Http\Resources\EntryResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Taskday\Http\Requests\UpdateEntryRequest;
use Illuminate\Http\Response;

class EntryApiController extends Controller
{
    use HandlesEntriesRequests;

    /**
     * Return the requested resource from storage.
     */
    public function show(Entry $entry): JsonResource
    {
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
        $entry = $this->updateFromRequest($entry, $request);

        return response()->noContent();
    }

    /**
     * Delete the given resource from storage.
     */
    public function destroy(Entry $entry): Response
    {
        $this->delete($entry);

        return response()->noContent();
    }
}
