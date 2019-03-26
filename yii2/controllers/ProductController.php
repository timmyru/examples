<?php
/**
 * Created by PhpStorm.
 * User: Lera
 * Date: 25.01.2019
 * Time: 18:27
 */

namespace app\controllers;


use app\models\Products;
use yii\web\Controller;

class ProductController extends Controller
{
    public function actionIndex($id) {
        $product = new Products();
        $product = $product->getOneProduct($id);
        if (!\Yii::$app->user->isGuest) {
            $product['price'] *= 0.9;
        }
        return $this->render('index',compact('product'));
    }

}