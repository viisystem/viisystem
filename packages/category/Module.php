<?php

namespace app\packages\category;


class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\packages\category\controllers';
	
    public function init()
    {
        parent::init();

		// custom initialization code goes here
        \vii\assets\JurakitAsset::register(\Yii::$app->view);
    }
}
