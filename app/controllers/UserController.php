<?php

class UserController extends Controller
{
    public function index()
    {
        $this->isIndexInUrl();

        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/user/login');
        } else {
            $this->redirect('/user/profile/' . $_SESSION['user_id']);
        }
    }

    public function profile($user_id = null, $followMethod = null)
    {
        $this->loadModel('User');
        $user = new User();
        $user_data = $user->getUserById($user_id);

        if (!$user_data) {
            $this->notFound();
        } else {
            $this->loadController('TweetController');
            $tweetController = new TweetController();
            $tweets = $tweetController->tweetsByUser($user_id);
            
            if (isset($followMethod)) {
                $this->assertParamsAmount(2);

                $this->loadController('FollowController');
                $followController = new FollowController();
                $followController->setUser($user_id);
                $followController->setUserLogged($_SESSION['user_id']);
                $followController->setUserLoggedData($user->getUserById($_SESSION['user_id']));
                
                if (!method_exists($followController, $followMethod)) {
                    $this->notFound();
                }
                
                $followController->$followMethod();
            } else {
                $this->loadView('profile', ['title' => '@'. $user_data['username'] . ' / Twitter', 'user_data' => $user_data, 'tweets' => $tweets]);
            }
        }
    }

    public function register()
    {
        if (isset($_SESSION['user_id'])) {
            $this->redirect('/user');
        } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->loadModel('User');
            $user = new User();

            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $validation = $this->registerValidation($username, $email, $password);

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

    private function registerValidation($username, $email, $password)
    {
        $errors = array();

        if (empty($username)) {
            array_push($errors, 'El nombre de usuario es obligatorio');
        }

        if (empty($email)) {
            array_push($errors, 'El correo electrónico es obligatorio');
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, 'El correo electrónico no es válido');
        }

        if (empty($password)) {
            array_push($errors, 'La contraseña es obligatoria');
        }

        return $errors;
    }

    public function login()
    {
        if (isset($_SESSION['user_id'])) {
            $this->redirect('/user');
        } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->loadModel('User');
            $user = new User();

            $username = $_POST['username'];
            $password = $_POST['password'];

            $validation = $this->loginValidation($username, $password);

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

    private function loginValidation($username, $password)
    {
        $errors = array();

        if (empty($username)) {
            array_push($errors, 'El nombre de usuario es obligatorio');
        }

        if (empty($password)) {
            array_push($errors, 'La contraseña es obligatoria');
        }

        return $errors;
    }

    public function logout()
    {
        session_destroy();
        $this->redirect('/index');
    }

    public function explore()
    {
        $this->loadModel('User');
        $user = new User();
        $users = $user->getAllUsers();
        $this->loadView('explore', ['title' => 'Explorar', 'users' => $users]);
    }
}
