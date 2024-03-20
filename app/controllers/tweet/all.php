<?php
require_once './models/Tweet.php';
require_once './models/User.php';
require_once './helpers/config.php';
require_once './helpers/functions.php';

$user = new User($pdo);
$tweet = new Tweet($pdo);
$tweets = $tweet->getAllTweets();

$tweets_array = array();
foreach ($tweets as $tweet) {
    $user_data = $user->getUserById($tweet['user_id']);

    $tweet_array = array();
    $tweet_array['id'] = $tweet['id'];
    $tweet_array['username'] = $user_data['username'];
    $tweet_array['user_id'] = $user_data['id'];
    $tweet_array['tweet'] = $tweet['tweet'];
    array_push($tweets_array, $tweet_array);
}