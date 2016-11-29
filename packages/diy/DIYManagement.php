<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DIYManagement
 *
 * @author Minh
 */

namespace app\packages\diy;
use Yii;

class DIYManagement
{
	public static function AllDIYWidgets()
	{
		$result = [];
		foreach(Yii::$app->modules as $key=>$value)
		{
			$module = Yii::$app->getModule($key);
			if($module !== null)
			{
				try {
					$diys = $module->getDIYWidgets();
					if(is_array($diys)) {
						$result = array_merge($result, $diys);
					}
				}
				catch (yii\base\UnknownMethodException $e) { }
				catch(Exception $e) { }
			}
		}
		return $result;
	}
}
