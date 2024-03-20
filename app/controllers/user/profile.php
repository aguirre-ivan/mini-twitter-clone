<?php
require_once '../../models/User.php';
require_once '../../helpers/config.php';
require_once '../../helpers/functions.php';

$user = new User($pdo);
$userId = $_GET['id'];
$user_data = $user->getUserById($userId);
if (!$user_data) {
    header("Location: index.php");
    exit;
}