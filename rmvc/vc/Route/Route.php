<?php

namespace rmvc\vc\Route;

class Route
{

    private static array $routesGet = [];
    private static array $routesPost = [];
    
    public static function get(string $route,array $contoller): RouteConfiguration
    {
        return self::commonRouteConfig($route, $contoller, 'routesGet');
    }

    public static function post(string $route,array $contoller): RouteConfiguration
    {
        return self::commonRouteConfig($route, $contoller, 'routesPost');
    }

    public static function commonRouteConfig(string $route,array $contoller, $nameOfArray): RouteConfiguration
    {
        $routeConfiguration = new RouteConfiguration($route, $contoller[0], $contoller[1]);
        self::$$nameOfArray[] = $routeConfiguration;
        return $routeConfiguration;
    }

    /**
     * Retrieves the routeConfigurations for GET requests.
     *
     * @return array The routeConfigurations for GET requests.
     */
    public static function getRoutesGet()
    {
        return self::$routesGet;
    }

    public static function getRoutesPost()
    {
        return self::$routesPost;
    }

    public static function redirect($url)
    {
        header('Location: ' . $url);
    }
}