<?php

namespace Taskday\Http\Controllers;

use Inertia\Inertia;
use Taskday\Models\Field;
use Inertia\Response as InertiaResponse;
use Illuminate\Http\RedirectResponse;
use Taskday\Http\Requests\StoreFieldRequest;
use Taskday\Http\Resources\FieldResource;
use Taskday\Http\Requests\UpdateFieldRequest;

class FieldController extends Controller
{
    /**
     * Show the the resource.
     */
    public function show(Field $field): InertiaResponse
    {
        $field->load('boards');

        return Inertia::render('Categories/Show', [
            'title' => $field->title,
            'field' => FieldResource::make($field)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFieldRequest $request): RedirectResponse
    {
        Field::create($request->validated());

        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function update(Field $field, UpdateFieldRequest $request): RedirectResponse
    {
        $field->update($request->validated());

        return redirect()->back();
    }
}
