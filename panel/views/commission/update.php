<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model panel\models\Commission */

$this->title = 'Atualizar Comissão';
$this->params['breadcrumbs'][] = ['label' => 'Comissão', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idCommission, 'url' => ['view', 'idCommission' => $model->idCommission]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="commission-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
