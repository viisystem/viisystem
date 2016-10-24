<?php

namespace vii\assets;

use yii\web\AssetBundle;


class JqueryI18nAsset extends AssetBundle
{

    public $sourcePath = '@vii/assets/src/jquery-i18n';

    public $js = [
        'js/jquery.i18next.min.js',
        'js/jquery.i18next.run.js',
    ];

    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset'
    ];

}
