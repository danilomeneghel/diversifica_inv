<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel panel\models\IncomesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rendimentos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="incomes-index">

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
                'attribute' => 'idCompany',
                'value' => 'companies.name'
            ],
            'date',
            'profit',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
