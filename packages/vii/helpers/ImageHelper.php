<?php

namespace vii\helpers;

use yii\imagine\Image;
use Yii;

class ImageHelper
{

    public static function getThumb($path, $width = 150, $height = 100, $quality = 100)
    {
        $width = (int)$width;
        $height = (int)$height;
        $path = '/' . Yii::$app->params['uploadDir'] . '/' . $path;

        $webrun = Yii::getAlias('@webroot');
        $weburl = Yii::$app->urlManager->baseUrl;

        $sourcePath = $webrun . '/' . $path;
        $sourceUrl = $weburl . '/' . $path;

        $path = preg_replace('/\/' . Yii::$app->params['uploadDir'] . '/', '', $path, 1);
        $targetPath = "{$webrun}/thumb/{$width}x{$height}" . $path;
        $targetUrl = "{$weburl}/thumb/{$width}x{$height}" . $path;

        if (empty($path)) {
            return null;
        }

        if (file_exists($targetPath) && is_file($targetPath)) {
            return $targetUrl;
        }

        if ($width == 0 && $height == 0) {
            return $sourceUrl;
        }

        if (!file_exists($sourcePath) || !is_file($sourcePath)) {
            return null;
        }

        if ($width == 0 || $height == 0) {
            list($w, $h) = getimagesize($sourcePath);

            if ($width == 0) {
                $width = ceil($height * $w / $h);
                $targetPath = "{$webrun}/thumb/h{$height}" . $path;
            } else if ($height == 0) {
                $height = ceil($width * $h / $w);
                $targetPath = "{$webrun}/thumb/w{$width}" . $path;
            }
        }

        FileHelper::createDirectory(pathinfo($targetPath, PATHINFO_DIRNAME));
        Image::thumbnail($sourcePath, $width, $height)->save($targetPath, ['quality' => $quality]);

        return FileHelper::getUploadUrl($targetPath);
    }

}
