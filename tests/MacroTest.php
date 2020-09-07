<?php

namespace ProtoneMedia\LaravelBrowserKitMacro\Tests;

use Illuminate\Foundation\Testing\TestResponse as LegacyTestResponse;
use Illuminate\Testing\TestResponse as ModernTestResponse;
use Laravel\BrowserKitTesting\TestCase;
use ProtoneMedia\LaravelBrowserKitMacro\BrowserKitMacroServiceProvider;

class MacroTest extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [BrowserKitMacroServiceProvider::class];
    }

    /** @test */
    public function it_can_wrap_a_test_response_object_in_a_browser_kit_test_case()
    {
        $this->app['router']->get('/', function () {
            return '<input name="city" />';
        });

        $response = $this->get('/');

        if (class_exists(ModernTestResponse::class)) {
            $this->assertInstanceOf(ModernTestResponse::class, $response);
        } else {
            $this->assertInstanceOf(LegacyTestResponse::class, $response);
        }

        $response->browserKit(function ($test) {
            $this->assertInstanceOf(TestCase::class, $test);

            $test->seeElement('input', ['name' => 'city']);
            $test->dontSeeElement('input', ['name' => 'country']);
        });
    }
}
