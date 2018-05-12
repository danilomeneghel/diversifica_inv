<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model panel\models\WalletsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="wallets-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idWallet') ?>

    <?= $form->field($model, 'idLogin') ?>

    <?= $form->field($model, 'bitcoin') ?>

    <?= $form->field($model, 'litecoin') ?>

    <?= $form->field($model, 'dogecoin') ?>

    <?= $form->field($model, 'dateCreated') ?>

    <?php // echo $form->field($model, 'active') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-success']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
