<?php

namespace app\packages\services\models;

use Yii;

class ServicesForm extends ServicesFormBase
{

    public function rules()
    {
        return [
            [['borrow_money', 'borrow_time', 'fullname', 'phone'], 'required'],
            [['borrow_money', 'borrow_time'], 'integer'],
            ['email', 'email'],
            ['phone', 'match', 'pattern' => '/^0\d{9,10}$/', 'message' => '{attribute} không đúng']
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            'default' => ['borrow_money', 'borrow_time', 'fullname', 'email', 'phone'],
        ];
    }
}