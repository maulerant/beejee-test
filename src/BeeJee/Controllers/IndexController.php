<?php

namespace BeeJee\Controllers;

use BeeJee\Components\Controller;

class IndexController extends Controller
{
    public $name = 'Index';
    public $layout = 'main';

    public function actionIndex()
    {
        return $this->render('index');
    }
}
