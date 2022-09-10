<?php

use Illuminate\Support\Facades\Route;
use Taskday\Http\Controllers\EntryApiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::prefix('api')->middleware(['api', 'auth:sanctum', 'verified'])->group(function () {
    Route::resource('entries', EntryApiController::class, [ 'as' => 'api' ]);
});