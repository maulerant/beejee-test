<?php

namespace BeeJee\Components;

use Exception;

class Route
{
    protected $routes = [];

    /**
     * @param array $routes
     */
    public function __construct($routes = [])
    {
        $this->routes = $routes;
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
        if (empty($uri)) {
            $uri = $this->getDefaultRoute();
        }
        $exploded = explode('/', $uri);
        return "BeeJee\\Controllers\\" . ucfirst(reset($exploded)) . 'Controller';
    }

    /**
     * @param $uri
     * @return string
     * @throws Exception
     */
    public function getAction($uri)
    {
        if (empty($uri)) {
            $uri = $this->getDefaultRoute();
        }
        $exploded = explode('/', $uri);
        return 'action' . ucfirst(empty($exploded[1]) ? 'index' : $exploded[1]);
    }

    /**
     * @return array
     */
    public function getRoutes()
    {
        return $this->routes;
    }
}
