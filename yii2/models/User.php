<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class User extends ActiveRecord implements \yii\web\IdentityInterface
{

    public static function tableName()
    {
        return 'user';
    }

    public function checkLogin($login) {
        return User::find()->where(['username' => $login])->one();
    }

    public function checkEmail($email) {
        return User::find()->where(['email' => $email])->one();
    }


    public function updateInfo($postData) {
        $user = User::find()->where(['email' => Yii::$app->user->identity['email']])->one();
        $user->username = $postData['username'];
        $user->address = $postData['address'];
        $user->phone = $postData['phone'];
        $user->firstname = $postData['firstname'];
        if ($postData['newpassword'] != '') {
            $user->password = Yii::$app->security->generatePasswordHash($postData['newpassword']);
        }
        $user->save();
        Yii::$app->user->identity['password'] = $user->password;
    }


    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
//        foreach (self::$users as $user) {
//            if ($user['accessToken'] === $token) {
//                return new static($user);
//            }
//        }
//
//        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'isValidated' => 1]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    public function findAuth($auth) {
        return User::find()->where(['validateKey' => $auth])->one();
    }

    public function generateAuthKey() {
        $this->auth_key = \Yii::$app->security->generateRandomString();
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        if (!Yii::$app->user->isGuest) {
            $this->password = Yii::$app->user->identity['password'];
        }

        if (Yii::$app->getSecurity()->validatePassword($password, $this->password)) {
            return true;
        } else {
            return false;
        }
    }
}
