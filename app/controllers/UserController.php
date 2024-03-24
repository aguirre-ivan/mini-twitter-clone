<?php

class UserController extends Controller
{
    public function index()
    {
        $this->profile();
    }

    public function profile()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/user/login');
        } else {
            $this->loadModel('User');
            $user = new User();
            $user_data = $user->getUserById($_SESSION['user_id']);
            $this->loadView('profile', ['title' => 'Perfil', 'user_data' => $user_data]);
        }
    }

    public function register()
    {
        if (isset($_SESSION['user_id'])) {
            $this->redirect('/user/profile');
        } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    public function login()
    {
        if (isset($_SESSION['user_id'])) {
            $this->redirect('/user/profile');
        } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->loadModel('User');
            $user = new User();

            $username = $_POST['username'];
            $password = $_POST['password'];

            $validation = login_validation($username, $password);

            if (!empty($validation)) {
                $login_errors = $validation;
                $this->loadView('login', ['title' => 'Iniciar sesión', 'login_errors' => $login_errors]);
            } else {
                $login = $user->login($username, $password);
                if (!$login) {
                    $login_errors = array("El nombre de usuario o la contraseña son incorrectos");
                    $this->loadView('login', ['title' => 'Iniciar sesión', 'login_errors' => $login_errors]);
                } else {
                    $_SESSION['user_id'] = $login;
                    $this->loadView('login_successful', ['title' => 'Bienvenido']);
                }
            }
        } else {
            $this->loadView('login', ['title' => 'Iniciar sesión']);
        }
    }

    public function logout()
    {
        session_destroy();
        $this->redirect('/index');
    }
}
