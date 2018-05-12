<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel panel\models\InvestmentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Investimentos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="investments-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Adicionar', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'idLogin',
                'value' => 'login.username'
            ],
            [
                'attribute' => 'investedBTC',
                'format' => ['decimal', 8]
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
              'filter' => array(0 => "Não", 1 => "Sim"),
              'value' => function ($data) {
                return ($data->active == 0) ? "Não" : "Sim";
              }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
