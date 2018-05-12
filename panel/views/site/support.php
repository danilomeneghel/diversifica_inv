<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model panel\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Suporte';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('supportForm')): ?>
      <div class="alert alert-success">
          Obrigado por entrar em contato!<br>
          Em breve retornaremos.
      </div>
    <?php else: ?>


    <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-user"></i> Suporte</h4></div>
        <div class="panel-body">
            <div style="padding: 10px 0px 20px 0px">
              Se você tiver algum problema ou dúvida, por gentileza, preencha os dados abaixo e envie-nos.<br>
              Também poderá entrar em contato através do e-mail: <a href="mailto:diversificamais@gmail.com">diversificamais@gmail.com</a>
            </div>

            <div class="row">
                <div class="col-lg-5">

                    <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                        <?= $form->field($model, 'nome') ?>

                        <?= $form->field($model, 'email') ?>

                        <?= $form->field($model, 'assunto') ?>

                        <?= $form->field($model, 'mensagem')->textArea(['rows' => 6]) ?>

                        <?php /*echo $form->field($model, 'reCaptcha')->widget(
                            \himiklab\yii2\recaptcha\ReCaptcha::className(),
                            ['siteKey' => '6Le2OhEUAAAAAEBHUOm_KLcNb3RRmeiGGoYMwpmH']
                        )*/ ?>

                        <div class="form-group">
                            <?= Html::submitButton('Enviar', ['class' => 'btn btn-success', 'name' => 'contact-button']) ?>
                        </div>

                    <?php ActiveForm::end(); ?>

                </div>
            </div>

        </div>
    </div>

    <?php endif; ?>

</div>
