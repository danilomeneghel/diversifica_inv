<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use panel\models\Companies;
use kartik\daterange\DateRangePicker;
use yii\widgets\MaskedInput;

//use kartik\datecontrol\Module;
//use kartik\datecontrol\DateControl;

/* @var $this yii\web\View */
/* @var $model panel\models\Incomes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="incomes-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-duplicate"></i> Dados do Rendimento</h4></div>
        <div class="panel-body">

                <div class="row">
                    <div class="col-sm-4">
                        <?= $form->field($model, 'idCompany')->dropDownList(ArrayHelper::map(Companies::find()->all(), 'idCompany', 'name'))->label("Empresa") ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <?= $form->field($model, 'fixed')->checkbox([1 => 'Yes']) ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <?php
                            echo '<label>Data</label>';
                            echo '<div class="input-group form-group field-incomes-date required">';
                            echo '<span class="input-group-addon" title="Select date">
                                    <i class="glyphicon glyphicon-calendar"></i>
                                  </span>';
                            echo DateRangePicker::widget([
                                'name'=>'Incomes[date]',
                                'id' => 'Incomes-date',
                                'value' => $model->date,
                                'useWithAddon'=>true,
                                'pluginOptions'=>[
                                    'singleDatePicker'=>true,
                                    'showDropdowns'=>true,
                                ],
                                'options' => [
                                    'class' => 'form-control',
                                    'placeholder' => 'yyyy-mm-dd'
                                ]
                            ]);
                            echo '<div class="help-block"></div>';
                            echo '</div>';
                        ?>
                    </div>
                </div>

                <div class="row">&nbsp;</div>

                <div class="row">
                  <div class="col-sm-4">
                    <?= $form->field($model, 'profit')->widget(MaskedInput::classname(),([
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

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Adicionar' : 'Atualizar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
