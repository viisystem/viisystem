<?php

namespace vii\grid;

use Yii;

use vii\helpers\ArrayHelper;
use vii\helpers\Html;
use vii\helpers\ImageHelper;


class ImageColumn extends DataColumn
{
    public $imageOptions = ['width' => 55, 'height' => 55];
    public $attribute = 'image';
    public $format = 'raw';
    public $headerOptions = ['class' => 'w-80'];
    public $contentOptions = ['class' => 'w-80'];
    public $filter = false;

    public function getDataCellValue($model, $key, $index)
    {
        return Html::img(ImageHelper::getThumb(ArrayHelper::getValue($model, $this->attribute), $this->imageOptions['width'], $this->imageOptions['height']));
    }
}
