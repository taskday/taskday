<?php

namespace Taskday\Plugin\Support;

use Illuminate\Support\Facades\App;

trait HasActions
{
    public function run(string $name)
    {
        if ($this->actions()->has($name)) {
            App::call([$this->actions()->get($name), 'handle'], [
                'field' => request()->route('field'),
                'entry' => request()->route('entry'),
            ]);
        }
    }
}
