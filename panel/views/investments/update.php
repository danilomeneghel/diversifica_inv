<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model panel\models\Investments */

$this->title = 'Atualizar Investimento: ' . ' ' . $model->idInvestment;
$this->params['breadcrumbs'][] = ['label' => 'Investimento', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idInvestment, 'url' => ['view', 'idInvestment' => $model->idInvestment, 'idLogin' => $model->idLogin]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="investments-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
