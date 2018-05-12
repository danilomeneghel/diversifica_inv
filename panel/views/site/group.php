<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\DetailView;
use panel\models\Companies;
use panel\models\LoginsCompanies;

$this->title = 'Grupo';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'login.username',
                'value' => function ($data) {
                            return $data->login->username;
                           }
            ],
            [
                'attribute' => 'Qtd Empresas',
                'value' => function ($data) {
                            return LoginsCompanies::find()->where(['idLogin' => $data->idLogin])->count();
                           }
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
        ],
    ]); ?>

    <div style="text-align: right; font-weight: bold; padding-bottom: 20px">
      <?= "Total Investidores Ativo: " . $totalInvestors; ?>
    </div>
    <div style="text-align: right; font-weight: bold; padding-bottom: 20px">
      <?= "Total Investido Ativo: R$ " . number_format($totalInvested, 2); ?>
    </div>
</div>
