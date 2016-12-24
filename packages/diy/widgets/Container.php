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

class Container extends \yii\base\Widget
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
		
		// Check mode by request
		$this->mode = (!empty(\Yii::$app->request->get('diy')) ? (int)\Yii::$app->request->get('diy') : self::MODE_VIEW);
		
		if(\Yii::$app->user->can('diy.admin'))
		{
			\app\packages\diy\bundles\DIYAsset::register($this->getView());
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
			'page' => \Yii::$app->controller->id . '/' . \Yii::$app->controller->action->id
		]);
		if($storage != null)
		{
			$str_render = $storage->template;
			if($this->mode === self::MODE_VIEW)
			{
				$str_render = str_replace(['diy-row-header', 'diy-row', 'diy-col', 'diy-container'], ['hidden','','',''], $str_render);
			}
			if(!empty($storage->positions) && is_array($storage->positions))
			{
				foreach ($storage->positions as $one)
				{
					$str_position = '';
					foreach($one['widgets'] as $wid)
					{
						if(class_exists($wid['widget']['class'])) {
							$widgetCtrl = new $wid['widget']['class']([
								'settings' => $wid
							]);
							if($this->mode === self::MODE_DRAG)
							{
								$str_position .= $this->render('widget-loaded',[
									'settings' => $wid,
									'page' => $storage->page,
									'content' => $widgetCtrl->getContent(),
								]);
							}
							else
							{
								$str_position .=  $widgetCtrl->getContent();
							}
						}
					}
					$class = "diy-dropable";
					if($this->mode === self::MODE_VIEW) { $class = "diy-dropable-dsp"; }
					$str_render = str_replace('{{' . $one['position'] . '}}',
						'<div id="'.$one['position'].'" class="'.$class.'">' . $str_position . '</div>',
					$str_render);
				}
			}
		}
		/////////////////////////////////////////////////////////////////////////
		return $this->renderWidgetToolbar() . $this->render('container',[
			'content' => $str_render,
			'mode' => $this->mode,
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