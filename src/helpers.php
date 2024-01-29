<?php

declare(strict_types=1);

use Ziming\LaravelEmailSniperLink\LaravelEmailSniperLink;

if (! function_exists('email_sniper_link_quick')) {
    function sniper_link_quick(string $receiverEmail, ?string $fromEmail = null): ?string
    {
        return LaravelEmailSniperLink::getSniperLinkQuick($receiverEmail, $fromEmail);
    }
}

if (! function_exists('email_sniper_link')) {
    /**
     * @throws Detection\Exception\MobileDetectException
     */
    function email_sniper_link(string $receiverEmail, ?string $fromEmail = null): ?string
    {
        return LaravelEmailSniperLink::getSniperLink($receiverEmail, $fromEmail);
    }
}
