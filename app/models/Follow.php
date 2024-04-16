<?php

/**
 * Class Follow
 *
 * Represents the relationship between users following each other and provides methods for managing follows.
 */
class Follow
{
    private $pdo;

    /**
     * Follow constructor.
     *
     * Initializes the Follow object and sets up the database connection.
     */
    public function __construct()
    {
        $database = new Database;
        $this->pdo = $database->getPdo();
    }

    /**
     * Follow a user.
     *
     * @param int $followerId The ID of the user who is following.
     * @param int $followedId The ID of the user being followed.
     */
    public function follow($followerId, $followedId)
    {
        if (!$this->isFollowing($followerId, $followedId)) {
            $stmt = $this->pdo->prepare("INSERT INTO follows (follower_id, followed_id) VALUES (:follower_id, :followed_id)");
            $stmt->execute(['follower_id' => $followerId, 'followed_id' => $followedId]);
        }
    }

    /**
     * Unfollow a user.
     *
     * @param int $followerId The ID of the user who is unfollowing.
     * @param int $followedId The ID of the user being unfollowed.
     */
    public function unfollow($followerId, $followedId)
    {
        if ($this->isFollowing($followerId, $followedId)) {
            $stmt = $this->pdo->prepare("DELETE FROM follows WHERE follower_id = :follower_id AND followed_id = :followed_id");
            $stmt->execute(['follower_id' => $followerId, 'followed_id' => $followedId]);
        }
    }

    /**
     * Check if a user is following another user.
     *
     * @param int $followerId The ID of the user who might be following.
     * @param int $followedId The ID of the user who might be followed.
     *
     * @return bool True if the user is following, otherwise false.
     */
    public function isFollowing($followerId, $followedId)
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM follows WHERE follower_id = :follower_id AND followed_id = :followed_id");
        $stmt->execute(['follower_id' => $followerId, 'followed_id' => $followedId]);
        $count = $stmt->fetchColumn();
        return $count > 0;
    }

    /**
     * Get followers of a user.
     *
     * @param int $userId The ID of the user whose followers are being retrieved.
     *
     * @return array An array containing all followers of the specified user.
     */
    public function getFollowers($userId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id IN (SELECT follower_id FROM follows WHERE followed_id = :user_id)");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll();
    }

    /**
     * Get users that a user is following.
     *
     * @param int $userId The ID of the user whose followed users are being retrieved.
     *
     * @return array An array containing all users that the specified user is following.
     */
    public function getFollowing($userId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id IN (SELECT followed_id FROM follows WHERE follower_id = :user_id)");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll();
    }

    /**
     * Get users that a user is not following.
     *
     * @param int $userId The ID of the user whose non-followed users are being retrieved.
     *
     * @return array An array containing all users that the specified user is not following.
     */
    public function getNotFollowing($userId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id NOT IN (SELECT followed_id FROM follows WHERE follower_id = :user_id) AND id != :user_id;");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll();
    }

    /**
     * Get the number of followers for a user.
     *
     * @param int $userId The ID of the user whose followers count is being retrieved.
     *
     * @return int The number of followers for the specified user.
     */
    public function getFollowersCount($userId)
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM follows WHERE followed_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchColumn();
    }

    /**
     * Get the number of users that a user is following.
     *
     * @param int $userId The ID of the user whose following count is being retrieved.
     *
     * @return int The number of users that the specified user is following.
     */
    public function getFollowingCount($userId)
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM follows WHERE follower_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchColumn();
    }
}
