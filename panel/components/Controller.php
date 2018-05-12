<?php

namespace panel\components;

use Yii;
use yii\helpers\Url;
use yii\web\Controller as Control;
use panel\models\SupportForm;
use panel\models\Investments;
use panel\models\Withdrawals;
use panel\models\Commission;
use panel\models\UsersExtract;
use common\models\LoginForm;
use common\models\LoginAccess;
use common\models\PasswordResetRequestForm;
use common\models\ResetPasswordForm;

class Controller extends Control {

  public function init() {
      parent::init();

      date_default_timezone_set('America/Sao_Paulo');

      if(!empty(Yii::$app->user->identity->idLogin)) {
          $idLogin = Yii::$app->user->identity->idLogin;
          $level = Yii::$app->user->identity->level;

          //Saldo dísponivel
          $balanceCommission = $this->balanceCommission($idLogin, $level);

          //Grava na sessão o saldo
          $session = Yii::$app->session;
          //$session->set('amountBTCUSD', $amountBTCUSD);
          $session->set('amountBTCBRL', $this->amountBTC('brl'));
          $session->set('investedReal', $balanceCommission['investedReal']);
          $session->set('totalProfit', $balanceCommission['totalProfit']);
          $session->set('bitcoinTeamProfit', $balanceCommission['bitcoinTeamProfit']);
          $session->set('realTeamProfit', $balanceCommission['realTeamProfit']);

          //Salva no banco o total dos investimentos e rendimentos
          //$this->userExtract($idLogin, $investment['totalInvested'], $percentageCommission, $totalCommission, $investmentTime, $totalBalance, $withdrawals, $dateCurrent);
      }
  }

  public function balanceCommission($idLogin, $level) {
        $date = date('Y-m-d');
        $investedReal = 0;
        $totalProfit = 0;
        $bitcoinTeamProfit = 0;
        $realTeamProfit = 0;

        //Verifica se os dados estão atualizados
        $investmentsUpdated = Investments::find()->where('DATE(dateUpdated) < "' . $date . '" AND active = 1')->orderBy('idInvestment')->one();

        //Caso os dados não estejam atualizados, efetua a atualização
        if(!empty($investmentsUpdated)) {
            $this->updateInvestment($investmentsUpdated->dateUpdated);
        }

        if($level == 0) {
            $investments = Investments::find()->where('idLogin = ' . $idLogin . ' AND active = 1')->one();

            if(!empty($investments)) {
                $investedReal = Investments::find()->where('idLogin = '.$idLogin)->sum('investedReal');
                $totalProfit = $investments->totalProfit * $this->amountBTC('brl');
                $bitcoinTeamProfit = $investments->bitcoinTeamProfit;
                $realTeamProfit = $investments->realTeamProfit;
            }
        } else {
            $investedReal = Investments::find()->where('active = 1')->sum('investedReal');
            $investment = Investments::find()->select('totalProfit, bitcoinTeamProfit, realTeamProfit')->where('active = 1')->one();
            if(!empty($investment)) {
              $totalProfit = $investment->totalProfit * $this->amountBTC('brl');
              $bitcoinTeamProfit = $investment->bitcoinTeamProfit;
              $realTeamProfit = $investment->realTeamProfit;
            }
        }

        return ['investedReal' => $investedReal, 'totalProfit' => $totalProfit, 'bitcoinTeamProfit' => $bitcoinTeamProfit, 'realTeamProfit' => $realTeamProfit];
  }

  public function updateInvestment($dateUpdated = 0) {
      $bitcoinTeamProfit = 0;
      $realTeamProfit = 0;
      $date = date('Y-m-d');
      $dateWeek = date('w');

      //Pega a quantidade de investidores
      $qtdInvest = Investments::find()->where('active = 1')->count();
      $qtdInvested = (int)$qtdInvest;

      //Total de comissões do Grupo
      $commission = Commission::find()->one();
      $groupProfit = (float) $commission->groupProfit;

      //Calcula os valores para cada investimento
      $totalProfit = ($groupProfit * Yii::$app->params['commission'])/100; //Multiplica pelo percentual de comissão distribuido

      //Verifica se a comissão foi atualizada na data atual
      $commissionUpdated = Commission::find()->where('DATE(dateUpdated) = "' . $date . '"')->one();

      //Verifica se atualizou a comissão ou a data semanal atual é igual do saque para colocar o valor no saldo
      if(!empty($commissionUpdated) or ($dateWeek == Yii::$app->params['weekWithdraw'])) {
        if(!empty($qtdInvested)) {
          $bitcoinTeamProfit = ($totalProfit/$qtdInvested);
          $realTeamProfit = $bitcoinTeamProfit * $this->amountBTC('brl');
        }
      }

      Investments::updateAll(['totalProfit' => $totalProfit, 'bitcoinTeamProfit' => $bitcoinTeamProfit, 'realTeamProfit' => $realTeamProfit, 'dateUpdated' => $dateUpdated], 'active = 1');
  }

  public function amountCurrency($currency) {
      // URL site
      $url = "https://poloniex.com/public?command=returnTicker";

      //  Initiate curl
      $ch = curl_init();
      // Disable SSL verification
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      // Will return the response, if false it print the response
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      // Set the url
      curl_setopt($ch, CURLOPT_URL,$url);
      // Execute
      $result=curl_exec($ch);
      // Closing
      curl_close($ch);

      // Data cURL
      $data = json_decode($result, true);

      $pair = $data['BTC_'.$currency];

      $amount = $pair['last'];

      return $amount;
  }

  public function amountBTC($currency) {
      // URL site
      $url = "https://braziliex.com/api/v1/public/ticker/btc_".$currency;

      //  Initiate curl
      $ch = curl_init();
      // Disable SSL verification
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      // Will return the response, if false it print the response
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      // Set the url
      curl_setopt($ch, CURLOPT_URL,$url);
      // Execute
      $result=curl_exec($ch);
      // Closing
      curl_close($ch);

      // Data cURL
      $data = json_decode($result, true);

      $amount = $data['last'];

      return (float) $amount;
  }

  public function amountLTC($currency) {
      // URL site
      $url = "https://braziliex.com/api/v1/public/ticker/ltc_".$currency;

      //  Initiate curl
      $ch = curl_init();
      // Disable SSL verification
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      // Will return the response, if false it print the response
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      // Set the url
      curl_setopt($ch, CURLOPT_URL,$url);
      // Execute
      $result=curl_exec($ch);
      // Closing
      curl_close($ch);

      // Data cURL
      $data = json_decode($result, true);

      $amount = $data['last'];

      return (float) $amount;
  }

  public function amountDOGE($currency) {
      // URL site
      $url = "https://api.cryptonator.com/api/ticker/doge-".$currency;

      //  Initiate curl
      $ch = curl_init();
      // Disable SSL verification
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      // Will return the response, if false it print the response
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      // Set the url
      curl_setopt($ch, CURLOPT_URL,$url);
      // Execute
      $result=curl_exec($ch);
      // Closing
      curl_close($ch);

      // Data cURL
      $data = json_decode($result, true);

      $amount = $data['ticker']['price'];

      return (float) $amount;
  }

  public function actionLogin()
  {
      if (!\Yii::$app->user->isGuest) {
          return $this->goHome();
      }

      $error = false;
      $model = new LoginForm();
      $modelLoginAccess = new LoginAccess();

      if ($model->load(Yii::$app->request->post())) {
          if ($model->login()) {
              $modelLoginAccess->idLogin = Yii::$app->user->identity->idLogin;
              $modelLoginAccess->ip = Yii::$app->request->userIP;
              $modelLoginAccess->save();
              return $this->goBack();
          } else {
              $error = true;
          }
      }

      return $this->renderPartial('login', [
          'model' => $model,
          'error' => $error,
      ]);
  }

  public function actionLogout()
  {
      Yii::$app->user->logout();

      return $this->goHome();
  }

  public function actionSupport()
  {
      $model = new SupportForm();

      if ($model->load(Yii::$app->request->post()) && $model->sendEmail(Yii::$app->params['panelEmail'])) {
          Yii::$app->session->setFlash('supportForm');

          return $this->refresh();
      }
      return $this->render('support', [
          'model' => $model,
      ]);
  }

  protected function findInvestments($idInvestment)
  {
      if (($model = Investments::findOne(['idInvestment' => $idInvestment])) !== null) {
          return $model;
      } else {
          return null;
      }
  }

  protected function findModelUsersExtract($idLogin)
  {
      if (($model = UsersExtract::find()->where(["idLogin" => $idLogin])->one()) !== null) {
          return $model;
      } else {
          return new UsersExtract();
      }
  }

  protected function findModelLoginAccess($idLogin)
  {
      if (($model = LoginAccess::find()->where(["idLogin" => $idLogin])->orderBy(['date' => SORT_DESC])->limit(5)->all()) !== null) {
          return $model;
      } else {
          return new LoginAccess();
      }
  }

}
