<?php

namespace app\packages\dashboard\controllers\backend;

use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
		return $this->render('index');
    }
}
