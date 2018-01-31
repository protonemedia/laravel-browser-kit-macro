# Laravel Browser Kit Macro

[![Latest Version on Packagist](https://img.shields.io/packagist/v/pbmedia/laravel-browser-kit-macro.svg?style=flat-square)](https://packagist.org/packages/pbmedia/laravel-browser-kit-macro)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/pascalbaljetmedia/laravel-browser-kit-macro/master.svg?style=flat-square)](https://travis-ci.org/pascalbaljetmedia/laravel-browser-kit-macro)
[![Quality Score](https://img.shields.io/scrutinizer/g/pascalbaljetmedia/laravel-browser-kit-macro.svg?style=flat-square)](https://scrutinizer-ci.com/g/pascalbaljetmedia/laravel-browser-kit-macro)
[![Total Downloads](https://img.shields.io/packagist/dt/pbmedia/laravel-browser-kit-macro.svg?style=flat-square)](https://packagist.org/packages/pbmedia/laravel-browser-kit-macro)

This package prevents a User from being logged in more than once. It destroys the previous session when a User logs in and thereby allowing only one session per user. It assumes you use Laravel's [Authentication](https://laravel.com/docs/5.5/authentication) features.

## Requirements
* Laravel 5.4+
* PHP 7.0, 7.1 and 7.2 supported.
* Support for [Package Discovery](https://laravel.com/docs/5.5/packages#package-discovery).

## Installation

You can install the package via composer:

``` bash
composer require pbmedia/laravel-browser-kit-macro --dev
```

## Usage


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