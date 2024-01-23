<?php

namespace rmvc\vc;

use rmvc\vc\Route\Route;
use rmvc\vc\Route\RouteDispatcher;

class App
{
    public static function run()
    {
        $requestMethod = ucfirst(strtolower($_SERVER['REQUEST_METHOD']));

        $methodName = 'getRoutes' . $requestMethod;

        foreach (Route::$methodName() as $routeConfiguration) {
            $routeDispatcher = new RouteDispatcher($routeConfiguration);
            $routeDispatcher->dispatch();
        }
    }
}