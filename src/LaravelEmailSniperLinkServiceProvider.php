<?php

declare(strict_types=1);

namespace Ziming\LaravelEmailSniperLink;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelEmailSniperLinkServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-email-sniper-link')
            ->hasConfigFile();
    }
}
