<?php

namespace Database;

use PDO;
use PDOException;

class Database {
    private static $host = "localhost";
    private static $db_name = "shop_easy";
    private static $username = "saikyouboi";
    private static $password = "ilias1234";
    private static $instance = null;

    private function __construct() {;
        
    }

    public static function getInstance() {
        if (self::$instance == null) {
            try {
                self::$instance = new PDO("mysql:host=" . static::$host . ";dbname=" . static::$db_name, static::$username, static::$password,[PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
            } catch(PDOException $exception) {
                echo "Connection error: " . $exception->getMessage();
            }
        }
        return self::$instance;
    }

}