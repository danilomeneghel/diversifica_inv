<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\daterange\DateRangePicker;

//use kartik\datecontrol\Module;
//use kartik\datecontrol\DateControl;

/* @var $this yii\web\View */
/* @var $model panel\models\Commission */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="commmission-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-duplicate"></i> Dados da Comissão</h4></div>
        <div class="panel-body">

                <div class="row">
                    <div class="col-sm-4">
                        <?= $form->field($model, 'groupProfit')->textInput() ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <?= $form->field($model, 'paymentMethod')->dropDownList(['Bitcoin' => 'Bitcoin (BTC)', 'Litecoin' => 'Litecoin (LTC)', 'Dogecoin' => 'Dogecoin (DOGE)'])->label("Carteira") ?>
                    </div>
                </div>

        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Adicionar' : 'Atualizar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
