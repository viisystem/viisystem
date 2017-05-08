<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Articles
 *
 * @author Phongnv
 */
namespace app\packages\article\widgets;

class Articles extends \app\packages\diy\widgets\Widget
{
	public function init()
	{
		parent::init();
		$this->settings['widget']['title'] = 'FEATURE POST';
		if(empty($this->settings['params']))
		{
			$this->settings['params'] = [
				[
					'name' => 'number_of_post',
					'value' => 4,
					'label' => 'Number of Post',
					'type' => 'text',
					'cols' => 12,
				],
				[
					'name' => 'type',
					'value' => 'promotion',
					'label' => 'Number of Post',
					'type' => 'text',
					'cols' => 12,
				],
				[
					'name' => 'view',
					'value' => 'article-post',
					'label' => 'Number of Post',
					'type' => 'text',
					'cols' => 12,
				],
			];
		}
	}

	public function run() {
		$str = '';
		
		$number_of_post = $this->getParam('number_of_post', 4); // Lấy giá trị của param trong db, nếu không có thì cho default là 3
		
		$type = $this->getParam('type', 'promotion'); // Lấy tin nổi bật hay tin mới
		
		$view = $this->getParam('view', 'article-post'); // Trang view

		$cacheKey = 'articles_list' . $type;
        $cache = \Yii::$app->cache->get($cacheKey);
        if (empty($cache)) {
        	$condition = ['status' => '1'];
        	if (!empty($type) AND 'promotion' == $type) {
        		$condition['is_promotion'] ='1';
        	}

			$cache = \app\packages\article\models\Article::find()
				->where($condition)
				->orderBy('_id DESC')
				->limit($number_of_post)
				->all();

			\Yii::$app->cache->set($cacheKey, $cache);
		}
		
		foreach($cache as $one)
		{
			$str .= $this->render($view,[
				'item' => $one,
			]);
		}
		
		return $str;
	}
}