<?php

namespace rmvc\vc\Controller;

use App\http\Gates\yandexCaptchaGate;
use rmvc\vc\Service\AuthServiceContainer;
use rmvc\vc\Traits\ArgsForMethod;
use rmvc\vc\Service\ServiceContainer;

class Controller
{
    
    protected static ?ServiceContainer $serviceContainer = null;

    public function __construct()
    {
        if (self::$serviceContainer == null) {
            self::$serviceContainer = new ServiceContainer();
        }
    }

    public function authorize($gate, $argument)
    {
        $gate = AuthServiceContainer::get($gate);
        
        if ($gate == null) {
            return new \Exception('Invalid gate');
        }

        $validation = $gate->check($argument);

        if ($validation) {
            return true;
        } else {
            throw new \Exception('Invalid authorization');
        }

    }
}