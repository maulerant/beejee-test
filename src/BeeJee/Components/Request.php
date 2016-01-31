<?php
namespace BeeJee\Components;

use Exception;

class Request
{
    public $requestedURI = '';
    public $routes = [];

    /**
     * @param array $routes
     */
    public function __construct($routes = [])
    {
        $this->routes = [];
        $this->requestedURI = empty($_GET['q']) ? $this->getDefaultRoute() : $_GET['q'];
    }

    /**
     * @return string
     */
    public function getDefaultRoute()
    {
        return isset($this->routes['default']) ? $this->routes['default'] : 'index/index';
    }

    /**
     * @param $uri
     * @return string
     * @throws Exception
     */
    public function getControllerClass($uri)
    {
        $exploded = explode('/', $uri);
        if (empty($exploded)) {
            throw new Exception('Controller not found');
        }
        return "BeeJee\\Controllers\\" . ucfirst(reset($exploded)) . 'Controller';
    }

    /**
     * @param $uri
     * @return string
     * @throws Exception
     */
    public function getAction($uri)
    {
        $exploded = explode('/', $uri);
        if (empty($exploded)) {
            throw new Exception('Controller not found');
        }
        return 'action' . ucfirst(empty($exploded[1]) ? 'index' : $exploded[1]);
    }

    /**
     * @return string
     */
    public function getDomain()
    {
        return 'http://' . $_SERVER['SERVER_NAME'] . '/';
    }

    /**
     * @return mixed
     */
    public function get()
    {
        return $_GET;
    }

    /**
     * @return mixed
     */
    public function post()
    {
        return $_POST;
    }
}