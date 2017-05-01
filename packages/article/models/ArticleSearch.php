<?php

namespace app\packages\article\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\packages\article\models\Article;

/**
 * ArticleSearch represents the model behind the search form about `app\packages\article\models\Article`.
 */
class ArticleSearch extends Article
{
    public $keyword;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['_id', 'title', 'slug', 'image', 'category', 'excerpt', 'content', 'meta_title', 'meta_keyword', 'meta_description', 'tags', 'skin', 'sort', 'is_promotion', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by', 'language', 'source_id'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */

    /*
        $query = static::find();
        $query->where(['language' => Yii::$app->params['languageDefault']]);
        $query->orderBy(['sort' => SORT_DESC, 'create_time' => SORT_DESC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $pageSize,
            ],
            'sort' => [
                'attributes' => [
                    'name',
                    'status'
                ]
            ]
        ]);
     */
    public function search($params)
    {
        $query = Article::find();

        // add conditions that should always apply here
        $query->where(['language' => Yii::$app->params['languageDefault']]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20
            ],
            'sort' => [
                'defaultOrder' => [
                    'sort' => SORT_DESC,
                    'created_at' => SORT_DESC
                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere(['like', '_id', $this->_id])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'excerpt', $this->excerpt])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'meta_title', $this->meta_title])
            ->andFilterWhere(['like', 'meta_keyword', $this->meta_keyword])
            ->andFilterWhere(['like', 'meta_description', $this->meta_description])
            ->andFilterWhere(['like', 'tags', $this->tags])
            ->andFilterWhere(['like', 'skin', $this->skin])
            ->andFilterWhere(['like', 'sort', $this->sort])
            ->andFilterWhere(['like', 'is_promotion', $this->is_promotion])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'created_at', $this->created_at])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_at', $this->updated_at])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by])
            ->andFilterWhere(['like', 'language', $this->language])
            ->andFilterWhere(['like', 'source_id', $this->source_id]);

        return $dataProvider;
    }

    public function searchFrontend($params, $pageSize = 20)
    {
        $query = static::find();
        $query->where(['language' => Yii::$app->language, 'status' => '1']);
        $query->orderBy(['sort' => SORT_ASC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $pageSize,
            ]
        ]);

        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }

        // condition here
        if (!empty($this->keyword)) {
            $query->andFilterWhere(['or',
                ['like', 'name', $this->keyword],
                ['like', 'content', $this->keyword],
            ]);
        }

        return $dataProvider;
    }
}
