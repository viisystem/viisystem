<?php

namespace vii\assets;

use yii\web\AssetBundle;


class BootstrapDialogAsset extends AssetBundle
{

    public $sourcePath = '@vii/assets/src/bootstrap-dialog';

    public $css = [
        'css/bootstrap-dialog.min.css',
    ];

    public $js = [
        'js/bootstrap-dialog.min.js',
    ];

    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset'
    ];

}
