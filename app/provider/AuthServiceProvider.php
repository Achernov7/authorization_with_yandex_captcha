<?php

namespace App\provider;

use App\http\Gates\yandexCaptchaGate;

class AuthServiceProvider
{

    private static array $gates = [
        yandexCaptchaGate::class
    ];

    public static function getGates()
    {
        return self::$gates;
    }
}