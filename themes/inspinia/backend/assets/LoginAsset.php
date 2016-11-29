<?php
namespace app\themes\inspinia\backend\assets;

use yii\web\AssetBundle;

class LoginAsset extends AssetBundle
{
    //public $basePath = '@webroot';
    //public $baseUrl = '@web';
	public $sourcePath = '@app/themes/inspinia/backend/assets/publish';
	
    public $css = [
		'vendor/inspinia/font-awesome/css/font-awesome.css',
		'vendor/inspinia/css/animate.css',
		'vendor/inspinia/css/style.css',
    ];
	
    public $js = [
		
    ];
	
    public $depends = [
		'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
