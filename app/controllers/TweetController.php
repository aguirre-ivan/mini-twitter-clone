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
        
        return $this->getTweetsArray($tweets);
    }

    public function tweetsByUser($user_id)
    {
        $this->handleUrlAccessRestriction(__CLASS__, __FUNCTION__);

        $this->loadModel('Tweet');
        $tweet = new Tweet();
        $tweets = $tweet->getAllTweetsByUser($user_id);
        
        return $this->getTweetsArray($tweets);
    }

    public function followingTweets($user_id)
    {
        $this->handleUrlAccessRestriction(__CLASS__, __FUNCTION__);

        $this->loadModel('Tweet');
        $tweet = new Tweet();
        $tweets = $tweet->getFollowingTweets($user_id);

        return $this->getTweetsArray($tweets);
    }

    private function getTweetsArray($tweets)
    {
        $this->loadModel('User');
        $user = new User();
        $tweets_array = array();
        foreach ($tweets as $tweet) {
            $user_data = $user->getUserById($tweet['user_id']);

            $single_tweet = array();
            $single_tweet['id'] = $tweet['id'];
            $single_tweet['user_id'] = $tweet['user_id'];
            $single_tweet['username'] = $user_data['username'];
            $single_tweet['tweet'] = $tweet['tweet'];
            array_push($tweets_array, $single_tweet);
        }

        return $tweets_array;
    }
}
