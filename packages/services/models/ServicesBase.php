<?php

namespace app\packages\services\models;

use Yii;

/**
 * This is the model class for collection "services".
 *
 * @property \MongoDB\BSON\ObjectID|string $_id
 * @property mixed $title
 * @property mixed $type
 * @property mixed $bank
 * @property mixed $rate
 * @property mixed $rate_special
 * @property mixed $created_at
 * @property mixed $created_by
 * @property mixed $updated_at
 * @property mixed $language
 * @property mixed $status
 */
class ServicesBase extends \vii\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function collectionName()
    {
        return 'services';
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return [
            '_id',
            'title',
            'type',
            'bank',
            'rate',
            'rate_special',
            'created_at',
            'created_by',
            'updated_at',
            'language',
            'status',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'type', 'bank', 'rate', 'rate_special', 'created_at', 'created_by', 'updated_at', 'language', 'status'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            '_id' => Yii::t('services', 'ID'),
            'title' => Yii::t('services', 'Title'),
            'type' => Yii::t('services', 'Type'),
            'bank' => Yii::t('services', 'Bank'),
            'rate' => Yii::t('services', 'Rate'),
            'rate_special' => Yii::t('services', 'Rate special'),
            'created_at' => Yii::t('services', 'Created Date'),
            'created_by' => Yii::t('services', 'Created By'),
            'updated_at' => Yii::t('services', 'Updated Date'),
            'language' => Yii::t('services', 'Language'),
            'status' => Yii::t('services', 'Status'),
        ];
    }
}