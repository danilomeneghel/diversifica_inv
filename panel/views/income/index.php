<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel panel\models\IncomeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rendimento';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="Income-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'groupProfit',
            [
                'attribute' => 'dateUpdated',
                'format' => ['date', 'php:d-m-Y H:i:s']
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
                'visibleButtons' => [
                    'update' => true
               ]
            ]
        ],
    ]); ?>

</div>
