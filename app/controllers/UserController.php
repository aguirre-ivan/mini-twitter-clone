<?php

class UserController extends Controller
{
    public function profile()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->indexPage();
        }
        $this->loadView('profile');
    }

    public function register()
    {
        if (isset($_SESSION['user_id'])) {
            $this->indexPage();
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->loadModel('User');
            $user = new User();

            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $validation = register_validation($username, $email, $password);

            if (!empty($validation)) {
                $registration_errors = $validation;
                $this->loadView('register', ['title' => 'Registrarse', 'registration_errors' => $registration_errors]);
            } elseif ($user->userExists($username, $email)) {
                $error = "El usuario o el correo electrónico ya están en uso";
                $registration_errors = array($error);
                $this->loadView('register', ['title' => 'Registrarse', 'registration_errors' => $registration_errors]);
            } else {
                $user->createUser($username, $email, $password);
                $this->loadView('register_successful', ['title' => 'Registro existoso']);
            }
        } else {
            $this->loadView('register', ['title' => 'Registrarse']);
        }
    }
}
