<?php
class Connection {
      const HOST = "localhost";
      const DBNAME = "juniorphp";
      const USERNAME = "root";
      const PASSWORD = "gabogio210";
      public static function db() {
      $pdo = new PDO("mysql:host=".self::HOST.";dbname=".self::DBNAME, self::USERNAME, self::PASSWORD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
      }
}