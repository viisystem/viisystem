<?php

return [
    'timeZone' => 'Asia/Ho_Chi_Minh',
    'components' => [
        'errorHandler' => [
            'maxSourceLines' => 20,
        ],
        'request' => [
            'enableCookieValidation' => true,
            'enableCsrfValidation' => true,
            'cookieValidationKey' => 'letyii@!$(!&@',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'facebook' => [
                    'class' => 'yii\authclient\clients\Facebook',
                    'clientId' => '205949952886967',
                    'clientSecret' => 'bfc0c11ada1ab56ec57f459ce3d06b63',
                    'title' => '',
                    'viewOptions' => [
                        'popupWidth' => 800,
                        'popupHeight' => 500
                    ]
                ],
            ],
        ],
        'imageCache' => [
            'class' => 'letyii\imagecache\imageCache',
            'cachePath' => '@app/uploads/cache',
            'cacheUrl' => '@web/uploads/cache',
        ],
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'js' => [
                        'jquery.min.js',
                    ]
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [
                        'css/bootstrap.min.css',
                    ],
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'js' => [
                        'js/bootstrap.min.js',
                    ],
                ],
            ],
        ],
        'i18n' => [
            'translations' => [
                '*' => ['class' => 'yii\i18n\PhpMessageSource', 'basePath' => '@app/messages'],
            ]
        ],
        'formatter' => [
            'dateFormat' => 'dd-MM-yyyy',
            'decimalSeparator' => '.',
            'thousandSeparator' => ',',
            'currencyCode' => 'VND',
            'timeZone' => 'Asia/Ho_Chi_Minh',
            'nullDisplay' => '',
        ],
    ],
    'modules' => [
        'gridview' => [
            'class' => '\kartik\grid\Module',
        ],
        'datecontrol' =>  [
            'class' => '\kartik\datecontrol\Module'
        ],
    ]
];