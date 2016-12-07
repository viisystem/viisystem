<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProcessController
 *
 * @author Minh
 */
namespace app\packages\diy\controllers\backend;

use yii\web\Controller;

class ProcessController extends Controller
{
	public function actionGetSetting($data)
	{
		
	}
	
    public function actionGetContent($data)
    {
		$json = urldecode($data);
		$result = \yii\helpers\Json::decode($json);
		$widget = new $result['widget']['class']([
			'settings' => $result,
		]);
		echo $widget->getContent(); 
    }
	
	public function actionSaveWidget($page = null, $position = null, $widgets = null)
	{
		if($page == null)
		{
			$page = \Yii::$app->request->post('page');
			$position = \Yii::$app->request->post('position');
			$widgets = \Yii::$app->request->post('widgets');
		}
		$str_page = urldecode($page);
		$str_position = urldecode($position);
		$json = urldecode($widgets);
		$results = \yii\helpers\Json::decode($json);
		
		$model = \app\packages\diy\models\DiyStorage::findOne(['page'=>$str_page, 'position'=>$str_position]);
		if($model != null)
		{
			$model->settings = $results;
			$model->save();
		}
		else
		{
			$model = new \app\packages\diy\models\DiyStorage();
			$model->page = $str_page;
			$model->position = $str_position;
			$model->settings = $results;
			$model->save();
		}
		echo 'saved!';
	}
}
