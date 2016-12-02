<?php

namespace vii\grid;

use Yii;

use vii\helpers\ArrayHelper;
use vii\helpers\DataHelper;
use vii\helpers\Html;
use vii\helpers\Url;


class BooleanColumn extends DataColumn
{
    public $attribute = 'is_approved';
    public $headerOptions = ['class' => 'text-xs-center w-90'];
    public $contentOptions = ['class' => 'text-xs-center'];
    public $format = 'raw';

    public $route = null;
    public $readonly = false;

    /**
     * Initializes the object.
     * This method is invoked at the end of the constructor after the object is initialized with the
     * given configuration.
     */
    public function init()
    {
        $this->filter = [
            DataHelper::BOOLEAN_ON => Yii::t('common', 'BOOLEAN_ON'),
            DataHelper::BOOLEAN_OFF => Yii::t('common', 'BOOLEAN_OFF'),
        ];
    }

    public function getDataCellValue($model, $key, $index)
    {
        $url = 'javascript:';

        if (!$this->readonly) {
            $routes = [$this->route, 'id' => (string) $model->primaryKey];
            if ($this->route == null) {
                $routes[0] = '/' . Yii::$app->controller->uniqueId . '/' . str_replace('_', '-', $this->attribute);
            }

            $url = Url::to($routes);
        }

        $status = ArrayHelper::getValue($model, $this->attribute);
        if ($status == DataHelper::BOOLEAN_ON) {
            return Html::a('<i class="fa fa-star"></i><span class="sr-only">x</span>', $url, [
                'data-pjax' => '0',
                'class' => 'text-black', //text-amber
                'onclick' => 'jurakit.grid.status($(this)); return false'
            ]);
        }

        return Html::a('<i class="fa fa-star-o"></i>', $url, [
            'data-pjax' => '0',
            'class' => 'text-grey',
            'onclick' => 'jurakit.grid.status($(this)); return false'
        ]);
    }
}
