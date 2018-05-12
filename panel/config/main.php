<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php')
);

return [
    'id' => 'app-panel',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'panel\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-panel',
            'cookieValidationKey' => 'aW5rM948tMP9U8ucuiby7ifKJ1c-sQHH',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'panel\models\Auth',
            'enableAutoLogin' => true,
            'loginUrl'=>['/site/login'],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'params' => $params,
];
