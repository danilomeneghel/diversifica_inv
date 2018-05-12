<?php

namespace panel\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use panel\models\Commission;
use panel\models\CommissionSearch;
use panel\components\Controller;
use panel\components\AccessRule;
use panel\models\Auth;

/**
 * CommissionController implements the CRUD actions for Commission model.
 */
class CommissionController extends Controller
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
     * Lists all Commission models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CommissionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Commission model.
     * @param integer $idCommission
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
     * Updates an existing Commission model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idCommission
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

            //Atualiza os dados das comissões dos investidores
            $this->updateInvestment($dateUpdated);

            return $this->redirect(['view', 'id' => $id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Finds the Commission model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idCommission
     * @return Commission the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Commission::findOne(['idCommission' => $id])) !== null) {
            return $model;
        } else {
            return null;
        }
    }
}
