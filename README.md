# Laravel Email Sniper Link

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ziming/laravel-email-sniper-link.svg?style=flat-square)](https://packagist.org/packages/ziming/laravel-email-sniper-link)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/ziming/laravel-email-sniper-link/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/ziming/laravel-email-sniper-link/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/ziming/laravel-email-sniper-link/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/ziming/laravel-email-sniper-link/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/ziming/laravel-email-sniper-link.svg?style=flat-square)](https://packagist.org/packages/ziming/laravel-email-sniper-link)

This package helps you generate a sniper link for your email. Which makes it a lot easier for people to find your email.

For a quick explainer on what is an email sniper link, you can check out this link below.

https://growth.design/sniper-link

A common use case is for your verify email page.

This package currently generate email sniper links for
- Google Mail
- Outlook
- Yahoo Mail
- Proton Mail
- iCloud Mail

## Support us

You can make a donation or make a PR

## Installation

You can install the package via composer:

```bash
composer require ziming/laravel-email-sniper-link
```

## Usage

```php
use Ziming\LaravelEmailSniperLink\LaravelEmailSniperLink;

// This just do a quick guess based on the ending email address such as gmail.com, outlook.com, icloud.com etc.
LaravelEmailSniperLink::getSniperLinkQuick('receiver@gmail.com', 'optional-from-email-that-proton-mail-uses@gmail.com')

// This will do a more accurate guess by not only checking the ending email address but also the MX record of the email address
// if the email address domain is not 1 of the common ones.
// Which is more useful for business emails. But it does make network calls to fetch the MX records, so it is a little slower
LaravelEmailSniperLink::getSniperLink('receiver@gmail.com', 'optional-from-email@gmail.com')
```

The `LaravelEmailSniperLink` class has more static methods as well which might be useful for you.

Some helper functions are also available. For now there are 2. 

```php
// This just do a quick guess based on the ending email address such as gmail.com, outlook.com, icloud.com etc.
email_sniper_link_quick(string $receiverEmail, ?string $fromEmail = null);

// This will do a more accurate guess by not only checking the ending email address but also the MX record of the email address
// if the email address domain is not 1 of the common ones.
// Which is more useful for business emails. But it does make network calls to fetch the MX records, so it is a little slower
email_sniper_link(string $receiverEmail, ?string $fromEmail = null);

```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [ziming](https://github.com/ziming)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
