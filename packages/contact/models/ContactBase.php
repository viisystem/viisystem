<?php

namespace app\packages\contact\models;

use Yii;

/**
 * This is the model class for collection "contact".
 *
 * @property \MongoDB\BSON\ObjectID|string $_id
 * @property mixed $fullname
 * @property mixed $email
 * @property mixed $phone
 * @property mixed $content
 * @property mixed $created_at
 * @property mixed $updated_at
 * @property mixed $language
 */
class ContactBase extends \vii\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function collectionName()
    {
        return 'contact';
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return [
            '_id',
            'fullname',
            'email',
            'phone',
            'content',
            'created_at',
            'updated_at',
            'language',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fullname', 'email', 'phone', 'content', 'created_at', 'updated_at', 'language'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            '_id' => Yii::t('contact', 'ID'),
            'fullname' => Yii::t('contact', 'Fullname'),
            'email' => Yii::t('contact', 'Email'),
            'phone' => Yii::t('contact', 'Phone'),
            'content' => Yii::t('contact', 'Content'),
            'created_at' => Yii::t('contact', 'Created Date'),
            'updated_at' => Yii::t('contact', 'Updated Date'),
            'language' => Yii::t('contact', 'Language'),
        ];
    }
}