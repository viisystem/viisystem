<?php

namespace app\packages\diy\models;

use Yii;

class DiyStorage extends \yii\mongodb\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function collectionName()
    {
        return ['viidev', 'diy_storage'];
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return [
            '_id',
            'page',
            'positions',
            'template',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['page', 'position', 'settings'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            '_id' => Yii::t('diy', 'ID'),
            'page' => Yii::t('diy', 'Page'),
            'position' => Yii::t('diy', 'position'),
            'settings' => Yii::t('diy', 'Settings'),
        ];
    }
}