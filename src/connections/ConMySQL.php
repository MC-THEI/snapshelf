<?php

namespace App\connections;
use PDO;

class ConMySQL {
    public function connectToDB1() {
        $pdo = new PDO("mysql:host=localhost" . ";dbname=Users", "Tony", "ged33njv");
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        return $pdo;
    }
    public function connectToDB2() {
        $pdo = new PDO("mysql:host=localhost" . ";dbname=Users", "Tony", "ged33njv");
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        return $pdo;
    }
}