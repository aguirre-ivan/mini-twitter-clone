<?php

/**
 * IndexController
 *
 * This controller manages actions related to the index page and user feed.
 */
class IndexController extends Controller
{
    /**
     * IndexController constructor
     */
    public function index()
    {
        $this->isIndexInUrl();
        if (!isset($_SESSION['user_id'])) {
            $this->loadView('index', ['title' => 'Twitter']);
        } else {
            $this->redirect('/index/feed');
        }
    }

    /**
     * Displays the user's feed.
     */
    public function feed()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/index');
        } else {
            $this->loadModel('Tweet');
            $tweet = new Tweet();
            $tweets = $tweet->getAllTweets();
            $this->loadController('TweetController');
            $tweetController = new TweetController();
            $this->loadModel('User');
            $user = new User();
            $user_data = $user->getUserById($_SESSION['user_id']);
            $tweets = $tweetController->allTweets();
            $this->loadView('feed', ['title' => 'Inicio / Twitter', 'tweets' => $tweets, 'feed_type' => 'index', 'user_data' => $user_data]);
        }
    }

    /**
     * Displays the user's following feed.
     */
    public function following()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('index');
        } else {
            $this->loadModel('Tweet');
            $this->loadController('TweetController');
            $tweetController = new TweetController();
            $tweets = $tweetController->followingTweets($_SESSION['user_id']);
            $this->loadView('feed', ['title' => 'Inicio / Twitter', 'tweets' => $tweets, 'feed_type' => 'following']);
        }
    }
}
