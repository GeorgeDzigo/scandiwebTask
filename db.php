<?php
class Connection {
      public static function db() {
      $pdo = new PDO("mysql:host=localhost;dbname=id17519548_scandiwebtask", "id17519548_rooot", "2+Vai/U^e&V/[2a2");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
      }
}