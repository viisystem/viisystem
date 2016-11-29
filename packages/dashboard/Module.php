<?php

namespace app\packages\dashboard;
use yii\filters\AccessControl;

class Module extends \app\classes\Module
{
    public $controllerNamespace = 'app\packages\dashboard\controllers';
	
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

		// custom initialization code goes here
		\Yii::$app->formatter->nullDisplay = '';
    }
}