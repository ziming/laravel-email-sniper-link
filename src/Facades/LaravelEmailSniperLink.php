<?php

declare(strict_types=1);

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
