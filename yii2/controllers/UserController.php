<?php

namespace app\controllers;

use Yii;
use app\models\Order;
use app\models\User;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\LoginForm;

/**
 * AdminController implements the CRUD actions for Order model.
 */
class UserController extends Controller
{

    public $layout = 'user-layout';

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
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
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                    'logout' => ['post', 'get'],
                ],
            ],
        ];
    }


    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            if (Yii::$app->user->identity['username'] == 'admin') {
                $dataProvider = new ActiveDataProvider([
                    'query' => Order::find(),
                ]);
                return $this->render('index', compact('dataProvider'));
            } else {
                $dataProvider = new ActiveDataProvider([
                    'query' => Order::find()->where(['email'=>Yii::$app->user->identity['email']]),
                ]);
                return $this->render('index', compact('dataProvider'));
            }
        } else {
            return $this->goHome();
        }
    }


    public function actionView($id)
    {
        if (!Yii::$app->user->isGuest) {
           return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        } else {
            return $this->goHome();
        }
    }

    public function actionUpdate($id)
    {
        if (!Yii::$app->user->isGuest) {
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->render('update', [
                'model' => $model,
            ]);
        } else {
            return $this->goHome();
        }
    }

    public function actionDelete($id)
    {
        if (!Yii::$app->user->isGuest) {
            if (Yii::$app->user->identity['username'] == 'admin') {
                $this->findModel($id)->delete();

                return $this->redirect(['index']);

            } else {
                Yii::$app->session->setFlash('delete', 'Свяжитесь с магазином, чтобы удалить заказ');
                return $this->redirect(['index']);
            }


        } else {
            return $this->goHome();
        }
    }

    public function actionLogout()
    {
        if (!Yii::$app->user->isGuest) {
            Yii::$app->user->logout();
            return $this->goHome();

        } else {
            return $this->goHome();

        }

    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['index']);
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if (Yii::$app->user->identity['username'] == 'admin') {
                $dataProvider = new ActiveDataProvider([
                    'query' => Order::find(),
                ]);
                return $this->redirect(['index', compact('dataProvider')]);
            } else {
                $dataProvider = new ActiveDataProvider([
                    'query' => Order::find()->where(['email'=>Yii::$app->user->identity['email']]),
                ]);
                return $this->redirect(['index', compact('dataProvider')]);            }
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionChange() {

        if (Yii::$app->request->post('username')) {
            $postData = $_POST;
            $user = new User();

            $dataProvider = new ActiveDataProvider([
                'query' => Order::find(),
            ]);

            if ($postData['oldpassword'] != '') {
                if (!$user->validatePassword($postData['oldpassword'])) {
                    Yii::$app->session->setFlash('error', 'Старый пароль введен неверно');
                    return $this->render('index', compact('dataProvider'));
                }
            }

            if ($postData['confirmpassword'] != $postData['newpassword']) {
                Yii::$app->session->setFlash('confirmError', 'Пароли не совпадают');
                return $this->render('index', compact('dataProvider'));
            }

            $user->updateInfo($postData);
            Yii::$app->user->identity['username'] = $postData['username'];
            Yii::$app->user->identity['address'] = $postData['address'];
            Yii::$app->user->identity['firstname'] = $postData['firstname'];
            Yii::$app->user->identity['phone'] = $postData['phone'];
            Yii::$app->session->setFlash('change', 'Данные успешно изменены');

            if (Yii::$app->user->identity['username'] == 'admin') {
                return $this->render('index', compact('dataProvider'));

            } else {
                return $this->render('index', compact('dataProvider'));

            }
        }

        return false;
    }




    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
