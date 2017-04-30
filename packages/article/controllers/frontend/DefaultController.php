<?php

namespace app\packages\article\controllers\frontend;

use yii\web\Controller;
use app\packages\article\models\Article;
use app\packages\category\models\Category;
use app\packages\account\models\User;
use yii\web\NotFoundHttpException;
use Yii;

class DefaultController extends Controller
{
    public function actionView()
    {
    	$id = Yii::$app->request->get('id');
    	$slug = Yii::$app->request->get('slug');

    	$cacheKey = 'article_info_'.$id;
        $cache = Yii::$app->cache->get($cacheKey);
        if (empty($cache)) {
            $model = $this->findModel($id, $slug);

            $created_by = null;
            if (!empty($model)) {
            	$created_by = User::findOne($model->created_by);
            }

            $cache = [
            	'item' => $model,
            	'created_by' => $created_by,
            ];
            
            Yii::$app->cache->set($cacheKey, $cache);
        }

        $model = isset($cache['item']) ? $cache['item'] : null;
        Yii::$app->view->title = empty($model->seo_title) ? $model->title : $model->seo_title;

        return $this->render('view', $cache);
    }
    
    /**
     * Finds the model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @param string $slug
     * @return the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $slug)
    {
        if (($model = Article::find()->where(['_id' => $id, 'slug' => $slug])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
