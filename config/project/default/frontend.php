<?php

$theme = 'frontend';
$configs = [
    'name' => 'default',
    'language' => 'vi',
    'components' => [
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@app/views' => '@app/themes/' . $theme . '/views',
                    '@app/modules' => '@app/themes/' . $theme . '/modules',
                    '@app/widgets' => '@app/themes/' . $theme . '/widgets',
                ],
                'basePath' => '@app/themes/' . $theme,
                'baseUrl' => '@web/themes/' . $theme,
            ]
        ]
    ]
];

return $configs;
