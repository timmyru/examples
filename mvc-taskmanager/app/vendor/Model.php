<?php

namespace app\vendor;


class Model
{
    public $db;

    public function __construct()
    {
        $this->db = new Database();
    }
}