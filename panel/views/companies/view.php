<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model panel\models\Investments */

$this->title = 'Visualizar Empresa: ' . $model->idCompany;
$this->params['breadcrumbs'][] = ['label' => 'Empresa', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="companies-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Adicionar', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Atualizar', ['update', 'id' => $model->idCompany], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Excluir', ['delete', 'id' => $model->idCompany], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Confirma a exclusão desse item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-duplicate"></i> Dados da Empresa</h4></div>
        <div class="panel-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'idCompany',
                    'name',
                    'site',
                    [
                        'attribute' => 'dateCreated',
                        'format' => ['datetime', 'php:d-m-Y H:i:s']
                    ],

                ],
            ]) ?>
        </div>
    </div>
</div>
