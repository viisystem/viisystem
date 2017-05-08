<?php

namespace app\packages\account\controllers\frontend;

use app\packages\account\models\LoginForm;
use yii\web\Controller;
use Yii;
use app\packages\account\models\User;
use yii\web\NotFoundHttpException;
use vii\helpers\ArrayHelper;
use MongoId;

class DefaultController extends Controller
{
    public function actions()
    {
        return [
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'onAuthSuccess'],
            ],
        ];
    }

    public function onAuthSuccess($client)
    {
        $attributes = $client->getUserAttributes();
        $fullname = ArrayHelper::getValue($attributes, 'name');
        $email = ArrayHelper::getValue($attributes, 'email');
        $id = ArrayHelper::getValue($attributes, 'id');

        $model = User::find()->where(['source_id' => $id])->one();
        if (!empty($model)){
            $login = Yii::$app->user->login($model, 3600*24*30);
            // if ($login)
            //     $this->goBack();
        } else {
            $model = new User;
            $model->source_id = $id;
            $model->source = $client->getName();
            $model->username = $email;
            $model->emails = [
                [
                    'address' => $email
                ]
            ];

            $name = explode(' ', $fullname);
            $fisrtName = ArrayHelper::getValue($name, 0);
            $middleName = ArrayHelper::getValue($name, 1);
            $lastName = ArrayHelper::getValue($name, 2);

            $model->name = [
                'first' => $fisrtName,
                'middle' => $middleName,
                'last' => $lastName,
            ];

            $saveUser = $model->save();
            $login = Yii::$app->user->login($model, 3600*24*30);
            // if ($login)
            //     $this->goBack();
        }
    }

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