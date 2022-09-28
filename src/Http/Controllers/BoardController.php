<?php

namespace Taskday\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use Illuminate\Http\RedirectResponse;
use Taskday\Http\Resources\BoardResource;
use Taskday\Models\Board;
use Taskday\Http\Requests\StoreBoardRequest;
use Taskday\Http\Requests\UpdateBoardRequest;
use Illuminate\Http\Request;
use Taskday\Http\Resources\FieldResource;

class BoardController extends Controller
{
    /**
     * Show the the resource.
     */
    public function show(Board $board, Request $request): InertiaResponse
    {
        $board->load(['category', 'views', 'fields', 'entries.user', 'entries.fields']);

        return Inertia::render('Boards/Show', [
            'title' => $board->title,
            'breadcrumbs' => [
                ['name' => $board->category->title, 'href' => route('boards.show', $board->category) ],
            ],
            'board' => BoardResource::make($board),
            'groups' => FieldResource::collection($board->groups()),
            'query' => [
                'group_by' => $request->has('group_by')
                    ? $board->groups()->first(fn ($f) => $f->id === $request->input('group_by'))?->id
                    : $board->groups()->first()?->id
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBoardRequest $request): RedirectResponse
    {
        Board::create($request->validated());

        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function update(Board $board, UpdateBoardRequest $request): RedirectResponse
    {
        $board->update($request->validated());

        return redirect()->back();
    }
}
