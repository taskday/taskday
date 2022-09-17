<?php

use Taskday\Models\User;

beforeEach(function () {
    $this->user = createUserAndlogin();
});

test('a logged user can see their account settings', function () {
    $this->get(route('account'))->assertOk();
});

test('a logged user can update their account settings', function () {
    $data = User::factory()->make();

    $this->put(route('account.update'), [
            'first_name' => $data->first_name,
            'last_name' => $data->last_name,
            'username' => $data->username,
            'email' => $data->email,
        ])
        ->assertRedirect();

    $user = $this->user->fresh();

    expect($user->first_name)->toBe($data->first_name);
    expect($user->last_name)->toBe($data->last_name);
    expect($user->username)->toBe($data->username);
    expect($user->email)->toBe($data->email);
    expect($user->email_verified_at)->toBe(null);
});
