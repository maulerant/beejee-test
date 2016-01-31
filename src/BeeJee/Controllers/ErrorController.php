<?php

namespace BeeJee\Controllers;

use BeeJee\Components\Controller;

class ErrorController extends Controller
{
    public $layout = 'main';
    public $name = 'Error';

    public function error404()
    {
        $this->render('error404');
    }
}
