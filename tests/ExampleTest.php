<?php

declare(strict_types=1);

use Ziming\LaravelEmailSniperLink\LaravelEmailSniperLink;

it('generates a gmail sniper link', function (): void {
    config()->set('mail.from.address', 'sender@example.com');

    expect(LaravelEmailSniperLink::getSniperLinkQuick('receiver@gmail.com'))
        ->toBe('https://mail.google.com/mail/u/receiver@gmail.com/#search/from%3Asender%40example.com+in%3Aanywhere+newer_than%3A1d');
});

it('registers the helper functions', function (): void {
    config()->set('mail.from.address', 'sender@example.com');

    expect(email_sniper_link_quick('receiver@yahoo.com'))
        ->toBe('https://mail.yahoo.com/d/search/keyword=from%253Asender%40example.com');
});
