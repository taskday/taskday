<?php

namespace Taskday\Http\Controllers;

use Taskday\Models\Entry;
use Taskday\Http\Requests\StoreCommentRequest;
use Illuminate\Http\RedirectResponse;

class CommentController extends Controller
{
    public function store(Entry $entry, StoreCommentRequest $request): RedirectResponse
    {
        $entry->createComment($request->validated()['content']);

        return redirect()->back();
    }
}
