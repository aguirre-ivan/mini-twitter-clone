<?php
session_start();
require_once '../../models/User.php';
require_once '../../helpers/config.php';
require_once '../../helpers/functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = new User($pdo);

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $error = "El nombre de usuario y la contraseña son obligatorios";
        $_SESSION['login_error'] = $error;
        header("Location: ../../views/user/login-form.php");
    } else {
        $login = $user->login($username, $password);
        if (!$login) {
            $error = "El nombre de usuario o la contraseña son incorrectos";
            $_SESSION['login_error'] = $error;
            header("Location: ../../views/user/login-form.php");
        }
        header("Location: ../../views/user/login-successful.php");
    }
} else {
    header("Location: ../../views/user/login-form.php");
}
