<?php

namespace Taskday\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Taskday\Http\Controllers\Concerns\HandlesEntriesRequests;
use Taskday\Http\Requests\StoreBoardRequest;
use Taskday\Http\Requests\UpdateBoardRequest;
use Taskday\Http\Resources\BoardResource;
use Taskday\Models\Board;
use Taskday\Models\Filters\BoardFilter;

class BoardApiController extends Controller
{
    use HandlesEntriesRequests;

    /**
     * List all the resources.
     */
    public function index(BoardFilter $request): JsonResponse
    {
        $boards = Board::query()
            ->filter($request)
            ->with('category')
            ->latest()
            ->paginate(request('per_page', 10))
            ->through(fn ($board) => BoardResource::make($board));

        return response()->json($boards);
    }

    /**
     * Return the requested resource from storage.
     */
    public function show(Board $board): JsonResource
    {
        $this->authorize('view', $board);

        $board->load('fields');

        return BoardResource::make($board);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBoardRequest $request): JsonResponse
    {
        $board = $this->storeFromRequest($request);

        return response()->json($board, JsonResponse::HTTP_CREATED);
    }

    /**
     * Update a resource in storage.
     */
    public function update(Board $board, UpdateBoardRequest $request): Response
    {
        $this->authorize('update', $board);

        $this->updateFromRequest($board, $request);

        return response()->noContent();
    }

    /**
     * Delete the given resource from storage.
     */
    public function destroy(Board $board): Response
    {
        $this->authorize('delete', $board);

        $this->delete($board);

        return response()->noContent();
    }
}
