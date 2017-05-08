<?php

namespace app\packages\contact\models;

use Yii;
use DateTime;


class Contact extends ContactBase
{

    private static $_instance = null;

    /**
     * @var string
     */
    public $captcha;

    /**
     * @return \app\packages\contact\models\Contact
     */
    public static function getInstance()
    {
        if (null === static::$_instance) {
            static::$_instance = new static();
        }

        return static::$_instance;
    }

    public function rules()
    {
        return [
            [['fullname', 'phone', 'content'], 'required'],
            [['email'], 'email'],
            [['captcha'], 'required'],
            [['captcha'], 'captcha', 'captchaAction'=>'/contact/frontend/default/captcha'],
            [['content'], 'string', 'min' => 10],
            [['content'], 'string', 'min' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            'default' => ['fullname', 'email', 'phone', 'content', 'created_at', 'updated_at', 'captcha'],
        ];
    }

    public function setDefaultValues()
    {
        $this->language = Yii::$app->params['languageDefault'];
    }

}
