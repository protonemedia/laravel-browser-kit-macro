# Laravel Browser Kit Macro Reference

Complete reference for `pbmedia/laravel-browser-kit-macro`. Repository: https://github.com/protonemedia/laravel-browser-kit-macro

## Installation

```bash
composer require pbmedia/laravel-browser-kit-macro --dev
```

If not using Package Discovery, register the service provider in `config/app.php`:

```php
ProtoneMedia\LaravelBrowserKitMacro\BrowserKitMacroServiceProvider::class,
```

## Basic Usage

The package adds a `browserKit()` method to Laravel's `TestResponse`. It accepts a closure that receives a Browser Kit `TestCase` instance with the current application and response already set:

```php
/** @test */
public function it_presents_a_registration_form()
{
    $this->get('/register')
        ->assertStatus(200)
        ->browserKit(function ($test) {
            $test->seeElement('input', ['name' => 'email']);
        });
}
```

## Chaining Assertions

`browserKit()` returns the `TestResponse`, so it can be chained with any standard Laravel test assertion:

```php
$this->get('/settings')
    ->assertStatus(200)
    ->assertSee('Settings')
    ->browserKit(function ($test) {
        $test->seeElement('form', ['method' => 'POST']);
        $test->seeElement('input', ['name' => 'name']);
    })
    ->assertDontSee('Unauthorized');
```

## DOM Element Assertions

### seeElement

Assert that an HTML element exists, optionally with specific attributes:

```php
$this->get('/page')->browserKit(function ($test) {
    // Element exists by tag name
    $test->seeElement('form');

    // Element with specific attributes
    $test->seeElement('input', ['type' => 'text', 'name' => 'username']);
    $test->seeElement('a', ['href' => '/dashboard']);
    $test->seeElement('meta', ['name' => 'csrf-token']);
    $test->seeElement('select', ['name' => 'role']);
    $test->seeElement('button', ['type' => 'submit']);
    $test->seeElement('img', ['alt' => 'Logo']);
    $test->seeElement('div', ['class' => 'alert']);
});
```

### dontSeeElement

Assert that an HTML element does NOT exist:

```php
$this->get('/page')->browserKit(function ($test) {
    // Element should not exist
    $test->dontSeeElement('input', ['name' => 'admin_token']);
    $test->dontSeeElement('div', ['class' => 'error']);
});
```

## Common Testing Patterns

### Testing form fields

```php
/** @test */
public function the_contact_form_has_required_fields()
{
    $this->get('/contact')
        ->assertStatus(200)
        ->browserKit(function ($test) {
            $test->seeElement('input', ['name' => 'name', 'type' => 'text']);
            $test->seeElement('input', ['name' => 'email', 'type' => 'email']);
            $test->seeElement('textarea', ['name' => 'message']);
            $test->seeElement('button', ['type' => 'submit']);
        });
}
```

### Testing navigation links

```php
/** @test */
public function the_navbar_contains_expected_links()
{
    $this->get('/')
        ->assertStatus(200)
        ->browserKit(function ($test) {
            $test->seeElement('a', ['href' => '/about']);
            $test->seeElement('a', ['href' => '/contact']);
            $test->dontSeeElement('a', ['href' => '/admin']);
        });
}
```

### Testing meta tags

```php
/** @test */
public function the_page_has_proper_meta_tags()
{
    $this->get('/')
        ->browserKit(function ($test) {
            $test->seeElement('meta', ['name' => 'description']);
            $test->seeElement('meta', ['name' => 'viewport']);
            $test->seeElement('link', ['rel' => 'canonical']);
        });
}
```

### Testing conditional elements

```php
/** @test */
public function guests_do_not_see_admin_controls()
{
    $this->get('/dashboard')
        ->browserKit(function ($test) {
            $test->dontSeeElement('button', ['class' => 'delete-user']);
            $test->dontSeeElement('a', ['href' => '/admin/settings']);
        });
}

/** @test */
public function admins_see_admin_controls()
{
    $this->actingAs($this->adminUser)
        ->get('/dashboard')
        ->browserKit(function ($test) {
            $test->seeElement('button', ['class' => 'delete-user']);
            $test->seeElement('a', ['href' => '/admin/settings']);
        });
}
```

### Combining with POST responses

```php
/** @test */
public function validation_errors_show_correct_fields()
{
    $this->post('/register', [])
        ->assertStatus(302);

    $this->get('/register')
        ->browserKit(function ($test) {
            $test->seeElement('input', ['name' => 'email']);
        });
}
```

## How It Works

The package registers a macro on `Illuminate\Testing\TestResponse` (or the legacy `Illuminate\Foundation\Testing\TestResponse`). When `browserKit()` is called:

1. A `BrowserKitTestCase` instance is created with the current application and response.
2. The closure is called with this instance, giving access to all Browser Kit assertion methods.
3. The original `TestResponse` is returned for further chaining.

The service provider only registers the macro when:
- The application is **not** in production.
- The application is running in the **console** (i.e., during tests).
