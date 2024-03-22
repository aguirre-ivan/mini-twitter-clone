<?php

function dd($variable) {
    echo '<pre>';
    var_dump($variable);
    echo '</pre>';
}

function register_validation($username, $email, $password) {
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

function login_validation($username, $password) {
    $errors = array();

    if (empty($username)) {
        array_push($errors, 'El nombre de usuario es obligatorio');
    }

    if (empty($password)) {
        array_push($errors, 'La contraseña es obligatoria');
    }

    return $errors;
}