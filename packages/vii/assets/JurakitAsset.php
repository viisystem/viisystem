<?php

namespace vii\assets;

use yii\web\AssetBundle;


class JurakitAsset extends AssetBundle
{

    public $sourcePath = '@vii/assets/src/jurakit';

    public $css = [
        'css/jurakit.style.min.js',
    ];

    public $js = [
        'js/jurakit.grid.min.js',
        'js/jurakit.form.min.js',
    ];

    public $depends = [
        'vii\assets\BootstrapDialogAsset'
    ];

}
