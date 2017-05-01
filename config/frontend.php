<?php

$common = require(__DIR__ . '/common.php');

$config = [
	'defaultRoute' => 'dashboard/frontend/default',	
	'components' => [
		'errorHandler' => [
			'errorAction' => 'dashboard/frontend/error',
		],
		'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                //'gii/<controller:\w+>' => 'gii/<controller>/index',
                //'gii/<controller:\w+>/<action:\w+>' => 'gii/<controller>/<action>',
                
                //'gridview/<controller:\w+>' => 'gridview/<controller>/index',
                //'gridview/<controller:\w+>/<action:\w+>' => 'gridview/<controller>/<action>',
                
                //'diy/<controller:\w+>' => 'diy/<controller>/index',
                //'diy/<controller:\w+>/<action:\w+>' => 'diy/<controller>/<action>',
                
                'tim-kiem' => 'dashboard/frontend/search/index',
                'lien-he' => 'contact/frontend/default/index',
                'dang-nhap' => 'account/frontend/default/login',
                'dich-vu-<slug:[\d\w\-_]+>' => 'services/frontend/default/index',
                'chi-tiet-dich-vu' => 'services/frontend/default/detail',
                'tin-tuc' => 'article/frontend/category/news',

                '<slug:[\d\w\-_]+>-ac<id:[\d\w]+>' => 'article/frontend/category/index',
                '<slug:[\d\w\-_]+>-a<id:[\d\w]+>' => 'article/frontend/default/view',
                
                '<module:\w+>/<controller:\w+>' => '<module>/frontend/<controller>/index',
                '<module:\w+>/<controller:\w+>/<action>' => '<module>/frontend/<controller>/<action>',
                //'<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/frontend/<controller>/<action>',
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
            //'dsn' => 'mongodb://viidev:khongphaiem123!@#@52.77.56.164:27017/viidev',
			'dsn' => 'mongodb://127.0.0.1:27017/viidev',
        ],
        'view' => [
            'theme' => [
                'basePath' => '@app/themes/inspinia/frontend',
                'baseUrl' => '@web/themes/inspinia/frontend',
            ],
        ],
	],
	
	'layout' => 'frontend',
	'layoutPath' => '@app/themes/inspinia/frontend/layouts',
];

$configs = array_replace_recursive($common, $config);

return $configs;