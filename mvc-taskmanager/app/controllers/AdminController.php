<?php

namespace app\controllers;

use app\vendor\Controller;

class AdminController extends Controller
{
    public function actionLogin()
    {
        session_start();
        if (!$_SESSION['auth']) {
            $this->view->render('Вход в админку');
        } else {
            $_SESSION['success'] = 'Вы уже авторизованы под админским доступом';
            header("Location: /");
        }
    }

    public function actionAuth()
    {
        session_start();
        if ($_POST['login']) {
            $q = $this->model->auth($_POST['login'], $_POST['password']);
            if(!empty($q)) {
                $_SESSION['auth'] = 'admin';
                $_SESSION['success'] = 'Вы успешно зашли под доступом админа';
            }
        }
        header("Location: /");
    }

    public function actionLogout()
    {
        session_start();
        if ($_SESSION['auth']) {
            unset($_SESSION['auth']);
            $_SESSION['success'] = 'Вы успешно вышли из админки';
        }
        header("Location: /");
    }

    public function actionDelete()
    {
        session_start();
        if ($_SESSION['auth'] && $_POST['delete']) {
            $this->model->delete($_POST['delete']);
            $_SESSION['success'] = 'Задача удалена';
        }
        header("Location: /");
    }

    public function actionView($id = 0)
    {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $countId = $_POST['countId'];
        }
        session_start();
        if ($_SESSION['auth'] && $id) {
            $q = $this->model->read($id);
            $q['countId'] = $countId;
            $this->view->render("Задание №{$countId}", $q);
        } else {
            header("Location: /");
        }
    }

    public function actionUpdate()
    {
        session_start();
        if ($_SESSION['auth'] && $_POST['id']) {
            $this->model->update($_POST);
            $_SESSION['success'] = 'Задание успешно обновлено';
        }
        header("Location: /");
    }
}