<?php

namespace vii\grid;

use Yii;

use vii\helpers\Html;


class LanguageColumn extends DataColumn
{

    public $attribute = 'language';
    public $headerOptions = ['class' => 'text-center w-100'];
    public $contentOptions = ['class' => 'text-center'];
    public $format = 'raw';

    /**
     * Initializes the object.
     * This method is invoked at the end of the constructor after the object is initialized with the
     * given configuration.
     */
    public function init()
    {
        if (!Yii::$app->params['multilingual']) {
            $this->visible = false;
        }
    }

    public function getDataCellValue($model, $key, $index)
    {
        $languages = $model->languages;
        $languageSupport = Yii::$app->params['languageSupport'];

        $html = [];
        foreach ($languageSupport as $langKey => $langTitle) {
            if (isset($languages[$langKey])) {
                $html[] = Html::a($langKey, ['update', 'id' => (string)$languages[$langKey]['_id']], ['data-pjax' => '0', 'class' => "i18n-flag i18n-flag-{$langKey} active"]);
            } else {
                $html[] = Html::a($langKey, ['translate', 'id' => (string)$model->primaryKey, 'language' => $langKey], ['data-pjax' => '0', 'class' => "i18n-flag i18n-flag-{$langKey}"]);
            }
        }

        return implode('', $html);
    }
}
