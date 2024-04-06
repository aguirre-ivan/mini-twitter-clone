<?php

class Tweet
{
    private $pdo;

    public function __construct()
    {
        $database = new Database;
        $this->pdo = $database->getPdo();
    }

    public function createTweet($userId, $tweetContent)
    {
        $stmt = $this->pdo->prepare("INSERT INTO tweets (user_id, tweet) VALUES (:user_id, :tweet)");
        $stmt->execute(['user_id' => $userId, 'tweet' => $tweetContent]);
        return $this->pdo->lastInsertId();
    }

    public function getAllTweets()
    {
        $stmt = $this->pdo->prepare("SELECT tweets.*, users.username AS author_username, users.name AS author_name FROM tweets LEFT JOIN users ON tweets.user_id = users.id ORDER BY tweets.created_at DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getAllTweetsByUser($userId)
    {
        $stmt = $this->pdo->prepare("SELECT tweets.*, users.username AS author_username, users.name AS author_name FROM tweets LEFT JOIN users ON tweets.user_id = users.id WHERE tweets.user_id = :user_id ORDER BY tweets.created_at DESC");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll();
    }

    public function getFollowingTweets($userId)
    {
        $stmt = $this->pdo->prepare("SELECT tweets.*, users.username AS author_username, users.name AS author_name FROM tweets LEFT JOIN users ON tweets.user_id = users.id WHERE tweets.user_id IN (SELECT followed_id FROM follows WHERE follower_id = :user_id) ORDER BY tweets.created_at DESC");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll();
    }
}
