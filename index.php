<?php

// change the following paths if necessary
$yii=dirname(__FILE__).'/yii/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
//defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
//Yii::createWebApplication($config)->run();

$app = Yii::createWebApplication($config);

function loadSettings() {
    Yii::app()->name = Yii::app()->config->get('APP_NAME');
    if(Yii::app()->config->get('CHOOSE_THEME')==1)
            Yii::app()->theme = 'standart';
    if(Yii::app()->config->get('CHOOSE_THEME')==2)
    Yii::app()->theme = 'shadow_dancer';

    date_default_timezone_set('Europe/Moscow');
}

loadSettings();

$app->run();