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
        'css/frontend.css',
    ];
	
    public $js = [
    ];
	
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}