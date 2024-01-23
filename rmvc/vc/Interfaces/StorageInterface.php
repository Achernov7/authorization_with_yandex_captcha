<?php

namespace rmvc\vc\Interfaces;

interface StorageInterface
{
    public static function get(string|int $key);
    public static function has(string|int $key): bool;
    public static function set(string|int $key,object $value);
    public static function getAll(): array;
    public static function remove(string|int $key);
}