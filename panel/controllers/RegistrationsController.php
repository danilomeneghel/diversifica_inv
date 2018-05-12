<?php

namespace panel\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use panel\models\Companies;
use panel\models\LoginsCompanies;
use panel\models\Investments;
use panel\models\Model;
use panel\models\Auth;
use panel\models\SignupForm;
use panel\components\Controller;
use panel\components\AccessRule;
use common\models\Login;
use common\models\LoginSearch;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class RegistrationsController extends Controller
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
     * Lists all Users models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LoginSearch();
        $dataProvider = new ActiveDataProvider([
            'query' => LoginSearch::find(),
            'sort' => ['defaultOrder' => ['idLogin' => SORT_DESC]],
            'pagination' => ['pageSize' => 50],
        ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Users model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model
        ]);
    }

    /**
    * Creates a new Sectors model.
    * If creation is successful, the browser will be redirected to the 'view' page.
    * @return mixed
    */
    public function actionCreate()
    {
      $model = new Login();
      $model2 = new Investments();
      $model3 = new LoginsCompanies();

      if ($model->load(Yii::$app->request->post())) {
          $user = Login::find()->where(['username' => $model->username])->one();

          if(empty($user->username)) {
              $model->level = 0;
              $model->active = 1;
              if (!empty($model->password)) {
                  $model->setPassword($model->password);
              }
              $model->save();

              if ($model2->load(Yii::$app->request->post())) {
                  $model2->idLogin = $model->idLogin;

                  $amountBTCBRL = (float) $this->amountBTC('brl');
                  $investedReal = (float) $model2->investedReal;

                  if(!empty($amountBTCBRL))
                     $model2->investedBTC = $investedReal/$amountBTCBRL;
                  else
                     $model2->investedBTC = 0;
                  $model2->investedReal = $investedReal;
                  $model2->active = 0;
                  $model2->save();
              }

              if ($model3->load(Yii::$app->request->post())) {
                  foreach($model3->idCompany as $company) {
                    $model4 = new LoginsCompanies();

                    $model4->idLogin = $model->idLogin;
                    $model4->idCompany = (int) $company;
                    $model4->save();
                  }
              }

              return $this->redirect(['view', 'id' => $model->idLogin]);
          } else {
              Yii::$app->session->setFlash('error', 'Usuário já existente. Por favor, tente outro nome de usuário.');
          }
      }
      return $this->render('create', [
          'model' => $model,
          'model2' => $model2,
          'model3' => $model3,
      ]);
    }

    /**
    * Finds the Users model based on its primary key value.
    * If the model is not found, a 404 HTTP exception will be thrown.
    * @param integer $id
    * @return Users the loaded model
    * @throws NotFoundHttpException if the model cannot be found
    */
    public function actionUpdate($id)
    {
       $model = $this->findModel($id);
       $model2 = $this->findInvestmentModel($id);
       $model3 = $this->findLoginsCompaniesModel($id);
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

               $amountBTCBRL = (float) $this->amountBTC('brl');
               $investedReal = (float) $model2->investedReal;

               if(!empty($amountBTCBRL))
                  $model2->investedBTC = $investedReal/$amountBTCBRL;
               else
                  $model2->investedBTC = 0;
               $model2->investedReal = $investedReal;
               $model2->save();
           }

           if (!empty(Yii::$app->request->post('LoginsCompanies'))) {
               //Remove primeiro as empresas salvas anteriormente
               LoginsCompanies::deleteAll(['idLogin' => $model->idLogin]);

               foreach(Yii::$app->request->post('LoginsCompanies')['idCompany'] as $company) {
                 $model4 = new LoginsCompanies();

                 $model4->idLogin = $model->idLogin;
                 $model4->idCompany = (int) $company;
                 $model4->save();
               }
           }

           return $this->redirect(['view', 'id' => $model->idLogin]);
       } else {
           $model->password = null;

           return $this->render('update', [
               'model' => $model,
               'model2' => $model2,
               'model3' => $model3,
           ]);
       }
    }

    /**
     * Deletes an existing Users model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
       if (($model = Login::find()->where(["idLogin" => $id])->one()) !== null) {
           return $model;
       } else {
           return null;
       }
    }

    protected function findInvestmentModel($id)
    {
       if (($model = Investments::find()->where(["idLogin" => $id])->one()) !== null) {
           return $model;
       } else {
           return null;
       }
    }

    protected function findLoginsCompaniesModel($id)
    {
       if (($model = LoginsCompanies::find()->where(["idLogin" => $id])->all()) !== null) {
           return $model;
       } else {
           return null;
       }
    }

}
