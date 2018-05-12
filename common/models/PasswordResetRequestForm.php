<?php
namespace common\models;

use Yii;
use yii\base\Model;
use common\models\Login;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    public $email;
    //public $reCaptcha;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => '\common\models\Login',
                'filter' => ['active' => Login::STATUS_ACTIVE],
                'message' => 'There is no user with this email address.'
            ],
            // reCaptcha needs to be entered correctly
            //[['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator::className(), 'secret' => '6Le2OhEUAAAAAFVAo694LcEDOMAVfdJxOXHlsLnZ']
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return bool whether the email was send
     */
    public function sendEmail()
    {
        /* @var $user Login */
        $user = Login::findOne([
            'active' => Login::STATUS_ACTIVE,
            'email' => $this->email,
        ]);

        if (!$user) {
            return false;
        }

        if (!Login::isPasswordResetTokenValid($user->password_reset_token)) {
            $user->generatePasswordResetToken();
            if (!$user->save()) {
                return false;
            }
        }

        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['panelEmail'] => Yii::$app->params['panelEmail']])
            ->setTo($this->email)
            ->setSubject('Password reset for ' . Yii::$app->params['siteName'])
            ->send();
    }
}
