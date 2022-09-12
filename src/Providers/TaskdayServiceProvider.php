<?php

namespace Taskday\Providers;

use Illuminate\Support\ServiceProvider;
use Taskday\Taskday;
use Illuminate\Support\Facades\Blade;
use Illuminate\Database\Eloquent\Factories\Factory;
use Taskday\Console\Commands\UserListCommand;
use Taskday\Console\Commands\UserPasswordResetCommand;
use Taskday\Console\Commands\UserNewCommand;

class TaskdayServiceProvider extends ServiceProvider
{
    /**
     * We register all the services we need.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('taskday', function () {
            return new Taskday();
        });

        Factory::guessFactoryNamesUsing(function ($class) {
            return 'Taskday\\Database\\Factories\\' . class_basename($class) . 'Factory';
        });
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'taskday');
        $this->registerExceptionHandler();
        $this->registerCommands();
        $this->registerViews();
        $this->registerMigrations();
        $this->registerBladeDirectives();
    }

    public function registerExceptionHandler()
    {
        $this->app->singleton(
            Illuminate\Contracts\Debug\ExceptionHandler::class,
            Taskday\Exceptions\Handler::class
        );
    }

    public function registerViews(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'taskday');
    }

    public function registerCommands()
    {
        $this->commands([
            UserListCommand::class,
            UserNewCommand::class,
            UserPasswordResetCommand::class,
        ]);
    }

    public function registerMigrations(): void
    {
        if ($this->app->runningInConsole()) {
            $migrations = collect(glob(__DIR__ . '/../../database/migrations/*'))
                ->map('realpath')
                ->map('basename')
                ->filter(function ($path) {
                    return count(glob(database_path('migrations/*' . substr($path, 7)))) == 0;
                });

            if (count($migrations) > 0) {
                foreach ($migrations as $name) {
                    $path = __DIR__ . "/../../database/migrations/$name";
                    $name = database_path('migrations/' . date('Y_m_d_His', (time() + 1)) . "_" . substr($name, 7));

                    $this->publishes([ $path => $name ], 'taskday-migrations');
                }
            }
        }
    }

    protected function registerBladeDirectives(): void
    {
        Blade::directive('taskday', function ($expression) {
            return <<<EOT

            EOT;
        });
    }
}
