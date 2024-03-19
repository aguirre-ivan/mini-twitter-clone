<?php
require_once '../../models/Tweet.php';
require_once '../../models/User.php';
require_once '../../helpers/config.php';
require_once '../../helpers/functions.php';

$user = new User($pdo);
$user_data = $user->getUserById($_GET['id']);
if (!$user_data) {
    header("Location: index.php");
    exit;
}
$tweet = new Tweet($pdo);
$tweets = $tweet->getAllTweetsByUser($_GET['id']);

$tweets_array = array();
foreach ($tweets as $tweet) {
    $tweet_array = array();
    $tweet_array['id'] = $tweet['id'];
    $tweet_array['username'] = $user_data['username'];
    $tweet_array['tweet'] = $tweet['tweet'];
    array_push($tweets_array, $tweet_array);
}
