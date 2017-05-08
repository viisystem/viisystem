<?php

namespace app\packages\account\models;

use Yii;
use yii\helpers\ArrayHelper;

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
	public $confirm_password;

	public $new_pass;

	public function attributeLabels()
	{
		return array_merge(parent::attributeLabels(),[
			'displayName' => Yii::t('account', 'Name'),
            'displayEmails' => Yii::t('account', 'Email'),
            'displayAddresses' => Yii::t('account', 'Address'),
            'confirm_password' => Yii::t('account', 'Confirm password'),
            'new_pass' => Yii::t('account', 'Password'),
		]);
	}

	public function attributes()
	{
		return array_merge(parent::attributes(),[
            'confirm_password'
		]);
	}

	public function rules()
	{
		return array_merge(parent::rules(),[
			[['username', 'password', 'confirm_password', 'phone'], 'required', 'on' => 'register'],
			['username', 'unique', 'message' => Yii::t('account', 'This username has already been taken.'), 'on' => 'register'],
            ['confirm_password', 'compare', 'compareAttribute'=>'password', 'message'=>Yii::t('account', "Passwords don't match"), 'on' => 'register'],  
            ['confirm_password', 'compare', 'compareAttribute'=>'new_pass', 'message'=>Yii::t('account', "Passwords don't match"), 'on' => 'infomation'],  
		]);
	}

	/**
     * @inheritdoc
     */
    public function scenarios()
    {
        return array_merge(parent::rules(),[
            'register' => ['username', 'password', 'name', 'birth_date', 'gender', 'emails', 'phone', 'addresses', 'description', 'source', 'source_id', 'auth_key', 'token', 'created_date', 'updated_date', 'last_login_datetime', 'data', 'confirm_password'],
            'default' => ['username', 'password', 'name', 'birth_date', 'gender', 'emails', 'phone', 'addresses', 'description', 'source', 'source_id', 'auth_key', 'token', 'created_date', 'updated_date', 'last_login_datetime', 'data', 'confirm_password', 'new_pass'],
            'infomation' => ['username', 'password', 'name', 'birth_date', 'gender', 'emails', 'phone', 'addresses', 'description', 'source', 'source_id', 'auth_key', 'token', 'created_date', 'updated_date', 'last_login_datetime', 'data', 'confirm_password', 'new_pass'],
//            'addrole' => ['name'],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if (!empty($this->new_pass)) {
                $this->password = Yii::$app->getSecurity()->generatePasswordHash($this->new_pass);
            }
            return true;
        }
        return false;
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

	public static function getDisplayNames() {
		$fullname = Yii::$app->user->identity->displayName;
		$email = Yii::$app->user->identity->displayEmails;
		$phone = Yii::$app->user->identity->phone;
		$displayName = null;

		if (!empty($fullname))
			$displayName = $fullname;
		else if (!empty($email))
			$displayName = $email;
		else
			$displayName = ArrayHelper::getValue($phone, 'mobile');

		return $displayName;
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
