<?php
class User {
    private $pdo;

    public function __construct() {
        $database = new Database;
        $this->pdo = $database->getPdo();
    }

    public function createUser($username, $email, $password) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
        $stmt->execute(['username' => $username, 'email' => $email, 'password' => $password]);
        return $this->pdo->lastInsertId();
    }

    public function login($username, $password) {
        $stmt = $this->pdo->prepare("SELECT id, username, password FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch();
        if ($user && password_verify($password, $user['password'])) {
            return $user['id'];
        }
        return false;
    }

    public function userExists($username, $email) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username OR email = :email");
        $stmt->execute(['username' => $username, 'email' => $email]);
        $count = $stmt->fetchColumn();
        return $count > 0;
    }

    public function getUserById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function getAllUsers($limit = null) {
        $sql = "SELECT * FROM users";
        if ($limit) {
            $sql .= " LIMIT $limit";
        }
        $stmt = $this->pdo->query($sql . " ORDER BY id DESC");
        return $stmt->fetchAll();
    }
}