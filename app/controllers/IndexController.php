<?php

class IndexController extends Controller
{
    public function index()
    {
        $this->isIndexInUrl();

        if (!isset($_SESSION['user_id'])) {
            $this->loadView('index', ['title' => 'Bienvenido a Twitter']);
        } else {
            $this->loadModel('Tweet');
            $tweet = new Tweet();
            $tweets = $tweet->getAllTweets();
            $this->loadController('TweetController');
            $tweetController = new TweetController();
            $tweets = $tweetController->allTweets();
            $this->loadView('feed', ['title' => 'Inicio', 'tweets' => $tweets]);
        }
    }
}