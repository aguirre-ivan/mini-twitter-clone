<?php

class Follow {
    private $pdo;

    public function __construct() {
        $database = new Database;
        $this->pdo = $database->getPdo();
    }

    public function follow($followerId, $followedId) {
        if (!$this->isFollowing($followerId, $followedId)) {   
            $stmt = $this->pdo->prepare("INSERT INTO follows (follower_id, followed_id) VALUES (:follower_id, :followed_id)");
            $stmt->execute(['follower_id' => $followerId, 'followed_id' => $followedId]);
        }
    }

    public function unfollow($followerId, $followedId) {
        if ($this->isFollowing($followerId, $followedId)) {
            $stmt = $this->pdo->prepare("DELETE FROM follows WHERE follower_id = :follower_id AND followed_id = :followed_id");
            $stmt->execute(['follower_id' => $followerId, 'followed_id' => $followedId]);
        }
    }

    public function isFollowing($followerId, $followedId) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM follows WHERE follower_id = :follower_id AND followed_id = :followed_id");
        $stmt->execute(['follower_id' => $followerId, 'followed_id' => $followedId]);
        $count = $stmt->fetchColumn();
        return $count > 0;
    }

    public function getFollowers($userId) {
        $stmt = $this->pdo->prepare("SELECT * FROM users JOIN follows ON users.id = follows.follower_id WHERE follows.followed_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll();
    }

    public function getFollowing($userId) {
        $stmt = $this->pdo->prepare("SELECT * FROM users JOIN follows ON users.id = follows.followed_id WHERE follows.follower_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll();
    }
}