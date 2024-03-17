<?php
require_once '../../models/User.php';
require_once '../../helpers/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = new User($pdo);
    
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user->createUser($username, $email, $password);

    header("Location: ../../views/user/registration-successful.php");
    exit();
} else {
    require_once '../views/registration-form.php';
}
