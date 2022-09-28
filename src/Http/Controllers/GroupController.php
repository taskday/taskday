<?php

namespace Taskday\Http\Controllers;

use Inertia\Inertia;
use Taskday\Models\Group;
use Inertia\Response as InertiaResponse;
use Illuminate\Http\RedirectResponse;
use Taskday\Http\Requests\StoreGroupRequest;
use Taskday\Http\Resources\GroupResource;
use Taskday\Http\Requests\UpdateGroupRequest;

class GroupController extends Controller
{
    /**
     * Show the the resource.
     */
    public function show(Group $group): InertiaResponse
    {
        $group->load('boards');

        return Inertia::render('Categories/Show', [
            'title' => $group->title,
            'group' => GroupResource::make($group)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGroupRequest $request): RedirectResponse
    {
        Group::create($request->validated());

        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function update(Group $group, UpdateGroupRequest $request): RedirectResponse
    {
        $group->update($request->validated());

        return redirect()->back();
    }
}
