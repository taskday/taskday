<?php

namespace Taskday\Http\Controllers;

use Inertia\Inertia;
use Taskday\Models\Category;
use Inertia\Response as InertiaResponse;
use Illuminate\Http\RedirectResponse;
use Taskday\Http\Requests\StoreCategoryRequest;
use Taskday\Http\Resources\CategoryResource;
use Taskday\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Show the the resource.
     */
    public function show(Category $category): InertiaResponse
    {
        $this->authorize('view', $category);

        $category->load('boards');

        return Inertia::render('Categories/Show', [
            'title' => $category->title,
            'category' => CategoryResource::make($category)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        Category::create($request->validated());

        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function update(Category $category, UpdateCategoryRequest $request): RedirectResponse
    {
        $category->update($request->validated());

        return redirect()->back();
    }
}
