<?php

namespace BeeJee\Controllers;

use BeeJee\Components\Controller;
use BeeJee\Models\Comment;
use BeeJee\Utils\ImageUpload;

class CommentController extends Controller
{
    use ImageUpload;

    public $name = 'Comment';
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

    public function actionCreate()
    {
        $post = $this->request->post();
        if (!empty($post)) {
            $Comment = new Comment();
            $this->imageUploadPath = ROOT_PATH . '/media/upload/';
            $post['image'] = $this->upload();
            $Comment->create($post);
        }
        $this->redirect('comment/index');
    }

    public function actionEdit()
    {
        $get = $this->request->get();
        if (empty($get) || !isset($get['id'])) {
            $this->redirect('comment/index');
        }
        $Comment = new Comment();
        return $this->render('edit', [
            'comment' => $Comment->getById($get['id']),
            'isAdmin' => $this->app->isAdmin()
        ]);
    }

    public function actionUpdate()
    {
        $post = $this->request->post();
        if (!empty($post) && isset($post['id'])) {
            $Comment = new Comment();
            $Comment->update($post);
        }
        $this->redirect('comment/index');
    }
}
