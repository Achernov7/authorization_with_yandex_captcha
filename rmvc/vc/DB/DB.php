<?php

namespace rmvc\vc\DB;

use rmvc\vc\Config\Config;

class DB
{

    public static $typeOfDBConnection= 'sqlite';

    public static ?\PDO $DBConnection = null;

    public static function setTypeOfDBConnection(string $DBConnection): void
    {
        self::$typeOfDBConnection = 'sqlite';
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

    private static function connect()
    {
        if (self::$DBConnection == null) {
            if (self::$typeOfDBConnection == 'sqlite') {
                return self::$DBConnection = new \PDO('sqlite:' . Config::get('database.connections.sqlite.path'));
            }
        } else {
            return self::$DBConnection;
        }
    }

    public static function query(string $string, ?array $params = null): ?array
    {

        $db = self::connect();
        try {
            $statement = $db->prepare($string);

            if (is_array($params)) {
                foreach ($params as $key => $value) {
                    $statement->bindValue(':'.$key, $value);
                }
            }

            $result = $statement->execute();

            if (!$result) {
                return $statement->errorInfo();
            }

        } catch (\PDOException $e) {
            return $e->getMessage();
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);

        if (array_key_exists('0', $result)) {
            return $result;
        } else {
            return null;
        }
    }

    public static function exec(string $string)
    {
        $db = self::connect();
        $result = $db->exec($string);
        return $result;
    }

    public static function lastInsertId()
    {
        $db = self::connect();
        return $db->lastInsertId();
    }
}