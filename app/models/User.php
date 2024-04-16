<?php
class User {
    private $pdo;

    public function __construct() {
        $database = new Database;
        $this->pdo = $database->getPdo();
    }

    public function createUser($name, $username, $email, $password) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO users (name, username, email, password) VALUES (:name, :username, :email, :password)");
        $stmt->execute(['name' => $name, 'username' => $username, 'email' => $email, 'password' => $password]);
        $user_id = $this->pdo->lastInsertId();
        $stmt = $this->pdo->prepare("INSERT INTO users_info (user_id) VALUES (:user_id)");
        $stmt->execute(['user_id' => $user_id]);
        return $user_id;
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
        $stmt = $this->pdo->prepare("SELECT * FROM users LEFT JOIN users_info ON users.id = users_info.user_id WHERE users.id = :id");
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

    public function editUser($id, $name, $location, $bio, $headerImage, $profileImage) {
        $stmt = $this->pdo->prepare("UPDATE users SET name = :name WHERE id = :id");
        $stmt->execute(['name' => $name, 'id' => $id]);

        $stmt = $this->pdo->prepare("UPDATE users_info SET location = :location, bio = :bio WHERE user_id = :id");
        $stmt->execute(['location' => $location, 'bio' => $bio, 'id' => $id]);

        if ($headerImage) {
            $stmt = $this->pdo->prepare("UPDATE users_info SET header_image = :headerImage WHERE user_id = :id");
            $stmt->execute(['headerImage' => $headerImage, 'id' => $id]);
        }

        if ($profileImage) {
            $stmt = $this->pdo->prepare("UPDATE users_info SET profile_image = :profileImage WHERE user_id = :id");
            $stmt->execute(['profileImage' => $profileImage, 'id' => $id]);
        }
    }

    public function updateNameField($id, $name) {
        $stmt = $this->pdo->prepare("UPDATE users SET name = :name WHERE id = :id");
        $stmt->execute(['name' => $name, 'id' => $id]);
    }

    public function updateLocationField($id, $location) {
        $stmt = $this->pdo->prepare("UPDATE users_info SET location = :location WHERE user_id = :id");
        $stmt->execute(['location' => $location, 'id' => $id]);
    }

    public function updateBioField($id, $bio) {
        $stmt = $this->pdo->prepare("UPDATE users_info SET bio = :bio WHERE user_id = :id");
        $stmt->execute(['bio' => $bio, 'id' => $id]);
    }

    public function updateHeaderImageField($id, $headerImage) {
        $stmt = $this->pdo->prepare("UPDATE users_info SET header_image = :headerImage WHERE user_id = :id");
        $stmt->execute(['headerImage' => $headerImage, 'id' => $id]);
    }

    public function updateProfileImageField($id, $profileImage) {
        $stmt = $this->pdo->prepare("UPDATE users_info SET profile_image = :profileImage WHERE user_id = :id");
        $stmt->execute(['profileImage' => $profileImage, 'id' => $id]);
    }
}