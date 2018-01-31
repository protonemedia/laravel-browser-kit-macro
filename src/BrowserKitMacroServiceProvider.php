<?php

namespace Pbmedia\LaravelBrowserKitMacro;

use Illuminate\Foundation\Testing\TestResponse;
use Illuminate\Support\ServiceProvider;

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
            TestResponse::macro('browserKit', function ($callback) {
                $testCase = (new BrowserKitTestCase)
                    ->setApp(app())
                    ->setResponse($this);

                $callback($testCase);

                return $this;
            });
        }
    }
}
