<?php

/**
 * FollowController
 *
 * This controller manages actions related to following and unfollowing users,
 * as well as retrieving followers and following lists.
 */
class FollowController extends Controller
{
    private $user;
    private $userLogged;
    private $userLoggedData;

    /**
     * Sets the user ID being followed.
     *
     * @param int $user The ID of the user being followed.
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * Sets the ID of the logged-in user.
     *
     * @param int $userLogged The ID of the logged-in user.
     */
    public function setUserLogged($userLogged)
    {
        $this->userLogged = $userLogged;
    }

    /**
     * Sets data for the logged-in user.
     *
     * @param array $userLoggedData Data of the logged-in user.
     */
    public function setUserLoggedData($userLoggedData)
    {
        $this->userLoggedData = $userLoggedData;
    }

    /**
     * Follows a user.
     */
    public function follow()
    {
        if ($this->userLogged && $this->userLogged != $this->user) {
            $this->loadModel('Follow');
            $follow = new Follow();
            $follow->follow($this->userLogged, $this->user);
            $this->redirect('/user/profile/' . $this->user);
        }
    }

    /**
     * Unfollows a user.
     */
    public function unfollow()
    {
        if ($this->userLogged && $this->userLogged != $this->user) {
            $this->loadModel('Follow');
            $follow = new Follow();
            $follow->unfollow($this->userLogged, $this->user);
            $this->redirect('/user/profile/' . $this->user);
        }
    }

    /**
     * Retrieves followers of a user.
     */
    public function followers()
    {
        $this->loadModel('Follow');
        $follow = new Follow();
        $followers = $follow->getFollowers($this->user);
        $user_data = $this->loadUserHeader();
        $this->loadView('follows', ['title' => 'Seguidores de ' . $this->userLoggedData['username'], 'users' => $followers, 'user_data' => $user_data]);
    }

    /**
     * Retrieves users followed by a user.
     */
    public function following()
    {
        $this->loadModel('Follow');
        $follow = new Follow();
        $following = $follow->getFollowing($this->user);
        $user_data = $this->loadUserHeader();
        $this->loadView('follows', ['title' => 'Personas que sigue ' . $this->userLoggedData['username'], 'users' => $following, 'user_data' => $user_data]);
    }

    /**
     * Retrieves users not followed by the logged-in user.
     */
    public function notFollowing()
    {
        $this->loadModel('Follow');
        $follow = new Follow();
        $notFollowing = $follow->getNotFollowing($this->user);
        $this->loadView('explore', ['title' => 'Explorar', 'users' => $notFollowing]);
    }

    /**
     * Loads user data for display.
     *
     * @return array User data.
     */
    private function loadUserHeader()
    {
        $this->loadModel('User');
        $user = new User();
        return $user->getUserById($this->user);
    }
}