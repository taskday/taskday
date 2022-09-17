<?php

use Illuminate\Support\Facades\Route;
use Taskday\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Taskday\Http\Controllers\EntryController;
use Taskday\Http\Controllers\CommentController;
use Taskday\Http\Controllers\AccountController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['web', 'auth:sanctum', 'verified'])->group(function () {

    Route::redirect('home', '/');

    Route::get('account', [AccountController::class, 'index'])->name('account');
    Route::put('account', [AccountController::class, 'update'])->name('account.update');
    Route::post('account/email-verify/send', [AccountController::class, 'send'])->name('account.verification.send');
    Route::get('account/email-verify/{hash}', [AccountController::class, 'verify'])->name('account.verification.verify');

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('entries', EntryController::class);

    Route::resource('entries.comments', CommentController::class)->only('store');
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
    exec("mkdir -p " . base_path('public/build/'));
    exec("ln -sf " . __DIR__ . '/../public/build/manifest.json' . " " . base_path('public/build/'));
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
