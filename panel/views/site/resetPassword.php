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
$this->title = 'Reset Password';
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
                  <div class="form-group form-group-padding">
                      <div class="titulo-login">Alterar Senha</div>
                          <p>Digite sua nova senha.:</p>

                          <div class="row">
                              <div class="col-lg-8">
                                  <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>
                                      <?= $form->field($model, 'password')->passwordInput() ?>
                                      <div class="form-group">
                                          <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
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
