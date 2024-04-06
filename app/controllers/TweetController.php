<?php

class TweetController extends Controller
{
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_id = $_SESSION['user_id'];
            $tweet_content = $_POST['tweet_content'];

            if (empty($tweet_content)) {
                $error = "El tweet no puede estar vacío";
                $tweet_errors = array($error);
                $this->loadView('create', ['title' => 'Crear Tweet', 'tweet_errors' => $tweet_errors]);
            } else {

                $this->loadModel('Tweet');
                $tweet = new Tweet();
                $tweet->createTweet($user_id, $tweet_content);
                $this->redirect('/index');
            }
        }
    }

    public function allTweets()
    {
        $this->handleUrlAccessRestriction(__CLASS__, __FUNCTION__);

        $this->loadModel('Tweet');
        $tweet = new Tweet();
        $tweets = $tweet->getAllTweets();
        
        return $tweets;
    }

    public function tweetsByUser($user_id)
    {
        $this->handleUrlAccessRestriction(__CLASS__, __FUNCTION__);

        $this->loadModel('Tweet');
        $tweet = new Tweet();
        $tweets = $tweet->getAllTweetsByUser($user_id);
        
        return $tweets;
    }

    public function followingTweets($user_id)
    {
        $this->handleUrlAccessRestriction(__CLASS__, __FUNCTION__);

        $this->loadModel('Tweet');
        $tweet = new Tweet();
        $tweets = $tweet->getFollowingTweets($user_id);

        return $tweets;
    }
}
