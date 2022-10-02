<?php

use Illuminate\Support\Facades\Route;
use Taskday\Http\Controllers\EntryApiController;
use Taskday\Http\Controllers\CommentApiController;
use Taskday\Http\Controllers\NotificationApiController;
use Taskday\Http\Controllers\SearchController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::prefix('api')->middleware(['api', 'auth:sanctum', 'verified'])->group(function () {
    Route::resource('entries', EntryApiController::class, [ 'as' => 'api' ]);
    Route::resource('entries.comments', CommentApiController::class, [ 'as' => 'api' ]);

    // Search entries
    Route::get('search', SearchController::class)->name('api.search');

    // Notifications
    Route::get('notifications', [NotificationApiController::class, 'index'])->name('api.notifications.index');
    Route::post('notifications', [NotificationApiController::class, 'store'])->name('api.notifications.store');
    Route::patch('notifications/{id}/read', [NotificationApiController::class, 'markAsRead'])->name('api.notifications.read');
    Route::post('notifications/mark-all-read', [NotificationApiController::class, 'markAllRead'])->name('api.notifications.readAll');
    Route::post('notifications/{id}/dismiss', [NotificationApiController::class, 'dismiss'])->name('api.notifications.destroy');
});
