---
name: laravel-browser-kit-macro-development
description: Write Laravel feature tests using the browserKit() macro to perform BrowserKit-style DOM assertions such as seeElement, dontSeeElement, see, dontSee, seeLink, and seeInField on modern TestResponse objects.
license: MIT
metadata:
  author: Protone Media
---

# Laravel Browser Kit Macro Development

## Overview
Use `pbmedia/laravel-browser-kit-macro` to run BrowserKit-style DOM assertions inside modern Laravel feature tests. The package registers a `browserKit()` macro on `TestResponse` that gives you access to expressive assertions like `seeElement`, `dontSeeElement`, `see`, and `seeLink` without replacing your existing test setup.

## When to Activate
- Activate when writing or modifying feature tests that need DOM-level assertions (checking elements, attributes, form fields, links).
- Activate when code references the `browserKit()` method on a test response.
- Activate when the user wants to assert the presence or absence of HTML elements, form inputs, or links in a response.

## Scope
- In scope: installing the package, using the `browserKit()` macro, calling BrowserKit assertion methods inside the closure, combining with standard Laravel HTTP test assertions.
- Out of scope: full browser testing with Laravel Dusk, JavaScript-driven assertions, non-Laravel test frameworks.

## Workflow
1. Identify the test scenario (DOM element check, form field assertion, link verification, etc.).
2. Read `references/laravel-browser-kit-macro-guide.md` and focus on the relevant section.
3. Apply the patterns from the reference, keeping test code minimal and chaining `browserKit()` with standard assertions.

## Core Concepts

### Basic Usage
Chain `browserKit()` on any `TestResponse` to access BrowserKit assertions:

```php
public function test_registration_page_has_email_field(): void
{
    $this->get('/register')
        ->assertStatus(200)
        ->browserKit(function ($test) {
            $test->seeElement('input', ['name' => 'email']);
        });
}
```

### Combining with Standard Assertions
The `browserKit()` macro returns the `TestResponse`, so you can continue chaining:

```php
$this->get('/dashboard')
    ->assertStatus(200)
    ->assertSee('Welcome')
    ->browserKit(function ($test) {
        $test->seeElement('nav', ['class' => 'main-nav']);
        $test->seeLink('Profile', '/profile');
    })
    ->assertViewIs('dashboard');
```

### Common BrowserKit Assertions
Inside the `browserKit()` closure, you have access to all BrowserKit assertion methods:

```php
->browserKit(function ($test) {
    $test->see('Welcome');
    $test->dontSee('Error');
    $test->seeElement('input', ['name' => 'email', 'type' => 'email']);
    $test->dontSeeElement('input', ['name' => 'admin_secret']);
    $test->seeLink('Sign Up', '/register');
    $test->seeInField('email', 'user@example.com');
    $test->seeIsChecked('remember');
})
```

## Do and Don't

Do:
- Always chain `browserKit()` after an HTTP test method (`get`, `post`, etc.) and its standard assertions.
- Use `seeElement` with an attributes array to match specific HTML attributes.
- Combine `browserKit()` DOM checks with standard assertions like `assertStatus()` and `assertSee()` for comprehensive tests.
- Install the package as a dev dependency with `--dev`.

Don't:
- Don't use `browserKit()` in production code — the macro only registers outside the `production` environment and only when running in console.
- Don't confuse this with Laravel Dusk — `browserKit()` operates on the HTTP response HTML, not a real browser.
- Don't forget that the closure receives a BrowserKit `TestCase` instance, not the standard Laravel test class.

## References
- `references/laravel-browser-kit-macro-guide.md`
