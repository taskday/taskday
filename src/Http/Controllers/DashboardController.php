<?php

namespace Taskday\Http\Controllers;

use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard/Index', [
            'title' => 'Dashboard'
        ]);
    }
}
