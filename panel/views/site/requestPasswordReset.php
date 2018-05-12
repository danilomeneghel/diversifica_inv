<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model panel\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\bootstrap\ActiveForm;
use panel\assets\AppAsset;

AppAsset::register($this);
$this->title = 'Request Password Reset';
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="bg-login">
        <?php $this->beginBody() ?>
        <?php
        $form = ActiveForm::begin([
          'id' => 'login-form',
          'options' => ['class' => 'form-horizontal'],
          'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
          ],
        ]);
        ?>
        <div class="login">
            <div class="login-margem">
                <div class="logo-margin">
                    <?=Html::img(Yii::$app->homeUrl.'images/logo.png', ['width' => 280]);?>
                </div>
                <div class="box box-login">
                  <div class="site-request-password-reset form-group form-group-padding">
                      <div class="titulo-login">Solicitar Recuperação de Senha</div>

                      <div style="padding: 10px 0px 20px 0px">Por favor, preencha o seu e-mail.<br> Um link para redefinir a senha será enviado.</div>

                      <div class="row">
                          <div class="col-lg-8">
                              <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
                                  <div class="form-group">
                                    <div class="input-icon">
                                        <i class="fa fa-envelope"></i>
                                        <?= $form->field($model, 'email', [
                                            'inputOptions'=>[
                                                'class'=>'form-control',
                                                'placeholder'=>'E-mail',
                                            ]
                                        ])->label(false); ?>
                                    </div>
                                  </div>
                                  <?php /*echo $form->field($model, 'reCaptcha')->widget(
                                      \himiklab\yii2\recaptcha\ReCaptcha::className(),
                                      ['siteKey' => '6Le2OhEUAAAAAEBHUOm_KLcNb3RRmeiGGoYMwpmH']
                                  )->label(false);*/ ?>
                                  <div class="btn-password-reset">
                                      <?= Html::submitButton('Enviar', ['class' => 'btn btn-success']) ?>
                                  </div>
                                  <div class="btn-password-reset">
                                      <?= Html::a('Voltar', ['/site/login'], ['class'=>'btn btn-success']) ?>
                                  </div>
                              <?php ActiveForm::end(); ?>
                          </div>
                      </div>
                  </div>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
