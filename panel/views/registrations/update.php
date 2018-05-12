<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model panel\models\Registrtion */

$this->title = 'Atualizar Cadastro';
$this->params['breadcrumbs'][] = ['label' => 'Cadastro', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="registrations-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
      foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
          echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
      }
    ?>

    <?= $this->render('_form', [
        'model' => $model,
        'model2' => $model2,
        'model3' => $model3
    ]) ?>

</div>
