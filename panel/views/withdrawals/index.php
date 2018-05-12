<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;

/* @var $this yii\web\View */
/* @var $searchModel panel\models\WithdrawalsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Saques';
$this->params['breadcrumbs'][] = $this->title;

$level = Yii::$app->user->identity->level;
?>
<div class="withdrawals-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Sacar', ['create'], ['class' => 'btn btn-success']) ?>
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
            'paymentMethod',
            'amount',
            [
                'attribute' => 'address',
                'format' => 'raw',
                'value' => function ($data) {
                            return ($data->status == 1) ? Html::a($data->address, 'https://bitinfocharts.com/'.$data->paymentMethod.'/address/'.$data->address, ['target' => '_blank']) : $data->address;
                           }
            ],
            [
                'attribute' => 'dateCreated',
                'format' => ['datetime', 'php:d-m-Y H:i:s']
            ],
            [
                'attribute' => 'status',
                'filter' => array(0 => "Pending", 1 => "Complete"),
                'value' => function ($data) {
                            return ($data->status == 0) ? "Pending" : "Complete";
                           }
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',
                'visibleButtons' => [
                    'delete' => true
               ]
            ]
        ],
    ]); ?>

    <div style="text-align: right; font-weight: bold; padding-bottom: 20px">
      <?= "Total de Saques: R$ " . number_format($totalWithdrawals, 2); ?>
    </div>
</div>
