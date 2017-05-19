<?php

namespace app\packages\services\models;

use Yii;

class ServicesForm extends ServicesFormBase
{
    public $moduleName = 'services';
    
    public function rules()
    {
        return [
            [['borrow_money', 'borrow_time', 'fullname', 'phone'], 'required', 'on' => 'borrow'],
            [['salary', 'fullname', 'phone'], 'required', 'on' => 'borrow_salary'],
            [['fullname', 'phone'], 'safe', 'on' => 'noborrow'],
            [['borrow_money', 'borrow_time', 'salary', 'status'], 'integer'],
            ['email', 'email'],
            ['phone', 'match', 'pattern' => '/^0\d{9,10}$/', 'message' => '{attribute} không đúng'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            'default' => ['borrow_money', 'borrow_time', 'fullname', 'email', 'phone', 'salary', 'status'],
            'noborrow' => ['borrow_money', 'borrow_time', 'fullname', 'email', 'phone', 'status'],
            'borrow' => ['borrow_money', 'borrow_time', 'fullname', 'email', 'phone', 'status'],
            'borrow_salary' => ['salary', 'fullname', 'email', 'phone', 'status'],
        ];
    }
}