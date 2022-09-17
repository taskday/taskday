<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\ServiceProvider as InertiaServiceProvider;
use Kalnoy\Nestedset\NestedSetServiceProvider;
use Laravel\Fortify\FortifyServiceProvider;
use Laravel\Sanctum\SanctumServiceProvider;
use Taskday\Providers\TaskdayServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    use RefreshDatabase;

    protected function getPackageProviders($app): array
    {
        return [
            FortifyServiceProvider::class,
            InertiaServiceProvider::class,
            NestedSetServiceProvider::class,
            SanctumServiceProvider::class,
            TaskdayServiceProvider::class,
        ];
    }

    protected function resolveApplicationHttpKernel($app)
    {
        $app->singleton('Illuminate\Contracts\Http\Kernel', 'Tests\Stub\Http\Kernel');
    }

    protected function getEnvironmentSetUp($app)
    {
        config()->set('auth.providers.users.model', \Taskday\Models\User::class);
        config()->set('inertia.testing.page_paths', [ __DIR__ . '/../resources/pages' ]);

        foreach (glob(__DIR__ . '/../database/migrations/*.php') as $migration) {
            (require $migration)->up();
        }
    }
}
