<?php

namespace panel\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use panel\models\Withdrawals;
use panel\models\WithdrawalsSearch;
use panel\models\Investments;
use panel\models\Commission;
use panel\components\Controller;
use panel\components\AccessRule;
use panel\components\ApiPoloniex;
use panel\models\Wallets;
use panel\models\Auth;
use common\models\Login;
use Coinbase\Wallet\Client;
use Coinbase\Wallet\Configuration;
use Coinbase\Wallet\Resource\Address;
use Coinbase\Wallet\Enum\CurrencyCode;
use Coinbase\Wallet\Resource\Transaction;
use Coinbase\Wallet\Value\Money;

/**
 * WithdrawController implements the CRUD actions for Withdrawals model.
 */
class WithdrawController extends Controller
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
                            Auth::LEVEL_USER,
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
     * Lists all Withdrawals models.
     * @return mixed
     */
    public function actionIndex()
    {
        $idLogin = Yii::$app->user->identity->idLogin;
        $level = Yii::$app->user->identity->level;

        $findUser = null;
        if($level == 0)
          $findUser = 'idLogin = ' . $idLogin;

        $searchModel = new WithdrawalsSearch();
        $dataProvider = new ActiveDataProvider([
            'query' => WithdrawalsSearch::find()->where($findUser),
        ]);

        $withdrawalBTC = Withdrawals::find()->where(['idLogin' => $idLogin, 'paymentMethod' => 'Bitcoin', 'status' => 1])->sum('amount');
        $withdrawalLTC = Withdrawals::find()->where(['idLogin' => $idLogin, 'paymentMethod' => 'Litecoin', 'status' => 1])->sum('amount');
        $withdrawalDOGE = Withdrawals::find()->where(['idLogin' => $idLogin, 'paymentMethod' => 'Dogecoin', 'status' => 1])->sum('amount');

        $totalWithdrawals = ($withdrawalBTC * $this->amountBTC('brl')) + ($withdrawalLTC * $this->amountLTC('brl')) + ($withdrawalDOGE * $this->amountDOGE('brl'));

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'totalWithdrawals' => $totalWithdrawals
        ]);
    }

    /**
     * Creates a new Withdrawals model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $idLogin = Yii::$app->user->identity->idLogin;
        $post = Yii::$app->request->post();
        $session = Yii::$app->session;
        $totalBalance = (float) $session->get('bitcoinTeamProfit');
        $dateFinal = date('Y-m-d 23:59:59', strtotime('- 7 days'));
        $dateWeek = date('w');

        $model = new Withdrawals();

        //Busca as carteiras do usuário
        $wallet = Wallets::find()->where('idLogin = ' . $idLogin)->one();

        //Verifica qual o metodo de pagamento será liberado para saque
        $commission = Commission::find()->one();
        $paymentMethod = $commission->paymentMethod;

        if (!empty($post)) {
            if($dateWeek == Yii::$app->params['weekWithdraw']) {
                //Verifica se o investimento está ativo
                $investment = Investments::find()->where('idLogin = ' . $idLogin . ' AND active = 1')->one();

                if(!empty($investment)) {

                    $amountBTC = $investment->bitcoinTeamProfit;
                    //$amountBRL = $investment->realTeamProfit;

                    //Verifica se já foi efetuado algum saque nos ultimos 7 dias
                    $findWithdraw = Withdrawals::find()->where('idLogin = ' . $idLogin . ' AND dateCreated > "' . $dateFinal . '"')->one();

                    if(empty($findWithdraw)) {
                        //Verifica qual o metodo de pagamento
                        if($paymentMethod == "Bitcoin") {
                          $currency = "BTC";
                          $address = $wallet->bitcoin;
                          $amount = $amountBTC;
                        } else if($paymentMethod == "Litecoin") {
                          $currency = "LTC";
                          $address = $wallet->litecoin;
                          $amount = $amountBTC / $this->amountCurrency("LTC");
                        } else if($paymentMethod == "Dogecoin") {
                          $currency = "DOGE";
                          $address = $wallet->dogecoin;
                          $amount = $amountBTC / $this->amountCurrency("DOGE");
                        }

                        //Envia o valor do saque solicitado
                        $sendWithdraw = $this->sendWithdraw($idLogin, $currency, trim($address), $amount);

                        //Salva os dados no banco
                        $model->idLogin = $idLogin;
                        $model->amount = $amount;
                        $model->paymentMethod = $paymentMethod;
                        $model->address = $address;
                        $model->status = $sendWithdraw;
                        $model->save();

                        return $this->redirect(['index', 'idWithdrawal' => $model->idWithdrawal, 'idLogin' => $model->idLogin]);
                    } else {
                        Yii::$app->session->setFlash('error', 'Saque já realizado nos últimos 7 dias!');
                    }
                }
            } else {
                Yii::$app->session->setFlash('error', 'Somente é possível realizar saques no Sábado!');
            }
        }

        return $this->render('create', [
            'model' => $model,
            'bitcoinWallet' => $wallet->bitcoin,
            'litecoinWallet' => $wallet->litecoin,
            'dogecoinWallet' => $wallet->dogecoin,
            'paymentMethod' => $paymentMethod
        ]);
    }

    public function sendWithdraw($idLogin, $currency, $address, $amount) {
        $user = $this->findModelLogin($idLogin);
        $username = $user->username;

        $apiPoloniex = new ApiPoloniex;

        //Verifica o saldo inicial
        $balance = $apiPoloniex->get_balances();
        $balanceCurrency = (float)$balance[$currency];

        //Verifica se tem saldo disponivel
        if($balanceCurrency > $amount) {
          //Realiza o envio da criptomoeda
          $withdraw = $apiPoloniex->withdraw(strtoupper($currency), $amount, $address);

          if(!empty($withdraw["response"]))
            return 1;
          else
            return 0;
        } else {
            return 0;
        }
    }

    /**
     * Deletes an existing Withdrawals model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idWithdrawal
     * @param integer $idLogin
     * @param integer $idSector
     * @return mixed
     */
    public function actionDelete($idWithdrawal, $idLogin)
    {
        $idLogin = Yii::$app->user->identity->idLogin;

        $session = Yii::$app->session;
        $totalBalance = number_format($session->get('bitcoinTeamProfit'), 8);

        $model = $this->findModel($idWithdrawal, $idLogin);

        $delete = $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Withdrawals model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idWithdrawal
     * @param integer $idLogin
     * @param integer $idSector
     * @return Withdrawals the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idWithdrawal, $idLogin)
    {
        if (($model = Withdrawals::findOne(['idWithdrawal' => $idWithdrawal, 'idLogin' => $idLogin])) !== null) {
            return $model;
        } else {
            return null;
        }
    }

    protected function findModelLogin($id)
    {
        if (($model = Login::findOne($id)) !== null) {
            return $model;
        } else {
            return null;
        }
    }
}
