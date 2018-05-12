<?php

namespace panel\models;

use common\models\Login as Login;

class Auth extends \yii\base\Object implements \yii\web\IdentityInterface
{
    public $idLogin;
    public $name;
    public $username;
    public $password;
    public $level;
    public $active;
    public $password_reset_token;
    public $email;
    public $dateCreated;

    const LEVEL_USER = 1;
    const LEVEL_MANAGER = 2;
    const LEVEL_ADMIN = 3;

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        //return isset(self::$login[$id]) ? new static(self::$login[$id]) : null;
        $login = Login::find()->where(['idLogin' => $id, 'active' => 1])->one();
        if ($login) {
            return new static($login);
        } else {
            return null;
        }
    }

    /**
     * @inheritdoc
     */
    public static function findUser($username)
    {
        //return isset(self::$login[$id]) ? new static(self::$login[$id]) : null;
        $login = Login::find()->where(['username' => $username, 'active' => 1])->one();
        if ($login) {
            return new static($login);
        } else {
            return null;
        }
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        /*foreach (self::$login as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }*/

        return null;
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        $login = Login::find()->where(['username'=>$username])->one();
        if ($login) {
            return new static($login);
        } else {
            return null;
        }
    }

    public static function findByUsernameLevel($username, $level)
    {
        $login = Login::find()->where(['username'=>$username, 'level'=>$level])->one();
        if ($login) {
            return new static($login);
        } else {
            return null;
        }
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->idLogin;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return null;
        //$this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return null;
        //$this->authKey === $authKey;
    }

}
