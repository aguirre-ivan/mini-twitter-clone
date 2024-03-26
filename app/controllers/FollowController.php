<?php

class FollowController extends Controller
{
    private $user;
    private $userLogged;
    private $userLoggedData;

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function setUserLogged($userLogged)
    {
        $this->userLogged = $userLogged;
    }

    public function setUserLoggedData($userLoggedData)
    {
        $this->userLoggedData = $userLoggedData;
    }

    public function follow()
    {
        $this->loadModel('Follow');
        $follow = new Follow();
        $follow->follow($this->userLogged, $this->user);
        $this->redirect('/user/profile/' . $this->user);
    }

    public function unfollow()
    {
        $this->loadModel('Follow');
        $follow = new Follow();
        $follow->unfollow($this->userLogged, $this->user);
        $this->redirect('/user/profile/' . $this->user);
    }

    public function followers()
    {
        $this->loadModel('Follow');
        $follow = new Follow();
        $followers = $follow->getFollowers($this->user);
        $this->loadView('followers', ['title' => 'Seguidores de ' . $this->userLoggedData['username'], 'followers' => $followers]);
    }

    public function following()
    {
        $this->loadModel('Follow');
        $follow = new Follow();
        $following = $follow->getFollowing($this->user);
        $this->loadView('following', ['title' => 'Seguindo ' . $this->userLoggedData['username'], 'following' => $following]);
    }
}