<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FeaturePost
 *
 * @author Minh
 */
namespace app\packages\blog\widgets;

class FeaturePost extends \app\packages\diy\widgets\Widget
{
	public function init()
	{
		parent::init();
		$this->settings['widget']['title'] = 'FEATURE POST';
		if(count($this->settings['params']) <= 0) // Set cái này là để nếu không có load trong db thì mới lấy cái default ở trong
		{
			$this->settings['params'] = [
				[
					'name' => 'number_of_post',
					'value' => 3,
					'label' => 'Number of Post',
					'type' => 'text',
					'cols' => 12,
				],
			];
		}
	}
	
	public function getContent()
	{
		$str = '';
		
		$number_of_post = $this->getParam('number_of_post', 3); // Lấy giá trị của param trong db, nếu không có thì cho default là 3
		$query = \app\packages\blog\models\Blog::find();
		$query->limit = $number_of_post;
		$rows = $query->all();
		
		foreach($rows as $one)
		{
			$str .= $this->render('feature-post',[
				'item' => $one,
			]);
		}
		
		return $str;
	}
}