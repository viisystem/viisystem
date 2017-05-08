<?php

namespace app\packages\account;
use vii\components\AccessControl;

class Module extends \app\classes\Module
{
    public $controllerNamespace = 'app\packages\account\controllers';
	
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
		\Yii::$app->formatter->nullDisplay = '';
    }
	
	public function getModulePermissions()
	{
		return require (__DIR__ . '/permissions.php');
	}
}