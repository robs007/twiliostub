<?php

namespace Robs007\Twiliostub\Facades;

use Illuminate\Support\Facades\Facade;

class Twiliostub extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'twiliostub';
    }
}
