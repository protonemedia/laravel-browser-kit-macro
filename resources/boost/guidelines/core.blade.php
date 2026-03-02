{{-- Laravel Browser Kit Macro Guidelines for AI Code Assistants --}}
{{-- Source: https://github.com/protonemedia/laravel-browser-kit-macro --}}
{{-- License: MIT | (c) Protone Media --}}

## Browser Kit Macro

- `pbmedia/laravel-browser-kit-macro` adds a `browserKit()` macro to Laravel's `TestResponse`, giving access to Browser Kit DOM assertions in modern Laravel tests.
- Always activate the `browser-kit-macro-development` skill when working with the `browserKit()` method, Browser Kit DOM assertions like `seeElement` or `dontSeeElement`, or any code that references `ProtoneMedia\LaravelBrowserKitMacro`.
