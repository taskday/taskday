<?php

namespace Taskday\Http\Controllers;
use Taskday\Models\Entry;
use Illuminate\Http\Client\Request;
use Illuminate\Http\JsonResponse;

class CommentApiController extends Controller
{
    /**
     * List all the resources for the given entry.
     */
    public function index(Entry $entry, Request $request): JsonResponse
    {
        return response()->json([]);
    }
}
