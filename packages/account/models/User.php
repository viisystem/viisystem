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
class User extends UserBase implements \yii\web\IdentityInterface
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
	
	public static function findIdentity($id)
	{
		return static::findOne($id);
	}
	
	/**
	* @inheritdoc
	*/
	public static function findIdentityByAccessToken($token, $type = null)
	{
		return static::findOne(['access_token' => $token]);
		//throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
	}
	
	/**
	* Finds user by username
	*
	* @param  string      $username
	* @return static|null
	*/
	public static function findByUsername($username)
	{
		return static::findOne(['username' => $username]);
	}
	
	public function getId()
	{
		return $this->getPrimaryKey()->__toString();
	}
	
	/**
	* @inheritdoc
	*/
	public function getAuthKey()
	{
		return $this->auth_key;
	}

	/**
	* @inheritdoc
	*/
	public function validateAuthKey($authKey)
	{
		return $this->auth_key === $authKey;
	}
	
	public function validatePassword($password)
	{
		try
		{
			$pass = $this->password;
			return Yii::$app->security->validatePassword($password, $this->password);
		}
		catch (\Exception $ex)
		{
			$user = User::findByUsername($this->username);
			if($user != null)
			{
				$user->password = Yii::$app->security->generatePasswordHash($user->password);
				$this->password = $user->password;
				$user->save();
			}
		}
		return Yii::$app->security->validatePassword($password, $this->password);
	}
	
	/**
	* Generates password hash from password and sets it to the model
	*
	* @param string $password
	*/
	public function setPassword($password)
	{
		//$this->password = \yii\helpers\Security::generatePasswordHash($password);
		$this->password = $password;
	}

	/**
	* Generates "remember me" authentication key
	*/
	public function generateAuthKey()
	{
		$this->auth_key = Yii::$app->security->generateRandomString(); // Security::generateRandomKey();
	}

	/**
	* Generates new password reset token
	*/
	public function generatePasswordResetToken()
	{
		$this->password_reset_token = Security::generateRandomKey() . '_' . time();
	}

	/**
	* Removes password reset token
	*/
	public function removePasswordResetToken()
	{
		$this->password_reset_token = null;
	}
}
