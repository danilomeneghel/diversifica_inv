<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model panel\models\Companies */

$this->title = 'Atualizar Empresa: ' . ' ' . $model->idCompany;
$this->params['breadcrumbs'][] = ['label' => 'Empresa', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idCompany, 'url' => ['view', 'idCompany' => $model->idCompany]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="companies-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
