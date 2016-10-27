<?php

namespace vii\assets;

use yii\web\AssetBundle;


class JurakitAsset extends AssetBundle
{

    public $sourcePath = '@vii/assets/src/jurakit';

    public $css = [
        'css/jurakit.style.min.css',
    ];

    public $js = [
        'js/jurakit.grid.min.js',
        'js/jurakit.form.min.js',
    ];

    public $depends = [
        'vii\assets\BootstrapDialogAsset',
        'vii\assets\JqueryI18nAsset'
    ];

}
