<?php

ini_set('date.timezone','Asia/Tehran');

error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);

// change the following paths if necessary
$yii=dirname(__FILE__).'/yii/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

//remove the following line when in production mode
defined('YII_DEBUG') or define('YII_DEBUG', true);

require_once($yii);
Yii::createWebApplication($config)->run();
