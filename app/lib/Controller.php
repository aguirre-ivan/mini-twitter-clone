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
        die();
    }

    public function redirect($location)
    {
        header("Location: $location");
    }

    private function getUrl()
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

    public function handleUrlAccessRestriction ($class_name, $method_name) {
        $controller = strtolower(str_replace('Controller', '', $class_name));

        if ($this->getUrl() == [$controller, $method_name]) {
            $this->notFound();
        }
    }

    public function isIndexInUrl() {
        if (isset($this->getUrl()[1]) and $this->getUrl()[1] == 'index') {
            $this->notFound();
        }
    }

    public function assertParamsAmount($amount) {
        if (count($this->getUrl()) != $amount + 2) {
            $this->notFound();
        }
    }
}
