<?php
/**
 * Created by PhpStorm.
 * User: Lera
 * Date: 23.01.2019
 * Time: 13:18
 */

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Category extends ActiveRecord
{
    public static function tableName()
    {
        return 'category';
    }

    public function getCats() {
        $cats = Yii::$app->cache->get('cats');
        if(!$cats) {
            $cats = Category::find()->all();
            Yii::$app->cache->set('cats', $cats, 3600);
        }
        return $cats;
    }


}