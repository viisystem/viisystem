<?php

namespace app\packages\blog\controllers\backend;

use yii\web\Controller;
use Yii;


class DefaultController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
