<?php

namespace app\packages\diy;
use yii\filters\AccessControl;

class Module extends \app\classes\Module
{
    public $controllerNamespace = 'app\packages\diy\controllers';
	
    public function init()
    {
        parent::init();

		// custom initialization code goes here
		\Yii::$app->formatter->nullDisplay = '';
    }
	
	public function getModulePermissions()
	{
		return require (__DIR__ . '/permissions.php');
	}
	
	public function getDIYWidgets()
	{
		return require (__DIR__ . '/diywidgets.php');
	}
}