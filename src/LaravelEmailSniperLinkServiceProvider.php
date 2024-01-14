<?php

namespace Ziming\LaravelEmailSniperLink;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Ziming\LaravelEmailSniperLink\Commands\LaravelEmailSniperLinkCommand;

class LaravelEmailSniperLinkServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-email-sniper-link')
            ->hasConfigFile();
    }
}
