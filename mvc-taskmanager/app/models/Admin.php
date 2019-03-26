<?php

namespace app\models;

use app\vendor\Model;

class Admin extends Model
{
    public function auth($login, $password)
    {
        return $this->db->read("SELECT * FROM `bee_auth` WHERE login='$login' AND password='$password'");
    }

    public function read($id) {
        return $this->db->read("SELECT * FROM `bee` WHERE id='$id'");
    }

    public function delete($id)
    {
        $this->db->query("DELETE FROM `bee` WHERE id='$id'");
    }

    public function update($update)
    {
        $id = $update['id'];
        $username = $update['username'];
        $email = $update['email'];
        $task = $update['task'];
        $isDone = $update['isDone'];
        $this->db->query("UPDATE `bee` SET username='$username', email='$email', task='$task', isDone='$isDone' WHERE id='$id'");
    }
}