<?php
namespace rmvc\vc\Route;


use rmvc\vc\Facades\Response;
use rmvc\vc\Traits\ArgsForMethod;
use rmvc\vc\Service\ServiceContainer;

class RouteDispatcher
{

    private ?string $requestUri = null;

    private array $paramMap = [];

    private array $paramRequestMap = [];

    private string $lastParamRequestUri = '';

    private ?string $lastRouteParam = null;

    private RouteConfiguration $routeConfiguration;

    use ArgsForMethod;

    public function __construct($routeConfiguration)
    {
        $this->routeConfiguration = $routeConfiguration;
    }

    public function dispatch()
    {
        $this->cleanRouteConfiguration();
        
        $this->setParamMap();

        $this->makeRegexRequest();
        $this->run();
    }

    private function cleanRouteConfiguration()
    {
        if ($this->requestUri == null) {
            $this->requestUri = $this->cleanUri($_SERVER['REQUEST_URI']);
        }
        $this->routeConfiguration->route = $this->cleanUri($this->routeConfiguration->route);
    }

    private function cleanUri($str):string
    {
        return preg_replace('/(^\/)|(\/$)/', '', $str);
    }

    private function setParamMap()
    {
        $routeArray = explode('/', $this->routeConfiguration->route);

        foreach ($routeArray as $paramKey => $param) {
            if (preg_match('/{.*}/', $param)) {
                $this->paramMap[$paramKey] = preg_replace('/(^{)|(}$)/', '', $param);
            }

            if (count($routeArray) == $paramKey + 1) {
                if (!isset($this->paramMap[$paramKey])) {
                    $this->lastRouteParam = $routeArray[$paramKey];
                }
            }

            $requestUriArray[$paramKey] = $param;
        }

    }

    private function makeRegexRequest()
    {
        $requestUriArray = explode('/', $this->requestUri);
        $this->lastParamRequestUri = end($requestUriArray);
        foreach ($this->paramMap as $paramKey => $param) {
            if (!isset($requestUriArray[$paramKey])) {
                return;
            }

            $this->paramRequestMap[$param] = $requestUriArray[$paramKey];
            $requestUriArray[$paramKey] = '{.*}';
        }

        $this->requestUri = implode('/', $requestUriArray);
        $this->prepareRegex();

    }

    private function prepareRegex()
    {
        $this->requestUri = str_replace('/', '\/', $this->requestUri);
    }

    private function run()
    {
        if (preg_match("/$this->requestUri/", $this->routeConfiguration->route)) {
            if ($this->lastRouteParam == null) {
                $this->render();
            } else {
                if ($this->lastParamRequestUri == $this->lastRouteParam) {
                    $this->render();
                }
            }
        }
    }

    private function render()
    {
        $className = $this->routeConfiguration->controller;
        $methodName = $this->routeConfiguration->method;

        $parametersForMethod = $this->argsForMethod($className, $methodName, new ServiceContainer());

        if (!$parametersForMethod) {
            $parametersForMethod = [];
        }

        try {
            $result = (new $className)->$methodName(...$parametersForMethod,...$this->paramRequestMap);
        } catch (\Exception $e) {
            if (preg_match('/^[Invalid]+/', $e->getMessage())) {
                $result = Response::json(['error' => $e->getMessage()]);
            } else {
                $result = Response::json($e->getMessage());
            }
        };

        print($result); 

        die();
    }

}