<?php

namespace App\service;

use rmvc\vc\Service\Request\Validation\Validation;

class checkNumberOfEmail
{
    public static function check(string $value): array
    {
        try {
            $value = Validation::validateEmail($value);
            return ['type' => 'email', 'value' => $value,];
        } catch (\Exception $e) {
        }

        try {
            $value = Validation::validatePhone($value);
            return ['type' => 'phone', 'value' => $value];
        } catch (\Exception $e) {
        }

        return ['type' => 'none', 'value' => $value];
    }
}