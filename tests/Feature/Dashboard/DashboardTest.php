<?php

use Taskday\Models\User;
use Inertia\Testing\AssertableInertia;

test('a logged user can view the dashboard and the title', function () {
    $this->withoutExceptionHandling();

    $this->actingAs(User::factory()->create())
        ->get(route('dashboard'))
        ->assertInertia(fn (AssertableInertia $page) => $page
            ->component('Dashboard/Index')
            ->where('title', 'Dashboard'));
});
