<?php

namespace panel\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use panel\components\Controller;
use panel\components\AccessRule;
use panel\models\Auth;
use common\models\LoginSearch;
use common\models\Login;

/**
 * LoginsController implements the CRUD actions for Logins model.
 */
class LoginsController extends Controller
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
     * Lists all Logins models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LoginSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Logins model.
     * @param integer $idLogin
     * @return mixed
     */
    public function actionView($idLogin)
    {
        $model = $this->findModel($idLogin);

        return $this->render('view', [
            'model' => $model,
            'level' => $this->getLevel($model->level),
        ]);
    }

    public function getLevel($level) {
        if($level == 0)
            return "User";
        else if($level == 1)
            return "Manager";
        else
            return "Administrator";
    }

    /**
     * Creates a new Logins model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Logins();

        if ($model->load(Yii::$app->request->post())) {
            $model->password = sha1($model->password);
            $model->save();
            return $this->redirect(['view', 'idLogin' => $model->idLogin]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Logins model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idLogin
     * @return mixed
     */
    public function actionUpdate($idLogin)
    {
        $model = $this->findModel($idLogin);

        if ($model->load(Yii::$app->request->post())) {
            if (!empty($model->password))
                $model->password = sha1($model->password);
            $model->save();

            return $this->redirect(['view', 'idLogin' => $model->idLogin]);
        } else {
            $model->password = null;

            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Logins model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idLogin
     * @return mixed
     */
    public function actionDelete($idLogin)
    {
        $this->findModel($idLogin)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Logins model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idLogin
     * @return Logins the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idLogin)
    {
        if (($model = Logins::findOne(['idLogin' => $idLogin])) !== null) {
            return $model;
        } else {
            return null;
        }
    }
}
