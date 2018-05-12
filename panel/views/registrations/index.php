<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel panel\models\RegistrtionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cadastros';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="registrations-index">

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
            'username',
            'email',
            [
                'attribute' => 'dateCreated',
                'format' => ['datetime', 'php:d-m-Y H:i:s'],
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
