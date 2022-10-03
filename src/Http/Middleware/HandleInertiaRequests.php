<?php

namespace Taskday\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Illuminate\Support\Facades\Auth;
use Taskday\Http\Resources\BoardResource;
use Taskday\Http\Resources\UserResource;
use Taskday\Http\Resources\CategoryResource;
use Taskday\Models\Board;
use Taskday\Models\Category;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'taskday::app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request)
    {
        return array_merge(parent::share($request), [
            'csrf_token' => function () {
                return csrf_token();
            },
            'user' => function () {
                return Auth::check() ? UserResource::make(Auth::user()) : null;
            },
            'sidebar' => [
                'show_boards' => function () {
                    return request()->route()->getName() == 'boards.show';
                },
                'items' => function () {

                    if (! Auth::check()) {
                        return [];
                    }

                    if (request()->route()->getName() == 'boards.show') {
                        $board = request()->route('board');
                        $board->category->load('boards');
                        return [CategoryResource::make($board->category)];
                    }

                    return Category::query()
                        ->with('boards')
                        ->whereHas('boards', function ($board) {
                            $board->sharedWithCurrentUser();
                        })
                        ->orWhere('user_id', Auth::id())
                        ->orderBy('title')
                        ->get()
                        ->map(fn ($entry) => CategoryResource::make($entry));
                }
            ]
        ]);
    }
}
