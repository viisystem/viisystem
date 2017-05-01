<?php

namespace app\packages\dashboard\controllers\frontend;

use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
    	\Yii::$app->view->title = 'Findbank.vn';
        return $this->render('index');
    }
}
