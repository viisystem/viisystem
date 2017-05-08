<?php

namespace app\packages\contact\controllers\frontend;

use yii\web\Controller;
use app\packages\contact\models\Contact;
use Yii;

class DefaultController extends Controller
{
    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction'
            ],
        ];
    }
    
    public function actionIndex() {
    	$model = new Contact;
    	$model->setDefaultValues();
    	
        if ($model->load(Yii::$app->request->post()) AND $model->save()){
        	Yii::$app->session->setFlash('form_success', 'Bạn đã gửi liên hệ thành công!');
        }
        
        Yii::$app->view->title = 'Liên hệ';

    	return $this->render('contact', ['item' => $model]);
    }
}
