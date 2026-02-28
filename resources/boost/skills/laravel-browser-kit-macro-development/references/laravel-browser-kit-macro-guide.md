# laravel-browser-kit-macro development guide

For full documentation, see the README: https://github.com/protonemedia/laravel-browser-kit-macro#readme

## At a glance
Adds a macro to use classic **BrowserKit**-style testing helpers in modern Laravel testing.

## Local setup
- Install dependencies: `composer install`
- Keep the dev loop package-focused (avoid adding app-only scaffolding).

## Testing
- Run: `composer test` (preferred) or the repository’s configured test runner.
- Add regression tests for bug fixes.

## Notes & conventions
- Keep compatibility with Laravel's testing layer (TestResponse/macros).
- Prefer adding tests that demonstrate the macro behavior on responses.
- Don't couple to application routes; keep fixtures minimal.
