<?php
/**
 * Created by PhpStorm.
 * User: Lera
 * Date: 27.01.2019
 * Time: 19:19
 */

namespace app\models;


use yii\db\ActiveRecord;

class Subscribe extends ActiveRecord
{
    public static function tableName()
    {
      return 'subscribe';
    }

    public function findEmail($email) {
        return Subscribe::find()->where(['email' => $email])->one();
    }

    public function findAuth($auth) {
        return Subscribe::find()->where(['auth_key' => $auth])->one();
    }
}