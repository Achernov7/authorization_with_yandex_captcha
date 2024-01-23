<?php

namespace rmvc\vc\Loading;

use rmvc\vc\Facades\Request;
use App\provider\AuthServiceProvider;
use rmvc\vc\Service\ServiceContainer;
use rmvc\vc\Service\AuthServiceContainer;

class LoadingServices
{

    private static bool $wasLoaded = false;


    private static array $services = [
        Request::class,
    ];

    public static function registerDefaultServices()
    {

        if (self::$wasLoaded) {
            return;
        }

        $authServiceContainer = new AuthServiceContainer();
        $gates = AuthServiceProvider::getGates();
        if ($gates != null) {
            foreach ($gates as $gate) {
                $authServiceContainer->set($gate, new $gate());
            }
        }

        $serviceContainer = new ServiceContainer();
        foreach (self::$services as $service) {
            $serviceContainer->set($service, new $service());
        }

        self::$wasLoaded = true;
    }

}