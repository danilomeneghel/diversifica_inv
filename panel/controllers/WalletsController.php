<?php

namespace panel\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use panel\models\Wallets;
use panel\models\WalletsSearch;
use panel\components\Controller;
use panel\components\AccessRule;
use panel\models\Auth;

/**
 * WalletsController implements the CRUD actions for wallets model.
 */
class WalletsController extends Controller
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
     * Lists all wallets models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WalletsSearch();
        $dataProvider = new ActiveDataProvider([
            'query' => WalletsSearch::find(),
            'sort' => ['defaultOrder' => ['idWallet' => SORT_DESC]],
            'pagination' => ['pageSize' => 50],
        ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Displays a single Wallets model.
     * @param integer $id
     * @param integer $idLogin
     * @return mixed
     */
    public function actionView($idWallet, $idLogin)
    {
        $model = $this->findModel($idWallet, $idLogin);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Wallets model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
     public function actionCreate()
     {
         $model = new Wallets();

         if ($model->load(Yii::$app->request->post())) {
            $model->save();

            return $this->redirect(['view', 'idWallet' => $model->idWallet, 'idLogin' => $model->idLogin]);
         } else {
             return $this->render('create', [
                 'model' => $model,
             ]);
         }
     }

    /**
     * Updates an existing Wallets model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idWallet
     * @param integer $idLogin
     * @return mixed
     */
    public function actionUpdate($idWallet, $idLogin)
    {
        $model = $this->findModel($idWallet, $idLogin);

        if ($model->load(Yii::$app->request->post())) {
            $model->save();

            return $this->redirect(['view', 'idWallet' => $model->idWallet, 'idLogin' => $model->idLogin]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Wallets model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idWallet
     * @param integer $idLogin
     * @return mixed
     */
    public function actionDelete($idWallet, $idLogin)
    {
        $this->findModel($idWallet, $idLogin)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Wallets model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $idLogin
     * @return Wallets the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idWallet, $idLogin)
    {
        if (($model = Wallets::findOne(['idWallet' => $idWallet, 'idLogin' => $idLogin])) !== null) {
            return $model;
        } else {
            return null;
        }
    }
}
