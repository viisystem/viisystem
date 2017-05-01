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

use Yii;

class ArticlesSearch extends \app\packages\diy\widgets\Widget
{
	public $keyword;

	public $view = 'articles_search';

	public $limit = 20;

	public function init()
	{
		parent::init();
	}

	public function run() {
		$searchModel = new \app\packages\article\models\ArticleSearch();
        $searchModel->keyword = $this->keyword;
        $dataProvider = $searchModel->searchFrontend(Yii::$app->request->queryParams, $this->limit);

        return $this->render($this->view, [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'viewFile' => $this->view
        ]);
	}
}