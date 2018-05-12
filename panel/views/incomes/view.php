<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model panel\models\Incomes */

$this->title = 'Visualizar Rendimento: ' . $model->idIncome;
$this->params['breadcrumbs'][] = ['label' => 'Incomes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="incomes-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Adicionar', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Atualizar', ['update', 'idIncome' => $model->idIncome, 'idCompany' => $model->idCompany], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Excluir', ['delete', 'idIncome' => $model->idIncome, 'idCompany' => $model->idCompany], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Confirmar a exclusão desse item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-duplicate"></i> Dados do Rendimento</h4></div>
        <div class="panel-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'idIncome',
                    [
                        'attribute' => 'idCompany',
                        'label' => 'Company',
                        'value'=>$model->companies->name,
                    ],
                    [
                        'attribute' => 'fixed',
                        'value'=> ($model->fixed == 0) ? 'No' : 'Yes',
                    ],
                    'date',
                    'profit'
                ],
            ]) ?>
        </div>
    </div>
</div>
