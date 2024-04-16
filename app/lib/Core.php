<?php

/**
 * Core Class
 * 
 * Handles routing and loading of controllers and their methods based on the URL.
 */
class Core
{
    /**
     * @var object|null $controller The current controller instance.
     */
    protected $controller;

    /**
     * @var string|null $method The name of the current method being called.
     */
    protected $method;

    /**
     * @var array $parameters The parameters passed to the controller method.
     */
    protected $parameters = [];

    /**
     * Constructs a new Core instance.
     * 
     * Parses the URL, determines the controller and method to be called,
     * and invokes the method with parameters.
     */
    public function __construct()
    {
        $url = $this->getUrl();

        // Set default controller and method if URL is empty or only contains 'index'
        if (empty($url) || ($url[0] == 'index' && count($url) == 1)) {
            $controllerName = 'IndexController';
            $methodName = 'index';
        } else {
            // Capitalize the first letter of the controller name and set method name
            $controllerName = ucwords($url[0] ?? '') . 'Controller';
            $methodName = $url[1] ?? 'index';
        }

        $controllerFile = '../app/controllers/' . $controllerName . '.php';

        // Check if controller file exists
        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            $this->controller = new $controllerName;

            // Check if controller method exists
            if (method_exists($this->controller, $methodName)) {
                $this->method = $methodName;
                $this->parameters = array_slice($url, 2);
            } else {
                $this->method = 'notFound';
            }
        } else {
            // If controller file doesn't exist, load default Controller
            $this->controller = new Controller;
            $this->method = 'notFound';
        }

        // Call the controller method with parameters
        call_user_func_array([$this->controller, $this->method], $this->parameters);
    }

    /**
     * Gets the URL from the GET parameters and sanitizes it.
     * 
     * @return array The URL segments.
     */
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