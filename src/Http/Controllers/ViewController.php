<?php

namespace Taskday\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use Illuminate\Http\RedirectResponse;
use Taskday\Http\Resources\ViewResource;
use Taskday\Models\View;
use Taskday\Http\Requests\StoreViewRequest;
use Taskday\Http\Requests\UpdateViewRequest;

class ViewController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreViewRequest $request): RedirectResponse
    {
        View::create($request->validated());

        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function update(View $view, UpdateViewRequest $request): RedirectResponse
    {
        $view->update($request->validated());

        return redirect()->back();
    }

    /**
     * Delete the given view.
     */
    public function destroy(View $view): RedirectResponse
    {
        $view->delete();

        return redirect()->back();
    }
}
