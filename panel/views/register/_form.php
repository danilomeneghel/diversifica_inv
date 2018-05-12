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

<div class="register-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-user"></i> Dados Pessoais</h4></div>
        <div class="panel-body">
          <div style="padding: 10px 0px 20px 0px">
            Se você precisar alterar algum dado que estiver bloqueado, por favor entre em contato pelo suporte ou e-mail: <a href="mailto:diversificamais@gmail.com">diversificamais@gmail.com</a>
          </div>

          <div class="row">
              <div class="col-sm-4">
                <?php if(!empty($model->name)) { ?>
                  <div class="form-group">
                    <label>Nome</label>
                    <div class="form-control-disabled"><?=$model->name; ?></div>
                  </div>
                <?php } else { ?>
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                <?php } ?>
              </div>
          </div>

          <div class="row">
              <div class="col-sm-4">
                  <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
              </div>
          </div>

          <div class="row">
              <div class="col-sm-4">
                <?php if(!empty($model->username)) { ?>
                  <div class="form-group">
                    <label>Usuário</label>
                    <div class="form-control-disabled"><?=$model->username; ?></div>
                  </div>
                <?php } else { ?>
                    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
                <?php } ?>
              </div>
          </div>

          <div class="row">
              <div class="col-sm-4">
                  <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
              </div>
          </div>

        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-briefcase"></i> Empresas</h4></div>
        <div class="panel-body">
          <div class="row">
              <div class="col-sm-4">
                  <?php
                      if(empty($model4)) {
                        $model4 = new LoginsCompanies();
                      } else {
                        foreach($model4 as $company)
                          $checkedList[] = $company->idCompany;
                        $company->idCompany = $checkedList;
                        $model4 = $company;
                      }

                      echo $form->field($model4, 'idCompany')->checkboxList(ArrayHelper::map(Companies::find()->where(['active' => 1])->all(), 'idCompany', 'name'),['itemOptions'=>['disabled' => true, 'readonly' => true]])->label('Empresas Investidas');
                  ?>
              </div>
          </div>

          <div style="height:15px"></div>

          <div class="row">
            <div class="col-sm-4">
              <?= $form->field($model3, 'investedReal')->widget(MaskedInput::classname(),([
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
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-bitcoin"></i> Pagamento</h4></div>
        <div class="panel-body">
          <?php if(empty($model2->bitcoin)) { ?>
            <div class="row">
                <div class="col-sm-4">
                    <?= $form->field($model2, 'bitcoin')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
          <?php } else { ?>
            <div class="row" style="padding-top: 20px">
                <div class="col-sm-4">
                    <label>Carteira Bitcoin (BTC)</label>
                    <div class="form-control-disabled"><?=$model2->bitcoin; ?></div>
                </div>
            </div>
          <?php } ?>

          <div style="height:15px"></div>

          <?php if(empty($model2->litecoin)) { ?>
            <div class="row">
                <div class="col-sm-4">
                    <?= $form->field($model2, 'litecoin')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
          <?php } else { ?>
            <div class="row" style="padding-top: 20px">
                <div class="col-sm-4">
                    <label>Carteira Litecoin (LTC)</label>
                    <div class="form-control-disabled"><?=$model2->litecoin; ?></div>
                </div>
            </div>
          <?php } ?>

          <div style="height:15px"></div>

          <?php if(empty($model2->dogecoin)) { ?>
            <div class="row">
                <div class="col-sm-4">
                    <?= $form->field($model2, 'dogecoin')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
          <?php } else { ?>
            <div class="row" style="padding-top: 20px">
                <div class="col-sm-4">
                    <label>Carteira Dogecoin (DOGE)</label>
                    <div class="form-control-disabled"><?=$model2->dogecoin; ?></div>
                </div>
            </div>
          <?php } ?>
        </div>
    </div>

    <?php /* echo $form->field($model, 'reCaptcha')->widget(
        \himiklab\yii2\recaptcha\ReCaptcha::className(),
        ['siteKey' => '6Le2OhEUAAAAAEBHUOm_KLcNb3RRmeiGGoYMwpmH']
    )*/ ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Cadastrar' : 'Atualizar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
