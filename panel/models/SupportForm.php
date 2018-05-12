<?php

namespace panel\models;

use Yii;
use yii\base\Model;

/**
 * SupportForm is the model behind the contact form.
 */
class SupportForm extends Model
{
    public $nome;
    public $email;
    public $assunto;
    public $mensagem;
    public $reCaptcha;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // nome, email, assunto and mensagem are required
            [['nome', 'email', 'assunto', 'mensagem'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            // reCaptcha needs to be entered correctly
            //[['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator::className(), 'secret' => '6Le2OhEUAAAAAFVAo694LcEDOMAVfdJxOXHlsLnZ']
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param  string  $email the target email address
     * @return boolean whether the model passes validation
     */
    public function sendEmail($email)
    {
        $message = $this->email . ' - ' . $this->nome . '
        ' . $this->mensagem;

        if ($this->validate()) {
            Yii::$app->mailer->compose()
                 ->setFrom($email)
                 ->setTo($email)
                 ->setSubject($this->assunto)
                 ->setTextBody($message)
                 ->send();

            return true;
        }
        return false;
    }
}
