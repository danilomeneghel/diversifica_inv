<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use common\models\Login;

//use kartik\datecontrol\Module;
//use kartik\datecontrol\DateControl;

/* @var $this yii\web\View */
/* @var $model panel\models\Investments */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="investments-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-duplicate"></i> Dados do Investimento</h4></div>
        <div class="panel-body">
                <div class="row">
                    <div class="col-sm-4">
                        <?= $form->field($model, 'idLogin')->dropDownList(ArrayHelper::map(Login::find()->orderBy(['idLogin' => SORT_DESC])->all(), 'idLogin', 'username'))->label("Usuário") ?>
                    </div>
                </div>

                <div class="row">
                  <div class="col-sm-4">
                    <?= $form->field($model, 'investedReal')->widget(MaskedInput::classname(),([
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
