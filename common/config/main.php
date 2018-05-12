<?php
$config = [
	'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
          'class' => 'yii\web\UrlManager',
          'enablePrettyUrl' => true,
          'showScriptName' => false,
          'rules' => [
              '<controller:\w+>/<id:\d+>' => '<controller>/view',
              '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
              '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
          ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
                 'class' => 'yii\swiftmailer\Mailer',
                 'viewPath' => '@common/mail',
                 'useFileTransport' => false,
                 'transport' => [
                    'class' => 'Swift_SmtpTransport',
                    'host' => 'mailout.one.com',
                    'username' => 'suporte@diversificainvestimentos.com',
                    'password' => '',
                    'port' => '25',
                    //'encryption' => 'tls',
                 ],
        ],
        /*'reCaptcha' => [
            'name' => 'reCaptcha',
            'class' => 'himiklab\yii2\recaptcha\ReCaptcha',
            'siteKey' => '6Le2OhEUAAAAAEBHUOm_KLcNb3RRmeiGGoYMwpmH',
            'secret' => '6Le2OhEUAAAAAFVAo694LcEDOMAVfdJxOXHlsLnZ',
        ],*/
        'db' => require(__DIR__ . '/db.php'),
    ],
];

return $config;
