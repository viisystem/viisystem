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
 * @property mixed $auth_key
 * @property mixed $token
 * @property mixed $created_date
 * @property mixed $updated_date
 * @property mixed $last_login_datetime
 * @property mixed $data
 */
class User extends UserBase
{
	public function attributeLabels()
	{
		return array_merge(parent::attributeLabels(),[
			'displayName' => Yii::t('account', 'Name'),
            'displayEmails' => Yii::t('account', 'Email'),
            'displayAddresses' => Yii::t('account', 'Address'),
		]);
	}
	
	public function getDisplayName()
	{
		if(is_array($this->name))
		{
			return implode(' ', $this->name);
		}
		else if(is_string($this->name))
		{
			return $this->name;
		}
		return null;
	}
	
	public function getDisplayEmails()
	{
		if(is_array($this->emails))
		{
			$str = '';
			foreach($this->emails as $i=>$one)
			{
				$str .= implode(', ', $one);
			}
			return $str;
		}
		else if(is_string($this->emails))
		{
			return $this->emails;
		}
		return null;
	}
	
	public function getDisplayAddresses()
	{
		if(is_array($this->addresses))
		{
			$str = '';
			foreach($this->addresses as $i=>$one)
			{
				$str .= implode(', ', array_filter($one));
			}
			return $str;
		}
		else if(is_string($this->addresses))
		{
			return $this->addresses;
		}
		return null;
	}
}
