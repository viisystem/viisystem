<?php

namespace app\packages\account\controllers\frontend;

use app\packages\account\models\LoginForm;
use yii\web\Controller;
use Yii;
use app\packages\account\models\User;
use yii\web\NotFoundHttpException;

class DefaultController extends Controller
{
    public function actionLogin()
    {
		if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
		
		$this->layout = '@app/themes/inspinia/frontend/layouts/login';
        Yii::$app->view->title = 'Đăng nhập hệ thống findbank.vn';
        return $this->render('login', [
            'model' => $model,
        ]);
	}

    public function actionRegister()
    {
        $model = new User();
        $model->scenario = 'register';

        $this->layout = '@app/themes/inspinia/frontend/layouts/login';
        Yii::$app->view->title = 'Đăng ký hệ thống findbank.vn';
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->user->login($model, 3600*24*30);
            return $this->redirect(['/account/frontend/default/infomation']);
        } else {
            return $this->render('register', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $_id
     * @return mixed
     */
    public function actionInfomation()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = $this->findModel(Yii::$app->user->id);
        $model->scenario = 'infomation';
        Yii::$app->view->title = 'Thông tin cá nhân';
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Sửa thông tin thành công');
        }

        return $this->render('infomation', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $_id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	public function actionLogout()
	{
		Yii::$app->user->logout();
        return $this->goHome();
	}
}