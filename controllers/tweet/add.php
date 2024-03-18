<?php
session_start();
require_once '../../models/Tweet.php';
require_once '../../helpers/config.php';
require_once '../../helpers/functions.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $tweet_content = $_POST['tweet_content'];
    $tweet = new Tweet($pdo);
    $tweet->createTweet($user_id, $tweet_content);
    header('Location: ../../views/feed.php');
}