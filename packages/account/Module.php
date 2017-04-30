<?php

namespace app\packages\account;
use yii\filters\AccessControl;

class Module extends \app\classes\Module
{
    public $controllerNamespace = 'app\packages\account\controllers';
	
	public function behaviors()
    {
        return [
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					[
						// 'controllers'=>['account/backend/auth'],
						'allow'=>true,
						// 'matchCallback' => function($rule, $action) {
      //                       if(strpos($action->controller->id, 'frontend/') !== false)
      //                           return true;
      //                       return false;
      //                   }
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
	
	public function getModulePermissions()
	{
		return require (__DIR__ . '/permissions.php');
	}
}