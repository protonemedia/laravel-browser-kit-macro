# Laravel Browser Kit Macro Reference

Complete reference for `protonemedia/laravel-browser-kit-macro` (`pbmedia/laravel-browser-kit-macro`).

Primary docs: https://github.com/protonemedia/laravel-browser-kit-macro#readme

## Purpose

Laravel’s classic BrowserKit testing helpers are convenient for DOM assertions, but modern Laravel testing typically uses `TestResponse`.

This package bridges the gap by adding a **`browserKit()`** method to `TestResponse`, allowing you to run BrowserKit assertions against the response.

## Installation

Dev dependency:

```bash
composer require pbmedia/laravel-browser-kit-macro --dev
```

If you’re not using package discovery, register the service provider:

```php
ProtoneMedia\LaravelBrowserKitMacro\BrowserKitMacroServiceProvider::class,
```

Upgrading note (README): v5 changed the namespace to `ProtoneMedia\LaravelBrowserKitMacro`.

## Usage

`browserKit()` accepts a closure. The closure receives a BrowserKit `TestCase` instance.

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

### Common patterns

- Use it for DOM-level assertions that are tedious with string matching.
- Combine with standard HTTP assertions first (`assertStatus`, `assertSee`, `assertSeeInOrder`) and then use BrowserKit for specific elements/attributes.

## Pitfalls / gotchas

- **Dev-only:** it’s intended for testing, not production code.
- **Macro availability:** if the macro is missing, verify the provider is registered / package discovery is enabled.
- **Callback expectations:** the `$test` object is BrowserKit-style; use BrowserKit methods (`seeElement`, etc.).
