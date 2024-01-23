<?php

namespace rmvc\vc\Service\Auth;

use rmvc\vc\DB\DB;

final class Auth
{

    private static ?array $authUserInformation = null;

    public static function check(string $login, string $password): bool
    {
        return $login == 'admin' && $password == 'admin';
    }

    public static function user()
    {
        if (self::$authUserInformation == null) {
            if (isset($_SESSION['auth_id'])) {
                $data = DB::query('SELECT * FROM USERS WHERE ID = :id', ['id' => $_SESSION['auth_id']]);
                self::$authUserInformation = $data[0];
                return self::$authUserInformation;
            } else {
                self::$authUserInformation = null;
            }
        } else {
            return self::$authUserInformation;
        }
    }

}