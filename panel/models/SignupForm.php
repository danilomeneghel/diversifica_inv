<?php

namespace panel\models;

use Yii;
use yii\base\Model;
use common\models\Login;

class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
          ['username', 'trim'],
          ['username', 'required'],
          ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
          ['username', 'string', 'min' => 2, 'max' => 255],

          ['email', 'trim'],
          ['email', 'required'],
          ['email', 'email'],
          ['email', 'string', 'max' => 255],
          ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

          ['password', 'required'],
          ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup($id)
    {
        $login = new Login();
        $login->idLogin = $id;
        $login->username = $this->username;
        $login->setPassword($this->password);
        $login->email = $this->email;
        $login->active = 1;

        return $login;
    }
}
