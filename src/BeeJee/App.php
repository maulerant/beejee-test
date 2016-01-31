<?php

namespace BeeJee;

use BeeJee\Components\DataSource;
use BeeJee\Components\Request;
use BeeJee\Components\Response;
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
        $this->request = new Request($config['routes']);
        $this->basePath = dirname(__FILE__);
        DataSource::init($this->config);
    }

    /**
     *
     */
    public function run()
    {
        try {
            $controllerClass = $this->request->getControllerClass($this->request->requestedURI);
            if (!class_exists($controllerClass)) {
                throw new Exception('Controller not found');
            }
            $action = $this->request->getAction($this->request->requestedURI);
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
}