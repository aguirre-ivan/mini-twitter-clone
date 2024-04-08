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
        $profile_button = $this->getButtonProfile($user_id);

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
                $page_title = $user_data['name'] . ' (@' . $user_data['username'] . ') / Twitter';

                $this->loadView('profile', ['title' => $page_title, 'user_data' => $user_data, 'tweets' => $tweets, 'profile_button' => $profile_button]);
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

            $name = $_POST['name'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $validation = $this->registerValidation($name, $username, $email, $password);

            if (!empty($validation)) {
                $registration_errors = $validation;
                $this->loadView('register', ['title' => 'Registrarse', 'registration_errors' => $registration_errors]);
            } elseif ($user->userExists($username, $email)) {
                $error = "El usuario o el correo electrónico ya están en uso";
                $registration_errors = array($error);
                $this->loadView('register', ['title' => 'Registrarse', 'registration_errors' => $registration_errors]);
            } else {
                $user->createUser($name, $username, $email, $password);
                $this->loadView('register_successful', ['title' => 'Registro existoso']);
            }
        } else {
            $this->loadView('register', ['title' => 'Registrarse']);
        }
    }

    private function registerValidation($name, $username, $email, $password)
    {
        $errors = array();

        if (empty($name)) {
            array_push($errors, 'El nombre es obligatorio');
        }

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

    public function edit() {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/user/login');
        } else {
            $this->loadModel('User');
            $user = new User();
            $user_id = $_SESSION['user_id'];
            $user_data = $user->getUserById($user_id);
            $this->loadView('edit_profile', ['title' => 'Editar perfil', 'user_data' => $user_data]);

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $name = $_POST['name'];
                $location = $_POST['location'];
                $bio = $_POST['bio'];

                $errors = array();
                
                if (empty($name)) {
                    array_push($errors, 'El nombre es obligatorio');
                }

                $profile_image = $_FILES['profileImage'];
                $header_image = $_FILES['headerImage'];
                
                $images_validation = array_unique(array_merge($this->validateImage($profile_image), $this->validateImage($header_image)));
                
                $errors = array_merge($errors, $images_validation);
                
                $profile_image_upload = $this->uploadImage($profile_image);
                $header_image_upload = $this->uploadImage($header_image);

                if (!$profile_image_upload && !$header_image_upload) {
                    array_push($errors, 'Error en la carga de imagenes');
                }

                if (empty($errors)) {
                    $user->editUser($user_id, $name, $location, $bio, $profile_image_upload, $header_image_upload);
                    $this->redirect('/user/profile');
                } else {
                    $this->loadView('edit_profile', ['title' => 'Editar perfil', 'user_data' => $user_data, 'errors' => array_merge($errors, $images_validation)]);
                }
            }
        }
    }

    private function validateImage($image)
    {
        $errors = array();

        $allowed_types = array('image/jpeg', 'image/png', 'image/gif');
        $max_size = MAX_UPLOAD_SIZE_MB * 1024 * 1024;

        if ($image['size'] > $max_size) {
            array_push($errors, 'Las  no pueden pesar mas de ' . MAX_UPLOAD_SIZE_MB . 'MB');
        }

        if (!in_array($image['type'], $allowed_types)) {
            array_push($errors, 'Solo se permiten imagenes en formato JPG, PNG o GIF');
        }

        return $errors;
    }

    private function uploadImage($image) {
        $image_name = uniqid() . $image['name'];
        if (move_uploaded_file($image['tmp_name'], UPLOAD_IMG_DIRECTORY . $image_name)) {
            dd(UPLOAD_IMG_DIRECTORY . $image_name);
            return $image_name;
        } else {
            return false;
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
        $user_id = $_SESSION['user_id'];
        $this->loadController('FollowController');
        $followController = new FollowController();
        $followController->setUser($user_id);
        $users = $followController->notFollowing($user_id);
    }

    private function getButtonProfile($user_id)
    {
        $this->loadModel('Follow');
        $follow = new Follow();
        $isFollowing = $follow->isFollowing($_SESSION['user_id'], $user_id);

        if ($isFollowing) {
            return array('text' => 'Dejar de seguir', 'link' => '/user/profile/' . $user_id . '/unfollow');
        } elseif ($_SESSION['user_id'] == $user_id) {
            return array('text' => 'Editar perfil', 'link' => '/user/edit');
        }

        return array('text' => 'Seguir', 'link' => '/user/profile/' . $user_id . '/follow');
    }
}
