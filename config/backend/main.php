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
            'class' => 'viisystem\common\backend\Module'
        ],
    ]
];
