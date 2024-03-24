<?php

class Core
{
    protected $controller;
    protected $method;
    protected $parameters = [];

    public function __construct()
    {
        $url = $this->getUrl();

        if (empty($url) or ($url[0] == 'index' and count($url) == 1)) {
            $controllerName = 'IndexController';
            $methodName = 'index';
        } else {
            $controllerName = ucwords($url[0] ?? '') . 'Controller';
            $methodName = $url[1] ?? 'index';
        }

        $controllerFile = '../app/controllers/' . $controllerName . '.php';

        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            $this->controller = new $controllerName;

            if (method_exists($this->controller, $methodName)) {
                $this->method = $methodName;
                $this->parameters = array_slice($url, 2);
            } else {
                $this->method = 'notFound';
            }
        } else {
            $this->method = 'notFound';
        }

        call_user_func_array([$this->controller, $this->method], $this->parameters);
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
