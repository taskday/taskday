<?php

use Taskday\Models\User;

test('a logged user can see their account settings', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('account'))
        ->assertOk();
});

test('a logged user can update their account settings', function () {
    $user = User::factory()->create();
    $data = User::factory()->make();

    $this->actingAs($user)
        ->put(route('account.update'), [
            'first_name' => $data->first_name,
            'last_name' => $data->last_name,
            'username' => $data->username,
            'email' => $data->email,
        ])
        ->assertRedirect();

    $user = $user->fresh();

    expect($user->first_name)->toBe($data->first_name);
    expect($user->last_name)->toBe($data->last_name);
    expect($user->username)->toBe($data->username);
    expect($user->email)->toBe($data->email);
    expect($user->email_verified_at)->toBe(null);
});
