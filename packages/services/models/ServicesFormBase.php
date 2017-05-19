<?php

namespace app\packages\services\models;

use Yii;

/**
 * This is the model class for collection "services_form".
 *
 * @property \MongoDB\BSON\ObjectID|string $_id
 * @property mixed $borrow_money
 * @property mixed $borrow_time
 * @property mixed $salary
 * @property mixed $fullname
 * @property mixed $email
 * @property mixed $phone
 * @property mixed $status
 */
class ServicesFormBase extends \vii\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function collectionName()
    {
        return 'services_form';
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return [
            '_id',
            'borrow_money',
            'borrow_time',
            'salary',
            'fullname',
            'email',
            'phone',
            'status',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['borrow_money', 'borrow_time', 'salary', 'fullname', 'email', 'phone', 'status'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'borrow_money' => Yii::t('services', 'Borrow Money'),
            'borrow_time' => Yii::t('services', 'Borrow Time'),
            'salary' => Yii::t('services', 'Salary'),
            'fullname' => Yii::t('services', 'Full Name'),
            'phone' => Yii::t('services', 'Phone'),
            'email' => Yii::t('services', 'Email'),
            'status' => Yii::t('services', 'Status'),
        ];
    }
}