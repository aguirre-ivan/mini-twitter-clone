<?php

/**
 * Controller
 *
 * This class provides common methods and utilities for controllers.
 */
class Controller
{
    /**
     * Loads a model.
     *
     * @param string $model The name of the model to load.
     * @return object An instance of the loaded model.
     */
    public function loadModel($model)
    {
        require_once '../app/models/' . $model . '.php';
        return new $model;
    }

    /**
     * Loads a controller.
     *
     * @param string $controller The name of the controller to load.
     * @return object An instance of the loaded controller.
     */
    public function loadController($controller)
    {
        require_once '../app/controllers/' . $controller . '.php';
        return new $controller;
    }

    /**
     * Loads a view.
     *
     * @param string $view The name of the view to load.
     * @param array $page_data Data to pass to the view.
     */
    public function loadView($view, $page_data = [])
    {
        $view_file = '../app/views/pages/' . $view . '.php';
        if (file_exists($view_file)) {
            require_once $view_file;
        } else {
            $this->notFound();
        }
    }

    /**
     * Redirects to a specified location.
     *
     * @param string $location The URL to redirect to.
     */
    public function redirect($location)
    {
        header("Location: $location");
    }

    /**
     * Displays a "Page Not Found" error page and terminates the script.
     */
    public function notFound()
    {
        require_once '../app/views/pages/page_not_found.php';
        die();
    }

    /**
     * Handles access restriction for specific controller methods.
     *
     * @param string $class_name The name of the controller class.
     * @param string $method_name The name of the controller method.
     */
    public function handleUrlAccessRestriction($class_name, $method_name)
    {
        $controller = strtolower(str_replace('Controller', '', $class_name));

        if ($this->getUrl() == [$controller, $method_name]) {
            $this->notFound();
        }
    }

    /**
     * Checks if 'index' is present in the URL and displays a "Page Not Found" error page if it is.
     */
    public function isIndexInUrl()
    {
        if (isset($this->getUrl()[1]) && $this->getUrl()[1] == 'index') {
            $this->notFound();
        }
    }

    /**
     * Asserts the number of parameters in the URL and displays a "Page Not Found" error page if incorrect.
     *
     * @param int $amount The expected number of parameters in the URL.
     */
    public function assertParamsAmount($amount)
    {
        if (count($this->getUrl()) != $amount + 2) {
            $this->notFound();
        }
    }

    /**
     * Parses and sanitizes the URL.
     *
     * @return array An array containing the parsed and sanitized URL segments.
     */
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
}