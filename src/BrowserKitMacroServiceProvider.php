<?php

namespace ProtoneMedia\LaravelBrowserKitMacro;

use Illuminate\Foundation\Testing\TestResponse as LegacyTestResponse;
use Illuminate\Support\ServiceProvider;
use Illuminate\Testing\TestResponse as ModernTestResponse;

class BrowserKitMacroServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register any package services.
     *
     * @return void
     * @throws Exception
     */
    public function register()
    {
        if ($this->app->environment('production')) {
            return;
        }

        if ($this->app->runningInConsole()) {
            $class = class_exists(ModernTestResponse::class) ? ModernTestResponse::class : LegacyTestResponse::class;

            $class::macro('browserKit', function ($callback) {
                $testCase = (new BrowserKitTestCase(get_class($this)))
                    ->setApp(app())
                    ->setResponse($this->baseResponse);

                $callback($testCase);

                return $this;
            });
        }
    }
}
