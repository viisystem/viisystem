<?php

namespace app\packages\services;

use yii\filters\AccessControl;

class Module extends \app\classes\Module
{
    public $controllerNamespace = 'app\packages\services\controllers';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow'=>true,
                        'matchCallback' => function($rule, $action) {
                            if(strpos($action->controller->id, 'frontend/') !== false)
                                return true;
                            return false;
                        }
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function init()
    {
        parent::init();
        \Yii::$app->formatter->nullDisplay = '';
    }
}
