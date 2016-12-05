<?php

namespace app\packages\blog\controllers\backend;

use app\packages\blog\models\Blog;
use app\packages\blog\models\BlogSearch;

use vii\helpers\Url;
use vii\helpers\FileHelper;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
 * BlogController implements the CRUD actions for Blog model.
 */
class BlogController extends Controller
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

                    'is-promotion' => ['post'],
                    'is-active' => ['post'],

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
                'modelClass' => '\app\packages\blog\models\Blog',
                'statusField' => 'is_active',
                'statusValue' => '1'
            ],
            'bulk-active-off' => [
                'class' => 'vii\actions\BulkStatusAction',
                'modelClass' => '\app\packages\blog\models\Blog',
                'statusField' => 'is_active',
                'statusValue' => '0'
            ],
            'bulk-delete' => [
                'class' => 'vii\actions\BulkDeleteAction',
                'modelClass' => '\app\packages\blog\models\Blog',
            ],

            'is-promotion' => [
                'class' => 'vii\actions\BooleanAction',
                'modelClass' => '\app\packages\blog\models\Blog',
                'statusField' => 'is_promotion'
            ],
            'is-active' => [
                'class' => 'vii\actions\BooleanAction',
                'modelClass' => '\app\packages\blog\models\Blog',
                'statusField' => 'is_active'
            ],

            'sort' => [
                'class' => 'vii\actions\SortAction',
                'modelClass' => '\app\packages\blog\models\Blog',
            ],
        ];
    }

    /**
     * Lists all Blog models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BlogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Blog model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->redirect(['index']);
//        return $this->render('view', [
//            'model' => $this->findModel($id),
//        ]);
    }

    /**
     * Creates a new Blog model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Blog();
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
     * Updates an existing Blog model.
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
     * Deletes an existing Blog image.
     * @param string $id
     * @return mixed
     */
    public function actionDeleteImage($id)
    {
        Yii::$app->response->format = 'json';

        $model = $this->findModel($id);
        if ($model->image != null && FileHelper::removeUploaded($model->image)) {
            $model->image = null;
            if ($model->save()) {
                return ['s' => 1];
            }
        }

        return ['s' => 0];
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
        if (($model = Blog::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
