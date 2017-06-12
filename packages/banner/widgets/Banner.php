<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Banner
 *
 * @author Phongnv
 */
namespace app\packages\banner\widgets;

class Banner extends \app\packages\diy\widgets\Widget
{
	public function init()
	{
		parent::init();
		$this->settings['widget']['title'] = 'Banner';
		if(empty($this->settings['params']))
		{
			$this->settings['params'] = [
				[
					'name' => 'number_of_post',
					'value' => 10,
					'label' => 'Number of Post',
					'type' => 'text',
					'cols' => 12,
				],
			];
		}
	}

	public function run() {
		$str = '';
		
		$number_of_post = $this->getParam('number_of_post', 10); // Lấy giá trị của param trong db, nếu không có thì cho default là 3

		$cacheKey = 'banner_list';
        $cache = \Yii::$app->cache->get($cacheKey);
        // if (empty($cache)) {
			$cache = \app\packages\banner\models\Banner::find()
				->where(['status' => '1'])
				->orderBy('sort ASC')
				->limit($number_of_post)
				->all();

			\Yii::$app->cache->set($cacheKey, $cache);
		// }
		
		foreach($cache as $one)
		{
			$str .= $this->render('banner-post',[
				'item' => $one,
			]);
		}
		
		return $str;
	}
}