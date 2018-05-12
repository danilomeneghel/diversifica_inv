<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model panel\models\InvestmentsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="investments-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idInvestment') ?>

    <?= $form->field($model, 'idLogin') ?>

    <?= $form->field($model, 'investedBTC') ?>

    <?= $form->field($model, 'totalProfit') ?>

    <?= $form->field($model, 'bitcoinTeamProfit') ?>

    <?= $form->field($model, 'realTeamProfit') ?>

    <?= $form->field($model, 'dateUpdated') ?>

    <?php // echo $form->field($model, 'active') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-success']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
