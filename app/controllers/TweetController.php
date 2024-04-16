<?php

/**
 * Class TweetController
 *
 * Controller for managing tweets and related operations.
 */
class TweetController extends Controller
{
    /**
     * Create a new tweet.
     *
     * @return mixed|null The created tweet, or null if no tweet was created.
     */
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

    /**
     * Get all tweets.
     *
     * @return array An array containing all tweets.
     */
    public function allTweets()
    {
        $this->handleUrlAccessRestriction(__CLASS__, __FUNCTION__);

        $this->loadModel('Tweet');
        $tweet = new Tweet();
        $tweets = $tweet->getAllTweets();

        return $tweets;
    }

    /**
     * Get tweets by a specific user.
     *
     * @param int $user_id The ID of the user whose tweets are being retrieved.
     *
     * @return array An array containing all tweets by the specified user.
     */
    public function tweetsByUser($user_id)
    {
        $this->handleUrlAccessRestriction(__CLASS__, __FUNCTION__);

        $this->loadModel('Tweet');
        $tweet = new Tweet();
        $tweets = $tweet->getAllTweetsByUser($user_id);

        return $tweets;
    }

    /**
     * Get tweets from users that a specific user is following.
     *
     * @param int $user_id The ID of the user whose followed tweets are being retrieved.
     *
     * @return array An array containing tweets from users that the specified user is following.
     */
    public function followingTweets($user_id)
    {
        $this->handleUrlAccessRestriction(__CLASS__, __FUNCTION__);

        $this->loadModel('Tweet');
        $tweet = new Tweet();
        $tweets = $tweet->getFollowingTweets($user_id);

        return $tweets;
    }
}
