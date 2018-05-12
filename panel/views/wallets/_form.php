<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use common\models\Login;

//use kartik\datecontrol\Module;
//use kartik\datecontrol\DateControl;

/* @var $this yii\web\View */
/* @var $model panel\models\Wallets */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="wallets-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-duplicate"></i> Dados da Carteira</h4></div>
        <div class="panel-body">
                <div class="row">
                    <div class="col-sm-4">
                        <?= $form->field($model, 'idLogin')->dropDownList(ArrayHelper::map(Login::find()->orderBy(['idLogin' => SORT_DESC])->all(), 'idLogin', 'username'))->label("Usuário") ?>
                    </div>
                </div>

                <div class="row">
                  <div class="col-sm-12">
                      <div class="row">
                          <div class="col-sm-4">
                              <?= $form->field($model, 'bitcoin')->textInput(['maxlength' => true]) ?>
                          </div>
                      </div>

                      <div style="height:15px"></div>

                      <div class="row">
                          <div class="col-sm-4">
                              <?= $form->field($model, 'litecoin')->textInput(['maxlength' => true]) ?>
                          </div>
                      </div>

                      <div style="height:15px"></div>

                      <div class="row">
                          <div class="col-sm-4">
                              <?= $form->field($model, 'dogecoin')->textInput(['maxlength' => true]) ?>
                          </div>
                      </div>
                  </div>
                </div>

        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Adicionar' : 'Atualizar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
