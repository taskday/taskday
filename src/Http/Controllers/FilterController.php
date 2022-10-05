<?php

namespace Taskday\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use Illuminate\Http\RedirectResponse;
use Taskday\Http\Resources\FilterResource;
use Taskday\Models\Filter;
use Taskday\Http\Requests\StoreFilterRequest;
use Taskday\Http\Requests\UpdateFilterRequest;

class FilterController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFilterRequest $request): RedirectResponse
    {
        Filter::create($request->validated());

        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function update(Filter $filter, UpdateFilterRequest $request): RedirectResponse
    {
        $filter->update($request->validated());

        return redirect()->back();
    }

    /**
     * Delete the given filter.
     */
    public function destroy(Filter $filter): RedirectResponse
    {
        $filter->delete();

        return redirect()->back();
    }
}
