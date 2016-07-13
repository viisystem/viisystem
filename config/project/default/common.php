<?php

$modules = ['common'];
$moduleList = require(__DIR__ . '/../../modules.php');
foreach ($moduleList as $moduleName => $config) {
    if (in_array($moduleName, $modules)) {
        $configsModules[$moduleName] = $config['config'];
        $configsTranslations[$moduleName] = $config['translations'];
    }
}

return [
    'modules' => $configsModules,
    'components' => [
        'i18n' => [
            'translations' => $configsTranslations
        ]
    ],
    'params' => [
        
    ]
];
