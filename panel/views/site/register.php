<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model panel\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use panel\assets\AppAsset;
use panel\models\Companies;

AppAsset::register($this);
$this->title = 'Register';
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
        <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
        <div class="login">
            <div class="login-margem2">
                <div class="logo-margin">
                    <?=Html::img(Yii::$app->homeUrl.'images/logo.png', ['width' => 280]);?>
                </div>
                <?php
                foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
                  echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
                }
                ?>
                <div class="box box-login2">
                  <div class="site-request-password-reset form-group form-group-padding">
                      <div class="titulo-login">Cadastro</div>

                      <div style="padding: 8px 0px 20px 0px; font-size:13px">
                        Participe do nosso grupo e receba parte dos 25% distribuido!<br>
                        Para isso é preciso estar registrado pelo <a href="http://diversificamais.com/ganhar-pela-internet/ganhar-dinheiro-investindo" target="_blank"><b>nosso link de afiliados aqui</b></a>.<br>
                        <b>O mínimo são 2 sites investidos com R$ 200 (ou mais) em cada site.<b>
                      </div>

                      <div class="panel panel-default">
                          <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <?= $form->field($model2, 'bitcoin')->textInput(['maxlength' => true]) ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <?= $form->field($model2, 'litecoin')->textInput(['maxlength' => true]) ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <?= $form->field($model2, 'dogecoin')->textInput(['maxlength' => true]) ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4">
                                    <?= $form->field($model4, 'idCompany')->inline(true)->checkboxList(ArrayHelper::map(Companies::find()->where(['active' => 1])->all(), 'idCompany', 'name'))->label("Empresas Investidas") ?>
                                </div>
                            </div>

                            <div style="height:15px"></div>

                            <div class="row">
                              <div class="col-sm-12">
                                <?= $form->field($model3, 'investedReal')->widget(MaskedInput::classname(),([
                                    'clientOptions' => [
                                            'alias' => 'decimal',
                                            'digits' => 2,
                                            'radixPoint' => '.',
                                            'groupSeparator' => ',',
                                            'autoGroup' => true,
                                            'removeMaskOnSubmit' => true,
                                        ],
                                    ])); ?>
                              </div>
                            </div>
                          </div>
                      </div>

                      <div class="panel panel-default">
                          <div class="panel-body">

                            <div class="row">
                                <div class="col-sm-12">
                                    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
                                </div>
                            </div>

                          </div>
                      </div>

                      <div class="form-group">
                          <?= Html::submitButton('Cadastrar', ['class' => 'btn btn-success']) ?>
                          <?= Html::a('Voltar', ['/site/login'], ['class'=>'btn btn-success']) ?>
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
