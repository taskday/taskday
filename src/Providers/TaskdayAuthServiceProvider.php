<?php

namespace Taskday\Providers;

use Illuminate\Http\Request;
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

        Fortify::resetPasswordView(function (Request $request) {
            return Inertia::render('Auth/ResetPassword', [
                'token' => $request->token,
                'email' => $request->email,
            ]);
        });

        Fortify::requestPasswordResetLinkView(function () {
            return Inertia::render('Auth/ForgotPassword');
        });

        Fortify::confirmPasswordView(function () {
            return Inertia::render('Auth/ConfirmPassword');
        });
    }
}
