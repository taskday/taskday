<?php

use Illuminate\Support\Facades\Route;
use Taskday\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Taskday\Http\Controllers\EntryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['web', 'auth:sanctum', 'verified'])->group(function () {

    Route::redirect('home', '/');

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('entries', EntryController::class);
});

/*
|--------------------------------------------------------------------------
| Assets Routes
|--------------------------------------------------------------------------
*/


if (App::environment(['local', 'testing'])) {
    $symlinkHotfile = base_path('public/hot');
    $hotfile = realpath(__DIR__ . '/../public/hot');
    if (file_exists($hotfile)) {
        exec("ln -sf $hotfile $symlinkHotfile");
    }
}

if (file_exists(__DIR__ . '/../public/build/manifest.json')) {
    $manifest = json_decode(file_get_contents(__DIR__ . '/../public/build/manifest.json'));

    foreach ($manifest as $key => $entry) {
        Route::get('/build/' . $entry->file, function () use ($entry) {
            return response()->file(__DIR__ . '/../public/build/' . $entry->file, [
                'content-type' => match (pathinfo($entry->file, PATHINFO_EXTENSION)) {
                    'js' => 'application/javascript',
                    'css' => 'text/css',
                    default => 'text/plain',
                }
            ]);
        });
    }
}
