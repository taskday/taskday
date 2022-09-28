<?php

namespace Taskday\Providers;

use Laravel\Fortify\Fortify;
use Illuminate\Support\ServiceProvider;
use Taskday\Actions\Fortify\CreateNewUser;
use Taskday\Actions\Fortify\UpdateUserProfileInformation;
use Taskday\Actions\Fortify\UpdateUserPassword;
use Taskday\Actions\Fortify\ResetUserPassword;
use Inertia\Inertia;

class TaskdayAuthServiceProvider extends ServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        Fortify::verifyEmailView(function () {
            return Inertia::render('Auth/Verify');
        });
    }
}
