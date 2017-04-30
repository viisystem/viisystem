<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\packages\account\bundles;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class LoginAsset extends AssetBundle
{

    public $sourcePath = '@app/themes/inspinia/frontend/assets/publish';
    
    public $css = [
        'css/pages/page_log_reg_v2.css',
    ];
    
    public $js = [
        'plugins/backstretch/jquery.backstretch.min.js',
    ];
    
    public $depends = [
        'app\themes\inspinia\frontend\assets\FrontendAsset',
    ];
}
