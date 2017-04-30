<?php

namespace app\packages\services\controllers\backend;

use Yii;
use yii\web\Controller;
use app\packages\services\models\ServicesSearch;
use app\packages\services\models\Services;
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
                'modelClass' => '\app\packages\services\models\Services',
                'statusField' => 'status',
                'statusValue' => '1'
            ],
            'bulk-active-off' => [
                'class' => 'vii\actions\BulkStatusAction',
                'modelClass' => '\app\packages\services\models\Services',
                'statusField' => 'status',
                'statusValue' => '0'
            ],
            'bulk-delete' => [
                'class' => 'vii\actions\BulkDeleteAction',
                'modelClass' => '\app\packages\services\models\Services',
            ],
            'status' => [
                'class' => 'vii\actions\BooleanAction',
                'modelClass' => '\app\packages\services\models\Services',
                'statusField' => 'status'
            ],
            'sort' => [
                'class' => 'vii\actions\SortAction',
                'modelClass' => '\app\packages\services\models\Services',
            ],
        ];
    }

    /**
     * Lists all Services models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ServicesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Services model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Services();
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
     * Updates an existing Services model.
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
     * Finds the Blog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Blog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Services::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
