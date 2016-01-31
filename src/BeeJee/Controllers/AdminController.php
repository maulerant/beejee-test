<?php

namespace BeeJee\Controllers;

use BeeJee\Components\Controller;
use BeeJee\Models\Admin;

class AdminController extends Controller
{
    public $name = 'Admin';
    public $layout = 'main';

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        $post = $this->request->post();
        $Admin = new Admin();
        if (!empty($post) && $Admin->check($post)) {
            $_SESSION['isAdmin'] = true;
            $this->redirect('comment/index');
        }
        return $this->render('login');
    }

    public function actionLogout()
    {
        $_SESSION['isAdmin'] = false;
        $this->redirect('comment/index');
    }
}