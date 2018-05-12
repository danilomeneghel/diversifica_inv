<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model panel\models\Investments */

$this->title = 'Visualizar Investimento: ' . $model->idInvestment;
$this->params['breadcrumbs'][] = ['label' => 'Investimento', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="investments-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Adicionar', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Atualizar', ['update', 'idInvestment' => $model->idInvestment, 'idLogin' => $model->idLogin], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Excluir', ['delete', 'idInvestment' => $model->idInvestment, 'idLogin' => $model->idLogin], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Confirma a exclusão desse item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-duplicate"></i> Dados do Investimento</h4></div>
        <div class="panel-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'idInvestment',
                    [
                        'attribute' => 'idLogin',
                        'label' => 'Username',
                        'value'=>$model->login->username,
                    ],
                    [
                        'attribute' => 'investedBTC',
                        'format' => ['decimal', 8]
                    ],
                    [
                        'attribute' => 'investedReal',
                        'format' => ['decimal', 2]
                    ],
                    [
                        'attribute' => 'totalProfit',
                        'format' => ['decimal', 2]
                    ],
                    [
                        'attribute' => 'bitcoinTeamProfit',
                        'format' => ['decimal', 8]
                    ],
                    [
                        'attribute' => 'realTeamProfit',
                        'format' => ['decimal', 2]
                    ],
                    [
                      'attribute' => 'dateUpdated',
                      'format' => ['datetime', 'php:d-m-Y H:i:s']
                    ],
                    [
                        'attribute' => 'active',
                        'value' => ($model->active == 0) ? "Não" : "Sim",
                    ],

                ],
            ]) ?>
        </div>
    </div>
</div>
