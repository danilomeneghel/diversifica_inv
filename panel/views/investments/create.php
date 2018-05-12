<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model panel\models\Investments */

$this->title = 'Adicionar Investimento';
$this->params['breadcrumbs'][] = ['label' => 'Investimento', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="investments-create">

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
