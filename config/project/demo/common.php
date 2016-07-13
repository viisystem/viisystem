<?php
$host = isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : '';

$modules = ['common'];
$moduleList = require(__DIR__ . '/../../modules.php');

foreach ($moduleList as $moduleName => $config) {
    if (in_array($moduleName, $modules)) {
        $configsModules[$moduleName] = $config['config'];

        if (isset($config['translations'])) {
            $configsTranslations[$moduleName] = $config['translations'];
        }
    }
}

return [
    'language' => 'vi',
    'modules' => $configsModules,
    'components' => [
        'i18n' => [
            'translations' => $configsTranslations
        ]
    ],
    'params' => [

    ]
];
