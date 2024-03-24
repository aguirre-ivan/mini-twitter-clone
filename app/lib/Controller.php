<?php

class Controller
{
    public function loadModel($model)
    {
        require_once '../app/models/' . $model . '.php';
        return new $model;
    }

    public function loadController($controller)
    {
        require_once '../app/controllers/' . $controller . '.php';
        return new $controller;
    }

    public function loadView($view, $page_data = [])
    {
        $view_file = '../app/views/pages/' . $view . '.php';
        if (file_exists($view_file)) {
            require_once $view_file;
        } else {
            $this->notFound();
        }
    }

    public function notFound()
    {
        require_once '../app/views/pages/page_not_found.php';
    }

    public function index(){
        if ($this -> getUrl() == ['index']) {
            $this->loadView('index');
        } else {
            $this -> notFound();
        }
    }

    public function redirect($location)
    {
        header("Location: $location");
    }

    public function getUrl()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        } else {
            return [];
        }
    }
}
