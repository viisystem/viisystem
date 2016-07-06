<?php

return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'basePath' => dirname(__DIR__) . '/../',
    'runtimePath' => __DIR__ . '/../runtime',
    'bootstrap' => ['log'],
    'controllerNamespace' => 'common\controllers',
    'aliases' => [
        '@viisystem/system' => '@viisystem/yii2-system/src',
        '@viisystem/user' => '@viisystem/yii2-user/src',
    ],
    'components' => [
        'db' => require(__DIR__ . '/db.php'),
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'enkGCqWEmR3UXqGLWeZs',
            'enableCookieValidation' => true,
            'enableCsrfValidation' => true,
            'csrfParam' => '_csrf',
        ],
    ],
];
