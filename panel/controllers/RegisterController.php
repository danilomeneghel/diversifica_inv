<?php

namespace panel\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use panel\models\Model;
use panel\components\Controller;
use panel\components\AccessRule;
use panel\models\Auth;
use panel\models\Companies;
use panel\models\Wallets;
use panel\models\LoginsCompanies;
use panel\models\Investments;
use common\models\Login;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class RegisterController extends Controller
{
    public function behaviors()
    {
        return [
            'access'=>[
                'class'=>AccessControl::classname(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'only'=>[],
                'rules' => [
                    [
                        'actions' => [],
                        'allow' => true,
                        'roles' => [
                            Auth::LEVEL_ADMIN,
                            Auth::LEVEL_MANAGER,
                            Auth::LEVEL_USER
                        ],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Displays a single Users model.
     * @param integer $id
     * @return mixed
     */
    public function actionView()
    {
        $id = Yii::$app->user->identity->idLogin;
        $model = $this->findModelLogin($id);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Users model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate()
    {
        $id = Yii::$app->user->identity->idLogin;
        $model = $this->findModelLogin($id);
        $model2 = $this->findModelWallets($id);
        $model3 = $this->findModelInvestment($id);
        $model4 = $this->findModelLoginsCompanies($id);
        $password = $model->password;

        if ($model->load(Yii::$app->request->post())) {
            if (!empty($model->password)) {
               $model->setPassword($model->password);
            } else {
               $model->password = $password;
            }
            $model->save();


            if ($model2->load(Yii::$app->request->post())) {
                $model2->idLogin = $model->idLogin;
                $model2->save();

              if ($model3->load(Yii::$app->request->post())) {
                  $model3->idLogin = $model->idLogin;

                  $amountBTCBRL = (float) $this->amountBTC('brl');
                  $investedReal = (float) $model3->investedReal;

                  if(!empty($amountBTCBRL))
                     $model3->investedBTC = $investedReal/$amountBTCBRL;
                  else
                     $model3->investedBTC = 0;
                  $model3->investedReal = $investedReal;
                  $model3->save();
              }
            }

            Yii::$app->session->setFlash('success', 'Perfil Atualizado!');
            return $this->redirect(['update', 'idLogin' => $model->idLogin]);
        } else {
            $model->password = null;

            return $this->render('update', [
                'model' => $model,
                'model2' => $model2,
                'model3' => $model3,
                'model4' => $model4,
            ]);
        }
    }

    protected function findModelLogin($id)
    {
        if (($model = Login::find()->where(["idLogin" => $id])->one()) !== null) {
            return $model;
        } else {
            return null;
        }
    }

    protected function findModelWallets($id)
    {
       if (($model = Wallets::find()->where(["idLogin" => $id])->one()) !== null) {
           return $model;
       } else {
           return null;
       }
    }

    protected function findModelInvestment($id)
    {
       if (($model = Investments::find()->where(["idLogin" => $id])->one()) !== null) {
           return $model;
       } else {
           return null;
       }
    }

    protected function findModelLoginsCompanies($id)
    {
       if (($model = LoginsCompanies::find()->where(["idLogin" => $id])->all()) !== null) {
           return $model;
       } else {
           return null;
       }
    }

}
