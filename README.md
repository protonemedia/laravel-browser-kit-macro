# Laravel Browser Kit Macro

[![Latest Version on Packagist](https://img.shields.io/packagist/v/pbmedia/laravel-browser-kit-macro.svg?style=flat-square)](https://packagist.org/packages/pbmedia/laravel-browser-kit-macro)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/pascalbaljetmedia/laravel-browser-kit-macro/master.svg?style=flat-square)](https://travis-ci.org/pascalbaljetmedia/laravel-browser-kit-macro)
[![Quality Score](https://img.shields.io/scrutinizer/g/pascalbaljetmedia/laravel-browser-kit-macro.svg?style=flat-square)](https://scrutinizer-ci.com/g/pascalbaljetmedia/laravel-browser-kit-macro)
[![Total Downloads](https://img.shields.io/packagist/dt/pbmedia/laravel-browser-kit-macro.svg?style=flat-square)](https://packagist.org/packages/pbmedia/laravel-browser-kit-macro)

This package allows you to seamlessly use the [Browser Kit features](https://github.com/laravel/browser-kit-testing) in more modern Laravel installations.

## Requirements
* Laravel 5.4+
* PHP 7.0, 7.1 and 7.2 supported.
* Support for [Package Discovery](https://laravel.com/docs/5.5/packages#package-discovery).

## Installation

You can install the package via composer:

``` bash
composer require pbmedia/laravel-browser-kit-macro --dev
```

If you're using Laravel 5.4, add the Service Provider to your `config/app.php` file:

```php
Pbmedia\LaravelBrowserKitMacro\BrowserKitMacroServiceProvider::class,
```

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

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email pascal@pascalbaljetmedia.com instead of using the issue tracker.

## Credits

- [Pascal Baljet](https://github.com/pascalbaljet)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
