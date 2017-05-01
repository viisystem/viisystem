<?php

namespace app\packages\dashboard\controllers\frontend;

use yii\web\Controller;
use Yii;

class SearchController extends Controller
{
    public function actionIndex($keyword)
    {
    	$strKeyword = (!empty($keyword)) ? ' từ khóa: ' . $keyword : null;
    	Yii::$app->view->title = 'Kết quả tìm kiếm' . $strKeyword;
        return $this->render('index', [
        	'keyword' => $keyword
        ]);
    }
}
