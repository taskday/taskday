<?php

use Taskday\Models\User;

use function Pest\Laravel\post;

test('a registed user can login', function () {

    $user = User::factory()->create([ 'password' => bcrypt('password') ]);

    post(route('login'), [
        'email' => $user->email,
        'password' => 'password'
    ]);

    $this->assertAuthenticated();
});
