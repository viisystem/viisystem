<?php

namespace app\packages\category\controllers\backend;

use vii\helpers\StringHelper;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

use app\packages\category\models\Category;


class CategoryController extends Controller
{

    public $categoryTitle = null;
    public $categoryTable = null;
    public $categoryClass = '\app\packages\category\models\Category';

    public $keyCategory = null;
    public $controllerId = '/category/category';
    public $viewPath = '@app/packages/category/views/backend/category';
    public $languageId = null;

    public function getViewPath()
    {
        return Yii::getAlias($this->viewPath);
    }

    public function beforeAction($action)
    {
        if ($this->languageId == null) {
            $this->languageId = Yii::$app->request->getQueryParam('language');
        }

        if (!array_key_exists($this->languageId, Yii::$app->params['languageSupport'])) {
            $this->languageId = Yii::$app->language;
        }

        return parent::beforeAction($action);
    }

    /**
     * @param $id
     * @return \app\packages\category\models\Category
     * @throws \yii\base\InvalidConfigException
     */
    protected function findModel($id)
    {
        $model = Yii::createObject($this->categoryClass);
        $model->setTableName($this->categoryTable);
        return $model->getData($id);
    }

    public function actionIndex()
    {
        /* @var $model \app\packages\category\models\Category */
        $obj = Yii::createObject($this->categoryClass);
        if (($model = $obj::findTable($this->categoryTable)->where(['lft' => 1, 'key' => $this->keyCategory, 'language' => $this->languageId])->one()) === null) {
            $model = Yii::createObject($this->categoryClass);
            $model->setTableName($this->categoryTable);
            $model->scenario = 'root';
            $model->title = $this->keyCategory;
            $model->key = $this->keyCategory;
            $model->language = $this->languageId;
            $model->is_active = 1;
            if (!$model->makeRoot()) {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $returnUrl = Yii::$app->request->get('returnUrl', Url::to(['index']));
            return (Yii::$app->request->post('action', 'save') == 'save')
                ? $this->redirect(['update', 'id' => $model->getId(), 'returnUrl' => $returnUrl])
                : $this->redirect($returnUrl);
        }

        $model->items = $model->children()->all();
        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionItemCreate($id)
    {
        Yii::$app->response->format = 'json';

        if (($model = $this->findModel($id)) === null) {
            return ['s' => 0, 'm' => Yii::t('common', 'The requested page does not exist.')];
        }

        $modelItem = Yii::createObject($this->categoryClass);
        $modelItem->setScenario('item');
        $modelItem->setTableName($this->categoryTable);
        $modelItem->setDefaultValues();
        $modelItem->language = $model->language;
        $modelItem->key = $model->key;

        if ($modelItem->load(Yii::$app->request->post()) && $modelItem->appendTo($model)) {
            $model->refresh();
            return [
                's' => 1,
                'c' => $this->renderPartial('itemList', [
                    'model' => $model,
                    'modelItem' => $model->children()->all()
                ])
            ];
        }

        return [
            's' => 1,
            'f' => $this->renderAjax('itemForm', ['model' => $modelItem]),
        ];
    }

    public function actionItemUpdate($id, $item)
    {
        Yii::$app->response->format = 'json';

        $model = $this->findModel($id);
        $modelItem = $this->findModel($item);
        if ($model === null || $modelItem === null)
            return ['s' => 0];

        $modelItem->scenario = 'item';

        if ($modelItem->load(Yii::$app->request->post()) && $modelItem->save()) {
            $model->refresh();
            return [
                's' => 1,
                'c' => $this->renderPartial('itemList', [
                    'model' => $model,
                    'modelItem' => $model->children()->all()
                ])
            ];
        }

        return [
            's' => 1,
            'f' => $this->renderAjax('itemForm', ['model' => $modelItem])
        ];
    }

    public function actionItemUpdateFull($id, $item)
    {
        $model = $this->findModel($id);
        $modelItem = $this->findModel($item);
        if ($model === null || $modelItem === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $modelItem->scenario = 'item';

        if ($modelItem->load(Yii::$app->request->post()) && $modelItem->save()) {
            $returnUrl = Yii::$app->request->get('returnUrl', Url::to(['index']));
            return $this->redirect($returnUrl);
        }

        return $this->render('itemFormFull', ['model' => $modelItem]);
    }

    public function actionItemDelete($id, $item)
    {
        Yii::$app->response->format = 'json';

        $model = $this->findModel($id);
        $modelItem = $this->findModel($item);

        if ($model === null || $modelItem === null)
            return ['s' => 0];

        if ($modelItem->delete() && Yii::$app->getRequest()->isAjax) {
            $model->refresh();
            return [
                's' => 1,
                'c' => $this->renderPartial('itemList', [
                    'model' => $model,
                    'modelItem' => $model->children()->all()
                ])
            ];
        }

        return ['s' => 0];
    }

    public function actionItemInsert($id, $item)
    {
        Yii::$app->response->format = 'json';

        $obj = Yii::createObject($this->categoryClass);
        $paramOperation = Yii::$app->request->getQueryParam('operation', $obj::OPERATION_APPEND_TO);
        if (array_key_exists($paramOperation, $obj::$operations)) {
            $itemOperation = $obj::$operations[$paramOperation];
        } else {
            return ['s' => 0];
        }

        $model = $this->findModel($id);
        $modelData = $this->findModel($item);

        //$modelItem = new Category();
        $modelItem = Yii::createObject($this->categoryClass);
        $modelItem->setTableName($this->categoryTable);
        $modelItem->setDefaultValues();
        $modelItem->language = $model->language;
        $modelItem->key = $model->key;

        if ($modelItem->load(Yii::$app->request->post()) && $modelItem->validate()) {
            if (call_user_func_array(array($modelItem, $itemOperation), array($modelData))) {
                $model->refresh();
                $modelItem->refresh();

                return [
                    's' => 1,
                    'c' => $this->renderAjax('itemList', [
                        'model' => $model,
                        'modelItem' => $model->children()->all()
                    ])
                ];
            }
        }

        return [
            's' => 1,
            'f' => $this->renderAjax('itemForm', ['model' => $modelItem])
        ];
    }

    public function actionItemMove($id, $item)
    {
        Yii::$app->response->format = 'json';
        $items = json_decode(Yii::$app->request->post('items'), true);

        $model = $this->findModel($id);
        if ($model === null || empty($items)) {
            return ['s' => 0];
        }

        $collection = Yii::$app->mongodb->getCollection(Category::collectionName());
        foreach ($items as $item) {
            $collection->update(['_id' => $item['id']], [
                'lft' => $item['lft'],
                'rgt' => $item['rgt'],
                'depth' => $item['depth']
            ]);
        }

        $model->refresh();
        return [
            's' => 1,
            'c' => $this->renderAjax('itemList', [
                'model' => $model,
                'modelItem' => $model->children()->all()
            ])
        ];
    }

}
