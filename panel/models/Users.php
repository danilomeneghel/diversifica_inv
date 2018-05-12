<?php

namespace panel\models;

use Yii;
use common\models\Login;

/**
 * This is the model class for table "user".
 *
 * @property integer $idUser
 * @property string $name
 * @property string $gender
 * @property string $dateCreated
 *
 * @property Dre[] $dres
 * @property UsersEmail[] $usersEmail
 * @property Login[] $logins
 */
class Users extends \yii\db\ActiveRecord
{
    public $reCaptcha;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rs_users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'gender', 'dateBirth', 'termsService'], 'required'],
            [['dateBirth'], 'date', 'format' => 'php:Y-m-d'],
            ['dateBirth', 'validateDate'],
            [['name', 'profession'], 'string', 'max' => 45],
            [['referral'], 'integer'],
            [['dateCreated'], 'datetime', 'format' => 'php:Y-m-d H:i:s'],
            // reCaptcha needs to be entered correctly
            [['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator::className(), 'secret' => '6Le2OhEUAAAAAFVAo694LcEDOMAVfdJxOXHlsLnZ']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idUser' => 'Id User',
            'name' => 'Full Name',
            'gender' => 'Gender',
            'dateBirth' => 'Date Birth',
            'profession' => 'Profession',
            'referred' => 'Referred',
            'dateCreated' => 'Date Created',
            'logins.username' => 'Username',
            'logins.level' => 'Level',
            'logins.active' => 'Active',
            'referrals.username' => 'Referral',
        ];
    }

    public function validateDate(){
        $year = date("Y") - 18;

        if(strtotime($this->dateBirth) >= strtotime($year."-01-01")){
            $this->addError('dateBirth','It is compulsory to be over 18 years old to register!');
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersAddress()
    {
        return $this->hasMany(UsersAddress::className(), ['idUser' => 'idUser']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersPhone()
    {
        return $this->hasMany(UsersPhone::className(), ['idUser' => 'idUser']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogins()
    {
        return $this->hasMany(Login::className(), ['idUser' => 'idUser']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReferrals()
    {
        return $this->hasOne(Login::className(), ['idUser' => 'referral']);
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param  string  $email the target email address
     * @return boolean whether the model passes validation
     */
    public function sendEmail($email, $post)
    {
        $name = $post['Users']['name'];
        $username = $post['SignupForm']['username'];
        $emailUser = $post['SignupForm']['email'];

        $message = '    Dear '.$name.',


        Thanks for registering at eInvesty!
        We are glad you have chosen to be a part of our community and hope you enjoy all the resources of the site.

        To access the plataform and start investing, go to:
        '.Yii::$app->params['siteUrl'].'/panel

        Your username is:
        '.$username.'

        Your password is the same as the one you entered when you registered.

        If you forget or can not log in, try to generate a new password by clicking on the "Forgot password" link.
        If you have any questions or need help, please contact us at '.Yii::$app->params['panelEmail'].'.


        Best Regards,
        eInvesty Team.';

        Yii::$app->mailer->compose()
            ->setFrom($email)
            ->setTo([$emailUser => $name])
            ->setSubject('Welcome to eInvesty!')
            ->setTextBody($message)
            ->send();

        return true;
    }
}
