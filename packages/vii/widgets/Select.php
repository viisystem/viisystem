<?php

namespace vii\widgets;

use Yii;

use vii\helpers\DataHelper;
use vii\helpers\Html;

use kartik\select2\Select2;

class Select extends Select2
{

    public $clear = false;
    public $category = false;
    public $callback = null;

    public function init()
    {
        $this->theme = self::THEME_BOOTSTRAP;

        $this->pluginOptions['allowClear'] = ($this->clear) ? true : false;

        if (empty($this->options['placeholder'])) {
            $this->options['placeholder'] = \Yii::t('common', '---');
        }

        if (empty($this->data) && $this->category == false) {
            $this->pluginOptions['minimumResultsForSearch'] = 'Infinity';
            $this->data = DataHelper::getBooleanOptions();
        }

        if ($this->callback != null) {
            $this->addon = [
                'append' => [ //prepend
                    'content' => Html::a(Html::icon('plus'), 'javascript:', ['class' => 'input-group-addon', 'title' => 'Create', 'data-toggle' => 'tooltip']),
                    'asButton' => true
                ]
            ];
        }

        parent::init();
    }

    public function run()
    {
        if (!Yii::$app->params['mobileDetect']['isDesktop']) {
            $this->options['class'] = 'form-control';
            $this->data = ['' => Yii::t('common', '---')] + $this->data;

            if ($this->hasModel()) {
                echo Html::activeDropDownList($this->model, $this->attribute, $this->data, $this->options);
            } else {
                echo Html::dropDownList($this->name, $this->value, $this->data, $this->options);
            }

            return false;
        }

        parent::run();
    }
}
