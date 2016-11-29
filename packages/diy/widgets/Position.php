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
	
	public function init() {
		parent::init();
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
		return $str_widgets . \yii\helpers\Html::tag('div', '', $this->options);
	}
}