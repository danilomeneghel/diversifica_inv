<?php

namespace panel\models;

use Yii;
use yii\base\Model;

/**
 * UsersForm is the model behind the contact form.
 */
class UsersForm extends Model
{
    public $name;
    public $email;
    public $reCaptcha;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['name', 'gender', 'dateBirth', 'termsService'], 'required'],
            [['dateBirth'], 'date', 'format' => 'php:Y-m-d'],
            [['name', 'profession'], 'string', 'max' => 35],
            [['dateCreated'], 'datetime'],
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
        ];
    }
}
