<?php

declare(strict_types=1);

session_start([
    'cookie_lifetime' => 3600,
]);

session_start();

use rmvc\vc\App;

require __DIR__ . '/../vendor/autoload.php';

include_once __DIR__ . '/../app/bootstrap/preload.php';

App::run();