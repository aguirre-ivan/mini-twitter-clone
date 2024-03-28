<?php

class IndexController extends Controller
{
    public function index($params = [])
    {
        $this->isIndexInUrl();
        $this->redirect('/index/feed');
    }

    public function feed()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('index');
        } else {
            $this->loadModel('Tweet');
            $tweet = new Tweet();
            $tweets = $tweet->getAllTweets();
            $this->loadController('TweetController');
            $tweetController = new TweetController();
            $tweets = $tweetController->allTweets();
            $this->loadView('feed', ['title' => 'Inicio / Twitter', 'tweets' => $tweets]);
        }
    }

    public function following()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('index');
        } else {
            $this->loadModel('Tweet');
            $this->loadController('TweetController');
            $tweetController = new TweetController();
            $tweets = $tweetController->followingTweets($_SESSION['user_id']);
            $this->loadView('feed', ['title' => 'Inicio / Twitter', 'tweets' => $tweets]);
        }
    }
}