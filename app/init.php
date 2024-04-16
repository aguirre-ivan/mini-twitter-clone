<?php

// Load configuration settings and helper functions
require_once 'config/config.php';
require_once 'helpers/functions.php';

// Start a session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Autoload classes using spl_autoload_register
spl_autoload_register(function ($lib) {
    require_once 'lib/' . $lib . '.php';
});