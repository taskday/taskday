<?php

namespace Taskday\Http\Controllers;

use Taskday\Http\Resources\EntryResource;
use Inertia\Inertia;
use Taskday\Models\Entry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Taskday\Http\Requests\UpdateAccountRequest;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class AccountController extends Controller
{
    public function index(Request $request): \Inertia\Response
    {
        return Inertia::render('Account/Index', [
            'title' => 'Account'
        ]);
    }

    public function update(UpdateAccountRequest $request): RedirectResponse
    {
        $data = $request->validated();

        /** @var \Taskday\Models\User */
        $user = Auth::user();
        $isUpdatingEmail = $data['email'] != $user->email;

        if ($user->update($data)) {
            if ($isUpdatingEmail) {
                $user->forceFill([ 'email_verified_at' => null ])->save();
                $this->send($request);
            }
        }

        return redirect()->back();
    }

    public function send(Request $request): RedirectResponse
    {
        $request->user()->sendEmailVerificationNotification();

        return redirect()->back();
    }

    public function verify(EmailVerificationRequest $request): RedirectResponse
    {
        $request->fulfill();

        return redirect('dashboard');
    }
}
