<?php

require_once 'functions.php';

define('ENV_FILE_PATH', __DIR__ . '/../.env');

if (!file_exists(ENV_FILE_PATH)) {
    die("El archivo .env no existe" . ENV_FILE_PATH);
}

$env_vars = parse_ini_file(ENV_FILE_PATH);

$db_host = $env_vars['DB_HOST'];
$db_name = $env_vars['DB_NAME'];
$db_user = $env_vars['DB_USER'];
$db_pass = $env_vars['DB_PASS'];

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexión exitosa a la base de datos";
} catch (PDOException $e) {
    die("Error al conectar a la base de datos: " . $e->getMessage());
}
