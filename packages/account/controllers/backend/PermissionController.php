<?php

namespace app\packages\account\controllers\backend;

use yii\web\Controller;
use Yii;

class PermissionController extends Controller
{
    public function actionIndex()
    {
		//$auth = Yii::$app->authManager;
		//$permission = $auth->createPermission('TEST');
		//$permission->description = "TEST DESCRIPTION";
		//$auth->add($permission);
		//echo 'ok';
        return $this->render('index');
    }
}
