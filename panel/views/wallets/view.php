<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model panel\models\Wallets */

$this->title = 'Visualizar Carteira: ' . $model->idWallet;
$this->params['breadcrumbs'][] = ['label' => 'Carteira', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wallets-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Adicionar', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Atualizar', ['update', 'idWallet' => $model->idWallet, 'idLogin' => $model->idLogin], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Excluir', ['delete', 'idWallet' => $model->idWallet, 'idLogin' => $model->idLogin], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Confirma a exclusão desse item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-duplicate"></i> Dados da Carteira</h4></div>
        <div class="panel-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'idWallet',
                    [
                        'attribute' => 'idLogin',
                        'label' => 'Username',
                        'value'=>$model->login->username,
                    ],
                    'bitcoin',
                    'litecoin',
                    'dogecoin',
                    [
                      'attribute' => 'dateCreated',
                      'format' => ['datetime', 'php:d-m-Y H:i:s']
                    ],
                    
                ],
            ]) ?>
        </div>
    </div>
</div>
