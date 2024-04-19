<?php

/**
 * Class UserController
 *
 * This class manages user-related actions such as registration, login, profile viewing, and editing.
 */
class UserController extends Controller
{
    /**
     * Redirects to the user's profile if logged in, otherwise redirects to login.
     */
    public function index()
    {
        $this->isIndexInUrl();

        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/user/login');
        } else {
            $this->redirect('/user/profile/' . $_SESSION['user_id']);
        }
    }

    /**
     * Displays the user's profile.
     *
     * @param int|null $user_id The ID of the user whose profile is being viewed. If not provided, the logged-in user's profile is displayed.
     * @param string|null $followMethod The follow method to execute (follow/unfollow), if provided.
     * 
     * If the user is not found, the method will return a 404 error.
     */
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
                $this->loadModel('Follow');
                $follow = new Follow();
                $following_count = $follow->getFollowingCount($user_id);
                $followers_count = $follow->getFollowersCount($user_id);

                $this->loadView('profile', ['title' => $page_title, 'user_data' => $user_data, 'tweets' => $tweets, 'following_count' => $following_count, 'followers_count' => $followers_count, 'profile_button' => $profile_button]);
            }
        }
    }

    /**
     * Displays the registration form.
     * 
     * If the user is already logged in, the method will redirect to the user's profile.
     */
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

    /**
     * Validates the registration form fields.
     *
     * @param string $name The name of the user.
     * @param string $username The username of the user.
     * @param string $email The email of the user.
     * @param string $password The password of the user.
     * 
     * @return array An array containing the validation errors.
     */
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

    /**
     * Displays the login form.
     * 
     * If the user is already logged in, the method will redirect to the user's profile.
     */
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

    /**
     * Displays the form to edit the user's profile.
     * 
     * If the user is not logged in, the method will redirect to the login form.
     */
    public function edit()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/user/login');
        } else {
            $this->loadModel('User');
            $user = new User();
            $user_id = $_SESSION['user_id'];
            $user_data = $user->getUserById($user_id);

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $name = $_POST['name'];
                $location = $_POST['location'];
                $bio = $_POST['bio'];
                $profile_image = $_FILES['profileImage'];
                $header_image = $_FILES['headerImage'];

                $filter_nulls = function ($value) {
                    return $value !== null;
                };

                $errors = array_filter(array(
                    $this->handleUserNameField($user_id, $name),
                    $this->handleLocationField($user_id, $location),
                    $this->handleBioField($user_id, $bio),
                    $this->handleProfileImageField($user_id, $profile_image),
                    $this->handleHeaderImageField($user_id, $header_image)
                ), $filter_nulls);

                if (empty($errors)) {
                    $this->redirect('/user/profile/' . $user_id);
                } else {
                    $this->loadView('edit_profile', ['title' => 'Editar perfil', 'user_data' => $user_data, 'errors' => $errors]);
                }
            } else {
                $this->loadView('edit_profile', ['title' => 'Editar perfil', 'user_data' => $user_data, 'errors' => array()]);
            }
        }
    }

    /**
     * Handles the user name field.
     *
     * @param int $user_id The ID of the user.
     * @param string $name The name of the user.
     * 
     * @return string|null An error message if the field is invalid, otherwise null.
     */
    private function handleUserNameField($user_id, $name)
    {
        if (empty($name)) {
            return 'El nombre es obligatorio';
        }

        $this->updateUserField($user_id, 'Name', $name);
    }

    /**
     * Handles the location field.
     *
     * @param int $user_id The ID of the user.
     * @param string $location The location of the user.
     * 
     * @return null.
     */
    private function handleLocationField($user_id, $location)
    {
        $this->updateUserField($user_id, 'Location', $location);
    }

    /**
     * Handles the bio field.
     *
     * @param int $user_id The ID of the user.
     * @param string $bio The bio of the user.
     * 
     * @return null.
     */
    private function handleBioField($user_id, $bio)
    {
        $this->updateUserField($user_id, 'Bio', $bio);
    }

    /**
     * Handles the profile image field.
     *
     * @param int $user_id The ID of the user.
     * @param array $profile_image The profile image file.
     * 
     * @return string|null An error message if the field is invalid, otherwise null.
     */
    private function handleProfileImageField($user_id, $profile_image)
    {
        return $this->handleImageField($user_id, $profile_image, 'ProfileImage');
    }

    /**
     * Handles the header image field.
     *
     * @param int $user_id The ID of the user.
     * @param array $header_image The header image file.
     * 
     * @return string|null An error message if the field is invalid, otherwise null.
     */
    private function handleHeaderImageField($user_id, $header_image)
    {
        return $this->handleImageField($user_id, $header_image, 'HeaderImage');
    }

    /**
     * Handles the image field.
     *
     * @param int $user_id The ID of the user.
     * @param array $image The image file.
     * @param string $image_field_name The name of the image field.
     * 
     * @return string|null An error message if the field is invalid, otherwise null.
     */
    private function handleImageField($user_id, $image, $image_field_name)
    {
        if ($image['size'] != 0) {
            $image_validation = $this->validateImage($image);
            if (!empty($image_validation)) {
                return $image_validation;
            }

            $image_name = $this->uploadImage($image);
            if (!$image_name) {
                return 'Error en la carga de imagen';
            }

            $this->updateUserField($user_id, $image_field_name, $image_name);
        }
    }

    /**
     * Updates a user field.
     *
     * @param int $user_id The ID of the user.
     * @param string $field The field to update.
     * @param string $value The value to set.
     * 
     * @return null.
     */
    private function updateUserField($user_id, $field, $value)
    {
        $this->loadModel('User');
        $user = new User();
        $userMethod = 'update' . $field . 'Field';

        $user->$userMethod($user_id, $value);
    }

    /**
     * Validates an image.
     *
     * @param array $image The image to validate.
     * 
     * @return string An error message if the image is invalid, otherwise an empty string.
     */
    private function validateImage($image)
    {
        $allowed_types = array('image/jpeg', 'image/png', 'image/gif');
        $max_size = MAX_UPLOAD_SIZE_MB * 1024 * 1024;

        if ($image['size'] > $max_size) {
            return 'Las  no pueden pesar mas de ' . MAX_UPLOAD_SIZE_MB . 'MB';
        }

        if (!in_array($image['type'], $allowed_types)) {
            return 'Solo se permiten imagenes en formato JPG, PNG o GIF';
        }

        return '';
    }

    /**
     * Uploads an image.
     *
     * @param array $image The image to upload.
     * 
     * @return string|bool The name of the uploaded image if successful, otherwise false.
     */
    private function uploadImage($image)
    {
        $image_name = uniqid() . $image['name'];
        if (move_uploaded_file($image['tmp_name'], UPLOAD_IMG_DIRECTORY . $image_name)) {
            return $image_name;
        } else {
            return false;
        }
    }

    /**
     * Validates the login form fields.
     *
     * @param string $username The username of the user.
     * @param string $password The password of the user.
     * 
     * @return array An array containing the validation errors.
     */
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

    /**
     * Logs out the user.
     */
    public function logout()
    {
        session_destroy();
        $this->redirect('/index');
    }

    /**
     * Displays the explore page.
     */
    public function explore()
    {
        $user_id = $_SESSION['user_id'];
        $this->loadController('FollowController');
        $followController = new FollowController();
        $followController->setUser($user_id);
        $users = $followController->notFollowing($user_id);
    }

    /**
     * Gets the profile button for the user.
     *
     * @param int $user_id The ID of the user.
     * 
     * @return array The profile button data.
     */
    private function getButtonProfile($user_id = null)
    {
        if (!isset($_SESSION['user_id'])) {
            return array('text' => 'Iniciar sesion para seguir', 'link' => '/user/login');
        }

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
