<?php

namespace app\classes;

class Module extends \yii\base\Module
{
    public function getModulePermissions()
	{
		return [];
	}
	
	public function getDIYWidgets()
	{
		return [];
	}
}