<?php

// change the following paths if necessary
$yii=dirname(__FILE__).'/../yii-1.1.13/framework/yii.php';

$config = dirname(__FILE__).'/protected/config/back.php';
 
// Remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);
 
require_once($yii);
Yii::createWebApplication($config)->runEnd('back');