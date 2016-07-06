<?php

return [
    'id' => 'backend',
    'defaultRoute' => 'system/default/index',
    'components' => [
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@app/views' => '@common/themes/backend/views',
                    '@app/modules' => '@common/themes/backend/modules',
                    '@app/widgets' => '@common/themes/backend/widgets',
                ]
            ]
        ]
    ],
    'modules' => [
        'system' => [
            'class' => 'common\modules\system\backend\Module'
        ],
        'user' => [
            'class' => 'common\modules\user\backend\Module'
        ],
    ]
];
