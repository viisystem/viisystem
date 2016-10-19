<?php
namespace app\themes\inspinia\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    //public $basePath = '@webroot';
    //public $baseUrl = '@web';
	public $sourcePath = '@app/themes/inspinia/assets/publish';
	
    public $css = [
		'vendor/inspinia/font-awesome/css/font-awesome.css',
		'vendor/inspinia/css/plugins/toastr/toastr.min.css',
		'vendor/inspinia/js/plugins/gritter/jquery.gritter.css',
		'vendor/inspinia/css/animate.css',
		'vendor/inspinia/css/style.css',
        'css/site.css',
    ];
	
    public $js = [
		'vendor/inspinia/js/plugins/metisMenu/jquery.metisMenu.js',
		'vendor/inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js',
		'vendor/inspinia/js/plugins/peity/jquery.peity.min.js',
		'vendor/inspinia/js/inspinia.js',
		'vendor/inspinia/js/plugins/pace/pace.min.js',
		'vendor/inspinia/js/plugins/gritter/jquery.gritter.min.js',
		'vendor/inspinia/js/plugins/sparkline/jquery.sparkline.min.js',
		'vendor/inspinia/js/plugins/toastr/toastr.min.js',
    ];
	
    public $depends = [
		'yii\web\JqueryAsset',
		'yii\jui\JuiAsset',
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
		'yii\bootstrap\BootstrapPluginAsset',
    ];
}
