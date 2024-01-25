<?php

declare(strict_types=1);

namespace Ziming\LaravelEmailSniperLink;

use Detection\Exception\MobileDetectException;
use Detection\MobileDetect;
use Illuminate\Support\Str;

class LaravelEmailSniperLink
{
    /**
     * @throws MobileDetectException
     */
    public static function getSniperLinkQuick(string $receiverEmail, ?string $fromEmail = null): ?string
    {
        if (self::isGoogleEmailQuick($receiverEmail)) {
            return self::googleSniperLink($receiverEmail);
        }

        if (self::isOutlookEmailQuick($receiverEmail)) {
            return self::outlookSniperLink($receiverEmail);
        }

        if (self::isYahooEmail($receiverEmail)) {
            return self::yahooMailSniperLink($fromEmail);
        }

        if (self::isICloudEmail($receiverEmail)) {
            return self::iCloudMailSniperLink();
        }

        if (self::isProtonMail($receiverEmail)) {
            return self::protonMailSniperLink($fromEmail);
        }

        return null;
    }

    /**
     * @throws MobileDetectException
     */
    public static function getSniperLink(string $receiverEmail, ?string $fromEmail = null): ?string
    {
        $quickSniperLink = self::getSniperLinkQuick($receiverEmail, $fromEmail);

        if ($quickSniperLink !== null) {
            return $quickSniperLink;
        }

        if (self::isGoogleEmail($receiverEmail)) {
            return self::googleSniperLink($receiverEmail);
        }

        if (self::isOutlookEmailQuick($receiverEmail)) {
            return self::outlookSniperLink($receiverEmail);
        }

        return null;
    }

    /**
     * @throws MobileDetectException
     */
    public static function googleSniperLink(string $receiverEmail): string
    {
        $detect = new MobileDetect();

        if ($detect->isiPhone() || $detect->isiPad()) {
            return 'googlegmail://';
        }

        return self::googleMailDesktopSniperLink($receiverEmail);
    }

    public static function outlookSniperLink(string $receiverEmail): string
    {
        $detect = new MobileDetect();

        if ($detect->isiPhone() || $detect->isiPad()) {
            return 'ms-outlook://';
        }

        return self::outlookMailDesktopSniperLink($receiverEmail);
    }

    /**
     * @throws MobileDetectException
     */
    public static function yahooMailSniperLink(?string $fromEmail = null): string
    {
        $detect = new MobileDetect();

        if ($detect->isiPhone() || $detect->isiPad()) {
            return 'ymail://';
        }

        return self::yahooMailDesktopSniperLink($fromEmail);
    }

    /**
     * @throws MobileDetectException
     */
    public static function iCloudMailSniperLink(): string
    {
        $detect = new MobileDetect();

        if ($detect->isiPhone() || $detect->isiPad()) {
            return 'message://';
        }

        return self::iCloudMailDesktopSniperLink();
    }

    public static function googleMailDesktopSniperLink(string $receiverEmail, ?string $fromEmail = null): string
    {
        if ($fromEmail === null) {
            $fromEmail = config('mail.from.address');
        }

        $fromEmail = urlencode($fromEmail);

        return "https://mail.google.com/mail/u/{$receiverEmail}/#search/from%3A{$fromEmail}+in%3Aanywhere+newer_than%3A1d";

    }

    public static function outlookMailDesktopSniperLink(string $receiverEmail): string
    {
        return 'https://outlook.live.com/mail/?login_hint='.urlencode($receiverEmail);
    }

    public static function yahooMailDesktopSniperLink(?string $fromEmail = null): string
    {
        if ($fromEmail === null) {
            $fromEmail = config('mail.from.address');
        }

        return 'https://mail.yahoo.com/d/search/keyword=from%253A'.urlencode($fromEmail);
    }

    public static function iCloudMailDesktopSniperLink(): string
    {
        return 'https://www.icloud.com/mail';
    }

    public static function protonMailDesktopSniperLink(?string $fromEmail = null): string
    {
        if ($fromEmail === null) {
            $fromEmail = config('mail.from.address');
        }

        return 'https://mail.proton.me/u/0/all-mail#from='.urlencode($fromEmail);
    }

    public static function isGoogleEmailQuick(string $email): bool
    {
        return Str::endsWith($email, ['@gmail.com', '@google.com', '@googlemail.com']);
    }

    public static function isGoogleEmail(string $email): bool
    {
        if (self::isGoogleEmailQuick($email)) {
            return true;
        }

        $mxRecords = self::fetchMxRecords($email);

        foreach ($mxRecords as $mxRecord) {
            if (Str::endsWith($mxRecord, '.google.com')) {
                return true;
            }
        }

        return false;
    }

    public static function isOutlookEmailQuick(string $email): bool
    {
        return Str::contains($email, [
            '@outlook.', // outlook.com, outlook.sg etc
            '@hotmail.', // hotmail.com, hotmail.sg, hotmail.in etc
            '@live.com', // live.com, live.com.sg
            '@microsoft.', // microsoft.com
        ]);
    }

    public static function isOutlookEmail(string $email): bool
    {
        if (self::isOutlookEmailQuick($email)) {
            return true;
        }

        $mxRecords = self::fetchMxRecords($email);

        foreach ($mxRecords as $mxRecord) {
            if (Str::endsWith($mxRecord, '.outlook.com')) {
                return true;
            }
        }

        return false;
    }

    public static function isYahooEmail(string $email): bool
    {
        if (Str::contains($email, [
            '@yahoo.',
        ])) {
            return true;
        }

        //        $mxRecords = self::fetchMxRecords($email);
        //
        //        foreach ($mxRecords as $mxRecord) {
        //            if (Str::endsWith($mxRecord, '.yahoodns.net')) {
        //                return true;
        //            }
        //        }

        return false;
    }

    public static function isICloudEmail(string $email): bool
    {
        if (Str::contains($email, [
            '@icloud.',
        ])) {
            return true;
        }

        $mxRecords = self::fetchMxRecords($email);

        foreach ($mxRecords as $mxRecord) {
            if (Str::endsWith($mxRecord, 'icloud.com')) {
                return true;
            }
        }

        return false;
    }

    /**
     * @throws MobileDetectException
     */
    public static function protonMailSniperLink(?string $fromEmail = null): string
    {
        if ($fromEmail === null) {
            $fromEmail = config('mail.from.address');
        }

        $detect = new MobileDetect();

        if ($detect->isiPhone() || $detect->isiPad()) {
            return 'protonmail://';
        }

        return self::protonMailDesktopSniperLink($fromEmail);
    }

    public static function isProtonMail(string $email): bool
    {
        if (Str::contains($email, [
            '@protonmail.',
        ])) {
            return true;
        }

        // more advanced checks later

        return false;
    }

    public static function fetchMxRecords(string $email): array
    {
        $domain = explode('@', $email)[1];

        // return true if MX record exists
        // return false if no MX records
        getmxrr($domain, $mxRecords);

        return $mxRecords;
    }
}
