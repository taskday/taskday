<?php

namespace Taskday\Http\Controllers;

use Inertia\Inertia;
use Taskday\Models\Widget;

class DashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard/Index', [
            'title' => 'Dashboard',
            'widgets' => Widget::query()->owned()->get(),
        ]);
    }
}
