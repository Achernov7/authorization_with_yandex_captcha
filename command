<?php

use rmvc\vc\Config\Config;
use rmvc\vc\DB\DB;

if (PHP_SAPI !== 'cli') {
    die('CLI only');
}

spl_autoload_register(function ($class_name) {
    $class_name = str_replace('\\', '/', $class_name);
    if (file_exists(__DIR__ . '/' . $class_name . '.php')) {
        require_once __DIR__ . '/' . $class_name . '.php';
    }
});

Config::setPath(__DIR__ . '/config');


if ($argv[1] == 'migrate') {

    $sql =<<<EOF
        CREATE TABLE USERS
        (ID INTEGER PRIMARY KEY     NOT NULL,
        NAME           CHAR(20)    NOT NULL,
        PHONE            INT     NOT NULL,
        CREATED_AT     DATETIME    DEFAULT CURRENT_TIMESTAMP,
        UPDATED_AT     DATETIME    DEFAULT CURRENT_TIMESTAMP,
        EMAIL        CHAR(80)    NOT NULL,
        PASSWORD         REAL);
        EOF;
    DB::exec($sql);

}

if ($argv[1] == 'symlinks') {
    symlink(__DIR__ . '/resources/js', 'public/js');
    symlink(__DIR__ . '/resources/css', 'public/css');
}