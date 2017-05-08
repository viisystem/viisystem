<?php

namespace app\packages\banner;

use vii\components\AccessControl;

class Module extends \app\classes\Module
{
    public $controllerNamespace = 'app\packages\banner\controllers';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
            ],
        ];
    }

    public function getModulePermissions()
    {
        return require(__DIR__ . '/permissions.php');
    }

    public function init()
    {
        parent::init();
        \Yii::$app->formatter->nullDisplay = '';
    }
}
