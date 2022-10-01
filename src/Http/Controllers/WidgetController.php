<?php

namespace Taskday\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use Illuminate\Http\RedirectResponse;
use Taskday\Http\Resources\WidgetResource;
use Taskday\Models\Widget;
use Taskday\Http\Requests\StoreWidgetRequest;
use Taskday\Http\Requests\UpdateWidgetRequest;

class WidgetController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWidgetRequest $request): RedirectResponse
    {
        Widget::create($request->validated());

        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function update(Widget $widget, UpdateWidgetRequest $request): RedirectResponse
    {
        $widget->update($request->validated());

        return redirect()->back();
    }

    /**
     * Delete the given widget.
     */
    public function destroy(Widget $widget): RedirectResponse
    {
        $widget->delete();

        return redirect()->back();
    }
}
