<?php
session_start();
require_once '../../models/User.php';
require_once '../../helpers/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = new User($pdo);

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($user->userExists($username, $email)) {
        $error = "El usuario o el correo electrónico ya están en uso";
        $_SESSION['registration_error'] = $error;
        header("Location: ../../views/user/registration-form.php");
    } else {
        $user->createUser($username, $email, $password);
        header("Location: ../../views/user/registration-successful.php");
    }
} else {
    header("Location: ../../views/user/registration-form.php");
}
