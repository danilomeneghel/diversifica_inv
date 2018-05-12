<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use panel\models\Users;
use panel\assets\AppAsset;
use common\models\Login;

AppAsset::register($this);

$session = Yii::$app->session;

if(!empty(Yii::$app->user->identity->idLogin)) {
  $idLogin = Yii::$app->user->identity->idLogin;
} else {
  echo "<br>Erro! Usuário não encontrado.<br>";
  echo "Por favor, volte e efetue o login novamente.";
  exit;
}

if(!empty(Yii::$app->user->identity->level))
  $level = Yii::$app->user->identity->level;
else
  $level = 0;

$login = Login::find()->where(['idLogin' => $idLogin])->one();
$nameUser = $login->name;
$levelName = null;

switch($level) {
  case 2:
    $levelName = "Administrador";
    break;
  case 1:
    $levelName = "Gerente";
    break;
  default:
    $levelName = $login->email;
    break;
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shortcut icon" href="favicon.ico" type="image/ico" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="skin-blue sidebar-mini wysihtml5-supported">
<?php $this->beginBody() ?>
<div class="wrap">
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="<?=Yii::$app->homeUrl;?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>e</b>IT</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">
            <?=Html::img(Yii::$app->homeUrl.'images/logo2.png', ['width' => 150]);?>
        </span>
      </a>

      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-amount-btc">
          1 BTC = R$ <?= number_format($session->get('amountBTCBRL'), 2);?>
        </div>

        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-user icon-write"></i>
                <?=strtok($nameUser, ' ');?>
                <span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <p>
                    <?=$nameUser;?>
                    <small><?=$levelName;?></small>
                  </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="<?=Yii::$app->homeUrl;?>register/update" class="btn btn-default btn-flat">Perfil</a>
                  </div>
                  <div class="pull-right">
                    <a href="<?=Yii::$app->homeUrl;?>site/logout" class="btn btn-default btn-flat">Sair</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>

      </nav>
    </header>

    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="info">
            <div class="name-user">
              <?=$nameUser;?>
            </div>
            <?php if($level == 0) { ?>
              <div class="header-title">Saldo Disponível</div>
              <div class="header-balance"><?= number_format($session->get('bitcoinTeamProfit'), 8);?> BTC</div>
            <?php } else { ?>
              <div class="header-title"><?=$levelName; ?></div>
            <?php } ?>
          </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
          <li>
            <a href="<?=Yii::$app->homeUrl;?>">
              <i class="fa fa-home"></i> <span>Home</span>
            </a>
          </li>
          <?php if($level!=0) { ?>
          <li>
            <a href="<?=Yii::$app->homeUrl;?>companies">
              <i class="fa fa-building"></i> <span>Empresas</span>
            </a>
          </li>
          <li>
            <a href="<?=Yii::$app->homeUrl;?>registrations">
              <i class="fa fa-user"></i> <span>Cadastros</span>
            </a>
          </li>
          <li>
            <a href="<?=Yii::$app->homeUrl;?>wallets">
              <i class="fa fa-btc"></i> <span>Carteiras</span>
            </a>
          </li>
          <li>
            <a href="<?=Yii::$app->homeUrl;?>investments">
              <i class="fa fa-money"></i> <span>Investimentos</span>
            </a>
          </li>
          <li>
            <a href="<?=Yii::$app->homeUrl;?>incomes">
              <i class="fa fa-dollar"></i> <span>Rendimentos</span>
            </a>
          </li>
          <li>
            <a href="<?=Yii::$app->homeUrl;?>site/group">
              <i class="fa fa-users"></i> <span>Grupo</span>
            </a>
          </li>
          <li>
            <a href="<?=Yii::$app->homeUrl;?>commission">
              <i class="fa fa-puzzle-piece"></i> <span>Comissão</span>
            </a>
          </li>
          <li>
            <a href="<?=Yii::$app->homeUrl;?>withdrawals">
              <i class="fa fa-upload"></i> <span>Saques</span>
            </a>
          </li>
          <?php } ?>
          <?php if($level==0) { ?>
          <li>
            <a href="<?=Yii::$app->homeUrl;?>register/update">
              <i class="fa fa-user"></i> <span>Perfil</span>
            </a>
          </li>
          <li>
            <a href="<?=Yii::$app->homeUrl;?>site/group">
              <i class="fa fa-users"></i> <span>Grupo</span>
            </a>
          </li>
          <li>
            <a href="<?=Yii::$app->homeUrl;?>withdraw/create">
              <i class="fa fa-money"></i> <span>Sacar</span>
            </a>
          </li>
          <li>
            <a href="<?=Yii::$app->homeUrl;?>withdraw">
              <i class="fa fa-upload"></i> <span>Saques</span>
            </a>
          </li>
          <?php } ?>
          <li>
            <a href="<?=Yii::$app->homeUrl;?>site/support">
              <i class="fa fa-envelope-o"></i> <span>Suporte</span>
            </a>
          </li>
          <li>
            <a href="<?=Yii::$app->homeUrl;?>site/logout">
              <i class="fa fa-sign-out"></i> <span>Sair</span>
            </a>
          </li>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Main content -->
      <section class="content">
          <?= $content ?>
      </section>
    </div>
    <!-- /.content-wrapper -->

<footer class="main-footer">
  <div class="pull-right hidden-xs">
    Copyright &copy; <?=date("Y");?> - DiversificA +
  </div>
  &nbsp;
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
