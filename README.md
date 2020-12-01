# Laravel Browser Kit Macro

[![Latest Version on Packagist](https://img.shields.io/packagist/v/pbmedia/laravel-browser-kit-macro.svg?style=flat-square)](https://packagist.org/packages/pbmedia/laravel-browser-kit-macro)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/protonemedia/laravel-browser-kit-macro/master.svg?style=flat-square)](https://travis-ci.org/protonemedia/laravel-browser-kit-macro)
[![Quality Score](https://img.shields.io/scrutinizer/g/protonemedia/laravel-browser-kit-macro.svg?style=flat-square)](https://scrutinizer-ci.com/g/protonemedia/laravel-browser-kit-macro)
[![Total Downloads](https://img.shields.io/packagist/dt/pbmedia/laravel-browser-kit-macro.svg?style=flat-square)](https://packagist.org/packages/pbmedia/laravel-browser-kit-macro)

This package allows you to seamlessly use the [Browser Kit features](https://github.com/laravel/browser-kit-testing) in more modern Laravel installations.

## Requirements
* Laravel 6.0 or higher.
* PHP 7.3 or higher.
* Support for [Package Discovery](https://laravel.com/docs/5.5/packages#package-discovery).

## Support

We proudly support the community by developing Laravel packages and giving them away for free. Keeping track of issues and pull requests takes time, but we're happy to help! If this package saves you time or if you're relying on it professionally, please consider [supporting the maintenance and development](https://github.com/sponsors/pascalbaljet).

## Installation

You can install the package via composer:

``` bash
composer require pbmedia/laravel-browser-kit-macro --dev
```

If you're not using Package Discovery, add the Service Provider to your `config/app.php` file:

```php
ProtoneMedia\LaravelBrowserKitMacro\BrowserKitMacroServiceProvider::class,
```

## Upgrading to v5

* The namespace has changed to `ProtoneMedia\LaravelBrowserKitMacro`. Please update your code accordingly.

## Usage

This package adds a `browserKit` method to the `TestResponse` class. It accepts a Closure which receives the [Browser Kit TestCase](https://github.com/laravel/browser-kit-testing/blob/master/src/TestCase.php) as its first argument.

```php
/** @test */
public function it_presents_a_registration_form()
{
    $this->get('register')
        ->assertStatus(200)
        ->browserKit(function ($test) {
            $test->seeElement('input', ['name' => 'email']);
        });
}
```

## Testing

``` bash
$ composer test
```

## Other Laravel packages

* [`Laravel Analytics Event Tracking`](https://github.com/protonemedia/laravel-analytics-event-tracking): Laravel package to easily send events to Google Analytics.
* [`Laravel Blade On Demand`](https://github.com/protonemedia/laravel-blade-on-demand): Laravel package to compile Blade templates in memory.
* [`Laravel Cross Eloquent Search`](https://github.com/protonemedia/laravel-cross-eloquent-search): Laravel package to search through multiple Eloquent models.
* [`Laravel Eloquent Scope as Select`](https://github.com/protonemedia/laravel-eloquent-scope-as-select): Stop duplicating your Eloquent query scopes and constraints in PHP. This package lets you re-use your query scopes and constraints by adding them as a subquery.
* [`Laravel FFMpeg`](https://github.com/protonemedia/laravel-ffmpeg): This package provides an integration with FFmpeg for Laravel. The storage of the files is handled by Laravel's Filesystem.
* [`Laravel Form Components`](https://github.com/protonemedia/laravel-form-components): Blade components to rapidly build forms with Tailwind CSS Custom Forms and Bootstrap 4. Supports validation, model binding, default values, translations, includes default vendor styling and fully customizable!
* [`Laravel Mixins`](https://github.com/protonemedia/laravel-mixins): A collection of Laravel goodies.
* [`Laravel Paddle`](https://github.com/protonemedia/laravel-paddle): Paddle.com API integration for Laravel with support for webhooks/events.
* [`Laravel Verify New Email`](https://github.com/protonemedia/laravel-verify-new-email): This package adds support for verifying new email addresses: when a user updates its email address, it won't replace the old one until the new one is verified.
* [`Laravel WebDAV`](https://github.com/protonemedia/laravel-webdav): WebDAV driver for Laravel's Filesystem.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email code@protone.media instead of using the issue tracker.

## Credits

- [Pascal Baljet](https://github.com/pascalbaljet)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
