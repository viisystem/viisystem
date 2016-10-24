<?php

namespace vii\grid;

use Yii;

use vii\helpers\Html;


class LanguageColumn extends DataColumn
{
    public $attribute = 'language';
    public $headerOptions = ['class' => 'hidden-print w-90'];
    public $contentOptions = ['class' => 'hidden-print w-90 text-xs-center'];
    public $format = 'raw';

    /**
     * Initializes the object.
     * This method is invoked at the end of the constructor after the object is initialized with the
     * given configuration.
     */
    public function init()
    {
//        $this->filter = [
//            DataHelper::BOOLEAN_ON => Yii::t('common', 'BOOLEAN_ON'),
//            DataHelper::BOOLEAN_OFF => Yii::t('common', 'BOOLEAN_OFF'),
//        ];

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
            $html[] = (isset($languages[$langKey]))
                ? Html::a(Html::img(Yii::getAlias('@assets-url') . "/img/flag/16/{$langKey}.png"), ['update', 'id' => $languages[$langKey]['_id']], ['data-pjax' => '0', 'class' => 'i18n-flag active'])
                : Html::a(Html::img(Yii::getAlias('@assets-url') . "/img/flag/16/{$langKey}.png"), ['translate', 'id' => $model->getId(), 'language' => $langKey], ['data-pjax' => '0', 'class' => 'i18n-flag']);
        }

        return implode('', $html);
    }
}
