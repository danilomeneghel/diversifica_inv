<?php

use yii\helpers\Html;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use panel\models\Companies;
use panel\models\LoginsCompanies;

/* @var $this yii\web\View */
/* @var $model panel\models\Registrtion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="registrations-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <div class="panel panel-default">
        <div class="panel-body">
          <div class="row">
              <div class="col-sm-6">
                  <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
              </div>
          </div>

          <div class="row">
              <div class="col-sm-6">
                  <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
              </div>
          </div>

          <div style="height:15px"></div>

          <div class="row">
              <div class="col-sm-4">
                <?php
                    if(empty($model3)) {
                      $model3 = new LoginsCompanies();
                    } else {
                      foreach($model3 as $company)
                        $checkedList[] = $company->idCompany;
                      $company->idCompany = $checkedList;
                      $model3 = $company;
                    }

                    echo $form->field($model3, 'idCompany')->checkboxList(ArrayHelper::map(Companies::find()->where(['active' => 1])->all(), 'idCompany', 'name'))->label('Empresas Investidas');
                ?>
              </div>
          </div>

          <div style="height:15px"></div>

          <div class="row">
            <div class="col-sm-4">
              <?= $form->field($model2, 'investedReal')->widget(MaskedInput::classname(),([
                  'clientOptions' => [
                          'alias' => 'decimal',
                          'digits' => 2,
                          'radixPoint' => '.',
                          'groupSeparator' => ',',
                          'autoGroup' => true,
                          'removeMaskOnSubmit' => true,
                      ],
                  ])); ?>
            </div>
          </div>

          <div class="row">
              <div class="col-sm-4">
                  <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
              </div>
          </div>

          <div class="row">
              <div class="col-sm-4">
                  <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
              </div>
          </div>

          <div class="row">
              <div class="col-sm-2">
                  <?= $form->field($model, 'level')->dropDownList(array(0 => 'Usuário', 1 => 'Gerente', 2 => 'Administrador')) ?>
              </div>
          </div>

          <div class="row">
              <div class="col-sm-2">
                  <?= $form->field($model, 'active')->dropDownList(array(1 => 'Sim', 0 => 'Não')) ?>
              </div>
          </div>

          <div class="form-group">
              <?= Html::submitButton($model->isNewRecord ? 'Cadastrar' : 'Atualizar', ['class' => 'btn btn-success']) ?>
          </div>

          </div>
      </div>

      <?php ActiveForm::end(); ?>
</div>
