<?php

namespace Taskday\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Taskday\Http\Resources\EntryResource;
use Taskday\Models\Entry;
use Taskday\Models\Filters\EntryFilter;

class SearchController extends Controller
{
    public function __invoke(EntryFilter $request): JsonResponse
    {
        $entries = Entry::query()
            ->filter($request)
            ->get();

        return response()->json(
            EntryResource::collection($entries)
        );
    }
}
