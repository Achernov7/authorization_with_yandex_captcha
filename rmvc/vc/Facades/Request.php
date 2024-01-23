<?php

namespace rmvc\vc\Facades;

use rmvc\vc\Service\Request\Validation\Validation;

class Request
{
    private static ?array $data = null;

    public function __construct()
    {
        if (static::$data == null) {
            $this::$data = $_POST;
        }
    }

    public static function validated()
    {
        if (static::rules() != null) {
            return Validation::validate(static::$data, static::rules());
        } else {
            return static::$data;
        }
    }

    public static function rules(): ?array
    {
        return null;
    }
}