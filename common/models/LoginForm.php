<?php

namespace common\models;

use Yii;
use yii\base\Model;
use common\models\Login;

/**
 * LoginForm is the model behind the login form.
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $reCaptcha;
    public $rememberMe = true;

    private $_user;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
          [['username', 'password'], 'required'],
          ['username', 'trim'],
          [['username', 'password'], 'string', 'max' => 40],
          ['password', 'string', 'min' => 6],
          ['password', 'validatePassword'],
          // reCaptcha needs to be entered correctly
          //[['reCaptcha'], 'validateReCaptcha']
        ];
    }

    /**
     * @inheritdoc
     */
     /**
      * @inheritdoc
      */
     public function attributeLabels()
     {
         return [
             'name' => 'Nome',
             'username' => 'Usuário',
             'password' => 'Senha',
             'email' => 'E-mail',
             'level' => 'Nível',
             'active' => 'Ativo',
             'dateCreated' => 'Data de Criação',
         ];
     }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
     public function validatePassword($attribute, $params)
     {
         if (!$this->hasErrors()) {
             $user = $this->getUser();
             if (!$user || !$user->validatePassword($this->password)) {
                 $this->addError($attribute, 'Incorrect username or password.');
             }
         }
     }

     public function validateReCaptcha()
     {
        if ($this->hasErrors()) {
            return \himiklab\yii2\recaptcha\ReCaptchaValidator::className();
        }
     }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser());
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return Auth|null
     */
     protected function getUser()
     {
         if ($this->_user === null) {
             $this->_user = Login::findByUsername($this->username);
         }

         return $this->_user;
     }

}
