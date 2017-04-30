<?php

namespace app\packages\article\controllers\frontend;

use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        echo 'Frontend';
    }

    public function actionContact() {
    	return $this->render('contact');
    }
}
