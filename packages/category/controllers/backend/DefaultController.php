<?php

namespace app\packages\category\controllers\backend;

use vii\helpers\Url;
use app\packages\category\models\Category;
use app\packages\category\models\CategorySearch;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
 * DefaultController implements the CRUD actions for Category model.
 */
class DefaultController extends Controller
{

    public $controllerId = '/category/category';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'is-featured' => ['POST'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'is-active' => [
                'class' => 'vii\actions\BooleanAction',
                'modelClass' => '\app\packages\category\models\Category',
                'statusField' => 'is_active'
            ],
        ];
    }

    public function actionIndex()
    {
        $query = Category::find();
        $query->where(['language' => Yii::$app->params['languageDefault']]);
        $query->roots();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Category model.
     * @param integer $_id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Category();
        $model->scenario = 'root';
        $model->setDefaultValues();

        if ($model->load(Yii::$app->request->post()) && $model->makeRoot()) {
            $returnUrl = Yii::$app->request->get('returnUrl', Url::to(['index']));
            return (Yii::$app->request->post('action', 'save') == 'save')
                ? $this->redirect(['update', 'id' => $model->getId(), 'returnUrl' => $returnUrl])
                : $this->redirect($returnUrl);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionTranslate($id, $language)
    {
        if (($modelSource = $this->findModel($id)) === null)
            throw new NotFoundHttpException('The requested page does not exist.');

        $model = new Category();
        $model->scenario = 'root';
        $model->setDefaultValues();
        $model->setTranslateValues($language, $modelSource);

        if ($model->load(Yii::$app->request->post()) && $model->makeRoot()) {
            $returnUrl = Yii::$app->request->get('returnUrl', Url::to(['index']));
            return (Yii::$app->request->post('action', 'save') == 'save')
                ? $this->redirect(['update', 'id' => $model->getId(), 'returnUrl' => $returnUrl])
                : $this->redirect($returnUrl);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        if (($model = $this->findModel($id)) === null)
            throw new NotFoundHttpException('The requested page does not exist.');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $returnUrl = Yii::$app->request->get('returnUrl', Url::to(['index']));
            return (Yii::$app->request->post('action', 'save') == 'save')
                ? $this->redirect(['update', 'id' => $model->getId(), 'returnUrl' => $returnUrl])
                : $this->redirect($returnUrl);
        }

        $model->items = $model->children()->all();
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        Yii::$app->response->format = 'json';

        if (($model = $this->findModel($id)) === null)
            return ['s' => 0];

        $model->deleteWithChildren();
        return ['s' => 1];
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return \app\packages\category\models\Category
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        return $model = Category::findOne($id);
    }
}
