<?php

namespace rmvc\vc\Service;

use rmvc\vc\Interfaces\StorageInterface;

class ServiceContainer implements StorageInterface
{

    private static array $services = [];

    public static function get(string|int $key)
    {
        return self::$services[$key];
    }

    public static function has(string|int $key): bool
    {
        return array_key_exists($key, self::$services);
    }

    public static function set(string|int $key,object $value): void
    {
        self::$services[$key] = $value;
    }

    public static function remove(string|int $key): void
    {
        unset(self::$services[$key]);
    }

    public static function getAll(): array
    {
        return self::$services;
    }
}