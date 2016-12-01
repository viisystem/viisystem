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
	];
	
	public function init()
	{
		parent::init();
		$this->settings['widget']['class'] = self::className();
		\app\packages\diy\widgets\bundles\DIYAsset::register($this->getView());
	}

	// Hàm này dùng để trả về cái draggable icon. Cái icon này nằm ở thanh sidebar, user sẽ kéo thả vào giao diện
	public function getDraggableIcon()
	{
		return $this->render('widget-icon', [
			'settings' => $this->settings,
			'page' => \Yii::$app->controller->id . '/' . \Yii::$app->controller->action->id,
		]);
	}

	// Sẽ trả về cái html+javascript để display lên cái form setting. Ở trang frontend thì sẽ cho cái form này display lên bằng cái jquery dialog hoặc bootstrap dialog. Thay đổi gì trong form setting này rồi nhấn save thì widget sẽ lưu vào db.
	// Ví dụ trong db sẽ lưu thông số là {widget:"vii\widgets\Article", position:1234, settings:{items_per_page:5, title:...}}
	public function getSettingForm()
	{
		
	}

	// Hàm này là để display widget sau khi kéo thả. Khi thả widget vào layout thì hàm này sẽ render 1 cái box, phần nội dung bên trong thì do hàm widget() trả về, nghĩa là sẽ hiển thị như frontend. Và title cái box sẽ hiển thị icon setting, icon setting này sẽ có cái link, click vào thì lên dialog cho hiện lên cái getSettingForm
	public function getSettingBar()
	{
		
	}
	
	// Hàm này sẽ trả về nội dung hiển thị
	public function getContent()
	{
		return '';
	}
}
