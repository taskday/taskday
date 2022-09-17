<?php

namespace Taskday\Http\Controllers;

use Taskday\Models\Entry;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Taskday\Models\Comment;
use Taskday\Http\Resources\CommentResource;
use Taskday\Http\Requests\UpdateCommentRequest;

class CommentApiController extends Controller
{
    public function index(Entry $entry, Request $request): JsonResponse
    {
        return response()->json(CommentResource::collection($entry->comments));
    }

    public function show(Entry $entry, Comment $comment): JsonResponse
    {
        return response()->json(CommentResource::make($comment));
    }

    public function update(Entry $entry, Comment $comment, UpdateCommentRequest $request): JsonResponse
    {
        $comment->update($request->validated());

        return response()->json(CommentResource::make($comment));
    }
}
