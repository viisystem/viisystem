<?php

namespace vii\helpers;

use yii\helpers\BaseUrl;
use Yii;

class Url extends BaseUrl
{
    public static function toFrontend($url = '', $scheme = false)
    {
        if (is_array($url)) {
            return static::toRouteFrontend($url, $scheme);
        }

        $url = Yii::getAlias($url);
        if ($url === '') {
            $url = Yii::$app->getRequest()->getUrl();
        }

        if (!$scheme) {
            return $url;
        }

        if (strncmp($url, '//', 2) === 0) {
            // e.g. //hostname/path/to/resource
            return is_string($scheme) ? "$scheme:$url" : $url;
        }

        if (($pos = strpos($url, ':')) == false || !ctype_alpha(substr($url, 0, $pos))) {
            // turn relative URL into absolute
            $url = Yii::$app->get('urlManagerFrontend')->getHostInfo() . '/' . ltrim($url, '/');
        }

        if (is_string($scheme) && ($pos = strpos($url, ':')) !== false) {
            // replace the scheme with the specified one
            $url = $scheme . substr($url, $pos);
        }

        return $url;
    }

    public static function toRouteFrontend($route, $scheme = false)
    {
        $route = (array) $route;
        $route[0] = static::normalizeRoute($route[0]);

        if ($scheme) {
            return Yii::$app->get('urlManagerFrontend')->createAbsoluteUrl($route, is_string($scheme) ? $scheme : null);
        } else {
            return Yii::$app->get('urlManagerFrontend')->createUrl($route);
        }
    }

}