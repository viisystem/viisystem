<?php

namespace app\packages\account\controllers\backend;

use yii\web\Controller;

class PermissionController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
