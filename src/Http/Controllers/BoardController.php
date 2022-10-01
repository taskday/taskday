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
    public function edit(Board $board)
    {
        $this->authorize('update', $board);

        $board->load('members');

        return Inertia::render('Boards/Edit', [
            'title' => 'Edit ' . $board->title,
            'board' => $board,
        ]);
    }

    /**
     * Show the the resource.
     */
    public function show(Board $board, Request $request): InertiaResponse
    {
        $this->authorize('view', $board);

        $board->load(['category', 'views', 'fields', 'entries.user', 'entries.fields', 'entries.activities.user', 'entries' => function ($entries) {
            $entries->withCount('comments');
        }]);

        return Inertia::render('Boards/Show', [
            'title' => $board->title,
            'breadcrumbs' => [
                ['name' => $board->category->title, 'href' => route('categories.show', $board->category) ],
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
        $this->authorize('create', Board::class);

        Board::create($request->validated());

        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function update(Board $board, UpdateBoardRequest $request): RedirectResponse
    {
        $this->authorize('update', $board);

        $board->update($request->validated());

        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function destroy(Board $board): RedirectResponse
    {
        $this->authorize('delete', $board);

        $board->fields()->delete();
        $board->entries()->delete();
        $board->delete();

        return redirect()->route('categories.show', $board->category);
    }

    /**
     * Update users members.
     */
    public function updateMembers(Request $request, Board $board)
    {
        $this->authorize('update', $board);

        $data = $request->validate([
            'members' => 'array'
        ]);

        $board->syncMembers($data['members']);

        return redirect()->back();
    }
}
