<?php

namespace Taskday\Http\Controllers;

use Inertia\Inertia;
use Taskday\Models\Field;
use Illuminate\Http\RedirectResponse;
use Taskday\Http\Requests\UpdateFieldValueRequest;
use Taskday\Models\Entry;

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
}
