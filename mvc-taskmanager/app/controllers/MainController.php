<?php

namespace app\controllers;
use app\vendor\Controller;


class MainController extends Controller
{
    public function actionIndex()
    {
        session_start();
        $arr = $this->model->getInfo();
        $total = $this->model->getTotalPages();
        $this->view->render('Список задач', [$arr, $total]);
    }

    public function actionCreate()
    {
        if (!empty($_POST['username'])) {
            session_start();
            $_SESSION['success'] = 'Задача успешно сохранена!';
            $this->model->create($_POST);
        }
        header("Location: ". $_SERVER['HTTP_REFERER']);
    }
}