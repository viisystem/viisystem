<?php

namespace app\packages\setting;


class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\packages\setting\controllers';
	
    public function init()
    {
        parent::init();

		// custom initialization code goes here
        \vii\assets\JurakitAsset::register(\Yii::$app->view);
    }
}
