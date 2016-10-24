<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace vii\grid;

use Closure;
use Yii;

use vii\helpers\Html;
use vii\helpers\Url;


class ActionColumn extends \yii\grid\ActionColumn
{

    public $headerOptions = ['class' => 'hidden-md-down hidden-print w-130'];
    public $contentOptions = ['class' => 'hidden-md-down hidden-print text-center'];

    public $template = '{view} {update} {delete}';

    /**
     * Initializes the default button rendering callbacks.
     */
    protected function initDefaultButtons()
    {
        if (!isset($this->buttons['view'])) {
            $this->buttons['view'] = function ($url, $model, $key) {
                return Html::a('<i class="fa fa-eye"></i>', $url, [
                    'title' => Yii::t('yii', 'View'),
                    'data-toggle' => 'tooltip',
                    'data-pjax' => '0',
                    'class' => 'grid-action'
                ]);
            };
        }
        if (!isset($this->buttons['update'])) {
            $this->buttons['update'] = function ($url, $model, $key) {
                return Html::a('<i class="fa fa-pencil-square-o"></i>', $url, [
                    'title' => Yii::t('yii', 'Update'),
                    'data-toggle' => 'tooltip',
                    'data-pjax' => '0',
                    'class' => 'grid-action'
                ]);
            };
        }
        if (!isset($this->buttons['delete'])) {
            $this->buttons['delete'] = function ($url, $model, $key) {
                return Html::a('<i class="fa fa-trash-o"></i>', $url, [
                    'title' => Yii::t('yii', 'Delete'),
                    'data-toggle' => 'tooltip',
                    'data-pjax' => '0',
                    'class' => 'grid-action',
                    'onclick' => 'jurakit.grid.delete($(this)); return false'
//                    'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
//                    'data-method' => 'post',
                ]);
            };
        }
    }

    public function createUrl($action, $model, $key, $index)
    {
        if ($this->urlCreator instanceof Closure) {
            return call_user_func($this->urlCreator, $action, $model, $key, $index);
        } else {
            $params = is_array($key) ? $key : ['id' => (string) $key];
            $params[0] = $this->controller ? $this->controller . '/' . $action : $action;

            if ($action === 'update') {
                $params['returnUrl'] = Yii::$app->request->url;
            }

            return Url::toRoute($params);
        }
    }
}
