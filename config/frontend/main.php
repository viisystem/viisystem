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
            'class' => 'viisystem\common\frontend\Module'
        ],
    ]
];
