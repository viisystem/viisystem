<?php

namespace app\packages\blog;

use yii\filters\AccessControl;

class Module extends \app\classes\Module
{
    public $controllerNamespace = 'app\packages\blog\controllers';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
//                    [
//                        'controllers' => ['account/backend/auth'],
//                        'allow' => true,
//                    ],
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

    public function getModulePermissions()
    {
        return require(__DIR__ . '/permissions.php');
    }
	
	public function getDIYWidgets()
	{
		return require (__DIR__ . '/diywidgets.php');
	}
}
