<?php
$config = [
    'id' => 'vii-system',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
	'aliases' => [
		'@vii' => dirname(__DIR__) . '/packages/vii'
	],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'lwA4Hg541EcQiC7VCrybYDVi6j7X1sOyfwaoPFRI',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'dashboard/backend/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
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
		'i18n' => [
			'translations' => [
				'*' => [
					'class' => 'yii\i18n\PhpMessageSource',
					'basePath' => '@app/messages'
				],
				'category' => [
					'class' => 'yii\i18n\PhpMessageSource',
					'basePath' => '@app/packages/category/messages'
				],
			]
		],
    ],
	'timeZone' => 'Asia/Ho_Chi_Minh',
	'language' => 'vi',
	'modules' => [
		'dashboard' => [
			'class' => 'app\packages\dashboard\Module',
		],
		'account' => [
			'class' => 'app\packages\account\Module',
		],
		'article' => [
			'class' => 'app\packages\article\Module',
		],
		'category' => [
			'class' => 'app\packages\category\Module',
		],
	],
    'params' => [
		'multilingual' => 0,
		'languageSource' => 'vi', // Dùng cho translate
		'languageDefault' => 'vi',
		'languageBackend' => 'vi',
		'languageFrontend' => 'vi',
		'languageSupport' => [
			'vi' => 'Tiếng Việt',
			'en' => 'English'
		],

		'mobileDetect' => [
			'isDesktop' => true
		]
	],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
		'generators' => [
			'mongoDbModel' => [
				'class' => 'yii\mongodb\gii\model\Generator'
			]
		]
    ];
}

return $config;