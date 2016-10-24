<?php

namespace app\packages\category\controllers\backend;

use vii\helpers\StringHelper;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


class CategoryController extends Controller
{

    public $categoryTitle = null;
    public $categoryTable = null;
    //public $categoryAssnTable = null;

    public $categoryClass = '\app\packages\category\models\Category';

    public $lookupCategory = null;
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
        if (($model = $obj::findTable($this->categoryTable)->where(['lft' => 1, 'lookup_id' => $this->lookupCategory, 'language' => $this->languageId])->one()) === null) {
            $model = Yii::createObject($this->categoryClass);
            $model->setTableName($this->categoryTable);
            $model->scenario = 'root';
            $model->title = $this->lookupCategory;
            $model->lookup_id = $this->lookupCategory;
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

    public function actionItemCreate($id) {
        Yii::$app->response->format = 'json';

        if (($model = $this->findModel($id)) === null) {
            return ['s' => 0, 'm' => Yii::t('common', 'The requested page does not exist.')];
        }

        $modelItem = Yii::createObject($this->categoryClass);
        $modelItem->setScenario('item');
        $modelItem->setTableName($this->categoryTable);
        $modelItem->setDefaultValues();
        $modelItem->language = $model->language;
        $modelItem->lookup_id = $model->lookup_id;

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

    public function actionItemCreateQuick($params) {
        Yii::$app->response->format = 'json';

        $paramsConfig = StringHelper::decrypt($params);
        if (!isset($paramsConfig['lookup_id'])) {
            die;
        }

        /* @var $model \app\packages\category\models\Category */
        //if (($model = Category::find()->where(['lft' => 1, 'language' => $paramsConfig['language'], 'lookup_id' => $paramsConfig['lookup_id']])->one()) === null)
        //if (($model = Category::findTable($this->categoryTable)->where(['lft' => 1, 'language' => $paramsConfig['language'], 'lookup_id' => $paramsConfig['lookup_id']])->one()) === null)
//        $obj = Yii::createObject($this->categoryClass);
//        if (($model = $obj::findTable($this->categoryTable)->where(['lft' => 1, 'language' => $paramsConfig['language'], 'lookup_id' => $paramsConfig['lookup_id']])->one()) === null)
//            return ['s' => 0, 'm' => Yii::t('common', 'The requested page does not exist.')];


        $obj = Yii::createObject($this->categoryClass);
        if (($model = $obj::findTable($this->categoryTable)->where(['lft' => 1, 'language' => $paramsConfig['language'], 'lookup_id' => $paramsConfig['lookup_id']])->one()) === null) {
            $model = Yii::createObject($this->categoryClass);
            $model->setTableName($this->categoryTable);
            $model->scenario = 'root';
            $model->title = $this->lookupCategory;
            $model->lookup_id = $this->lookupCategory;
            $model->language = $this->languageId;
            $model->is_active = 1;
            if (!$model->makeRoot()) {
                return ['s' => 0, 'm' => Yii::t('common', 'The requested page does not exist.')];
            }
        }


        //$modelItem = new Category(['scenario' => 'item']);
        $modelItem = Yii::createObject($this->categoryClass);
        $modelItem->setScenario('item');
        $modelItem->setTableName($this->categoryTable);
        $modelItem->setDefaultValues();
        $modelItem->language = $model->language;
        $modelItem->lookup_id = $model->lookup_id;

        if ($modelItem->load(Yii::$app->request->post()) && $modelItem->appendTo($model)) {
            $modelItem->refresh();
            return [
                's' => 1,
                'c' => $this->renderPartial('itemFormQuickSuccess', ['modelItem' => $modelItem, 'paramsConfig' => $paramsConfig])
            ];
        }

        return [
            's' => 1,
            'f' => $this->renderAjax('itemFormQuick', ['modelItem' => $modelItem])
        ];
    }

    public function actionItemUpdate($id, $item) {
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

    public function actionItemDelete($id, $item) {
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

    public function actionItemInsert($id, $item) {
        Yii::$app->response->format = 'json';

        $obj = Yii::createObject($this->categoryClass);
        $paramOperation = Yii::$app->request->getQueryParam('operation', $obj::OPERATION_APPEND_TO);
        if (array_key_exists($paramOperation, $obj::$operations)) {
            $itemOperation = $obj::$operations[$paramOperation];
        } else {
            return ['s' => 0];
        }
//        $paramOperation = Yii::$app->request->getQueryParam('operation', Category::OPERATION_APPEND_TO);
//        if (array_key_exists($paramOperation, Category::$operations)) {
//            $itemOperation = Category::$operations[$paramOperation];
//        } else {
//            return ['s' => 0];
//        }

        $model = $this->findModel($id);
        $modelData = $this->findModel($item);

        //$modelItem = new Category();
        $modelItem = Yii::createObject($this->categoryClass);
        $modelItem->setTableName($this->categoryTable);
        $modelItem->setDefaultValues();
        $modelItem->language = $model->language;
        $modelItem->lookup_id = $model->lookup_id;

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

    public function actionItemMove($id, $item) {
        Yii::$app->response->format = 'json';

        $id = StringHelper::getId($id);
        $paramItemId = StringHelper::getId(Yii::$app->request->post('itemId'));
        $paramItemParent = StringHelper::getId(Yii::$app->request->post('itemParent'));
        $paramItemBefore = StringHelper::getId(Yii::$app->request->post('itemBefore'));
        $paramItemAfter = StringHelper::getId(Yii::$app->request->post('itemAfter'));

        $model = $this->findModel($id);
        $modelItem = $this->findModel($paramItemId);

        if ($model === null || $modelItem === null)
            return ['s' => 0];

        if ($paramItemParent != null && $paramItemBefore == null && $paramItemAfter == null) {
            $modelItem->appendTo($this->findModel($paramItemParent));
        } elseif (
            ($paramItemParent != null && $paramItemBefore == null && $paramItemAfter != null) ||
            ($paramItemParent == null && $paramItemBefore == null && $paramItemAfter != null) ||
            ($paramItemParent == null && $paramItemBefore != null && $paramItemAfter != null)
        ) {
            $modelItem->insertBefore($this->findModel($paramItemAfter));
        } elseif (
            ($paramItemParent != null && $paramItemBefore != null && $paramItemAfter == null) ||
            ($paramItemParent == null && $paramItemBefore != null && $paramItemAfter == null)
        ) {
            $modelItem->insertAfter($this->findModel($paramItemBefore));
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
