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
    'defaultRoute' => 'common/backend/default',
    'extensions' => require(__DIR__ . '/../vendor/yiisoft/extensions.php'),
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\modules\account\models\User',
            'loginUrl' => ['/account/backend/auth/login'],
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'common/backend/error',
        ],
        'mail' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => true,
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
            'showScriptName' => true,
            'rules' => [
                '<controller:\w+>' => '<controller>/index',
                '<controller:\w+>/<action>' => '<controller>/<action>',

                '<module:\w+>/<controller:\w+>' => '<module>/backend/<controller>/index',
                '<module:\w+>/<controller:\w+>/<action>' => '<module>/backend/<controller>/<action>',
            ]
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@app/views' => '@app/themes/backend/views',
                    '@app/modules' => '@app/themes/backend/modules',
                    '@app/widgets' => '@app/themes/backend/widgets',
                ],
                'basePath' => '@app/themes/backend',
                'baseUrl' => '@web/themes/backend',
            ],
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
    require(__DIR__ . '/project/'.$project.'/backend.php')
);

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $configs['bootstrap'][] = 'debug';
    $configs['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'panels' => [
            'profiling' => ['class' => 'yii\debug\panels\ProfilingPanel'],
        ],
        'allowedIPs' => ['127.0.0.1', '::1', '192.168.*'],
    ];
    $configs['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1', '::1', '192.168.*'],
        'generators' => [
            'mongoDbModel' => [
                'class' => 'yii\mongodb\gii\model\Generator',
            ],
            'mongoDbModelPlus' => [
                'class' => 'app\modules\gii\generators\model\Generator',
            ],
            'mongoDbCrudPlus' => [
                'class' => 'app\modules\gii\generators\crud\Generator',
            ],
        ],
    ];
}

return $configs;
