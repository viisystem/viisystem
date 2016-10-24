<?php

namespace vii\helpers;

use Yii;

class DataHelper
{

    const BOOLEAN_ON = 1;
    const BOOLEAN_OFF = 0;

    public static function string2array($tags)
    {
        $temp = preg_split('/\s*,\s*/', trim($tags), -1, PREG_SPLIT_NO_EMPTY);
        return array_unique($temp);
    }

    public static function array2string($tags)
    {
        return implode(',', $tags);
    }

    public static function getRangeRules($options)
    {
        return array_keys($options);
    }

    public static function getLanguageOptions()
    {
        return Yii::$app->params['languageSupport'];
    }

    public static function getBooleanOptions()
    {
        return [
            self::BOOLEAN_ON => Yii::t('common', 'BOOLEAN_ON'),
            self::BOOLEAN_OFF => Yii::t('common', 'BOOLEAN_OFF'),
        ];
    }

    public static function getBooleanLabel($status)
    {
        if ($status == self::BOOLEAN_ON) {
            return Html::tag('span', '<i class="fa fa-check"></i>', ['class' => 'tag tag-xs tag-success']);
        } else {
            return Html::tag('span', '<i class=" fa fa-times"></i>', ['class' => 'tag tag-xs tag-default']);
        }
    }


    public static function getHtmlPurifierConfigs()
    {
        $hostInfo = Yii::$app->request->getHostInfo();
        return [
            'Attr.EnableID' => true,
            'Filter.YouTube' => true,
            'HTML.TargetBlank' => true,
            'HTML.SafeIframe' => true,
            'URI.SafeIframeRegexp' => "%^{$hostInfo}%",
            //'URI.SafeIframeRegexp' => '%^http://(www.youtube.com/embed/|player.vimeo.com/video/)%',
        ];
    }

    public static function getModules()
    {
        $modules = Yii::$app->modules;
        unset($modules['gii']);
        unset($modules['debug']);

        ksort($modules);
        return $modules;
    }

    public static function getModuleClasses()
    {
        $result = [];

        $modules = static::getModules();
        foreach ($modules as $module) {
            $moduleClass = null;
            if (is_array($module)) {
                $moduleClass = $module['class'];
            } else if (is_object($module)) {
                $moduleClass = get_class($module);
            }

            if ($moduleClass !== null) {
                $result[] = ltrim($moduleClass, '\\');
            }
        }

        return $result;
    }

    public static function getModuleOptions() {
        $result = [];
        foreach (static::getModules() as $key => $val) {
            //$result[$key] = Yii::t($key, 'Module Name');
            $result[$key] = $key;
        }
        return $result;
    }
    
    public static function isJSON($string) {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
}
