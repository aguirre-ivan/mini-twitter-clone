<?php

class IndexController extends Controller
{
    public function index()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->loadView('landing', ['title' => 'Bienvenido a Twitter']);
        } else {
            $this->loadView('index', ['title' => 'Inicio']);
        }
    }
}