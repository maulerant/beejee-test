<?php

namespace BeeJee\Controllers;

use BeeJee\Components\Controller;
use BeeJee\Models\Comment;

class CommentController extends Controller
{
    public $name = 'Comment';
    public $layout = 'main';

    public function actionIndex()
    {
        $this->redirect('index/index');
    }

    public function actionCreate()
    {
        $post = $this->request->post();
        if (!empty($post)) {
            $Comment = new Comment();
            $query = $Comment->ds->prepare('INSERT INTO comments (username, email, body) VALUES (:username, :email, :body)');

            $query->execute([
                ':username' => $post['username'],
                ':email' => $post['email'],
                ':body' => $post['body']
            ]);
        }
        $this->redirect('index/index');
    }
}
