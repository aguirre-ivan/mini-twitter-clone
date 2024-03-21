<?php

class UserController extends Controller {
    public function profile() {
        if (!isset($_SESSION['user_id'])) {
            $this->indexPage();
        }
        $this->loadView('profile');
    }

    public function login() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $pdo = Database::getInstance()->getPdo();
            $user = new User($pdo);
        
            $username = $_POST['username'];
            $password = $_POST['password'];
        
            if (empty($username) || empty($password)) {
                $error = "El nombre de usuario y la contraseña son obligatorios";
                $_SESSION['login_error'] = $error;
                header("Location: ../../views/user/login_form.php");
            } else {
                $login = $user->login($username, $password);
                if (!$login) {
                    $error = "El nombre de usuario o la contraseña son incorrectos";
                    $_SESSION['login_error'] = $error;
                    header("Location: ../../views/user/login_form.php");
                } else {
                    $_SESSION['user_id'] = $login;
                    header("Location: ../../views/user/login_successful.php");
                }
            }
        } else {
            header("Location: ../../views/user/login_form.php");
        }
        $this->loadView('login');
    }
}