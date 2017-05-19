<?php

namespace app\packages\services\models;

use Yii;
use vii\components\BitrixAPIConnect;


class CRMLeadBitrixAPI
{
    CONST LEAD_ADD_ACTION = 'crm.lead.add';

    CONST LEAD_DELETE_ACTION = 'crm.lead.delete';

    CONST LEAD_UPDATE_ACTION = 'crm.lead.update';

    private static $_instance = null;

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

    /**
     * Action add lead in CRM on bitrix
     * @param array $fields Field need add in aciton
     *
     * @throws InvalidConfigException
     * @return boolean
     */
    public function AddLeadCRM($fields) {
        $connection = BitrixAPIConnect::getInstance()->connection(self::LEAD_ADD_ACTION);

        return $this->CurlExec($connection, $this->formatFields($fields));
    }

    /**
     * Encode value fields and format array fields before send to api
     * @param array $fields Field need add in aciton
     *
     * @throws InvalidConfigException
     * @return array
     */
    private function formatFields($fields){
        if (!is_array($fields) OR empty($fields))
            return [];

        $arrField = [];
        foreach ($fields as $field => $value) {
            $arrField[] = $field . '=' .urlencode($value);
        }

        return $arrField;
    }

    /**
     * Action add lead in CRM on bitrix
     * @param string $connection Connection string
     * @param array $fields Field need add in aciton
     *
     * @throws InvalidConfigException
     * @return boolean|json
     */
    private function CurlExec($connection, $fields) {
        if (!is_array($fields) OR empty($fields))
            return false;

        $strGetFields = '&' . implode('&', $fields);

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, $connection . $strGetFields);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);

        if(!$response){
            die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
        }

        return $response;
    }
}
