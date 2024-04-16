<?php

/**
 * Class Tweet
 *
 * Represents a tweet and provides methods for tweet-related operations.
 */
class Tweet
{
    private $pdo;

    /**
     * Tweet constructor.
     *
     * Initializes the Tweet object and sets up the database connection.
     */
    public function __construct()
    {
        $database = new Database;
        $this->pdo = $database->getPdo();
    }

    /**
     * Create a new tweet.
     *
     * @param int    $userId       The ID of the user who is creating the tweet.
     * @param string $tweetContent The content of the tweet.
     *
     * @return int The ID of the newly created tweet.
     */
    public function createTweet($userId, $tweetContent)
    {
        $stmt = $this->pdo->prepare("INSERT INTO tweets (user_id, tweet) VALUES (:user_id, :tweet)");
        $stmt->execute(['user_id' => $userId, 'tweet' => $tweetContent]);
        return $this->pdo->lastInsertId();
    }

    /**
     * Get all tweets.
     *
     * @return array An array containing all tweets, along with author information.
     */
    public function getAllTweets()
    {
        $stmt = $this->pdo->prepare("SELECT tweets.*, users.username AS author_username, users.name AS author_name FROM tweets LEFT JOIN users ON tweets.user_id = users.id ORDER BY tweets.created_at DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Get all tweets by a specific user.
     *
     * @param int $userId The ID of the user whose tweets are being retrieved.
     *
     * @return array An array containing all tweets by the specified user, along with author information.
     */
    public function getAllTweetsByUser($userId)
    {
        $stmt = $this->pdo->prepare("SELECT tweets.*, users.username AS author_username, users.name AS author_name FROM tweets LEFT JOIN users ON tweets.user_id = users.id WHERE tweets.user_id = :user_id ORDER BY tweets.created_at DESC");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll();
    }

    /**
     * Get tweets from users that a specific user is following.
     *
     * @param int $userId The ID of the user whose followed tweets are being retrieved.
     *
     * @return array An array containing tweets from users that the specified user is following, along with author information.
     */
    public function getFollowingTweets($userId)
    {
        $stmt = $this->pdo->prepare("SELECT tweets.*, users.username AS author_username, users.name AS author_name FROM tweets LEFT JOIN users ON tweets.user_id = users.id WHERE tweets.user_id IN (SELECT followed_id FROM follows WHERE follower_id = :user_id) ORDER BY tweets.created_at DESC");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll();
    }
}
