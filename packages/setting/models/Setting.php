<?php

namespace app\packages\setting\models;

use vii\behaviors\SortBehavior;
use vii\helpers\ArrayHelper;
use Yii;



class Setting extends BaseSetting
{

    const TYPE_TEXT = 1;
    const TYPE_NUMBER = 2;
    const TYPE_TEXTAREA = 3;
    const TYPE_EDITOR = 4;
    const TYPE_BOOLEAN = 5;
    const TYPE_RADIO = 6;
    const TYPE_CHECKBOX = 7;
    const TYPE_DROPDOWN = 8;
    const TYPE_DATETIME = 9;
    const TYPE_COLOR_PICKER = 10;
    const TYPE_UPLOAD_IMAGE = 11;

    private static $_instance;

    /**
     * @return \app\packages\setting\models\Setting
     */
    public static function getInstance()
    {
        if (null === static::$_instance) {
            static::$_instance = new static();
        }

        return static::$_instance;
    }

    public static function find()
    {
        return new SettingQuery(get_called_class());
    }

    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(), [
                ['class' => SortBehavior::className()],
            ]
        );
    }

    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['type', 'key'], 'required'],
            ['key', 'unique'],
            ['key', 'match', 'pattern' => '/^[a-zA-Z0-9\_]+$/'],
        ]);
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if (!empty($this->items) && is_array($this->items)) {
            $items = [];
            foreach ($this->items as $index => $item) {
                if (isset($item['val'])) {
                    $items[(isset($item['key'])) ? $item['key'] : $index] = $item['val'];
                }
            }

            $this->items = $items;
        }

        return true;
    }

    public function getId()
    {
        return (string) $this->_id;
    }

    public function setDefaultValues()
    {
        /** @var $controller \app\packages\setting\controllers\backend\SettingController */
        $controller = Yii::$app->controller;

        $this->module = $controller->settingModule;
        $this->type = self::TYPE_TEXT;
    }

    public function getTypeOptions()
    {
        return [
            self::TYPE_TEXT =>  Yii::t('setting', 'TYPE_TEXT'),
            self::TYPE_NUMBER =>  Yii::t('setting', 'TYPE_NUMBER'),
            self::TYPE_TEXTAREA =>  Yii::t('setting', 'TYPE_TEXTAREA'),
            self::TYPE_EDITOR =>  Yii::t('setting', 'TYPE_EDITOR'),
            self::TYPE_BOOLEAN =>  Yii::t('setting', 'TYPE_BOOLEAN'),
            self::TYPE_RADIO =>  Yii::t('setting', 'TYPE_RADIO'),
            self::TYPE_CHECKBOX =>  Yii::t('setting', 'TYPE_CHECKBOX'),
            self::TYPE_DROPDOWN =>  Yii::t('setting', 'TYPE_DROPDOWN'),
            self::TYPE_DATETIME =>  Yii::t('setting', 'TYPE_DATETIME'),
            self::TYPE_COLOR_PICKER =>  Yii::t('setting', 'TYPE_COLOR_PICKER'),
            self::TYPE_UPLOAD_IMAGE =>  Yii::t('setting', 'TYPE_UPLOAD_IMAGE'),
        ];
    }

    public static function getValue($key, $default = null)
    {
        /** @var $model static */
        if (($model = static::find()->andWhere(['key' => $key])->one()) === null) {
            return $default;
        }

        return $model->value;
    }
    
}
