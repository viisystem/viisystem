<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Position
 *
 * @author Minh
 */
namespace app\packages\diy\widgets;

class Position extends \yii\base\Widget
{
	// Dùng chính thuộc tính html id của widget làm id của position
	public $options = [];
	public static $widgets = null;
	
	public function init()
	{
		parent::init();
		if(!isset($this->options['id'])) { $this->options['id'] = $this->getId(); }
		\app\packages\diy\widgets\bundles\DIYAsset::register($this->getView());
	}

	public function run() {
		$str_widgets = '';
		if(self::$widgets === null)
		{
			$str_widgets = '<div style="" class="diy-tool-bar"><div class="diy-tool-bar-title">Widgets</div><div style="padding: 4px 10px 4px 10px;">';
			$widgets = \app\packages\diy\DIYManagement::AllDIYWidgets();
			foreach($widgets as $widget)
			{
				$obj = new $widget();
				$str_widgets .= $obj->getDraggableIcon();
			}
			$str_widgets .= '</div></div>';
			self::$widgets = $str_widgets;
		}
		
		// Render storage widgets
		$str_render = '';
		$storage = \app\packages\diy\models\DiyStorage::findOne([
			'page' => \Yii::$app->controller->id . '/' . \Yii::$app->controller->action->id,
			'position' => $this->options['id'],
		]);
		if($storage != null)
		{
			if(!empty($storage->settings) && is_array($storage->settings))
			{
				foreach ($storage->settings as $one)
				{
					$widget = new $one['widget']['class']([
						'settings' => $one
					]);
					$str_render .= $widget->getContent();
				}
			}
		}
		/////////////////////////////////////////////////////////////////////////
		
		return $str_widgets . \yii\helpers\Html::tag('div', '', $this->options);
	}
}