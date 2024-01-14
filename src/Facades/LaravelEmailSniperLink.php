<?php

namespace Ziming\LaravelEmailSniperLink\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Ziming\LaravelEmailSniperLink\LaravelEmailSniperLink
 */
class LaravelEmailSniperLink extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Ziming\LaravelEmailSniperLink\LaravelEmailSniperLink::class;
    }
}
