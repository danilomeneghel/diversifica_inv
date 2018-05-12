<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model panel\models\Incomes */

$this->title = 'Atualizar Rendimento: ' . ' ' . $model->idIncome;
$this->params['breadcrumbs'][] = ['label' => 'Income', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idIncome, 'url' => ['view', 'idIncome' => $model->idIncome, 'idCompany' => $model->idCompany]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="incomes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
