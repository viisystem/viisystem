<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use Yii;
use yii\console\Controller;
use yii\helpers\ArrayHelper;
use app\packages\services\models\ServicesForm;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class PushDataBitrixController extends Controller {

    public function actionIndex() {
        $rowPerPage = 100;
        $index = 0;
        for ($i=0; $i < 1000; $i++) { 
            $model = ServicesForm::find()->limit($rowPerPage)->offset($i * $rowPerPage)->where(['status' => 0])->all();

            foreach ($model as $item) {
                $fields = [
                    'fields[NAME]' => $item->fullname,
                    'fields[TITLE]' => $item->fullname,
                    'fields[LFM[EMAIL][n1][VALUE]]' => $item->email,
                    'fields[LFM[PHONE][n1][VALUE]]' => $item->phone,
                ];

                // Add lead crm with infomation input user when save success infomation user
                CRMLeadBitrixAPI::getInstance()->AddLeadCRM($fields);

                echo $index . ': ' . $item->_id . ' - ' . $item->fullname;

                $index++;

                $model->status = 1;
                $model->save();
            }
        }
    }

}
