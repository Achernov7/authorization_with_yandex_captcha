<?php

namespace rmvc\vc\Route;

class RouteConfiguration
{
    public string $route;

    public string $controller;

    public string $method;

    private string $name;

    private string $middleware;

    public function __construct(string $route, string $controller, string $method)
    {
        $this->route = $route;
        $this->controller = $controller;
        $this->method = $method;
    }

    public function name(string $name): RouteConfiguration
    {
        $this->name = $name;
        return $this;
    }

    public function middleware(string $middleware): RouteConfiguration
    {
        $this->middleware = $middleware;
        return $this;
    }

}