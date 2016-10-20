<?php

namespace app\packages\article;
use yii\filters\AccessControl;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\packages\article\controllers';
	
    public function init()
    {
        parent::init();

		// custom initialization code goes here
		\Yii::$app->formatter->nullDisplay = '';
    }
}