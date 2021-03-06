<?php

namespace app\packages\services\models;

use Yii;
use DateTime;


class Services extends ServicesBase
{
    CONST TYPE_CAR = 'buycar';

    CONST TYPE_HOUSE = 'buyhouse';

    CONST TYPE_CREDIT_CARD = 'creditcard';

    CONST TYPE_CONSUMER_CREDIT = 'consumercredit';

    private static $_instance = null;

    public $moduleName = 'services';

    public $arrType;

    function __construct() {
        $this->arrType = [
            self::TYPE_CAR => Yii::t('services', 'Borrow buy car'),
            self::TYPE_HOUSE => Yii::t('services', 'Borrow buy house'),
            self::TYPE_CREDIT_CARD => Yii::t('services', 'Creadit card'),
            self::TYPE_CONSUMER_CREDIT => Yii::t('services', 'Consumer creadit'),
        ];
    }

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
            [['title', 'type', 'bank'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            'default' => ['title', 'type', 'bank', 'rate', 'rate_special', 'created_at', 'created_by', 'updated_at', 'language', 'status', 'data_creadit'],
        ];
    }

    public function setDefaultValues()
    {
        $this->language = Yii::$app->params['languageDefault'];

        $this->status = '1';
    }

}
