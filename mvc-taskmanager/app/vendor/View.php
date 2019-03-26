<?php

namespace app\vendor;

class View
{
    public $controller;
    public $action;
    public $layout = 'layout';

    public function __construct($route)
    {
        $this->controller = $route[0];
        $this->action = $route[1];
    }

    public function render ($title, $vars = [])
    {
        if ($vars) {
            extract($vars);
        }
        ob_start();
        require "app/views/{$this->controller}/{$this->action}.php";
        $content = ob_get_clean();
        require "app/views/layouts/{$this->layout}.php";
    }
}