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
            ['phone', 'validatePhone'],
            ['fullname', 'validateName'],
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

    public function validatePhone($attribute, $params, $validator)
    {
        $formatPhone = \vii\helpers\StringHelper::asPhone($this->$attribute);
        $firstPhone = substr($formatPhone, 0, 3);

        switch ($firstPhone) {
            case '841':
                if (strlen($formatPhone) < 12 OR strlen($formatPhone) > 12)
                    $this->addError($attribute, 'Số điện thoại phải có 11 số');

                break;

            case '848':
            case '849':
                if (strlen($formatPhone) < 11 OR strlen($formatPhone) > 11)
                    $this->addError($attribute, 'Số điện thoại phải có 10 số');

                break;
        }
    }

    public function validateName($attribute, $params, $validator)
    {
        $arrName = explode(" ", trim($this->$attribute));

        if (count($arrName) <= 1)
            $this->addError($attribute, 'Họ tên phải có khoảng cách');
    }
}