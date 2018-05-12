<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use panel\models\Companies;
use panel\models\LoginsCompanies;
use miloschuman\highcharts\Highcharts;

$this->title = 'Grupo DiversificA+';
?>

<div class="container">
  <div class="row">
        <div class="col-lg-3 col-sm-6">
            <div class="info-box">
              <div class="info-box-icon bg-write">
                <i class="fa fa-dollar icon-green"></i>
              </div>
              <div class="info-box-content">
                <h3 class="m-0 text-dark counter">R$ <?= number_format($investedReal, 2); ?></h3>
                <div class="text-muted m-t-5">Total de Investimento</div>
              </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="info-box">
            <div class="info-box-icon bg-write">
              <i class="fa fa-users icon-green"></i>
            </div>
            <div class="info-box-content">
                <h3 class="m-0 text-dark counter">R$ <?= number_format($totalProfit, 2); ?></h3>
                <div class="text-muted m-t-5">Bônus Total Atual</div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="info-box">
            <div class="info-box-icon bg-write">
              <i class="fa fa-user icon-green"></i>
            </div>
            <div class="info-box-content">
                <h3 class="m-0 text-dark counter">R$ <?= number_format($realTeamProfit, 2); ?></h3>
                <div class="text-muted m-t-5">Bônus por Pessoa</div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="info-box">
            <div class="info-box-icon bg-write">
              <i class="fa fa-money icon-green"></i>
            </div>
            <div class="info-box-content">
                <h3 class="m-0 text-dark counter font-600">R$ <?= number_format($totalWithdrawals, 2); ?></h3>
                <div class="text-muted m-t-5">Total de Saques</div>
            </div>
          </div>
        </div>
    </div>

    <div class="alert alert-success2">
      <?php if(date('w') == Yii::$app->params['weekWithdraw']) { ?>
        <div><b><a href="<?=Yii::$app->homeUrl.'withdraw';?>">Hoje é dia de pagamento!</a></b></div>
      <?php } else { ?>
        <div><b>Próximo Pagamento:</b> <?= date('d/m/Y', strtotime('next Saturday')); ?></div>
      <?php } ?>
      <div>
        <b>Empresas Indicadas:</b>
        <?php
            $companies = Companies::find()->where(['active' => 1])->all();
            foreach($companies as $company) {
                echo '<a href="'.$company->site.'" target="_blank">'.$company->name.'</a>, ';
            }
        ?>
      </div>
    </div>

    <div class="row margem-panel-chart">
        <div class="col-md-5">
          <div class="box box-success panel panel-chart">
              <div class="box-header with-border">
                <i class="fa fa-pie-chart"></i>
                <h4 class="box-title">Investimentos</h4>
                <div class="box-tools pull-right">
                  <button data-widget="collapse" class="btn btn-box-tool" type="button"><i class="fa fa-minus"></i></button>
                  <button data-widget="remove" class="btn btn-box-tool" type="button"><i class="fa fa-times"></i></button>
                </div>
              </div>
                <div class="box-body no-padding panel-body" style="display: block">
                    <div class="canvas-wrapper panel-chart-view">
                        <?php
                          echo Highcharts::widget([
                             'options' => [
                                 'title' => ['text' => ''],
                                 'plotOptions' => [
                                     'pie' => [
                                         'cursor' => 'pointer',
                                         'allowPointSelect' => 'true',
                                         'showInLegend' => 'true',
                                         'dataLabels' => ['enabled', 'false'],
                                         'innerSize' => '40%',
                                         'dataLabels' => [
                                             'enabled' => true,
                                             'format' => 'R${point.y:.1f}',
                                             'color' => '#777'
                                         ]
                                     ],
                                 ],
                                 'series' => [
                                     [
                                         'type' => 'pie',
                                         'name' => 'R$',
                                         'data' => $investment
                                     ]
                                 ],
                             ],
                          ]);
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="box box-success panel panel-chart">
                <div class="box-header with-border">
                  <i class="fa fa-bar-chart"></i>
                  <h4 class="box-title">Rendimento Semanal</h4>
                  <div class="box-tools pull-right">
                    <button data-widget="collapse" class="btn btn-box-tool" type="button"><i class="fa fa-minus"></i></button>
                    <button data-widget="remove" class="btn btn-box-tool" type="button"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body no-padding panel-body" style="display: block">
                    <div class="canvas-wrapper panel-chart-view">
                        <?php
                              echo Highcharts::widget([
                                 'options' => [
                                   'chart' => [
                                        'type' => 'column'
                                    ],
                                    'title' => [
                                        'text' => ''
                                    ],
                                    'xAxis' => [
                                        'categories' => $daysWeek,
                                        'crosshair' => 'true'
                                    ],
                                    'yAxis' => [
                                        'min' => 0,
                                        'title' => [
                                            'text' => ''
                                        ]
                                    ],
                                    'plotOptions' => [
                                        'series' => [
                                            'borderWidth' => 0,
                                            'dataLabels' => [
                                                'enabled' => true,
                                                'format' => '{point.y:.1f}%',
                                                'color' => '#777'
                                            ]
                                        ]
                                    ],
                                    'series' => $incomeWeekly
                                 ],
                              ]);
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div style="clear:both; height:20px"></div>

        <div class="col-md-12">
          <div class="box box-success panel panel-chart">
                <div class="box-header with-border">
                  <i class="fa fa-line-chart"></i>
                  <h4 class="box-title">Visão Geral</h4>
                  <div class="box-tools pull-right">
                    <button data-widget="collapse" class="btn btn-box-tool" type="button"><i class="fa fa-minus"></i></button>
                    <button data-widget="remove" class="btn btn-box-tool" type="button"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body no-padding panel-body" style="display: block">
                    <div class="canvas-wrapper panel-chart-view">
                        <?php
                          if(empty($monthYear)) {
                              echo "<div style='height:400px; padding:50px 10px; text-align:center'>No graphic in moment.<br>Please, wait more days.</div>";
                          } else {
                              echo Highcharts::widget([
                                 'options' => [
                                   'chart' => [
                                        'type' => 'spline'
                                    ],
                                    'title' => [
                                        'text' => ''
                                    ],
                                    'xAxis' => [
                                        'categories' => $monthYear,
                                    ],
                                    'yAxis' => [
                                        'title' => [
                                            'text' => ''
                                        ]
                                    ],
                                    'plotOptions' => [
                                        'line' => [
                                            'dataLabels' => [
                                                'enabled' => 'true'
                                            ],
                                            'enableMouseTracking' => 'false'
                                        ],
                                        'series' => [
                                            'dataLabels' => [
                                                'enabled' => true,
                                                'format' => '{point.y:.1f}%',
                                                'color' => '#777'
                                            ]
                                        ]
                                    ],
                                    'series' => $incomeOverview
                                 ],
                              ]);
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
      </div>
</div>
