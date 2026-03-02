---
name: browser-kit-macro-development
description: Use pbmedia/laravel-browser-kit-macro to access Browser Kit DOM assertions in modern Laravel test responses, including seeElement, dontSeeElement, and other Browser Kit TestCase methods.
license: MIT
metadata:
  author: Protone Media
---

# Browser Kit Macro Development

## Overview
Use pbmedia/laravel-browser-kit-macro to access Browser Kit DOM assertions within modern Laravel HTTP tests. The package registers a `browserKit()` macro on `TestResponse` that wraps the response in a Browser Kit `TestCase`, enabling DOM inspection methods like `seeElement` and `dontSeeElement`.

## When to Activate
- Activate when writing Laravel feature tests that need DOM element assertions beyond what `assertSee` provides.
- Activate when code references `browserKit()`, `seeElement`, `dontSeeElement`, or the `ProtoneMedia\LaravelBrowserKitMacro` namespace.
- Activate when the user wants to inspect specific HTML elements and their attributes in test responses.

## Scope
- In scope: using the `browserKit()` macro on test responses, DOM element assertions, combining Browser Kit assertions with modern Laravel test assertions.
- Out of scope: full Browser Kit testing (form interactions, page navigation), Dusk browser testing, non-Laravel frameworks.

## Workflow
1. Identify the DOM assertion needed (checking element existence, verifying attributes, etc.).
2. Read `references/browser-kit-macro-guide.md` and focus on the relevant section.
3. Apply the patterns from the reference, chaining `browserKit()` with standard Laravel test assertions.

## Core Concepts

### Basic Usage
Call `browserKit()` on any test response to access Browser Kit assertions:

```php
$this->get('/register')
    ->assertStatus(200)
    ->browserKit(function ($test) {
        $test->seeElement('input', ['name' => 'email']);
    });
```

### Chaining with Laravel Assertions
The `browserKit()` method returns `$this`, so it chains with standard assertions:

```php
$this->get('/profile')
    ->assertStatus(200)
    ->assertSee('Profile')
    ->browserKit(function ($test) {
        $test->seeElement('input', ['name' => 'name']);
        $test->dontSeeElement('input', ['name' => 'admin']);
    })
    ->assertDontSee('Error');
```

### Element Assertions
Use `seeElement` to assert an element exists with specific attributes, and `dontSeeElement` to assert it does not:

```php
$this->get('/form')
    ->browserKit(function ($test) {
        // Assert element exists with attributes
        $test->seeElement('input', ['type' => 'email', 'name' => 'email']);
        $test->seeElement('select', ['name' => 'country']);
        $test->seeElement('a', ['href' => '/terms']);

        // Assert element does not exist
        $test->dontSeeElement('input', ['name' => 'secret']);
    });
```

## Do and Don't

Do:
- Always chain `browserKit()` on a `TestResponse` returned by `$this->get()`, `$this->post()`, etc.
- Use `browserKit()` when you need to assert specific HTML element attributes that `assertSee` cannot check.
- Combine standard Laravel assertions with `browserKit()` for comprehensive test coverage.
- Install the package as a dev dependency: `composer require pbmedia/laravel-browser-kit-macro --dev`.

Don't:
- Don't use `browserKit()` for simple text assertions — use `assertSee()` or `assertSeeText()` instead.
- Don't try to interact with forms (typing, submitting) through the macro — it only supports assertions on the current response.
- Don't register the service provider in production — the package already guards against this.
- Don't forget that the callback receives a Browser Kit `TestCase` instance, not the `TestResponse`.

## References
- `references/browser-kit-macro-guide.md`
