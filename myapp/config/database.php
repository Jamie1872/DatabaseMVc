<?php
class Database {
    private static $host = "mtc353.encs.concordia.ca";
    private static $db   = "mtc353_1";
    private static $user = "mtc353_1";
    private static $pass = "waffles1";

    public static function connect() {
        try {
            $pdo = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$db, self::$user, self::$pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
}
?>
