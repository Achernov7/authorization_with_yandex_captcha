<?php

namespace App\http\Gates;

use App\service\yandexCaptcha;
use rmvc\vc\Interfaces\Gate;

class yandexCaptchaGate implements Gate
{
    public function check($token): bool
    {
        $yandexCaptcha = new yandexCaptcha();
        if ($nn = $yandexCaptcha->check_captcha($token)) {
            return true;
        }
        return false;
    }
}