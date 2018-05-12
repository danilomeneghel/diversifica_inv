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
$this->title = 'Grupo DiversificA+';
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="../favicon.ico" type="image/ico" />
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
                <?php
                  foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
                      echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
                  }
                ?>
                <div class="box box-login">
                    <div class="titulo-login">Efetuar Login</div>
                    <div class="form-group form-group-padding">
                      <div class="input-icon">
                        <i class="icon-user"></i>
                        <?= $form->field($model, 'username', [
                            'inputOptions'=>[
                                'class'=>'form-control',
                                'placeholder'=>'Usuário',
                            ]
                        ])->label(false); ?>
                      </div>
                      <div class="input-icon">
                        <i class="icon-lock"></i>
                        <?= $form->field($model, 'password', [
                            'inputOptions'=>[
                                'class'=>'form-control',
                                'placeholder'=>'Senha'
                            ]
                        ])->passwordInput()->label(false); ?>
                      </div>
                      <?php
                        /*if($error) {
                            echo $form->field($model, 'reCaptcha')->widget(
                                \himiklab\yii2\recaptcha\ReCaptcha::className(),
                                ['siteKey' => '6Le2OhEUAAAAAEBHUOm_KLcNb3RRmeiGGoYMwpmH']
                            )->label(false);
                        }*/
                      ?>
                      <div class="col-login-btn">
                          <?= Html::submitButton('Entrar', ['class' => 'btn btn-success', 'name' => 'login-button']) ?>
                      </div>
                      <div class="col-login-btn">
                          <?= Html::a('Cadastrar', ['/site/register'], ['class'=>'btn btn-success']) ?>
                      </div>
                    </div>
                    <div class="inner-box">
                      <div class="content">
                        <i class="icon-remove close hide-default"></i>
                        <a class="forgot-password-link" href="request-password-reset">Esqueci minha senha?</a>
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
