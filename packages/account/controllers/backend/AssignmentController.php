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
		$return = [];
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		
		$auth = \Yii::$app->authManager;
		$model_role = $auth->getRole($role);
		$model_user = \app\packages\account\models\User::findIdentity($user);
		if($model_role != null && $model_user != null)
		{
			$auth->assign($model_role, (string)$model_user->getId());
			$return['success'] = true;
			$return['result'] = $role;
			$return['uid'] = (string)$model_user->getId();
			$return['other'] = $auth->getRolesByUser((string)$model_user->getId());
		}
		else
		{
			$return['success'] = false;
		}
		return $return;
	}
}
