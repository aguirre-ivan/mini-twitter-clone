<?php

/**
 * Class User
 *
 * Represents a user and provides methods for user-related operations.
 */
class User
{
    private $pdo;

    /**
     * User constructor.
     *
     * Initializes the User object and sets up the database connection.
     */
    public function __construct()
    {
        $database = new Database;
        $this->pdo = $database->getPdo();
    }

    /**
     * Create a new user.
     *
     * @param string $name     The user's name.
     * @param string $username The user's username.
     * @param string $email    The user's email address.
     * @param string $password The user's password.
     *
     * @return int The ID of the newly created user.
     */
    public function createUser($name, $username, $email, $password)
    {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO users (name, username, email, password) VALUES (:name, :username, :email, :password)");
        $stmt->execute(['name' => $name, 'username' => $username, 'email' => $email, 'password' => $password]);
        $user_id = $this->pdo->lastInsertId();
        $stmt = $this->pdo->prepare("INSERT INTO users_info (user_id) VALUES (:user_id)");
        $stmt->execute(['user_id' => $user_id]);
        return $user_id;
    }

    /**
     * Log in a user.
     *
     * @param string $username The user's username.
     * @param string $password The user's password.
     *
     * @return mixed The ID of the user if login successful, otherwise false.
     */
    public function login($username, $password)
    {
        $stmt = $this->pdo->prepare("SELECT id, username, password FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch();
        if ($user && password_verify($password, $user['password'])) {
            return $user['id'];
        }
        return false;
    }

    /**
     * Check if a username or email already exists in the database.
     *
     * @param string $username The username to check.
     * @param string $email    The email to check.
     *
     * @return bool True if the username or email exists, otherwise false.
     */
    public function userExists($username, $email)
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username OR email = :email");
        $stmt->execute(['username' => $username, 'email' => $email]);
        $count = $stmt->fetchColumn();
        return $count > 0;
    }

    /**
     * Get user information by ID.
     *
     * @param int $id The ID of the user.
     *
     * @return mixed An array containing user information, or false if not found.
     */
    public function getUserById($id)
    {
        $stmt = $this->pdo->prepare("SELECT users.*, users_info.location, users_info.header_image, users_info.profile_image, users_info.bio FROM users LEFT JOIN users_info ON users.id = users_info.user_id WHERE users.id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    /**
     * Update user information.
     *
     * @param int    $id           The ID of the user.
     * @param string $name         The user's name.
     * @param string $location     The user's location.
     * @param string $bio          The user's biography.
     * @param string $headerImage  The URL of the user's header image.
     * @param string $profileImage The URL of the user's profile image.
     */
    public function editUser($id, $name, $location, $bio, $headerImage, $profileImage)
    {
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

    /**
     * Update the name field of a user.
     *
     * @param int    $id   The ID of the user.
     * @param string $name The new name.
     */
    public function updateNameField($id, $name)
    {
        $stmt = $this->pdo->prepare("UPDATE users SET name = :name WHERE id = :id");
        $stmt->execute(['name' => $name, 'id' => $id]);
    }

    /**
     * Update the location field of a user.
     *
     * @param int    $id       The ID of the user.
     * @param string $location The new location.
     */
    public function updateLocationField($id, $location)
    {
        $stmt = $this->pdo->prepare("UPDATE users_info SET location = :location WHERE user_id = :id");
        $stmt->execute(['location' => $location, 'id' => $id]);
    }

    /**
     * Update the bio field of a user.
     *
     * @param int    $id  The ID of the user.
     * @param string $bio The new biography.
     */
    public function updateBioField($id, $bio)
    {
        $stmt = $this->pdo->prepare("UPDATE users_info SET bio = :bio WHERE user_id = :id");
        $stmt->execute(['bio' => $bio, 'id' => $id]);
    }

    /**
     * Update the header image field of a user.
     *
     * @param int    $id           The ID of the user.
     * @param string $headerImage  The new URL of the header image.
     */
    public function updateHeaderImageField($id, $headerImage)
    {
        $stmt = $this->pdo->prepare("UPDATE users_info SET header_image = :headerImage WHERE user_id = :id");
        $stmt->execute(['headerImage' => $headerImage, 'id' => $id]);
    }

    /**
     * Update the profile image field of a user.
     *
     * @param int    $id           The ID of the user.
     * @param string $profileImage The new URL of the profile image.
     */
    public function updateProfileImageField($id, $profileImage)
    {
        $stmt = $this->pdo->prepare("UPDATE users_info SET profile_image = :profileImage WHERE user_id = :id");
        $stmt->execute(['profileImage' => $profileImage, 'id' => $id]);
    }
}
