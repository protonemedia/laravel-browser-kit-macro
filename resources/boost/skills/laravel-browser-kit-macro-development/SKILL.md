---
name: laravel-browser-kit-macro-development
description: Use protonemedia/laravel-browser-kit-macro to run BrowserKit-style DOM assertions against TestResponse in Laravel feature tests.
license: MIT
metadata:
  author: ProtoneMedia
---

# Laravel Browser Kit Macro Development

## Overview
Use `protonemedia/laravel-browser-kit-macro` to add a `browserKit()` macro to `TestResponse`, enabling BrowserKit-style DOM assertions (e.g. `seeElement`) in Laravel feature tests.

## When to Activate
- Activate when writing or modifying Laravel feature tests that need DOM-level assertions.
- Activate when code references `browserKit()`, `BrowserKitMacroServiceProvider`, or `ProtoneMedia\LaravelBrowserKitMacro`.
- Activate when the user wants to assert specific HTML elements or attributes in test responses.

## Scope
- In scope: installing the package, using the `browserKit()` macro in tests, BrowserKit assertion methods.
- Out of scope: modifying this package’s internal source code unless the user explicitly says they are contributing to the package.

## Workflow
1. Identify the task (install/setup, writing test assertions, debugging test failures, etc.).
2. Read `references/laravel-browser-kit-macro-guide.md` and focus on the relevant section.
3. Apply the documented patterns and keep examples minimal and Laravel-native.

## Core Concepts

### Basic Usage
Call `browserKit()` on a `TestResponse` to run BrowserKit assertions:

```php
$this->get(‘register’)
    ->assertStatus(200)
    ->browserKit(function ($test) {
        $test->seeElement(‘input’, [‘name’ => ‘email’]);
    });
```

### Combining with Standard Assertions
Use standard HTTP assertions first, then `browserKit()` for DOM-level checks:

```php
$this->get(‘/dashboard’)
    ->assertStatus(200)
    ->assertSee(‘Welcome’)
    ->browserKit(function ($test) {
        $test->seeElement(‘a’, [‘href’ => ‘/settings’]);
    });
```

## Do and Don’t

Do:
- Install as a dev dependency: `composer require pbmedia/laravel-browser-kit-macro --dev`.
- Use `browserKit()` for DOM assertions that are tedious with string matching.
- Combine standard `assert*` calls with `browserKit()` for comprehensive test coverage.
- Use BrowserKit methods (`seeElement`, etc.) inside the `browserKit()` callback.

Don’t:
- Don’t use this package in production code — it is for testing only.
- Don’t invent undocumented methods; stick to the docs and reference.
- Don’t forget to register `BrowserKitMacroServiceProvider` if package discovery is disabled.

## References
- `references/laravel-browser-kit-macro-guide.md`
