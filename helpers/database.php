<?php

class Database {
    private $pdo;

    public function __construct($host, $db_name, $user, $password) {
        $dsn = "mysql:host=$host;dbname=$db_name";
        $this->pdo = new PDO($dsn, $user, $password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Conexión exitosa";
    }

    public function getPdo() {
        return $this->pdo;
    }

    public function getConnectionStatus() {
        return $this->pdo->getAttribute(PDO::ATTR_CONNECTION_STATUS);
    }
}