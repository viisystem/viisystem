<?php

namespace app\packages\setting\models;

use yii\mongodb\ActiveQuery;
use Yii;

class SettingQuery extends ActiveQuery
{

    public function init()
    {
        parent::init();

        /** @var $controller \app\packages\setting\controllers\backend\SettingController */
        $controller = Yii::$app->controller;

        $this->andWhere(['module' => $controller->settingModule]);
    }

//    public function active()
//    {
//        $this->andWhere(['module' => Yii::$app->controller->module->id]);
//
//        return $this;
//    }
}
