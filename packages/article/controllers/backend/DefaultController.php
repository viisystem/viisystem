<?php

namespace app\packages\article\controllers\backend;

use yii\web\Controller;
use Yii;


class DefaultController extends Controller
{
    public function actionIndex()
    {
        return $this->redirect(['/article/article']);
        //return $this->render('index');
    }
}
