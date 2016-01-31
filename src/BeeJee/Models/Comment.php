<?php

namespace BeeJee\Models;

use BeeJee\Components\Model;

class Comment extends Model
{
    /**
     * @return string
     */
    public function tableName()
    {
        return 'comments';
    }

    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id',
            'username',
            'email',
            'body',
            'changed_by_admin',
            'accepted',
            'image',
            'created_at'
        ];
    }

    /**
     * @param $post
     */
    public function create($post)
    {
        $query = $this->ds->prepare('INSERT INTO comments (username, email, body, image) VALUES (:username, :email, :body, :image)');

        $query->execute([
            ':username' => $post['username'],
            ':email' => $post['email'],
            ':body' => $post['body'],
            ':image' => $post['image']
        ]);
    }

    /**
     * @param $post
     */
    public function update($post)
    {
        $comment = $this->getById($post['id']);
        $query = $this->ds->prepare('
            UPDATE comments
            SET
              username = :username,
              email = :email,
              body = :body,
              accepted = :accepted,
              changed_by_admin = :changed_by_admin
            WHERE id = :id
            ');
        $query->execute([
            ':id' => $post['id'],
            ':username' => isset($post['username']) ? $post['username'] : $comment['username'],
            ':email' => isset($post['email']) ? $post['email'] : $comment['username'],
            ':body' => isset($post['body']) ? $post['body'] : $comment['body'],
            ':accepted' => isset($post['accepted']) && $post['accepted'] == 'on',
            ':changed_by_admin' => isset($post['changed_by_admin']) ? $post['changed_by_admin'] : $comment['changed_by_admin']
        ]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        $query = $this->ds->prepare('SELECT * FROM comments WHERE id=:id');
        $query->execute([
            ':id' => $id
        ]);
        return $query->fetch();
    }
}