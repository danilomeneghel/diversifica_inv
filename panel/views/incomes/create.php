<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model panel\models\Incomes */

$this->title = 'Adicionar Rendimento';
$this->params['breadcrumbs'][] = ['label' => 'Incomes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="incomes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
        if(!empty($error)) {
            echo '<div class="alert alert-danger">' . $error . '</div>';
        }
    ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
