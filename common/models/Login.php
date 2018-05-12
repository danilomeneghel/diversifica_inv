<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use panel\models\LoginsCompanies;

class Login extends ActiveRecord implements IdentityInterface
{
    const STATUS_ACTIVE = 1;
    const LEVEL_USER = 1;
    const LEVEL_MANAGER = 2;
    const LEVEL_ADMIN = 3;

    //public $auth_key;
    public $created_at;
    public $updated_at;

    /**
     * @inheritdoc
     */
     /**
      * @inheritdoc
      */
     public static function tableName()
     {
         return 'rs_logins';
     }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'username'], 'required'],
            ['username', 'trim'],
            ['password', 'string', 'min' => 6],
            [['name', 'username', 'password'], 'string', 'max' => 60],
            ['email', 'email'],
            [['dateCreated'], 'datetime', 'format' => 'php:Y-m-d H:i:s'],
            [['level'], 'integer'],
            ['active', 'default', 'value' => self::STATUS_ACTIVE],
            // reCaptcha needs to be entered correctly
            //[['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator::className(), 'secret' => '6Le2OhEUAAAAAFVAo694LcEDOMAVfdJxOXHlsLnZ']
        ];
    }

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
     * @inheritdoc
     */
     public static function findIdentity($id)
     {
         return static::findOne(['idLogin' => $id, 'active' => self::STATUS_ACTIVE]);
     }

    /**
     * @inheritdoc
     */
     public static function findIdentityByAccessToken($token, $type = null)
     {
         throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
     }

    /**
    * Finds user by username
    *
    * @param  string      $username
    * @return static|null
    */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'active' => self::STATUS_ACTIVE]);
    }

    public static function findByUsernameLevel($username, $level)
    {
      return static::findOne(['username' => $username, 'level' => $level]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'active' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
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

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function getLoginsCompanies() {
       return $this->hasMany(LoginsCompanies::className(), ['idLogin' => 'idLogin']);
    }

}
