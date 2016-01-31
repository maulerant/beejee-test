<?php

namespace BeeJee\Components;

use BeeJee\App;

class Controller
{
    public $request;
    public $view;
    public $layout = 'main';
    /** @var  App */
    public $app;
    public $name = '';
    public $title = '';

    /**
     * @param $app
     * @param $request
     */
    public function __construct($app, $request)
    {
        $this->request = $request;
        $this->app = $app;
        $this->view = new View($app);
        if (empty($this->name)) {
            $this->name = get_class($this);
        }
    }

    /**
     * @param $view
     * @param $context
     * @return string
     */
    public function render($view, $context = [])
    {
        $context = array_merge($context, [
            'title' => empty($this->title) ? $this->app->config['title'] : $this->title
        ]);
        $content = $this->view->render($this->name . DIRECTORY_SEPARATOR . $view, $context);
        return $this->view->renderLayout($this->layout, $content, $context);
    }
}