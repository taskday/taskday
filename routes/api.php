<?php

use Illuminate\Support\Facades\Route;
use Taskday\Http\Controllers\EntryApiController;
use Taskday\Http\Controllers\CommentApiController;
use Taskday\Http\Controllers\SearchController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::prefix('api')->middleware(['api', 'auth:sanctum', 'verified'])->group(function () {
    Route::resource('entries', EntryApiController::class, [ 'as' => 'api' ]);
    Route::resource('entries.comments', CommentApiController::class, [ 'as' => 'api' ]);
    Route::get('search', SearchController::class)->name('api.search');
});
