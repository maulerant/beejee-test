<?php

namespace BeeJee;

use BeeJee\Components\DataSource;
use BeeJee\Components\Request;
use BeeJee\Components\Response;
use BeeJee\Components\Route;
use Exception;

class App
{
    public $config = [];
    public $request = [];
    public $basePath = '';

    /**
     * @param array $config
     */
    public function __construct(Array $config)
    {
        $this->config = $config;
        $this->request = new Request();
        $this->basePath = dirname(__FILE__);
        DataSource::init($this->config);
        session_start();
    }

    /**
     *
     */
    public function run()
    {
        try {
            $route = new Route($this->config['routes']);
            $controllerClass = $route->getControllerClass($this->request->getRequestedURI());
            if (!class_exists($controllerClass)) {
                throw new Exception('Controller not found');
            }
            $action = $route->getAction($this->request->getRequestedURI());
            $controller = new $controllerClass($this, $this->request);
            if (!method_exists($controller, $action)) {
                throw new Exception('Action not found');
            }
            $output = $controller->$action();
            $statusCode = 200;
        } catch (Exception $e) {
            $output = $e->getMessage();
            $statusCode = 404;
        }
        $response = new Response($statusCode, $output);
        $response->send();
    }

    /**
     * @return bool
     */
    public static function isAdmin()
    {
        return empty($_SESSION['isAdmin']) ? false : $_SESSION['isAdmin'];
    }
}