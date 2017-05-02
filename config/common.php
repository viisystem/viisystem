<?php
$config = [
    'id' => 'vii-system',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
	'aliases' => [
		'@vii' => dirname(__DIR__) . '/packages/vii'
	],
    'components' => [
    	'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'thousandSeparator' => '.',
            'decimalSeparator' => ',',
            'currencyCode' => 'VND',
        ],
        'imageCache' => [
            'class' => 'letyii\imagecache\imageCache',
            'cachePath' => '@app/uploads/cache',
            'cacheUrl' => '@web/uploads/cache',
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'lwA4Hg541EcQiC7VCrybYDVi6j7X1sOyfwaoPFRI',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
			'loginUrl' => ['account/backend/auth/login'],
            'identityClass' => 'app\packages\account\models\User',
            'enableAutoLogin' => false,
        ],
		'authManager' => [
			//'class' => 'yii\rbac\DbManager',
			'class' => 'yii\mongodb\rbac\MongoDbManager',
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
				'contact' => [
					'class' => 'yii\i18n\PhpMessageSource',
					'basePath' => '@app/packages/contact/messages'
				],
				'account' => [
					'class' => 'yii\i18n\PhpMessageSource',
					'basePath' => '@app/packages/account/messages'
				],
				'article' => [
					'class' => 'yii\i18n\PhpMessageSource',
					'basePath' => '@app/packages/article/messages'
				],
				'services' => [
					'class' => 'yii\i18n\PhpMessageSource',
					'basePath' => '@app/packages/services/messages'
				],
				'banner' => [
					'class' => 'yii\i18n\PhpMessageSource',
					'basePath' => '@app/packages/banner/messages'
				],
				// DUY
				'blog' => [
					'class' => 'yii\i18n\PhpMessageSource',
					'basePath' => '@app/packages/blog/messages'
				],
				'category' => [
					'class' => 'yii\i18n\PhpMessageSource',
					'basePath' => '@app/packages/category/messages'
				],
				'setting' => [
					'class' => 'yii\i18n\PhpMessageSource',
					'basePath' => '@app/packages/setting/messages'
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
		'diy' => [
			'class' => 'app\packages\diy\Module',
		],
		'services' => [
			'class' => 'app\packages\services\Module',
		],
		'banner' => [
			'class' => 'app\packages\banner\Module',
		],

		// Duy
		'blog' => [
			'class' => 'app\packages\blog\Module',
		],
		'category' => [
			'class' => 'app\packages\category\Module',
		],
		'setting' => [
			'class' => 'app\packages\setting\Module',
		],

		// Phongnv
		'contact' => [
			'class' => 'app\packages\contact\Module',
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

		'uploadUrl' => (pathinfo($_SERVER['SCRIPT_NAME'], PATHINFO_DIRNAME) === '/') ? null : pathinfo($_SERVER['SCRIPT_NAME'], PATHINFO_DIRNAME),
		'uploadDir' => 'uploads',
		'uploadPath' => dirname(__FILE__) . '/..',

		'mobileDetect' => [
			'isDesktop' => true
		]
	]
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