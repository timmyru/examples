<?php

namespace app\vendor;

use PDO;

class Database
{
    public $db;

    public function __construct()
    {
        $params = require('app/config/db.php');
        $this->db = new PDO("{$params['dbms']}:host={$params['host']}; dbname={$params['dbname']}; charset={$params['charset']}", "{$params['username']}", "{$params['password']}");
    }

    public function query($query)
    {
        $this->db->query($query);
    }

    public function read($query)
    {
        $q = $this->db->query($query);
        return $q->fetchAll(PDO::FETCH_ASSOC);
    }

}