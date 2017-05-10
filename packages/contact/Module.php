<?php

namespace app\packages\contact;
use vii\components\AccessControl;

class Module extends \app\classes\Module
{
    public $controllerNamespace = 'app\packages\contact\controllers';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
            ],
        ];
    }
	
    public function init()
    {
        parent::init();

		// custom initialization code goes here
		\Yii::$app->formatter->nullDisplay = '';
    }

    public function getModulePermissions()
    {
        return require(__DIR__ . '/permissions.php');
    }
}