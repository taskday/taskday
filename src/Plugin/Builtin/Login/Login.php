<?php

namespace Taskday\Plugin\Builtin\Login;

use Illuminate\Support\Collection;
use Taskday\Plugin\Plugin;
use Taskday\Plugin\Types\WidgetType;

class Login extends Plugin
{
    public string $type = 'login-plugin';

    public string $description = 'This built-in plugin add a dummy widget';

    public function widgets(): Collection
    {
        return new Collection([
            new class extends WidgetType {
                public string $type = 'login';

                public function boot()
                {
                    //
                }
            }
        ]);
    }
}
