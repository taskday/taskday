<?php

namespace Taskday\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Taskday\Http\Controllers\Concerns\HandlesEntriesRequests;
use Taskday\Http\Requests\StoreEntryRequest;
use Illuminate\Http\Request;
use Taskday\Models\Entry;
use Taskday\Http\Resources\EntryResource;
use Illuminate\Http\Resources\Json\JsonResource;

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
}
