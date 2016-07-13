<?php
$host = isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : '';
if ($host == 'demo.com') {
    $project = 'demo';
} else {
    $project = 'default';
}

if (isset($_GET['project']))
    $project = $_GET['project'];

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'language' => 'vi',
    'bootstrap' => ['log'],
    'defaultRoute' => 'common/frontend/default',
    'extensions' => require(__DIR__ . '/../vendor/yiisoft/extensions.php'),
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\modules\account\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'common/frontend/error',
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
		'urlManager' => [ 
			'enablePrettyUrl' => true,
            'showScriptName' => YII_ENV_DEV ? true : false,
		],
    ],
];


// Merge data config
$configs = array_replace_recursive(
    require(__DIR__ . '/common.php'),
    require(__DIR__ . '/db.php'),
    require(__DIR__ . '/params.php'),
    $config,
    require(__DIR__ . '/project/'.$project.'/common.php'),
    require(__DIR__ . '/project/'.$project.'/frontend.php'),
    [
        'components' => [
            'urlManager' => [
		        'enablePrettyUrl' => true,
	            'showScriptName' => false,
                'rules' => [
                    '<controller:\w+>' => '<controller>/index',
                    '<controller:\w+>/<action>' => '<controller>/<action>',

                    '<module:\w+>/<controller:\w+>' => '<module>/frontend/<controller>/index',
                    '<module:\w+>/<controller:\w+>/<action>' => '<module>/frontend/<controller>/<action>',
                ]
            ]
        ]
    ]
);

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $configs['bootstrap'][] = 'debug';
    $configs['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'panels' => [
            'profiling' => ['class' => 'yii\debug\panels\ProfilingPanel'],
        ],
        'allowedIPs' => ['127.0.0.1', '::1', '192.168.*', '*'],
    ];
}

return $configs;
