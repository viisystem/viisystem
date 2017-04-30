<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\packages\contact\bundles;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ContactAsset extends AssetBundle
{

    public $sourcePath = '@app/themes/inspinia/frontend/assets/publish';
    
    public $css = [
        'plugins/sky-forms-pro/skyforms/css/sky-forms.css',
        'plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css',
        'css/pages/page_contact.css',
    ];
    
    public $js = [
        'plugins/sky-forms-pro/skyforms/js/jquery.form.min.js',
        'plugins/sky-forms-pro/skyforms/js/jquery.validate.min.js',
        'js/plugins/google-map.js',
    ];
    
    public $depends = [
        'app\themes\inspinia\frontend\assets\FrontendAsset',
    ];
}
