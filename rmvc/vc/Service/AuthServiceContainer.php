<?php

namespace rmvc\vc\Service;

use rmvc\vc\Interfaces\StorageInterface;

class AuthServiceContainer implements StorageInterface
{

    private static array $gates;

    public static function get(string|int $key)
    {
        return self::$gates[$key];
    }

    public static function has(string|int $key): bool
    {
        
        return array_key_exists($key, self::$gates);
    }

    public static function set(string|int $key,object $value)
    {
        self::$gates[$key] = $value;
    }

    public static function remove(string|int $key)
    {
        unset(self::$gates[$key]);
    }

    public static function getAll(): array
    {
        return self::$gates;
    }
}