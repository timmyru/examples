<?php

namespace app\vendor;

class Controller
{
    public $view;
    public $route;
    public $model;

    public function __construct($route)
    {
        $this->route = $route;
        $this->view = new View($route);
        $this->model = $this->findModel($route[0]);
    }

    public function findModel($name)
    {
        $name = ucfirst($name);
        $path = "app\\models\\$name";
        if (class_exists($path)) {
            return new $path;
        }
    }
}