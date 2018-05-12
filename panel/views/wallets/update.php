<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model panel\models\Wallets */

$this->title = 'Atualizar Carteira: ' . ' ' . $model->idWallet;
$this->params['breadcrumbs'][] = ['label' => 'Carteira', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idWallet, 'url' => ['view', 'idWallet' => $model->idWallet, 'idLogin' => $model->idLogin]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="wallets-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
