<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\daterange\DateRangePicker;
use common\models\Login;

//use kartik\datecontrol\Module;
//use kartik\datecontrol\DateControl;

/* @var $this yii\web\View */
/* @var $model panel\models\Companies */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="companies-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-duplicate"></i> Dados da Empresa</h4></div>
        <div class="panel-body">
                <div class="row">
                    <div class="col-sm-4">
                        <?= $form->field($model, 'name')->textInput() ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <?= $form->field($model, 'site')->textInput() ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-2">
                        <?= $form->field($model, 'active')->dropDownList(array(1 => 'Sim', 0 => 'Não')) ?>
                    </div>
                </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Adicionar' : 'Atualizar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
