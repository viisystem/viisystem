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

use app\packages\category\models\Category;

class FeatureArticle extends \app\packages\diy\widgets\Widget
{
	public function init()
	{
		parent::init();
		$this->settings['widget']['title'] = 'FEATURE ARTICLE';
		if(empty($this->settings['params']))
		{
			$this->settings['params'] = [
				[
					'name' => 'number_of_post',
					'value' => 2,
					'label' => 'Number of Post',
					'type' => 'text',
					'cols' => 12,
				],
				[
					'name' => 'view',
					'value' => 'article_feature',
					'label' => 'offset_of_post of Post',
					'type' => 'text',
					'cols' => 12,
				],
				[
					'name' => 'tags_id',
					'value' => '',
					'label' => 'offset_of_post of Post',
					'type' => 'text',
					'cols' => 12,
				],
				[
					'name' => 'type',
					'value' => '',
					'label' => 'offset_of_post of Post',
					'type' => 'text',
					'cols' => 12,
				],
				[
					'name' => 'category_id',
					'value' => '',
					'label' => 'offset_of_post of Post',
					'type' => 'text',
					'cols' => 12,
				],
				[
					'name' => 'post_id',
					'value' => '',
					'label' => 'offset_of_post of Post',
					'type' => 'text',
					'cols' => 12,
				],
			];
		}
	}

	public function run() {
		$str = '';

		$number_of_post = $this->getParam('number_of_post', 2); // Lấy giá trị của param trong db, nếu không có thì cho default là 3

		$view = $this->getParam('view', 'article_feature'); // Trang view
		
		$tags_id = $this->getParam('tags_id', '');
		
		$category_id = $this->getParam('category_id', '');
		
		$type = $this->getParam('type', 'category');
		
		$post_id = $this->getParam('post_id');

		$cacheKey = 'articles_feature_' . $post_id . $type;
        $cache = \Yii::$app->cache->get($cacheKey);
        if (empty($cache)) {
        	$arrCondition = ['status' => '1', $type => $category_id];

        	if (!empty($tags_id))
        		$arrCondition = ['status' => '1', $type => $tags_id];

        	if (!empty($post_id))
        		$arrCondition = array_merge($arrCondition, ['_id' => ['$ne' => $post_id]]);

			$model = \app\packages\article\models\Article::find()
				->where($arrCondition)
				->orderBy('_id DESC')
				->limit($number_of_post)
				->all();

			$cache = [
				'item' => $model,
			];

			\Yii::$app->cache->set($cacheKey, $cache);
		}
		
		if (isset($cache['item'])) {
			foreach($cache['item'] as $one)
			{
				$assign = $cache;
				$assign['item'] = $one;
				$str .= $this->render($view, $assign);
			}
		}
		
		return $str;
	}
}