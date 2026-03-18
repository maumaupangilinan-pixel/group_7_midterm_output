<?php


class Connection {
    private static $pdo = null;

    // Database configuration variables
    private static $host = "localhost";
    private static $dbname = "online_store_system";
    private static $user = "postgres";
    private static $password = "852963";
    private static $port = 5432; 




    public static function get() {
        if (self::$pdo === null) {
            try {
                $dsn = "pgsql:host=" . self::$host . ";port=" . self::$port . ";dbname=" . self::$dbname;
                self::$pdo = new PDO($dsn, self::$user, self::$password, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]);
            } catch (PDOException $e) {
                // Proper error handling
                echo "Database connection failed: " . $e->getMessage();
                exit; // Stop script if connection fails
            }
        }
        return self::$pdo;
    }
}