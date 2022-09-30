<?php

namespace Taskday\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Taskday\Http\Resources\EntryResource;
use Taskday\Models\Entry;
use Taskday\Http\Requests\StoreCommentRequest;
use Illuminate\Http\RedirectResponse;

class SearchController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $ids = Entry::search($request->input('query'))->get()->pluck('id');

        $entries = Entry::query()
            ->whereIn('id', $ids)
            ->get();

        return response()->json(
            EntryResource::collection($entries)
        );
    }
}
