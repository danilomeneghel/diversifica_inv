<?php

namespace panel\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use panel\models\Incomes;
use panel\models\IncomesSearch;
use panel\components\Controller;
use panel\components\AccessRule;
use panel\models\Auth;

/**
 * IncomesController implements the CRUD actions for Incomes model.
 */
class IncomesController extends Controller
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
     * Lists all Incomes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new IncomesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Incomes model.
     * @param integer $idIncome
     * @param integer $idCompany
     * @return mixed
     */
    public function actionView($idIncome, $idCompany)
    {
        $incomes = new Incomes();
        $model = $this->findModel($idIncome, $idCompany);

        return $this->render('view', [
            'model' => $model,
            'company' => $incomes->getCompanies($model->idCompany),
        ]);
    }

    /**
     * Creates a new Incomes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Incomes();
        $post = Yii::$app->request->post();
        $find = "";

        if(!empty($post)) {
            $company = $post['Incomes']['idCompany'];
            $date = $post['Incomes']['date'];

            $find = Incomes::find()->where('idCompany = ' . $company . ' AND date = "' . $date . '"')->one();
        }

        if (empty($find)) {
            if ($model->load($post)) {
                $model->save();
                return $this->redirect(['view', 'idIncome' => $model->idIncome, 'idCompany' => $model->idCompany]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'error' => 'Rendimento já salvo para essa data!'
            ]);
        }
    }

    /**
     * Updates an existing Incomes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idIncome
     * @param integer $idCompany
     * @return mixed
     */
    public function actionUpdate($idIncome, $idCompany)
    {
        $model = $this->findModel($idIncome, $idCompany);

        if ($model->load(Yii::$app->request->post())) {
            $model->save();

            return $this->redirect(['view', 'idIncome' => $model->idIncome, 'idCompany' => $model->idCompany]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Incomes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idIncome
     * @param integer $idCompany
     * @return mixed
     */
    public function actionDelete($idIncome, $idCompany)
    {
        $this->findModel($idIncome, $idCompany)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Incomes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idIncome
     * @param integer $idCompany
     * @return Incomes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idIncome, $idCompany)
    {
        if (($model = Incomes::findOne(['idIncome' => $idIncome, 'idCompany' => $idCompany])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
