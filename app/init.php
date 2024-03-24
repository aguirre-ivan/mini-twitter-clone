<?php

require_once 'config/config.php';
require_once 'helpers/functions.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

spl_autoload_register(function ($lib) {
    require_once 'lib/' . $lib . '.php';
});