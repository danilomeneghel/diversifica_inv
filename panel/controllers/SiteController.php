<?php

namespace panel\controllers;

use Yii;
use yii\helpers\Url;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use panel\models\Companies;
use panel\models\Wallets;
use panel\models\LoginsCompanies;
use panel\models\Investments;
use panel\models\InvestmentsSearch;
use panel\models\Withdrawals;
use panel\models\Commission;
use panel\models\Incomes;
use common\models\PasswordResetRequestForm;
use common\models\ResetPasswordForm;
use panel\components\Controller;
use panel\components\AccessRule;
use panel\models\Auth;
use common\models\Login;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access'=>[
                'class'=>AccessControl::classname(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'only'=>['index'],
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
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
      $idLogin = Yii::$app->user->identity->idLogin;
      $level = Yii::$app->user->identity->level;

      $session = Yii::$app->session;
      $investedReal = $session->get('investedReal');
      $totalProfit = $session->get('totalProfit');
      $bitcoinTeamProfit = $session->get('bitcoinTeamProfit');
      $realTeamProfit = $session->get('realTeamProfit');

      //Total Retiradas Realizadas
      if($level == 0) {
          $withdrawalBTC = Withdrawals::find()->where(['idLogin' => $idLogin, 'paymentMethod' => 'Bitcoin', 'status' => 1])->sum('amount');
          $withdrawalLTC = Withdrawals::find()->where(['idLogin' => $idLogin, 'paymentMethod' => 'Litecoin', 'status' => 1])->sum('amount');
          $withdrawalDOGE = Withdrawals::find()->where(['idLogin' => $idLogin, 'paymentMethod' => 'Dogecoin', 'status' => 1])->sum('amount');
      } else {
          $withdrawalBTC = Withdrawals::find()->where(['paymentMethod' => 'Bitcoin', 'status' => 1])->sum('amount');
          $withdrawalLTC = Withdrawals::find()->where(['paymentMethod' => 'Litecoin', 'status' => 1])->sum('amount');
          $withdrawalDOGE = Withdrawals::find()->where(['paymentMethod' => 'Dogecoin', 'status' => 1])->sum('amount');
      }

      $totalWithdrawals = ($withdrawalBTC * $this->amountBTC('brl')) + ($withdrawalLTC * $this->amountLTC('brl')) + ($withdrawalDOGE * $this->amountDOGE('brl'));

      $findLogin = null;
      if($level == 0)
        $findLogin = 'idLogin = ' . $idLogin;

      //Companies
      $companies = array();
      if($level == 0)
        $resultInvest = LoginsCompanies::find()->where($findLogin)->joinWith('companies')->asArray()->all();
      else
        $resultInvest = Companies::find()->asArray()->all();

      if(!empty($resultInvest)) {
        if($level == 0) {
          foreach($resultInvest as $invest)
              $companies[$invest['idCompany']] = $invest['companies']['name'];
        } else {
          foreach($resultInvest as $invest)
              $companies[$invest['idCompany']] = $invest['name'];
        }
      }

      $totalCompanies = LoginsCompanies::find()->where($findLogin)->count('idCompany');

      //Investimento
      $investment = $this->investment($idLogin, $level, $companies);

      //Rendimento Semanal
      $incomeWeekly = $this->incomeWeekly($idLogin, $level, $companies);

      //Rendimento Visão Geral
      $incomeOverview = $this->incomeOverview($idLogin, $level, $companies);

      //Rendimento Percentual
      if(!empty($investment['totalInvested']))
        $percentageIncome = number_format((($incomeOverview['totalIncome'] / $investment['totalInvested']) * 100), 2);
      else
        $percentageIncome = 0;

      //Saldo disponível
      $session = Yii::$app->session;
      $balanceAvailable = $session->get('totalBalance');

      return $this->render('index', [
          'investedReal' => $investedReal,
          'totalProfit' => $totalProfit,
          'bitcoinTeamProfit' => $bitcoinTeamProfit,
          'realTeamProfit' => $realTeamProfit,
          'totalWithdrawals' => $totalWithdrawals,
          'companies' => $companies,
          'totalCompanies' => $totalCompanies,
          'investment' => $investment['investment'],
          'totalInvested' => $investment['totalInvested'],
          'percentageIncome' => $percentageIncome,
          'totalIncome' => $incomeOverview['totalIncome'],
          'daysWeek' => $incomeWeekly['week'],
          'incomeWeekly' => $incomeWeekly['incomeWeekly'],
          'monthYear' => $incomeOverview['months'],
          'monthName' => $this->monthName(date("m")),
          'incomeOverview' => $incomeOverview['incomeOverview'],
          'balanceAvailable' => $balanceAvailable,
      ]);
    }

    public function investment($idLogin, $level, $companies = array()) {
      $investment = array();
      $findLogin = null;
      if($level == 0)
        $findLogin = ' AND idLogin = ' . $idLogin;

      foreach($companies as $idCompany => $nameCompanies) {
          if($level == 0)
            $investmentCompany = Investments::find()->joinWith('loginsCompanies')->where('idCompany = ' . $idCompany . ' AND rs_logins_companies.idLogin = ' . $idLogin)->sum('investedReal');
          else
            $investmentCompany = Investments::find()->joinWith('loginsCompanies')->where('idCompany = ' . $idCompany)->sum('investedReal');

          if(!empty($investmentCompany))
            $investment[] = [$nameCompanies, (float)$investmentCompany];
      }

      $totalInvested = Investments::find()->where('active = 1'.$findLogin)->sum('investedReal');

      return ['investment' => $investment, 'totalInvested' => (float)$totalInvested];
    }

    public function incomeWeekly($idLogin, $level, $companies = array()) {
      $incomeWeekly = array();
      $week = array();
      $findLogin = null;
      if($level == 0)
        $findLogin = ' AND idLogin = ' . $idLogin;

      foreach($companies as $idCompany => $nameCompanies) {
          $profit = array();
          $contProfit = 0;
          $incomeCompany = 0;

          for($x=0; $x<=6; $x++) {
              if(date('w') == 0) {
                $date = date('Y-m-d', strtotime('+'.($x-6).' days'));
                $date2 = date('m/d', strtotime('+'.($x-6).' days'));
              } else {
                $date = date('Y-m-d', strtotime('+'.($x-date('w')).' days'));
                $date2 = date('m/d', strtotime('+'.($x-date('w')).' days'));
              }

              $week[] = $date2;
              $profitInvest = 0;

              if(strtotime($date) < strtotime(date("Y-m-d"))) {
                  $investmentCompany = LoginsCompanies::find()->select('idCompany')->where('idCompany = ' . $idCompany . $findLogin)->asArray()->one();
                  $incomeCompany = Incomes::find()->select('profit')->where('idCompany = ' . $idCompany . ' AND fixed != 1 AND date = "' . $date . '"')->asArray()->one();

                  if(!empty($investmentCompany)) {
                      if(!empty($incomeCompany)) {
                          $profitInvest = (float)round($incomeCompany['profit'], 2);

                        $contProfit++;
                      } else {
                          $incomeFixed = Incomes::find()->select('profit')->where('idCompany = ' . $idCompany . ' AND fixed = 1')->asArray()->one();

                          if(!empty($incomeFixed)) {
                                $profitInvest = (float)round($incomeFixed['profit'], 2);

                              $contProfit++;
                          } else {
                              $profitInvest = 0;
                          }
                      }
                  } else {
                      $profitInvest = 0;
                  }
            } else {
              $profitInvest = 0;
            }

              $profit[] = (float)$profitInvest;
          }

          if(!empty($contProfit)) {
              $incomeWeekly[] = [
                'name' => $nameCompanies,
                'data' => $profit
              ];
          }
      }

      return ['week' => $week, 'incomeWeekly' => $incomeWeekly];
    }

    public function incomeMonthly($idLogin, $level, $companies = array()) {
      $incomeDaily = array();
      $incomeMonthly = array();
      $findLogin = null;
      if($level == 0)
        $findLogin = ' AND idLogin = ' . $idLogin;

      foreach($companies as $idCompany => $nameCompanies) {
          $profitDaily = array();
          $profitMonthly = 0;
          $contProfit = 0;
          $month = date("m");
          $year = date("Y");
          $daysMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

          for($x=1; $x<=$daysMonth; $x++) {
              $date = date("Y")."-".date("m")."-".$x;

              if(strtotime($date) < strtotime(date("Y-m-d"))) {
                  $investmentCompany = LoginsCompanies::find()->select('idCompany')->where('idCompany = ' . $idCompany . $findLogin)->asArray()->one();
                  $incomeCompany = Incomes::find()->select('profit')->where('idCompany = ' . $idCompany . ' AND fixed != 1 AND DAY(date) = "' . $x . '" AND MONTH(date) = "' . date("m") . '" AND YEAR(date) = "' . date("Y") . '"')->asArray()->one();

                  if(!empty($investmentCompany)) {
                      if(!empty($incomeCompany)) {
                          if($level == 0) {
                            $profitDaily[] = [date("m")."/".$x, (float)round($incomeCompany['profit']/2, 2)];
                          } else {
                            $profitDaily[] = [date("m")."/".$x, (float)round($incomeCompany['profit'], 2)];
                          }
                          $profitMonthly = round($incomeCompany['profit'] + $profitMonthly, 2);

                          $contProfit++;
                      } else {
                          $incomeFixed = Incomes::find()->select('profit')->where('idCompany = ' . $idCompany . ' AND fixed = 1')->asArray()->one();

                          if(!empty($incomeFixed)) {
                              if($level == 0) {
                                $profitDaily[] = [date("m")."/".$x, (float)round($incomeFixed['profit']/2, 2)];
                              } else {
                                $profitDaily[] = [date("m")."/".$x, (float)round($incomeFixed['profit'], 2)];
                              }
                              $profitMonthly = round($incomeFixed['profit'] + $profitMonthly, 2);

                              $contProfit++;
                          } else {
                            $profitDaily[] = [date("m")."/".$x, 0];
                          }
                      }
                  } else {
                    $profitDaily[] = [date("m")."/".$x, 0];
                  }
              } else {
                $profitDaily[] = [date("m")."/".$x, 0];
              }
          }

          if(!empty($contProfit)) {
              $incomeDaily[] = [
                'name' => $nameCompanies,
                'id' => (int)$idCompany,
                'data' => $profitDaily
              ];

              $incomeMonthly[] = [
                'name' => $nameCompanies,
                'y' => (float)round($profitMonthly, 2),
                'drilldown' => (int)$idCompany
              ];
          }
      }

      return ['incomeDaily' => $incomeDaily, 'incomeMonthly' => $incomeMonthly];
    }

    public function incomeAnnual($idLogin, $level, $companies = array()) {
      $incomeMonthly = array();
      $incomeAnnual = array();
      $findLogin = null;
      if($level == 0)
        $findLogin = ' AND idLogin = ' . $idLogin;

      foreach($companies as $idCompany => $nameCompanies) {
          $profitMonthly = array();
          $profitAnnual = 0;
          $contProfit = 0;
          $daysInvestment = 1;

          for($x=1; $x<=12; $x++) {
              $date = date("Y")."-".$x."-01";

              if(strtotime($date) < strtotime(date("Y-m-d"))) {
                  $investmentCompany = LoginsCompanies::find()->select('idCompany')->where('idCompany = ' . $idCompany . $findLogin)->asArray()->one();
                  $incomeCompany = Incomes::find()->select('profit')->where('idCompany = ' . $idCompany . ' AND fixed != 1 AND MONTH(date) = "' . $x . '" AND YEAR(date) = "' . date("Y") . '"')->sum('profit');

                  if(!empty($investmentCompany)) {
                      $daysMonth = cal_days_in_month(CAL_GREGORIAN, $x, date("Y"));
                      $daysInvestment = ($x == date("m")) ? date("d") - 1 : $daysMonth;

                      if(!empty($incomeCompany)) {
                          if($level == 0) {
                            $profitMonthly[] = [date("Y")."/".$x, (float)round($incomeCompany/2, 2)];
                          } else {
                            $profitMonthly[] = [date("Y")."/".$x, (float)round($incomeCompany, 2)];
                          }
                          $profitAnnual = (float)round($incomeCompany + $profitAnnual, 2);

                          $contProfit++;
                      } else {
                          $incomeFixed = Incomes::find()->select('profit')->where('idCompany = ' . $idCompany . ' AND fixed = 1')->asArray()->one();

                          if(!empty($incomeFixed)) {
                              if($level == 0) {
                                $profitMonthly[] = [date("Y")."/".$x, (float)round(($incomeFixed['profit']*$daysInvestment)/2, 2)];
                              } else {
                                $profitMonthly[] = [date("Y")."/".$x, (float)round($incomeFixed['profit']*$daysInvestment, 2)];
                              }
                              $profitAnnual = (float)round(($incomeFixed['profit']*$daysInvestment) + $profitAnnual, 2);

                              $contProfit++;
                          } else {
                            $profitMonthly[] = [date("Y")."/".$x, 0];
                          }
                      }
                  } else {
                    $profitMonthly[] = [date("Y")."/".$x, 0];
                  }
              } else {
                $profitMonthly[] = [date("Y")."/".$x, 0];
              }
          }

          if(!empty($contProfit)) {
              $incomeMonthly[] = [
                'name' => $nameCompanies,
                'id' => (int)$idCompany,
                'data' => $profitMonthly
              ];

              $incomeAnnual[] = [
                'name' => $nameCompanies,
                'y' => (float)round($profitAnnual, 2),
                'drilldown' => (int)$idCompany
              ];
          }
      }

      return ['incomeMonthly' => $incomeMonthly, 'incomeAnnual' => $incomeAnnual];
    }

    public function incomeOverview($idLogin, $level, $companies = array()) {
      $incomeOverview = array();
      $months = array();
      $percentageSectorsTotal = array();
      $incomeCompanysTotal = array();
      $incomeInvest = 0;
      $percentageAverageTotal = 0;
      $findLogin = null;
      if($level == 0)
        $findLogin = ' AND idLogin = ' . $idLogin;

      foreach($companies as $idCompany => $nameCompanies) {
          $profitMonthly = array();
          $profitSectors = 0;
          $investmentCompany = 0;
          $incomeCompany = 0;
          $contProfit = 0;

          for($y=1; $y<=12; $y++) {
              $monthInvest = date("Y/m", strtotime('-'.(12-$y).' months'));
              $month = date("m", strtotime('-'.(12-$y).' months'));
              $year = date("Y", strtotime('-'.(12-$y).' months'));

              $profitInvest = 0;
              $daysMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

              for($x=1; $x<=$daysMonth; $x++) {
                  $date = $year."-".$month."-".$x;

                  if(strtotime($year."-".$month."-".$x) <= strtotime(date("Y-m-d"))) {
                      $profit = 0;
                      if($level == 0)
                        $investmentCompany = Investments::find()->select('idCompany')->joinWith('loginsCompanies')->where('idCompany = ' . $idCompany . ' AND rs_logins_companies.idLogin = ' . $idLogin)->sum('investedReal');
                      else
                        $investmentCompany = Investments::find()->select('idCompany')->joinWith('loginsCompanies')->where('idCompany = ' . $idCompany)->sum('investedReal');

                      $incomeCompany = Incomes::find()->select('profit')->where('idCompany = ' . $idCompany . ' AND fixed != 1 AND DAY(date) = "' . $x . '" AND MONTH(date) = "' . $month . '" AND YEAR(date) = "' . $year . '"')->asArray()->one();

                      if(!empty($investmentCompany)) {
                          if(!empty($incomeCompany)) {
                              $profit = (float)round($incomeCompany['profit'], 2);

                              $contProfit++;
                          } else {
                              $incomeFixed = Incomes::find()->select('profit')->where('idCompany = ' . $idCompany . ' AND fixed = 1 AND date <= "' . $year . '-'. $month . '-' . $x . '"')->asArray()->one();

                              if(!empty($incomeFixed)) {
                                  $profit = (float)round($incomeFixed['profit'], 2);

                                  $contProfit++;
                              } else {
                                $profit = 0;
                              }
                          }
                      } else {
                          $profit = 0;
                      }
                  } else {
                    $profit = 0;
                  }

                  $incomeInvest = (((float)$investmentCompany * $profit)/100) + $incomeInvest;

                  $profitInvest = $profit + $profitInvest;
              }

              $months[] = $monthInvest;
              $profitMonthly[] = (float)round($profitInvest, 2);
          }

          if(!empty($contProfit)) {
              $incomeOverview[] = [
                'name' => $nameCompanies,
                'data' => $profitMonthly
              ];
          }
      }

      return ['months' => $months, 'incomeOverview' => $incomeOverview, 'totalIncome' => $incomeInvest];
    }

    public function monthName($month) {
      switch ($month) {
        case "01":    $month = "Janeiro";     break;
        case "02":    $month = "Fevereiro";   break;
        case "03":    $month = "Março";       break;
        case "04":    $month = "Abril";       break;
        case "05":    $month = "Maio";        break;
        case "06":    $month = "Junho";       break;
        case "07":    $month = "Julho";       break;
        case "08":    $month = "Agosto";      break;
        case "09":    $month = "Setembro";    break;
        case "10":    $month = "Outubro";     break;
        case "11":    $month = "Novembro";    break;
        case "12":    $month = "Dezembro";    break;
      }

      return $month;
    }

    public function actionGroup()
    {
        $idLogin = Yii::$app->user->identity->idLogin;
        $level = Yii::$app->user->identity->level;

        $searchModel = new InvestmentsSearch();
        $dataProvider = new ActiveDataProvider([
            'query' => InvestmentsSearch::find(),
            'sort' => ['defaultOrder' => ['idInvestment' => SORT_DESC]],
            'pagination' => ['pageSize' => 50],
        ]);

        //Total de investidores
        $totalInvestors = Investments::find()->where('active = 1')->count();
        $totalInvested = Investments::find()->where('active = 1')->sum('investedReal');

        return $this->render('group', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'totalInvestors' => $totalInvestors,
            'totalInvested' => $totalInvested,
        ]);
    }

    /**
     * Register.
     *
     * @return mixed
     */
    public function actionRegister()
    {
        $model = new Login();
        $model2 = new Wallets();
        $model3 = new Investments();
        $model4 = new LoginsCompanies();

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
                        $model3->active = 0;
                        $model3->save();
                    }

                    if ($model4->load(Yii::$app->request->post())) {
                        foreach($model4->idCompany as $company) {
                          $model4->idLogin = $model->idLogin;
                          $model4->idCompany = (int) $company;
                          $model4->save();
                        }
                    }
                }

                Yii::$app->session->setFlash('success', 'Cadastro realizado com sucesso!');
            } else {
                Yii::$app->session->setFlash('error', 'Usuário já existente. Por favor, tente outro nome de usuário.');
            }

            return $this->goHome();
        } else {
            return $this->renderPartial('register', [
                'model' => $model,
                'model2' => $model2,
                'model3' => $model3,
                'model4' => $model4,
            ]);
        }
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Verifique seu e-mail para obter mais instruções.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Desculpe, não podemos redefinir a senha para o endereço de e-mail fornecido.');
            }
        }

        return $this->renderPartial('requestPasswordReset', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'Nova senha salva com sucesso!');

            return $this->goHome();
        }

        return $this->renderPartial('resetPassword', [
            'model' => $model,
        ]);
    }


}
