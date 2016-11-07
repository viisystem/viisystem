<?php

namespace app\packages\blog;


class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\packages\blog\controllers';
	
    public function init()
    {
        parent::init();

		// custom initialization code goes here
        \vii\assets\JurakitAsset::register(\Yii::$app->view);
    }
}
