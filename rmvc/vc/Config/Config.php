<?php

namespace rmvc\vc\Config;

class Config
{

    private static string $path = '../config';

    private static ?array $listOfConfigs = null;

    public static function setPath($path)
    {
        self::$path = $path;
    }


    public function __construct()
    {
    }

    public function __clone()
    {
    }
   
    public function __wakeup()
    {
    }

    public static function get(string $key)
    {
        self::set();

        if (array_key_exists($key, self::$listOfConfigs)) {
            return self::$listOfConfigs[$key];
        } else {
            return null;
        }
    }

    public static function set()
    {
        if (!is_null(self::$listOfConfigs)) {
            return;
        }

        $files = array_diff(scandir(self::$path), array('.', '..'));

        self::setArrayKeys($files);
    }

    private static function setArrayKeys($files)
    {
        foreach ($files as $nameOfValueWithExt) {

            $nameOfValue = str_replace('.php', '', $nameOfValueWithExt);

            $value = include self::$path . '/' . $nameOfValueWithExt;

            if (is_array($value)) {
                self::speadArray($value, $nameOfValue);
            } else {
                self::$listOfConfigs[$nameOfValue] = $value;
            }
        }
    }

    private static function speadArray(array $array, $keyOfArray)
    {
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                self::$listOfConfigs[$keyOfArray . '.' . $key] = $value;
                self::speadArray($value, $keyOfArray . '.' . $key);
            } else {
                self::$listOfConfigs[$keyOfArray . '.' . $key] = $value;
            }
        }
    }
}