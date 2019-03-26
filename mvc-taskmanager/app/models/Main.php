<?php

namespace app\models;

use app\vendor\Model;

class Main extends Model
{
    public function getInfo()
    {
        return $this->db->read("SELECT * FROM bee");
    }

    public function getTotalPages()
    {
        $q =  $this->db->read("SELECT COUNT(*) FROM bee");
        if ($q[0]['COUNT(*)'] % 3 == 0) {
            return $q[0]['COUNT(*)'] / 3;
        } else {
            $q = floor($q[0]['COUNT(*)'] / 3);
            return ($q + 1);
        }
    }

    public function create()
    {
        $email = htmlspecialchars($_POST['email']);
        $username = htmlspecialchars($_POST['username']);
        $task = htmlspecialchars($_POST['task']);
        $this->db->query("INSERT INTO `bee` (username, email, task) VALUES ('$username', '$email', '$task')");
    }
}