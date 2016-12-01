<?php

namespace vii\widgets;

use Yii;

use kartik\select2\Select2;


class Tags extends Select2
{

    public function init()
    {
        $this->theme = self::THEME_BOOTSTRAP;

        $this->options['multiple'] = true;
        $this->pluginOptions['tags'] = true;

        if (empty($this->options['placeholder'])) {
            $this->options['placeholder'] = '';
        }
        if (empty($this->pluginOptions['maximumInputLength'])) {
            $this->pluginOptions['maximumInputLength'] = 50;
        }

        $dataTags = [];
        if (!empty($this->model->tags)) {
            foreach ($this->model->tags as $tag) {
                $dataTags[$tag] = $tag;
            }
        }

        $this->data = $dataTags;
        parent::init();
    }
}
