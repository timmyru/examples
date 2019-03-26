<?php

namespace app\controllers;

use app\models\Category;
use app\models\Products;
use app\models\Subscribe;
use Yii;
use app\models\User;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;


class SiteController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post', 'get'],
                ],
            ],
        ];
    }


    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }


    public function actionIndex()
    {
        $products = new Products();
        $products = $products->getLastTenProducts();
        $cats = new Category();
        $cats = $cats->getCats();
        if (!\Yii::$app->user->isGuest) {
            foreach ($products as $good) {
                $good['price'] = $good['price']*0.9;
            }
        }
        return $this->render('index', compact('products', 'cats'));
    }

    public function actionSubscribe($email) {
        $subscribe = new Subscribe();
        $query = $subscribe->findEmail($email);
        if(!$query) {
            $subscribe->email = $email;
            $subscribe->auth_key = Yii::$app->security->generateRandomString();
            $subscribe->save();
            $message = "http://diploma-php/?subscribe=$subscribe->auth_key";
            mail(
                "$email",
                'Письмо с сайта драгоценностей с брюликами',
                "<html><body>Привет!<br />Чтобы подтвердить свою почту перейди по этой ссылке: <a href=$message>Подтвердить почту</a></body></html>",
                "From: ivan@example.com\r\n"
                ."Content-type: text/html; charset=utf-8\r\n"
                ."X-Mailer: PHP mail script"
            );
            return $this->renderPartial('subscribe', compact('subscribe'));
        } else {
            return $this->renderPartial('subscribe');
        }
    }

    public function actionRegister() {
        if (Yii::$app->request->post()) {
            $user = new User();
            if ($_POST['password'] != $_POST['confirmPassword']) {
                Yii::$app->session->setFlash('passwordRegister', 'Пароли не совпадают');
                return $this->render('register');
            } else if ($user->checkLogin($_POST['login'])) {
                Yii::$app->session->setFlash('loginRegister', 'Логин занят, придумайте другой');
                return $this->render('register');
            } else if ($user->checkEmail($_POST['email'])) {
                Yii::$app->session->setFlash('loginRegister', 'Уже есть пользователь с такой почтой');
                return $this->render('register');
            }

            $user->firstname = $_POST['username'];
            $user->username = $_POST['login'];
            $user->password = Yii::$app->security->generatePasswordHash($_POST['password']);
            $user->email = $_POST['email'];
            $user->address = $_POST['address'];
            $user->phone = $_POST['phone'];
            $user->validateKey = Yii::$app->security->generateRandomString();
            $user->save();
            $email = $_POST['email'];
            $message = "http://diploma-php/site/register?register=$user->validateKey";
            Yii::$app->session->setFlash('register', 'Загляните в свой почтовый ящик и подтвердите свою почту');
            mail(
                "$email",
                'Письмо с сайта драгоценностей с брюликами',
                "<html><body>Привет!<br />Чтобы подтвердить свою почту перейди по этой ссылке: <a href=$message>Подтвердить почту</a></body></html>",
                "From: ivan@example.com\r\n"
                ."Content-type: text/html; charset=utf-8\r\n"
                ."X-Mailer: PHP mail script"
            );
            return $this->render('register');
        }
        return $this->render('register');
    }


    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }


    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

}
