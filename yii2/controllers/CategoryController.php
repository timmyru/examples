<?php
/**
 * Created by PhpStorm.
 * User: Lera
 * Date: 23.01.2019
 * Time: 13:42
 */

namespace app\controllers;

use app\models\Products;
use yii\web\Controller;
use yii\data\Pagination;
use Yii;

class CategoryController extends Controller
{
    public function actionSearch($pageSize = 4) {
        $search = htmlspecialchars(Yii::$app->request->get('search'));
        $goods = new Products();
        $goods = $goods->getSearchResults($search);
        $pages = new Pagination(['totalCount' => $goods->count(), 'pageSize' => $pageSize]);
        $goods = $goods->offset($pages->offset)
            ->limit($pageSize)
            ->all();
        if (!\Yii::$app->user->isGuest) {
            foreach ($goods as $good) {
                $good['price'] = $good['price']*0.9;
            }
        }
        return $this->render('view', compact('goods', 'pages', 'search'));
    }

    public function actionView($cat, $pageSize = 4) {
        $goods = new Products();
        if ($cat == 'new') {
            $goods = $goods->getLastProductsForCats();
            $pages = new Pagination(['totalCount' => $goods->count(), 'pageSize' => $pageSize]);
            $goods = $goods->offset($pages->offset)
                ->limit($pageSize)
                ->all();
            if (!\Yii::$app->user->isGuest) {
                foreach ($goods as $good) {
                    $good['price'] = $good['price']*0.9;
                }
            }
            return $this->render('view', compact('goods', 'pages'));


        } else if ($cat == 'promo') {
            $goods = $goods->getPromoProducts();
            $pages = new Pagination(['totalCount' => $goods->count(), 'pageSize' => $pageSize]);
            $goods = $goods->offset($pages->offset)
                ->limit($pageSize)
                ->all();
            if (!\Yii::$app->user->isGuest) {
                foreach ($goods as $good) {
                    $good['price'] = $good['price']*0.9;
                }
            }
            return $this->render('view', compact('goods', 'pages'));


        } else {
            $goods = $goods->getCatProducts($cat);
            $pages = new Pagination(['totalCount' => $goods->count(), 'pageSize' => $pageSize]);
            $goods = $goods->offset($pages->offset)
                ->limit($pages->limit)
                ->all();
            if (!\Yii::$app->user->isGuest) {
                foreach ($goods as $good) {
                    $good['price'] = $good['price']*0.9;
                }
            }
            return $this->render('view', compact('goods', 'pages'));
        }
    }

}