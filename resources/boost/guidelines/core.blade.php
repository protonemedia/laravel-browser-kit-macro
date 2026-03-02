{{-- Laravel Browser Kit Macro Guidelines for AI Code Assistants --}}
{{-- Source: https://github.com/protonemedia/laravel-browser-kit-macro --}}
{{-- License: MIT | (c) Protone Media --}}

## Browser Kit Macro

- `pbmedia/laravel-browser-kit-macro` adds a `browserKit()` macro to Laravel's `TestResponse`, enabling BrowserKit-style DOM assertions (e.g., `seeElement`, `dontSeeElement`) in modern Laravel feature tests.
- Always activate the `laravel-browser-kit-macro-development` skill when writing tests that use the `browserKit()` macro, BrowserKit DOM assertions, or any code that references `BrowserKitMacroServiceProvider`.
