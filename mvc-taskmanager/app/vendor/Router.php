<?php

namespace app\vendor;

class Router
{
    public $route;

    public function __construct()
    {
        $url = trim($_SERVER['REQUEST_URI'], '/');
        if ((!$url && empty($_GET)) || isset($_GET['page']) || isset($_GET['sort'])) {
            $url = require ("app/web/defaultRoute.php");
        }
        $this->route = explode('/', $url);
        $this->route = [$this->route[count($this->route)-2], $this->route[count($this->route)-1]];
        $this->checkRoute($this->route);
    }

    public function checkRoute($route)
    {
        $controllerName = ucfirst($route[0]) . 'Controller';
        $actionName = 'action' . ucfirst($route[1]);
        $controllerRoute = "app\controllers\\$controllerName";
        if (class_exists($controllerRoute) && method_exists($controllerRoute, $actionName)) {
            $controller = new $controllerRoute($route);
            $controller->$actionName();
        } else {
            header("Location: /");
        }
    }
}