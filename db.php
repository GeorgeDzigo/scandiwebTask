<?php
class Connection {
      const HOST = "localhost";
      const DBNAME = "id17519548_scandiwebtask";
      const DBTABLE = "id17519548_rooot";
      const PASSWORD = "2+Vai/U^e&V/[2a2";
      public static function db() {
      $pdo = new PDO("mysql:host=".self::HOST.";dbname=".self::DBNAME, self::DBTABLE, self::PASSWORD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
      }
}