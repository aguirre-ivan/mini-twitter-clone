<?php
session_start();
require_once '../../models/User.php';
require_once '../../helpers/config.php';
require_once '../../helpers/functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = new User($pdo);

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $validation = register_validation($username, $email, $password);

    if (!empty($validation)) {
        $_SESSION['registration_error'] = $validation;
    } elseif ($user->userExists($username, $email)) {
        $error = "El usuario o el correo electrónico ya están en uso";
        $_SESSION['registration_error'] = array($error);
    } else {
        $user->createUser($username, $email, $password);
        header("Location: ../../views/user/registration_successful.php");
        exit();
    }

    header("Location: ../../views/user/registration_form.php");
} else {
    header("Location: ../../../index.php");
}
