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

// test('a new user can register', function () {

//     $factory = new UserFactory();
//     $user = $factory->make([ 'password' => bcrypt('password') ]);

//     post(route('register'), [
//         'name' => $user->name,
//         'email' => $user->email,
//         'password' => 'password',
//         'password_confirmation' => 'password'
//     ])->assertSessionDoesntHaveErrors();

//     post(route('login'), [
//         'email' => $user->email,
//         'password' => 'password'
//     ])->assertSessionDoesntHaveErrors();

//     $this->assertAuthenticated();
// });
