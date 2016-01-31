<?php

namespace BeeJee\Models;

class Admin
{
    /**
     * @param null $id
     * @return array
     */
    public function getById($id = null)
    {
        return [
            'username' => 'admin',
            'password' => '123'
        ];
    }

    /**
     * @param $post
     * @return bool
     */
    public function check($post)
    {
        if (isset($post['username']) && isset($post['password'])) {
            $admin = $this->getById();
            return $post['username'] == $admin['username'] && $post['password'] == $admin['password'];
        }
        return false;
    }
}