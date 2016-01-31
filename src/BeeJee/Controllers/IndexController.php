<?php

namespace BeeJee\Controllers;

use BeeJee\Components\Controller;
use BeeJee\Models\Comment;

class IndexController extends Controller
{
    public $name = 'Index';
    public $layout = 'main';

    public function actionIndex()
    {
        $get = $this->request->get();
        $Comment = new Comment();
        $query = $Comment->ds->prepare('SELECT * FROM comments ORDER by :order_by :direction;');
        $orderBy = isset($get['order_by']) && in_array($get['order_by'],
            ['username', 'created_at']) ? $get['order_by'] : 'created_at';
        $query->execute([
            ':order_by' => $orderBy,
            ':direction' => ($orderBy == 'created_at') ? 'DESC' : 'ASC'
        ]);
        return $this->render('index', [
            'comments' => $query->fetchAll(),
            'isAdmin' => $this->app->isAdmin()
        ]);
    }
}
