<?php

namespace app\packages\article\controllers\frontend;

use yii\web\Controller;
use app\packages\article\models\Article;
use app\packages\category\models\Category;
use yii\web\NotFoundHttpException;
use Yii;

class CategoryController extends Controller
{
    public function actionIndex()
    {
    	$id = Yii::$app->request->get('id');
    	$slug = Yii::$app->request->get('slug');

    	$cacheKey = 'category_info_'.$id;
        $cache = Yii::$app->cache->get($cacheKey);
        if (empty($cache)) {
            $model = $this->findModel($id, $slug);

            $articles = $this->getArticles($model->id);

            $cache = [
                'item' => $model,
                'articles' => $articles,
            ];
            
            Yii::$app->cache->set($cacheKey, $cache);
        }

        $model = isset($cache['item']) ? $cache['item'] : null;
        Yii::$app->view->title = empty($model->seo_title) ? $model->title : $model->seo_title;

        return $this->render('index', $cache);
    }

    public function actionNews(){
        $cacheKey = 'news';
        $cache = Yii::$app->cache->get($cacheKey);
        if (empty($cache)) {
            $articles = $this->getArticles();

            $cache = [
                'articles' => $articles,
            ];
            
            Yii::$app->cache->set($cacheKey, $cache);
        }

        Yii::$app->view->title = 'Tin tức';

        return $this->render('news', $cache);
    }

    private function getArticles($cat_id = null){
        $query = Article::find();

        $condition = ['status' => '1'];
        if (!empty($cat_id))
            $condition['category'] = (string) $cat_id;

        $query->where($condition);
        $query->orderBy('_id DESC');

        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $dataProvider;
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
        if (($model = Category::find()->where(['_id' => $id, 'slug' => $slug])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
