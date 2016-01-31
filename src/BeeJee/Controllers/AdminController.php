<?php

namespace BeeJee\Controllers;

use BeeJee\Components\Controller;

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
        if (!empty($post) && $this->check($post)) {
            $_SESSION['isAdmin'] = true;
            $this->redirect('index/index');
        }
        return $this->render('login');
    }

    public function actionLogout()
    {
        $_SESSION['isAdmin'] = false;
        $this->redirect('index/index');
    }

    protected function check($post)
    {
        if (isset($post['username']) && isset($post['password'])) {
            return $post['username'] == 'admin' && $post['password'] == '123';
        }
        return false;
    }
}