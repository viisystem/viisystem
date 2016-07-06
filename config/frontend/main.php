<?php

return [
    'id' => 'frontend',
    'defaultRoute' => 'system/default/index',
    'components' => [
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@app/views' => '@common/themes/frontend/views',
                    '@app/modules' => '@common/themes/frontend/modules',
                    '@app/widgets' => '@common/themes/frontend/widgets',
                ]
            ]
        ]
    ],
    'modules' => [
        'system' => [
            'class' => 'common\modules\system\frontend\Module'
        ],
        'user' => [
            'class' => 'common\modules\user\frontend\Module'
        ],
    ]
];
