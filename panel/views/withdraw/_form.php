<?php

use yii\helpers\Html;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$session = Yii::$app->session;

date_default_timezone_set('America/Sao_Paulo');

//use kartik\datecontrol\Module;
//use kartik\datecontrol\DateControl;

/* @var $this yii\web\View */
/* @var $model panel\models\Withdrawals */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="withdraw-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-usd"></i> Dados do Saque</h4></div>
        <div class="panel-body">
            <div>
              <h3 class="text-alert">Atenção!</h3>
              <div class="text-alert">
                <b>Só é permitido fazer 1 saque por semana (Sábados).<br>
                O saque será enviado para a carteira "<?=strtoupper($paymentMethod);?>".<br><br>
                Verifique se o endereço da carteira está preenchido corretamente!</b>
              </div>
            </div>

            <div style="height:15px"></div>

            <div><?php echo Html::img(Yii::$app->homeUrl.'images/bitcoin.png', ['width' => 250]);?></div>

            <div class="row" style="padding-top: 20px">
                <div class="col-sm-4">
                    <label>Carteira Bitcoin (BTC)</label>
                    <div class="form-control-disabled"><?=$bitcoinWallet; ?></div>
                </div>
            </div>

            <div style="height:15px"></div>

            <div><?php echo Html::img(Yii::$app->homeUrl.'images/litecoin.png', ['width' => 250]);?></div>

            <div class="row" style="padding-top: 20px">
                <div class="col-sm-4">
                    <label>Carteira Litecoin (LTC)</label>
                    <div class="form-control-disabled"><?=$litecoinWallet; ?></div>
                </div>
            </div>

            <div style="height:15px"></div>

            <div><?php echo Html::img(Yii::$app->homeUrl.'images/dogecoin.png', ['width' => 250]);?></div>

            <div class="row" style="padding-top: 20px">
                <div class="col-sm-4">
                    <label>Carteira Dogecoin (DOGE)</label>
                    <div class="form-control-disabled"><?=$dogecoinWallet; ?></div>
                </div>
            </div>

            <div class="row" style="padding-top: 20px">
                <div class="col-sm-4">
                    <label>Valor (R$)</label>
                    <div class="form-control-disabled"><?= number_format($session->get('realTeamProfit'), 2);?></div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Sacar' : 'Atualizar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
