<?php
set_time_limit(1000000000);
// change the following paths if necessary
$yii=dirname(__FILE__).'/yii/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
//defined('YII_DEBUG') or define('YII_DEBUG',true);
//define('YII_DEBUG',false)
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

define('WP_USE_THEMES', true);
$wp_did_header = true;
require_once('wordpress/wp-load.php');
 
require_once(dirname(__FILE__) . '/protected/components/ExceptionHandler.php');
$router = new ExceptionHandler();

require_once($yii);


Yii::createWebApplication($config)->run();
