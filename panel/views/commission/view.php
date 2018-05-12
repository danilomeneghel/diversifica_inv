<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model panel\models\Commission */

$this->title = 'Visualizar Comissão: ' . $model->idCommission;
$this->params['breadcrumbs'][] = ['label' => 'Comissão', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="commission-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->idCommission], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-duplicate"></i> Dados da Comissão</h4></div>
        <div class="panel-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'idCommission',
                    'groupProfit',
                    'paymentMethod',
                    'dateUpdated',
                ],
            ]) ?>
        </div>
    </div>
</div>
