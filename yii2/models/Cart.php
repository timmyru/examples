<?php
/**
 * Created by PhpStorm.
 * User: Lera
 * Date: 23.01.2019
 * Time: 23:21
 */

namespace app\models;


use yii\db\ActiveRecord;

class Cart extends ActiveRecord
{

    public function recalcCart($id) {
        $quantity = $_SESSION['cart'][$id]['quantity'];
        if (\Yii::$app->user->isGuest) {
            $price = $_SESSION['cart'][$id]['price'] * $quantity;
        } else {
            $price = $_SESSION['cart'][$id]['price'] * $quantity * 0.9;
        }
        $_SESSION['cart.totalQuantity'] -= $quantity;
        $_SESSION['cart.totalSum'] -= $price;
        unset($_SESSION['cart'][$id]);

    }

    public function changeCart($id, $q) {
        $quantity = $_SESSION['cart'][$id]['quantity'];
        if (\Yii::$app->user->isGuest) {
            $price = $_SESSION['cart'][$id]['price'] * $quantity;
        } else {
            $price = $_SESSION['cart'][$id]['price'] * $quantity * 0.9;
        }
        $_SESSION['cart.totalSum'] -= $price;

        if (\Yii::$app->user->isGuest) {
            $newPrice = $_SESSION['cart'][$id]['price'] * $q;
        } else {
            $newPrice = $_SESSION['cart'][$id]['price'] * $q * 0.9;
        }
        $_SESSION['cart.totalSum'] += $newPrice;

        $_SESSION['cart.totalQuantity'] -= $quantity;
        $_SESSION['cart'][$id]['quantity'] = $q;
        $_SESSION['cart.totalQuantity'] += $q;

    }

    public function addToCart($good, $q=1) {
        if ($_SESSION['cart'][$good->id]) {
            $_SESSION['cart'][$good->id]['quantity'] += $q;
        } else {
            $_SESSION['cart'][$good->id] = [
                'title' => $good['title'],
                'price' => $good['price'],
                'category' => $good['category'],
                'descr' => $good['descr'],
                'photo' => $good['photo'],
                'quantity' => $q,
            ];
        }

        if (\Yii::$app->user->isGuest) {
            $_SESSION['cart.totalSum'] = $_SESSION['cart.totalSum'] ? $_SESSION['cart.totalSum'] + $_SESSION['cart'][$good->id]['price']*$q : $_SESSION['cart'][$good->id]['price']*$q;
        } else {
            $_SESSION['cart.totalSum'] = $_SESSION['cart.totalSum'] ? $_SESSION['cart.totalSum'] + $_SESSION['cart'][$good->id]['price']*$q*0.9 : $_SESSION['cart'][$good->id]['price']*$q*0.9;
        }

        $_SESSION['cart.totalQuantity'] = $_SESSION['cart.totalQuantity'] ? $_SESSION['cart.totalQuantity'] + $q : $q;
    }
}