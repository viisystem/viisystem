<?php

$common = require(__DIR__ . '/common.php');

$config = [
	'defaultRoute' => 'dashboard/backend/default',	
	'components' => [
		'errorHandler' => [
			'errorAction' => 'dashboard/backend/error',
		],
		'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => true,
            'rules' => [
                //'gii/<controller:\w+>' => 'gii/<controller>/index',
                //'gii/<controller:\w+>/<action:\w+>' => 'gii/<controller>/<action>',
                
                //'gridview/<controller:\w+>' => 'gridview/<controller>/index',
                //'gridview/<controller:\w+>/<action:\w+>' => 'gridview/<controller>/<action>',
                
                //'diy/<controller:\w+>' => 'diy/<controller>/index',
                //'diy/<controller:\w+>/<action:\w+>' => 'diy/<controller>/<action>',
                
                '<module:\w+>/<controller:\w+>' => '<module>/backend/<controller>/index',
                '<module:\w+>/<controller:\w+>/<action>' => '<module>/backend/<controller>/<action>',
                //'<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/backend/<controller>/<action>',
            ]
        ],
		'db' => [
			'class' => 'yii\db\Connection',
			'dsn' => 'mysql:host=localhost;dbname=test',
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		],
		'mongodb' => [
            'class' => '\yii\mongodb\Connection',
			'dsn' => 'mongodb://viidev:khongphaiem123%21%40%23@52.77.56.164:27017/viidev',
        ],
	],
	'layout' => 'backend',
	'layoutPath' => '@app/themes/inspinia/layouts',
];

$configs = array_replace_recursive($common, $config);

return $configs;