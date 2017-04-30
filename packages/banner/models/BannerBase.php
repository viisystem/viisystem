<?php

namespace app\packages\banner\models;

use Yii;

/**
 * This is the model class for collection "banner".
 *
 * @property \MongoDB\BSON\ObjectID|string $_id
 * @property mixed $title
 * @property mixed $link
 * @property mixed $target
 * @property mixed $image
 * @property mixed $started_date
 * @property mixed $sort
 * @property mixed $ended_date
 * @property mixed $created_at
 * @property mixed $created_by
 * @property mixed $updated_at
 * @property mixed $language
 * @property mixed $status
 */
class BannerBase extends \vii\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function collectionName()
    {
        return 'banner';
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return [
            '_id',
            'title',
            'link',
            'target',
            'image',
            'started_date',
            'sort',
            'ended_date',
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
            [['title', 'link', 'target', 'image', 'started_date', 'sort', 'ended_date', 'created_at', 'created_by', 'updated_at', 'language', 'status'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            '_id' => Yii::t('banner', 'ID'),
            'title' => Yii::t('banner', 'Title'),
            'link' => Yii::t('banner', 'Link'),
            'target' => Yii::t('banner', 'Target'),
            'image' => Yii::t('banner', 'Image'),
            'image_form' => Yii::t('banner', 'Image Form'),
            'started_date' => Yii::t('banner', 'Started date'),
            'sort' => Yii::t('banner', 'Sort'),
            'ended_date' => Yii::t('banner', 'Ended date'),
            'created_at' => Yii::t('banner', 'Created Date'),
            'created_by' => Yii::t('banner', 'Created By'),
            'updated_at' => Yii::t('banner', 'Updated Date'),
            'language' => Yii::t('banner', 'Language'),
            'status' => Yii::t('banner', 'Status'),
        ];
    }
}