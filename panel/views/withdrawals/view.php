<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model panel\models\Withdrawals */

$this->title = 'Visualizar Saque: ' . $model->idWithdrawal;
$this->params['breadcrumbs'][] = ['label' => 'Saque', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="withdrawals-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Atualizar', ['update', 'idWithdrawal' => $model->idWithdrawal, 'idLogin' => $model->idLogin], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Excluir', ['delete', 'idWithdrawal' => $model->idWithdrawal, 'idLogin' => $model->idLogin], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Confirm the exclusion of this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-duplicate"></i> Dados do Saque</h4></div>
        <div class="panel-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'idWithdrawal',
                    [
                        'attribute' => 'idLogin',
                        'label' => 'Username',
                        'value'=>$model->login->username,
                    ],
                    'amount',
                    'paymentMethod',
                    [
                        'attribute' => 'address',
                        'format' => 'raw',
                        'value' => ($model->status == 1) ? Html::a($model->address, 'https://blockchain.info/address/'.$model->address, ['target' => '_blank']) : $model->address,
                    ],
                    [
                        'attribute' => 'dateCreated',
                        'format' => ['datetime', 'php:d-m-Y H:i:s']
                    ],
                    [
                        'attribute' => 'status',
                        'value' => ($model->status == 0) ? "Pending" : "Complete",
                    ],
                ],
            ]) ?>
        </div>
    </div>
</div>
