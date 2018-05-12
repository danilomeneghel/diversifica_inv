<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model panel\models\Withdrawals */

$this->title = 'Realizar Saque';
$this->params['breadcrumbs'][] = ['label' => 'Saque', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="withdrawals-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if(Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger" role="alert">
            <?= Yii::$app->session->getFlash('error') ?>
        </div>
    <?php endif; ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
