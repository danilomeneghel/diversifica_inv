<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model panel\models\Income */

$this->title = 'Atualizar Rendimento';
$this->params['breadcrumbs'][] = ['label' => 'Rendimento', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idIncome, 'url' => ['view', 'idIncome' => $model->idIncome]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="login-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
