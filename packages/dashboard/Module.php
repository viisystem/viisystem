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