<?php

namespace panel\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use panel\models\Income;
use panel\models\IncomeSearch;
use panel\components\Controller;
use panel\components\AccessRule;
use panel\models\Auth;

/**
 * IncomeController implements the CRUD actions for Income model.
 */
class IncomeController extends Controller
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
     * Lists all Income models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new IncomeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Income model.
     * @param integer $idIncome
     * @return mixed
     */
    public function actionView($id)
    {
        $income = new Income();
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model
        ]);
    }

    /**
     * Updates an existing Income model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idIncome
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $dateUpdated = date('Y-m-d H:i:s');
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->groupProfit = (float) $model->groupProfit;
            $model->dateUpdated = $dateUpdated;
            $model->save();

            //Atualiza os dados dos rendimentos dos investidores
            $this->updateInvestment($dateUpdated);

            return $this->redirect(['view', 'id' => $id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Finds the Income model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idIncome
     * @return Income the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Income::findOne(['idIncome' => $id])) !== null) {
            return $model;
        } else {
            return null;
        }
    }
}
