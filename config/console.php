<?php
$host = isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : '';
if (in_array($host, ['demo.com'])) {
    $project = 'demo';
} else {
    $project = 'default';
}

if (isset($_GET['project']))
    $project = $_GET['project'];

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'extensions' => require(__DIR__ . '/../vendor/yiisoft/extensions.php'),
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
    ],
];


// Merge data config
$configs = array_replace_recursive(
    require(__DIR__ . '/db.php'),
    require(__DIR__ . '/params.php'),
    $config,
    require(__DIR__ . '/project/'.$project.'/common.php')
);

return $configs;
