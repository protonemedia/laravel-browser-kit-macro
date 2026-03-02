# Laravel Browser Kit Macro Reference

Complete reference for `pbmedia/laravel-browser-kit-macro`. Full documentation: https://github.com/protonemedia/laravel-browser-kit-macro

## Overview

This package adds a `browserKit()` macro to Laravel's `TestResponse` class. It lets you use expressive BrowserKit-style DOM assertions (such as `seeElement`, `dontSeeElement`, `see`, `seeLink`) in modern Laravel feature tests without switching to a full BrowserKit test setup.

## Requirements

- Laravel 11 or 12
- PHP 8.2 or higher

## Installation

Install as a dev dependency:

```bash
composer require pbmedia/laravel-browser-kit-macro --dev
```

The package uses Laravel Package Discovery, so the service provider registers automatically. If you have disabled auto-discovery, add the service provider to your `config/app.php`:

```php
'providers' => [
    // ...
    ProtoneMedia\LaravelBrowserKitMacro\BrowserKitMacroServiceProvider::class,
],
```

The service provider only registers the macro when:
- The application is **not** in the `production` environment.
- The application is running in the console (i.e., during tests via Artisan/PHPUnit).

## Basic Usage

Call `browserKit()` on any `TestResponse` instance. It accepts a closure that receives a BrowserKit `TestCase` object:

```php
public function test_homepage_has_navigation(): void
{
    $this->get('/')
        ->assertStatus(200)
        ->browserKit(function ($test) {
            $test->seeElement('nav');
        });
}
```

The `browserKit()` macro returns the original `TestResponse`, so you can continue chaining assertions:

```php
$this->get('/contact')
    ->assertStatus(200)
    ->browserKit(function ($test) {
        $test->seeElement('form', ['action' => '/contact']);
        $test->seeElement('input', ['name' => 'email']);
        $test->seeElement('textarea', ['name' => 'message']);
    })
    ->assertViewIs('contact');
```

## BrowserKit Assertion Methods

All assertion methods from the Laravel BrowserKit Testing package are available inside the `browserKit()` closure. The `$test` parameter is an instance of `Laravel\BrowserKitTesting\TestCase`.

### Seeing and Not Seeing Text

```php
->browserKit(function ($test) {
    // Assert the response contains the given text
    $test->see('Welcome back');

    // Assert the response does not contain the given text
    $test->dontSee('Unauthorized');
})
```

### Seeing and Not Seeing Elements

```php
->browserKit(function ($test) {
    // Assert an element exists in the DOM
    $test->seeElement('input', ['name' => 'email']);

    // Assert an element does not exist in the DOM
    $test->dontSeeElement('input', ['name' => 'admin_token']);

    // Match by tag name only
    $test->seeElement('footer');

    // Match by tag name and multiple attributes
    $test->seeElement('input', ['type' => 'password', 'name' => 'password']);
})
```

### Seeing Text Within Elements

```php
->browserKit(function ($test) {
    // Assert a specific element contains the given text
    $test->seeInElement('h1', 'Dashboard');

    // Assert a specific element does not contain the given text
    $test->dontSeeInElement('h1', 'Admin Panel');
})
```

### Seeing Links

```php
->browserKit(function ($test) {
    // Assert a link with the given text and URL exists
    $test->seeLink('Sign Up', '/register');

    // Assert a link does not exist
    $test->dontSeeLink('Admin', '/admin');

    // Assert a link by text only (any URL)
    $test->seeLink('Home');
})
```

### Form Field Assertions

```php
->browserKit(function ($test) {
    // Assert a form field has the given value
    $test->seeInField('name', 'John Doe');

    // Assert a form field does not have the given value
    $test->dontSeeInField('name', 'Jane Doe');

    // Assert a select option is selected
    $test->seeIsSelected('country', 'us');

    // Assert a select option is not selected
    $test->dontSeeIsSelected('country', 'uk');

    // Assert a checkbox is checked
    $test->seeIsChecked('remember');

    // Assert a checkbox is not checked
    $test->dontSeeIsChecked('terms');
})
```

## Common Patterns

### Testing a Registration Form

```php
public function test_registration_form_has_required_fields(): void
{
    $this->get('/register')
        ->assertStatus(200)
        ->browserKit(function ($test) {
            $test->seeElement('form', ['method' => 'POST']);
            $test->seeElement('input', ['name' => 'name', 'type' => 'text']);
            $test->seeElement('input', ['name' => 'email', 'type' => 'email']);
            $test->seeElement('input', ['name' => 'password', 'type' => 'password']);
            $test->seeElement('input', ['name' => 'password_confirmation', 'type' => 'password']);
            $test->seeElement('button', ['type' => 'submit']);
        });
}
```

### Testing Navigation Links

```php
public function test_authenticated_user_sees_navigation(): void
{
    $this->actingAs($user)
        ->get('/dashboard')
        ->assertStatus(200)
        ->browserKit(function ($test) {
            $test->seeLink('Profile', '/profile');
            $test->seeLink('Settings', '/settings');
            $test->seeLink('Logout', '/logout');
            $test->dontSeeLink('Login', '/login');
        });
}
```

### Testing Form Pre-filled Values

```php
public function test_edit_form_is_prefilled(): void
{
    $user = User::factory()->create(['name' => 'John Doe', 'email' => 'john@example.com']);

    $this->actingAs($user)
        ->get('/profile/edit')
        ->assertStatus(200)
        ->browserKit(function ($test) use ($user) {
            $test->seeInField('name', $user->name);
            $test->seeInField('email', $user->email);
        });
}
```

### Combining with Standard Laravel Assertions

```php
public function test_dashboard_content(): void
{
    $this->actingAs($user)
        ->get('/dashboard')
        ->assertStatus(200)
        ->assertViewIs('dashboard')
        ->assertViewHas('projects')
        ->browserKit(function ($test) {
            $test->seeElement('table', ['id' => 'projects-table']);
            $test->seeInElement('h1', 'Your Projects');
            $test->seeLink('Create Project', '/projects/create');
        })
        ->assertSee('Dashboard');
}
```

### Testing Element Absence After Actions

```php
public function test_guest_cannot_see_admin_controls(): void
{
    $this->get('/page')
        ->assertStatus(200)
        ->browserKit(function ($test) {
            $test->dontSeeElement('button', ['class' => 'delete-btn']);
            $test->dontSeeElement('a', ['href' => '/admin']);
            $test->dontSeeLink('Admin Panel');
        });
}
```

### Testing Select Dropdowns and Checkboxes

```php
public function test_settings_form_has_correct_defaults(): void
{
    $this->actingAs($user)
        ->get('/settings')
        ->assertStatus(200)
        ->browserKit(function ($test) {
            $test->seeIsSelected('timezone', 'UTC');
            $test->seeIsSelected('language', 'en');
            $test->seeIsChecked('notifications');
            $test->dontSeeIsChecked('marketing_emails');
        });
}
```

## How It Works

The `BrowserKitMacroServiceProvider` registers a `browserKit` macro on `Illuminate\Testing\TestResponse` (or the legacy `Illuminate\Foundation\Testing\TestResponse`). When called:

1. A new `BrowserKitTestCase` instance is created.
2. The current application instance is injected via `setApp()`.
3. The base HTTP response is injected via `setResponse()`.
4. Your closure is called with the `BrowserKitTestCase`, giving you access to all BrowserKit assertion methods.
5. The original `TestResponse` is returned for further chaining.

## Gotchas

- The macro is **not registered in production** — it checks `$this->app->environment('production')` and returns early.
- The macro is **only registered when running in console** — it checks `$this->app->runningInConsole()`, so it is available during PHPUnit/Pest test runs.
- The closure receives a `Laravel\BrowserKitTesting\TestCase` instance, not your application's test class. You cannot call methods like `assertDatabaseHas` on `$test`.
- If you need to access variables from the test method, use `use` in the closure: `function ($test) use ($user) { ... }`.
- The `browserKit()` method works with any HTTP verb (`get`, `post`, `put`, `patch`, `delete`) since they all return a `TestResponse`.
