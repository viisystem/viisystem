<?php

namespace app\packages\banner\controllers\backend;

use Yii;
use yii\web\Controller;
use app\packages\banner\models\BannerSearch;
use app\packages\banner\models\Banner;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class DefaultController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'bulk-active-on' => ['post'],
                    'bulk-active-off' => ['post'],
                    'bulk-delete' => ['post'],

                    'status' => ['post'],

                    'sort' => ['post'],

                    'delete' => ['post'],
                    'delete-image' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'bulk-active-on' => [
                'class' => 'vii\actions\BulkStatusAction',
                'modelClass' => '\app\packages\banner\models\Banner',
                'statusField' => 'status',
                'statusValue' => '1'
            ],
            'bulk-active-off' => [
                'class' => 'vii\actions\BulkStatusAction',
                'modelClass' => '\app\packages\banner\models\Banner',
                'statusField' => 'status',
                'statusValue' => '0'
            ],
            'bulk-delete' => [
                'class' => 'vii\actions\BulkDeleteAction',
                'modelClass' => '\app\packages\banner\models\Banner',
            ],
            'status' => [
                'class' => 'vii\actions\BooleanAction',
                'modelClass' => '\app\packages\banner\models\Banner',
                'statusField' => 'status'
            ],
            'sort' => [
                'class' => 'vii\actions\SortAction',
                'modelClass' => '\app\packages\banner\models\Banner',
            ],
        ];
    }

    /**
     * Lists all Banner models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BannerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Banner model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Banner();
        $model->setDefaultValues();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('alert', Yii::t('common', 'Your data has been successfully saved'));

            $returnUrl = Yii::$app->request->get('returnUrl', Url::to(['index']));
            return (Yii::$app->request->post('action', 'save') == 'save')
                ? $this->redirect(['update', 'id' => (string)$model->_id, 'returnUrl' => $returnUrl])
                : $this->redirect($returnUrl);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Banner model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('alert', Yii::t('common', 'Your data has been successfully saved'));

            $returnUrl = Yii::$app->request->get('returnUrl', Url::to(['index']));
            return (Yii::$app->request->post('action', 'save') == 'save')
                ? $this->redirect(['update', 'id' => (string)$model->_id, 'returnUrl' => $returnUrl])
                : $this->redirect($returnUrl);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Blog model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Banner model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Banner the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Banner::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
