<?php

namespace Taskday\Providers;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Taskday\Console\Commands\UserCreateCommand;
use Taskday\Console\Commands\UserListCommand;
use Taskday\Console\Commands\UserResetPasswordCommand;
use Taskday\Plugin\Builtin\Issue\Issue;
use Taskday\Plugin\Builtin\Login\Login;
use Taskday\Plugin\Builtin\Progress\Progress;
use Taskday\Plugin\Builtin\Table\Table;
use Taskday\Taskday;

class TaskdayServiceProvider extends ServiceProvider
{
    /**
     * We register all the services we need.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(TaskdayEventServiceProvider::class);
        $this->app->register(TaskdayAuthServiceProvider::class);
        $this->app->register(TaskdayRouteServiceProvider::class);

        $this->app->singleton('taskday', function () {
            return new Taskday();
        });

        Factory::guessFactoryNamesUsing(function ($class) {
            return 'Taskday\\Database\\Factories\\' . class_basename($class) . 'Factory';
        });

        JsonResource::withoutWrapping();
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/taskday.php', 'taskday');

        $this->registerExceptionHandler();
        $this->registerCommands();
        $this->registerViews();
        $this->registerMigrations();
        $this->registerBladeDirectives();
        $this->registerBuiltinPlugins();
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
            UserCreateCommand::class,
            UserResetPasswordCommand::class,
        ]);
    }

    public function registerBuiltinPlugins()
    {
        \Taskday\Facades\Taskday::register(new Progress());
        \Taskday\Facades\Taskday::register(new Issue());
        \Taskday\Facades\Taskday::register(new Table());
        \Taskday\Facades\Taskday::register(new Login());
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
                $offset = 1;
                foreach ($migrations as $name) {
                    $path = __DIR__ . "/../../database/migrations/$name";
                    $name = database_path('migrations/' . date('Y_m_d_His', (time() + $offset)) . "_" . substr($name, 7));
                    $offset = $offset + 1;
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
