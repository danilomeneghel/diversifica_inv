<?php

namespace panel\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use panel\models\Investments;
use panel\models\InvestmentsSearch;
use panel\components\Controller;
use panel\components\AccessRule;
use panel\models\Auth;

/**
 * InvestmentsController implements the CRUD actions for Investments model.
 */
class InvestmentsController extends Controller
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
     * Lists all Investments models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InvestmentsSearch();
        $dataProvider = new ActiveDataProvider([
            'query' => InvestmentsSearch::find(),
            'sort' => ['defaultOrder' => ['idInvestment' => SORT_DESC]],
            'pagination' => ['pageSize' => 50],
        ]);

        $totalInvested = Investments::find()->sum('investedBTC');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'totalInvested' => $totalInvested
        ]);
    }

    /**
     * Displays a single Investments model.
     * @param integer $id
     * @param integer $idLogin
     * @return mixed
     */
    public function actionView($idInvestment, $idLogin)
    {
        $model = $this->findModel($idInvestment, $idLogin);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Investments model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
     public function actionCreate()
     {
         $model = new Investments();

         if ($model->load(Yii::$app->request->post())) {
            $model->idLogin = $model->idLogin;

            $amountBTCBRL = (float) $this->amountBTC('brl');
            $investedReal = (float) $model->investedReal;

            $model->investedBTC = $investedReal/$amountBTCBRL;
            $model->investedReal = $investedReal;
            $model->save();

            //Atualiza os dados do rendimento do investidor
            $this->updateInvestment($model->idLogin);

            return $this->redirect(['view', 'idInvestment' => $model->idInvestment, 'idLogin' => $model->idLogin]);
         } else {
             return $this->render('create', [
                 'model' => $model,
             ]);
         }
     }

    /**
     * Updates an existing Investments model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idInvestment
     * @param integer $idLogin
     * @return mixed
     */
    public function actionUpdate($idInvestment, $idLogin)
    {
        $model = $this->findModel($idInvestment, $idLogin);

        if ($model->load(Yii::$app->request->post())) {
            $model->idLogin = $model->idLogin;

            $amountBTCBRL = (float) $this->amountBTC('brl');
            $investedReal = (float) $model->investedReal;

            $model->investedBTC = $investedReal/$amountBTCBRL;
            $model->investedReal = $investedReal;
            $model->dateUpdated = date('Y-m-d H:i:s');
            $model->save();

            return $this->redirect(['view', 'idInvestment' => $model->idInvestment, 'idLogin' => $model->idLogin]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Investments model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idInvestment
     * @param integer $idLogin
     * @return mixed
     */
    public function actionDelete($idInvestment, $idLogin)
    {
        $this->findModel($idInvestment, $idLogin)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Investments model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $idLogin
     * @return Investments the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idInvestment, $idLogin)
    {
        if (($model = Investments::findOne(['idInvestment' => $idInvestment, 'idLogin' => $idLogin])) !== null) {
            return $model;
        } else {
            return null;
        }
    }
}
