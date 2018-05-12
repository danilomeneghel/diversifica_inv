<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use panel\models\LoginsCompanies;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model panel\models\Registrtion */

$this->title = 'Visualizar Cadastro';
$this->params['breadcrumbs'][] = ['label' => 'Cadastro', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="registrations-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Adicionar', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Atualizar', ['update', 'id' => $model->idLogin], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Excluir', ['delete', 'id' => $model->idLogin], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Confirma a exclusão deste item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-log-in"></i> Login</h4></div>
        <div class="panel-body">
            <?php
              $companiesList = LoginsCompanies::find()->select('name')->joinWith('companies', false)->where(['idLogin'=>$model->idLogin])->asArray()->all();

              if(!empty($companiesList)) {
                foreach($companiesList as $company)
                  $arrayCompanies[] = $company['name'];
                $companies = implode(', ',$arrayCompanies);
              } else {
                $companies = '';
              }
            ?>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'name',
                    'username',
                    'email',
                    [
                        'attribute'=>'idLogin',
                        'label' => 'Empresas',
                        'value'=> $companies,
                    ],
                    [
                      'attribute' => 'dateCreated',
                      'format' => ['datetime', 'php:d-m-Y H:i:s'],
                    ],
                    [
                        'attribute' => 'level',
                        'filter' => array(0 => "Usuário", 1 => "Gerente", 2 => "Administrador"),
                        'value' => ($model->level == 0) ? "Usuário" : ($model->level == 1 ? "Gerente" : "Administrador")
                    ],
                    [
                        'attribute' => 'active',
                        'value' => ($model->active == 0) ? "Não" : "Sim",
                    ],
                ],
            ]) ?>
        </div>
    </div>

</div>
