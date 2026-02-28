# Laravel Browser Kit Macro

[![Latest Version on Packagist](https://img.shields.io/packagist/v/pbmedia/laravel-browser-kit-macro.svg?style=flat-square)](https://packagist.org/packages/pbmedia/laravel-browser-kit-macro)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Quality Score](https://img.shields.io/scrutinizer/g/protonemedia/laravel-browser-kit-macro.svg?style=flat-square)](https://scrutinizer-ci.com/g/protonemedia/laravel-browser-kit-macro)
[![Total Downloads](https://img.shields.io/packagist/dt/pbmedia/laravel-browser-kit-macro.svg?style=flat-square)](https://packagist.org/packages/pbmedia/laravel-browser-kit-macro)

This package allows you to seamlessly use the [Browser Kit features](https://github.com/laravel/browser-kit-testing) in more modern Laravel installations.

## Requirements
* Laravel 10
* PHP 8.2 or higher

## Sponsor Us

[<img src="https://inertiaui.com/visit-card.jpg" />](https://inertiaui.com/inertia-table?utm_source=github&utm_campaign=laravel-browser-kit-macro)

❤️ We proudly support the community by developing Laravel packages and giving them away for free. If this package saves you time or if you're relying on it professionally, please consider [sponsoring the maintenance and development](https://github.com/sponsors/pascalbaljet) and check out our latest premium package: [Inertia Table](https://inertiaui.com/inertia-table?utm_source=github&utm_campaign=laravel-browser-kit-macro). Keeping track of issues and pull requests takes time, but we're happy to help!

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

* [`Inertia Table`](https://inertiaui.com/inertia-table?utm_source=github&utm_campaign=laravel-browser-kit-macro): The Ultimate Table for Inertia.js with built-in Query Builder.
* [`Laravel Blade On Demand`](https://github.com/protonemedia/laravel-blade-on-demand): Laravel package to compile Blade templates in memory.
* [`Laravel Cross Eloquent Search`](https://github.com/protonemedia/laravel-cross-eloquent-search): Laravel package to search through multiple Eloquent models.
* [`Laravel Eloquent Scope as Select`](https://github.com/protonemedia/laravel-eloquent-scope-as-select): Stop duplicating your Eloquent query scopes and constraints in PHP. This package lets you re-use your query scopes and constraints by adding them as a subquery.
* [`Laravel FFMpeg`](https://github.com/protonemedia/laravel-ffmpeg): This package provides an integration with FFmpeg for Laravel. The storage of the files is handled by Laravel's Filesystem.
* [`Laravel MinIO Testing Tools`](https://github.com/protonemedia/laravel-minio-testing-tools): Run your tests against a MinIO S3 server.
* [`Laravel Mixins`](https://github.com/protonemedia/laravel-mixins): A collection of Laravel goodies.
* [`Laravel Paddle`](https://github.com/protonemedia/laravel-paddle): Paddle.com API integration for Laravel with support for webhooks/events.
* [`Laravel Task Runner`](https://github.com/protonemedia/laravel-task-runner): Write Shell scripts like Blade Components and run them locally or on a remote server.
* [`Laravel Verify New Email`](https://github.com/protonemedia/laravel-verify-new-email): This package adds support for verifying new email addresses: when a user updates its email address, it won't replace the old one until the new one is verified.
* [`Laravel XSS Protection`](https://github.com/protonemedia/laravel-xss-protection): Laravel Middleware to protect your app against Cross-site scripting (XSS). It sanitizes request input, and it can sanatize Blade echo statements.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email code@protone.media instead of using the issue tracker.

## Credits

- [Pascal Baljet](https://github.com/pascalbaljet)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
