<?php

namespace app\packages\account\controllers\backend;

use app\packages\account\models\LoginForm;
use yii\web\Controller;
use Yii;

class LoginController extends Controller
{
    public function actionIndex()
    {
		if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
		$this->layout = '@app/themes/inspinia/backend/layouts/login';
        return $this->render('login', [
            'model' => $model,
        ]);
	}
	
	public function actionLogout()
	{
		Yii::$app->user->logout();
        return $this->goHome();
	}
}