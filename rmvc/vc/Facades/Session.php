<?php

namespace rmvc\vc\Facades;

class Session
{

    public static function id(): string
    {
        return session_id();
    }

    public static function set(string $key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    public static function get(string $key): mixed
    {
        if (!array_key_exists($key, $_SESSION)) {
            return null;
        }
        return $_SESSION[$key];
    }

    public static function unset_param(string $key): void
    {
        unset($_SESSION[$key]);
    }

    public static function destroy(): void
    {
        session_destroy();
    }

    public static function unset_all(): void
    {
        session_unset();
    }

    public static function has(string $key): bool
    {
        return array_key_exists($key, $_SESSION);
    }

    public static function close()
    {
        session_write_close();
    }

    public static function validated()
    {
        if ($_SESSION['auth'] == true && $_SESSION['ipAddress'] == $_SERVER['REMOTE_ADDR']) {
            return true;
        }  else {
            return false;
        }
    }

    public static function setUser($value)
    {
        $_SESSION['auth'] = true;
        $_SESSION['ipAddress'] = $_SERVER['REMOTE_ADDR'];
        $_SESSION['auth_id'] = $value;
    }
}