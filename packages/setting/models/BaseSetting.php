<?php

namespace app\packages\setting\models;

use Yii;

/**
 * This is the model class for collection "setting".
 *
 * @property \MongoDB\BSON\ObjectID|string $_id
 * @property mixed $tab_id
 * @property mixed $module
 * @property mixed $key
 * @property mixed $type
 * @property mixed $title
 * @property mixed $description
 * @property mixed $sort
 * @property mixed $value
 * @property mixed $items
 */
class BaseSetting extends \vii\mongodb\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function collectionName()
    {
        return 'setting';
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return [
            '_id',
            'tab_id',
            'module',
            'key',
            'type',
            'title',
            'description',
            'sort',
            'value',
            'items',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tab_id', 'module', 'key', 'type', 'title', 'description', 'sort', 'value', 'items'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            '_id' => Yii::t('setting', 'ID'),
            'tab_id' => Yii::t('setting', 'Tab ID'),
            'module' => Yii::t('setting', 'Module'),
            'key' => Yii::t('setting', 'Key'),
            'type' => Yii::t('setting', 'Type'),
            'title' => Yii::t('setting', 'Title'),
            'description' => Yii::t('setting', 'Description'),
            'sort' => Yii::t('setting', 'Sort'),
            'value' => Yii::t('setting', 'Value'),
            'items' => Yii::t('setting', 'Items'),
        ];
    }
}
