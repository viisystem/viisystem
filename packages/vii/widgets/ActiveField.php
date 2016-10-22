<?php

namespace vii\widgets;

use Yii;
use vii\helpers\ArrayHelper;
use vii\helpers\Html;


class ActiveField extends \yii\bootstrap\ActiveField
{

    public $type = null;

    public $options = ['class' => 'form-group'];

//    public $errorOptions = ['class' => 'help-block text-help'];

//    public $labelOptions = ['class' => 'form-control-label'];

    /**
     * Renders the opening tag of the field container.
     * @return string the rendering result.
     */
    public function begin()
    {
        if ($this->form->enableClientScript) {
            $clientOptions = $this->getClientOptions();
            if (!empty($clientOptions)) {
                $this->form->attributes[] = $clientOptions;
            }
        }

        $inputID = $this->getInputId();
        $attribute = Html::getAttributeName($this->attribute);
        $options = $this->options;
        $class = isset($options['class']) ? [$options['class']] : [];
        $class[] = "field-$inputID";
        if ($this->model->isAttributeRequired($attribute)) {
            $class[] = $this->form->requiredCssClass;
        }
        if ($this->model->hasErrors($attribute)) {
            $class[] = $this->form->errorCssClass;
        }

        if ($this->type == 'textInput') {
            $class[] = 'label-floating';
        }

        $options['class'] = implode(' ', $class);
        $tag = ArrayHelper::remove($options, 'tag', 'div');

        return Html::beginTag($tag, $options);
    }

    /**
     * Renders the closing tag of the field container.
     * @return string the rendering result.
     */
    public function end()
    {
        return Html::endTag(isset($this->options['tag']) ? $this->options['tag'] : 'div');
    }

    public function textInput($options = [])
    {
        $this->type = 'textInput';
        return parent::textInput($options);
    }

    public function textInputHorizontal($options = [])
    {
        $this->template = '<div class="row field-horizontal"><div class="col-sm-3">{label}</div><div class="col-sm-9">{input}{error}{hint}</div></div>';
        $options = array_merge($this->inputOptions, $options);
        $this->adjustLabelFor($options);
        $this->parts['{input}'] = Html::activeTextInput($this->model, $this->attribute, $options);

        return $this;
    }

}
