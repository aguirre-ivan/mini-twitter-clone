<?php

class Database {
    private $pdo;

    public function __construct($host, $db_name, $user, $password) {
        $dsn = "mysql:host=$host;dbname=$db_name";
        $this->pdo = new PDO($dsn, $user, $password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getPdo() {
        return $this->pdo;
    }
}