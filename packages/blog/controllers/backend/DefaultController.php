<?php

namespace app\packages\blog\controllers\backend;

use yii\web\Controller;
use Yii;


class DefaultController extends Controller
{
    public function actionIndex()
    {
        return $this->redirect(['/blog/blog']);
        //return $this->render('index');
    }
}
