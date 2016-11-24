<?php

namespace app\packages\account\controllers\backend;

use yii\web\Controller;

class AssignmentController extends Controller
{
    public function actionIndex($user)
    {
        return $this->renderPartial('assignment', [
			'user' => $user,
		]);
    }
	
	public function actionSetRole($user, $role, $checked)
	{
		
	}
}
