<?php

namespace app\packages\setting\controllers\backend;

use app\packages\setting\models\Setting;
use app\packages\setting\models\SettingModel;

use vii\helpers\ArrayHelper;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use Yii;


use yii\base\DynamicModel;
use yii\web\UploadedFile;


class SettingController extends Controller
{

    public $settingTab = null;
    public $settingModule = null;

    public $viewPath = '@app/packages/setting/views/backend/setting';


    public function getViewPath()
    {
        return Yii::getAlias($this->viewPath);
    }

    public function beforeAction($action)
    {
        if ($this->settingModule == null) {
            $this->settingModule = 'common'; //Yii::$app->controller->module->id;
        }

        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        /** @var $models array | \app\packages\setting\models\Setting */
        $models = Setting::find()->indexBy('key')->all();
        $attributesData = ArrayHelper::map($models, 'key', 'value');
        $attributes = array_keys($attributesData);

        $model = new SettingModel($attributes);
        $model->setRules($models);
        $model->attributes = $attributesData;

        if ($model->load(Yii::$app->request->post())) {
            $model->save();
            return $this->redirect(['index']);
        }

        return $this->render('index', [
            'models' => $models,
            'model' => $model,
        ]);
    }

    public function actionCreate()
    {
        $model = new Setting();
        $model->setDefaultValues();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        if (($model = Setting::findOne($id)) === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        if (($model = Setting::findOne($id)) === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $model->delete();
        $this->redirect(['index']);
    }
}
