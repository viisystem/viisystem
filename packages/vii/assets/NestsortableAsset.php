<?php

namespace vii\assets;

use yii\web\AssetBundle;


class NestsortableAsset extends AssetBundle
{

    public $sourcePath = '@vii/assets/src/nestsortable';

    public $css = [
        'css/nestsortable.min.css',
    ];

    public $js = [
        'js/jquery.nestedSortable.min.js',
        'js/nestsortable.min.js',
    ];

    public $depends = [
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
        'vii\assets\BootstrapDialogAsset',
        'yii\jui\JuiAsset',
    ];

}
