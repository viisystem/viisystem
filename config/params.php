<?php
$host = isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : '';

return [
    'params' => [
        'multilingual' => 0,
        'languageTranslate' => 0,
        'languageDefault' => 'vi',
        'languageSupport' => ['vi', 'en'],

        // Avatar
        'avatar_default' => '',
        
        // Upload
        'uploadUrl' => "http://{$host}",
        'uploadDir' => 'uploads',
        'uploadPath' => dirname(__FILE__) . '/..',

        'icon-framework' => 'bsg',
        'supportEmail' => 'contact@let.vn',
    ],
];