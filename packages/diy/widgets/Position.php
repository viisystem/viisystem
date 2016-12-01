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
	const MODE_DRAG = 1;
	const MODE_VIEW = 0;
	
	// Dùng chính thuộc tính html id của widget làm id của position
	public $options = [];
	public $mode = self::MODE_VIEW;
	public static $widgets = null;
	
	public function init()
	{
		parent::init();
		
		if(!isset($this->options['id']))
		{
			$this->options['id'] = $this->getId();
		}
		
		if(\Yii::$app->user->can('diy.admin'))
		{
			\app\packages\diy\widgets\bundles\DIYAsset::register($this->getView());
		}
		else
		{
			$this->mode = self::MODE_VIEW;
		}
	}

	public function run()
	{
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
					if($this->mode === self::MODE_DRAG)
					{
						$str_render .= $this->render('widget-loaded',[
							'settings' => $one,
							'page' => $storage->page,
							'content' => $widget->getContent(),
						]);
					}
					else
					{
						$str_render .=  $widget->getContent();
					}
				}
			}
		}
		/////////////////////////////////////////////////////////////////////////
		return $this->renderWidgetToolbar() . $this->render('position',[
			'options' => $this->options,
			'content' => $str_render,
			'mode' => $this->mode
		]);
		
		//\yii\helpers\Html::tag('div', $str_render, $this->options);
	}
	
	private function renderWidgetToolbar()
	{
		if(self::$widgets === null)
		{
			if(\Yii::$app->user->can('diy.admin'))
			{
				if($this->mode == Position::MODE_DRAG)
				{
					self::$widgets = $this->render('widget-toolbar');
				}
				else
				{
					self::$widgets = $this->render('edit-button');
				}
			}
			else
			{
				self::$widgets = '';
			}
			return self::$widgets;
		}
		return '';
	}
}