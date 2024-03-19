<?php

class Tweet {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function createTweet($userId, $tweetContent) {
        $stmt = $this->pdo->prepare("INSERT INTO tweets (user_id, tweet) VALUES (:user_id, :tweet)");
        $stmt->execute(['user_id' => $userId, 'tweet' => $tweetContent]);
        return $this->pdo->lastInsertId();
    }

    public function getAllTweets() {
        $stmt = $this->pdo->prepare("SELECT * FROM tweets ORDER BY created_at DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}