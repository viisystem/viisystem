<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\packages\services\bundles;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ServicesAsset extends AssetBundle
{

    public $sourcePath = '@app/themes/inspinia/frontend/assets/publish';
    
    public $css = [
        'plugins/fancybox/source/jquery.fancybox.css',
        'plugins/sky-forms-pro/skyforms/css/sky-forms.css',
        'plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css',
        'css/pages/page_contact.css',
    ];
    
    public $js = [
        'plugins/fancybox/source/jquery.fancybox.pack.js',
        'js/plugins/fancy-box.js',
    ];
    
    public $depends = [
        'app\themes\inspinia\frontend\assets\FrontendAsset',
    ];
}
