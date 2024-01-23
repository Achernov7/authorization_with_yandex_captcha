<?php

use App\hooks\Hook;
use rmvc\vc\Loading\LoadingServices;

if (preg_match('/^(\/api\/)(.+)/', $_SERVER['REQUEST_URI'], $matches)) {
    $_SERVER['REQUEST_URI'] = $matches[2];
    require "../routes/api.php";
} else {
    require "../routes/web.php";
}

if (isset($_SESSION['ipAddress']) && $_SERVER['REMOTE_ADDR']!=$_SESSION['ipAddress']) {
    session_unset();
    session_destroy();
    session_start();
}

LoadingServices::registerDefaultServices();

Hook::beforeApplicationBoot();