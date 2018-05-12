<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@site', dirname(dirname(__DIR__)) . '/site');
Yii::setAlias('@panel', dirname(dirname(__DIR__)) . '/panel');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');

$webroot = dirname(__DIR__) . '/www';
$web = rtrim(dirname($_SERVER["SCRIPT_NAME"]), '/');
Yii::setAlias('@home', $web . '/../site');
