<?php

namespace Taskday\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Taskday\Models\Activity;
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

    /**
     * Store a newly created resource in storage.
     */
    public function destroy(Field $field, Request $request): RedirectResponse
    {
        $field->values()->delete();

        Activity::where('meta_data->field_id', $field->id)->delete();

        $field->delete();

        return redirect()->back();
    }
}
