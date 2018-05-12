<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
);

return [
    'id' => 'app-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'console\controllers',
    'components' => [
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        /*'bootstrap' => ['gii'],
        'modules' => [
            'gii' => 'yii\gii\Module',
        ],*/
    ],
    'params' => $params,
];
