<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */
namespace app\themes\inspinia\frontend\assets;
use yii\web\AssetBundle;
/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class FrontendAsset extends AssetBundle
{
    //public $basePath = '@webroot';
    //public $baseUrl = '@web';
	public $sourcePath = '@app/themes/inspinia/frontend/assets/publish';
	
    public $css = [
        'css/style.css',
        'css/headers/header-default.css',
        'css/footers/footer-v1.css',
        'plugins/animate.css',
        'plugins/line-icons/line-icons.css',
        'plugins/font-awesome/css/font-awesome.min.css',
        'plugins/parallax-slider/css/parallax-slider.css',
        'plugins/owl-carousel/owl-carousel/owl.carousel.css',
        'plugins/revolution-slider/rs-plugin/css/settings.css',
        'css/theme-colors/blue.css',
        'css/theme-skins/dark.css',
        'css/custom.css',
    ];
	
    public $js = [
        'plugins/jquery/jquery-migrate.min.js',
        'plugins/back-to-top.js',
        'plugins/smoothScroll.js',
        'plugins/parallax-slider/js/modernizr.js',
        'plugins/parallax-slider/js/jquery.cslider.js',
        'plugins/owl-carousel/owl-carousel/owl.carousel.js',
        'plugins/revolution-slider/rs-plugin/js/jquery.themepunch.tools.min.js',
        'plugins/revolution-slider/rs-plugin/js/jquery.themepunch.revolution.min.js',
        'js/custom.js',
        'js/app.js',
        'js/plugins/owl-carousel.js',
        'js/plugins/style-switcher.js',
        'js/plugins/parallax-slider.js',
        'js/plugins/revolution-slider.js',
    ];
	
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}