<?php
/**
 * Created by PhpStorm.
 * User: Lera
 * Date: 23.01.2019
 * Time: 16:37
 */

namespace app\controllers;

use app\models\Cart;
use app\models\Order;
use app\models\OrderProducts;
use app\models\Products;
use Yii;
use yii\web\Controller;

class CartController extends Controller
{
    public function actionAdd($id, $q=1) {
        $session = Yii::$app->session;
        $session->open();

        $good = new Products();
        $good = $good->getOneProduct($id);
        $cart = new Cart();
        $cart->addToCart($good, $q);
//        $session->remove('cart');
//        $session->remove('cart.totalQuantity');
//        $session->remove('cart.totalSum');
        return true;
    }

    public function actionChange($id, $q) {
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->changeCart($id, $q);
        $this->layout = 'cart-layout';
        return $this->renderPartial('index', compact('session'));
    }

    public function actionDelete($id) {
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->recalcCart($id);
        $this->layout = 'cart-layout';
        return $this->renderPartial('index', compact('session'));
    }

    public function actionSuccess() {
        $session = Yii::$app->session;
        $session->open();
        if ($session['cart.totalSum']) {
            $order = new Order();
            $order->name = $_POST['username'];
            $order->email = $_POST['email'];
            $order->address = $_POST['address'];
            $order->phone = $_POST['phone'];
            $order->sum = $session['cart.totalSum'];
            $order->save();
            $currentId = $order->id;
            $email = $order->email;
            $this->saveOrderInfo($session['cart'], $currentId);

            mail('aprygin@mail.ru', "Заказ #$currentId принят", 'test');
            mail($email, "Заказ #$currentId принят", 'test');
            return $this->render('success', compact('session','currentId'));
        } else {
            return $this->goHome();
        };
    }

    protected function saveOrderInfo($goods, $orderId) {

        foreach ($goods as $id=>$good) {
            $orderInfo = new OrderProducts();
            $orderInfo->order_id = $orderId;
            $orderInfo->product_id = $id;
            $orderInfo->name = $good['title'];
            $orderInfo->quantity = $good['quantity'];
            if (!Yii::$app->user->isGuest) {
                $orderInfo->price = $good['price']*0.9;
                $orderInfo->sum = $good['price']*0.9*$good['quantity'];
            } else {
                $orderInfo->price = $good['price'];
                $orderInfo->sum = $good['price']*$good['quantity'];
            }

            $orderInfo->save();
        }

    }

    public function actionIndex() {
        $session = Yii::$app->session;
        $session->open();
        return $this->render('index', compact('session'));
    }
}