<?php

namespace Taskday\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static self register(AbstractPlugin $plugin)
 */
class Taskday extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \Taskday\Taskday::class;
    }
}
