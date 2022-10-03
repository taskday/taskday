<?php

namespace Taskday\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Taskday\Http\Controllers\Concerns\HandlesEntriesRequests;
use Taskday\Http\Resources\EntryResource;
use Taskday\Http\Resources\UserResource;
use Taskday\Models\Filters\UserFilter;

class UserApiController extends Controller
{
    use HandlesEntriesRequests;

    /**
     * List all the resources.
     */
    public function index(UserFilter $request): JsonResponse
    {
        $users =  config('taskday.user.model')::query()
            ->filter($request)
            ->get()
            ->map(fn ($entry) => UserResource::make($entry));

        return response()->json($users);
    }
}
