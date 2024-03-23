<?php

class Controller
{
    public function loadModel($model)
    {
        require_once '../app/models/' . $model . '.php';
        return new $model;
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
        $this->loadView('index');
    }

    public function redirect($location)
    {
        header("Location: $location");
    }
}
