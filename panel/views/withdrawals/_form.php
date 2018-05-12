<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Login;

$session = Yii::$app->session;

//use kartik\datecontrol\Module;
//use kartik\datecontrol\DateControl;

/* @var $this yii\web\View */
/* @var $model panel\models\Withdrawals */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="withdrawals-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-usd"></i> Dados do Saque</h4></div>
        <div class="panel-body">

                <div class="row">
                    <div class="col-sm-4">
                        <?= $form->field($model, 'idLogin')->dropDownList(ArrayHelper::map(Login::find()->orderBy(['idLogin' => SORT_DESC])->all(), 'idLogin', 'username'))->label("Usuário") ?>
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
        <?= Html::submitButton($model->isNewRecord ? 'Sacar' : 'Atualizar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
