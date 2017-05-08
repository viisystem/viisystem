<?php

namespace app\packages\article;
use vii\components\AccessControl;

class Module extends \app\classes\Module
{
    public $controllerNamespace = 'app\packages\article\controllers';

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
        return require(__DIR__ . '/permissions.php');
    }
	
	public function getDIYWidgets()
	{
		return require (__DIR__ . '/diywidgets.php');
	}
}
