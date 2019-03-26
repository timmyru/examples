<?php
/**
 * Created by PhpStorm.
 * User: Lera
 * Date: 23.01.2019
 * Time: 12:31
 */

namespace app\models;
use yii\db\ActiveRecord;
use Yii;

class Products extends ActiveRecord
{
    public static function tableName() {
        return 'products';
    }

    public function getLastTenProducts() {
        $products = Yii::$app->cache->get('tenProducts');
        if(!$products) {
            $products = Products::find()->orderBy(['id'=>SORT_DESC])->limit(10)->all();
            Yii::$app->cache->set('tenProducts', $products, 10);
        }
        return $products;
    }

    public function getLastProductsForCats() {
        return Products::find()->where(['id'=>[16,15,14,13,12,11,10,9,8,7]]);
    }

    public function getSearchResults($search) {
        return Products::find()->where(['like', 'title', $search]);
    }

    public function getProducts() {
        return Products::find()->all();
    }

    public function getOneProduct($id) {
        return Products::find()->where(['id'=>$id])->one();
    }

    public function getPromoProducts() {
        return Products::find()->where(['promo'=>1]);
    }

    public function getCatProducts($cat) {
        return Products::find()->where(['category'=>$cat]);
    }
}