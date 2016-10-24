<?php

namespace vii\helpers;

use yii\helpers\BaseHtml;
use Yii;

class Html extends BaseHtml
{

    public static function icon($name, $options = [])
    {
        $tag = ArrayHelper::remove($options, 'tag', 'span');
        $classPrefix = ArrayHelper::remove($options, 'prefix', 'fa fa-');
        static::addCssClass($options, $classPrefix . $name);
        return static::tag($tag, '', $options);
    }
    
}