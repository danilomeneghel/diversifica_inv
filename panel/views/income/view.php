<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model panel\models\Income */

$this->title = 'Visualizar Rendimento: ' . $model->idIncome;
$this->params['breadcrumbs'][] = ['label' => 'Rendimento', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="login-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idIncome], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-duplicate"></i> Dados do Rendimento</h4></div>
        <div class="panel-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'idIncome',
                    'groupProfit',
                    'dateUpdated',
                ],
            ]) ?>
        </div>
    </div>
</div>
