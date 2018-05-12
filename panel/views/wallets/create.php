<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model panel\models\Wallets */

$this->title = 'Adicionar Carteira';
$this->params['breadcrumbs'][] = ['label' => 'Carteira', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wallets-create">

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
