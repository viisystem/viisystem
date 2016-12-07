<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Widget
 *
 * @author Minh
 */
namespace app\packages\diy\widgets;

class Widget extends \yii\base\Widget
{
	// Đây là các thuộc tính mà widget sẽ dùng cho render cho enduser, và cũng là để hiển thị form settings
	public $settings = [
		'widget' => [
			'icon' => null,
			'title' => 'DIY Widget',
			'description' => 'Description',
		],
		'params' => [
			
		],
	];
	
	public function init()
	{
		parent::init();
		$this->settings['widget']['class'] = self::className();
		\app\packages\diy\bundles\DIYAsset::register($this->getView());
	}

	// Hàm này dùng để trả về cái draggable icon. Cái icon này nằm ở thanh sidebar, user sẽ kéo thả vào giao diện
	public function getDraggableIcon()
	{
		return $this->render('@app/packages/diy/widgets/views/widget-icon', [
			'settings' => $this->settings,
			'page' => \Yii::$app->controller->id . '/' . \Yii::$app->controller->action->id,
		]);
	}
	
	// Hàm này sẽ trả về nội dung hiển thị
	public function getContent()
	{
		return '';
	}
	
	public function getParam($name, $default = null)
	{
		$params = $this->settings['params'];
		foreach($params as $one){
			if($one['name'] == $name) {
				if(key_exists('value', $one)) {
					return $one['value'];
				}
				else {
					return $default;
				}
			}
		}
	}
}
