<?php

namespace app\packages\account\models;

use Yii;

/**
 * This is the model class for collection "user".
 *
 * @property \MongoDB\BSON\ObjectID|string $_id
 * @property mixed $username
 * @property mixed $password
 * @property mixed $name
 * @property mixed $birth_date
 * @property mixed $gender
 * @property mixed $emails
 * @property mixed $addresses
 * @property mixed $description
 * @property mixed $source
 * @property mixed $source_id
 * @property mixed $auth_key
 * @property mixed $token
 * @property mixed $created_date
 * @property mixed $updated_date
 * @property mixed $last_login_datetime
 * @property mixed $data
 */
class UserBase extends \yii\mongodb\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function collectionName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return [
            '_id',
            'username',
            'password',
            'name',
            'birth_date',
            'gender',
            'emails',
			'phone',
            'addresses',
            'description',
            'source',
            'source_id',
            'auth_key',
            'token',
            'created_date',
            'updated_date',
            'last_login_datetime',
            'data',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'name', 'birth_date', 'gender', 'emails', 'phone', 'addresses', 'description', 'source', 'source_id', 'auth_key', 'token', 'created_date', 'updated_date', 'last_login_datetime', 'data'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            '_id' => Yii::t('account', 'ID'),
            'username' => Yii::t('account', 'Username'),
            'password' => Yii::t('account', 'Password'),
            'name' => Yii::t('account', 'Name'),
            'birth_date' => Yii::t('account', 'Birth Date'),
            'gender' => Yii::t('account', 'Gender'),
            'emails' => Yii::t('account', 'Emails'),
			'phone' => Yii::t('account', 'Phone'),
            'addresses' => Yii::t('account', 'Addresses'),
            'description' => Yii::t('account', 'Description'),
            'source' => Yii::t('account', 'Source'),
            'source_id' => Yii::t('account', 'Source ID'),
            'auth_key' => Yii::t('account', 'Auth Key'),
            'token' => Yii::t('account', 'Token'),
            'created_date' => Yii::t('account', 'Created Date'),
            'updated_date' => Yii::t('account', 'Updated Date'),
            'last_login_datetime' => Yii::t('account', 'Last Login Datetime'),
            'data' => Yii::t('account', 'Data'),
        ];
    }
}