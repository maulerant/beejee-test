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
        return $this->render('index', [
            'comments' => $Comment->getAll($get['order_by']),
            'isAdmin' => $this->app->isAdmin()
        ]);
    }

    public function actionCreate()
    {
        $post = $this->request->post();
        if (!empty($post) && !empty($post['username']) && !empty($post['body'])) {
            $Comment = new Comment();
            if (empty($_FILES['picture'])) {
                $post['image'] = '';
            } else {
                $this->imageUploadPath = ROOT_PATH . '/media/upload/';
                $post['image'] = $this->upload($_FILES['picture']);
            }
            $Comment->create($post);
        }
        $this->redirect('comment/index');
    }

    public function actionEdit()
    {
        if (!$this->app->isAdmin()) {
            $this->redirect('admin/login');
        }
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
        if (!$this->app->isAdmin()) {
            $this->redirect('admin/login');
        }
        $post = $this->request->post();
        if (!empty($post) && isset($post['id'])) {
            $Comment = new Comment();
            $Comment->update($post);
        }
        $this->redirect('comment/index');
    }
}
