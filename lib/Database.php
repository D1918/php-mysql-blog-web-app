<?php

namespace Lib;

use PDO;

class Database
{
    private static ?PDO $pdo = null;

    public static function getConnection(): PDO
    {
        if (!self::$pdo) {
            $config = require __DIR__ . "/../config/config.php";

            $dbData = $config["db"];

            $dsn = sprintf(
                "mysql:host=%s;dbname=%s;charset=%s",
                $dbData["host"],
                $dbData["name"],
                $dbData["charset"]
            );

            self::$pdo = new PDO($dsn, $dbData["user"], $dbData["pass"], [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        }

        return self::$pdo;
    }
}
