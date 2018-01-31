<?php

namespace Pbmedia\LaravelBrowserKitMacro;

use Illuminate\Foundation\Application;
use Illuminate\Http\Response;
use Laravel\BrowserKitTesting\TestCase;

class BrowserKitTestCase extends TestCase
{
    public function createApplication()
    {
        return;
    }

    /**
     * Set the Application.
     *
     * @var \Illuminate\Foundation\Application
     */
    public function setApp(Application $app)
    {
        $this->app = $app;

        return $this;
    }

    /**
     * Set the response returned by the request.
     *
     * @var \Illuminate\Http\Response
     */
    public function setResponse(Response $response)
    {
        $this->response = $response;

        return $this;
    }
}
