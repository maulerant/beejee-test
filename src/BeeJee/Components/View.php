<?php

namespace BeeJee\Components;

use BeeJee\App;
use Exception;

class View
{
    /** @var  App */
    public $app;

    /**
     * @param App $app
     */
    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * @param       $view
     * @param array $params
     * @return string
     * @throws Exception
     */
    public function render($view, $params = [])
    {
        $viewFile = $this->getViewFile($view);
        if (!file_exists($viewFile)) {
            throw new Exception('View not found');
        }
        return $this->renderFile($viewFile, $params);
    }

    /**
     * @param $file
     * @param $params
     * @return string
     */
    public function renderFile($file, $params)
    {
        ob_start();
        ob_implicit_flush(false);
        extract($params, EXTR_OVERWRITE);
        require($file);
        return ob_get_clean();
    }

    /**
     * @param $view
     * @return string
     */
    protected function getViewFile($view)
    {
        return $this->app->basePath . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR . $view . '.php';
    }

    /**
     * @param $layout
     * @return string
     */
    protected function getLayoutFile($layout)
    {
        return $this->app->basePath . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR . 'Layouts' . DIRECTORY_SEPARATOR . $layout . '.php';
    }

    /**
     * @param        $layout
     * @param string $content
     * @param array  $context
     * @return string
     */
    public function renderLayout($layout, $content = '', $context = [])
    {
        return $this->renderFile($this->getLayoutFile($layout), array_merge(['content' => $content], $context));
    }
}