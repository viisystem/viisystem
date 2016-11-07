<?php

namespace app\packages\setting\widgets\backend;

use app\packages\setting\models\Setting;
use vii\helpers\Html;

use yii\widgets\InputWidget;
use yii\web\View;
use Yii;


class SettingItems extends InputWidget {

    private $inputName;

    public function init() {
        if (!isset($this->options['class']) OR empty($this->options['class']))
            $this->options['class'] = 'form-control m-b-xs';

        $this->options['onkeydown'] = 'addItemWhenPressKey(event);';

        $this->inputName = Html::getInputName($this->model, $this->attribute);
        $this->registerAssets();
    }

    /**
     * Renders the widget.
     */
    public function run() {
        $items = $this->model->{$this->attribute};

        // Generate key in items
        if (empty($items)) {
            $optionKey = rand(10000000, 99999999);
            $items = [
                $optionKey => '',
            ];
        }

        echo Html::beginTag('div', ['id' => 'items']);

        foreach ($items as $optionKey => $optionValue) {
            echo $this->createItem($optionKey, $optionValue);
        }

        // Tao ra bien hidden cua truong items, khi type = text thi truong items mac dinh bang rong
        if ($this->model->type == Setting::TYPE_TEXT)
            echo Html::hiddenInput($this->inputName, '', ['id' => 'itemEmpty']);

        echo Html::endTag('div');

        echo '<div class="row">';
        echo '<div class="col-md-2 col-md-offset-10">';
            echo Html::button(Yii::t('common', 'Create'), ['class' => 'btn btn-block btn-success', 'id' => 'addItem']);
        echo '</div>';
        echo '</div>';
    }

    private function registerAssets(){
        $this->view->registerJs("
            $('.field-setting-items').hide();
            if ($.inArray($('#setting-type').val(), ['".Setting::TYPE_RADIO."', '".Setting::TYPE_DROPDOWN."', '".Setting::TYPE_CHECKBOX."']) != -1) {
                $('.field-setting-items').show();    
            }
            
            $('#setting-type').change(function () {
                if ($.inArray(this.value, ['".Setting::TYPE_RADIO."', '".Setting::TYPE_DROPDOWN."', '".Setting::TYPE_CHECKBOX."']) != -1) {
                    $('#itemEmpty').remove();
                    $('.field-setting-items input').prop('disabled', false);
                    $('.field-setting-items').show();
                } else {
                    $('.field-setting-items').hide();
                    $('.field-setting-items input[type=text]').prop('disabled', true);
                    $('#itemEmpty').prop('disabled', false);
                }
            }).change();
            
            $('#addItem').click(function(){
                addItem();
            });

            function addItemWhenPressKey(event){
                if (event.keyCode == 40 || event.keyCode == 45){
                    addItem();
                }
            }

            // Generate key in items
            function addItem() {
                var optionKey = Math.round(Math.random() * 100000000);
                var item = '".$this->createItem()."';
                item = item.replace(/{optionKey}/g, optionKey);
                $('.field-setting-items #items').append(item);
                $('.field-setting-items #items input').last().focus();
            }
            
            // Remove item
            function removeItem(buttonRemove){
                $(buttonRemove).parent().parent().remove();
            }
            
            // Before save
            $('form').submit(function(){
                $('.field-setting-items input[type=text]').each(function(index) {
                    if ($(this).val().trim() == '') {
                        $(this).remove();
                    }
                });
            });

        ", View::POS_END);
    }

    private function createItem($optionKey = '', $optionValue = ''){
        $result = Html::beginTag('div', ['class' => 'input-groupx m-b-xs']);
        $result .= Html::beginTag('div', ['class' => 'row']);
        $result .= Html::beginTag('div', ['class' => 'col-md-3']);
        $result .= Html::textInput($this->inputName . '[{optionKey}][key]', '{optionKey}', $this->options);
        $result .= Html::endTag('div');
        $result .= Html::beginTag('div', ['class' => 'col-md-7']);
        $result .= Html::textInput($this->inputName . '[{optionKey}][val]', $optionValue, $this->options);
        $result .= Html::endTag('div');
        $result .= Html::beginTag('div', ['class' => 'col-md-2']);
        $result .= Html::button(Yii::t('common', 'Delete'), ['class' => 'btn btn-block btn-danger' ,'onclick' => 'removeItem(this)']);
        $result .= Html::endTag('div');
        $result .= Html::endTag('div');
        $result .= Html::endTag('div');

        if (!empty($optionKey)) {
            $result = str_replace ('{optionKey}', $optionKey, $result);
        }

        return $result;
    }
}

