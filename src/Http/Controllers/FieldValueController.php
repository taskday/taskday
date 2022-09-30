<?php

namespace Taskday\Http\Controllers;

use Inertia\Inertia;
use Taskday\Models\Field;
use Illuminate\Http\RedirectResponse;
use Taskday\Http\Requests\UpdateFieldValueRequest;
use Taskday\Models\Entry;
use Taskday\Http\Requests\ActionFieldValueRequest;

class FieldValueController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function update(Entry $entry, Field $field, UpdateFieldValueRequest $request): RedirectResponse
    {
        $entry->setFieldValue($field, $request->validated()['value']);

        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function action(Entry $entry, Field $field, ActionFieldValueRequest $request): RedirectResponse
    {
        $field->getFieldType()->run($request->input('name'));

        return redirect()->back();
    }
}
