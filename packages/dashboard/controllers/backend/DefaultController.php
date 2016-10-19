<?php

namespace app\packages\dashboard\controllers\backend;

use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        //echo \yii\helpers\Url::to(['/account/backend/default/index']);
		return $this->render('index');
    }
}
