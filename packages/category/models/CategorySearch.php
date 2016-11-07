<?php

namespace app\packages\category\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;


/**
 * CategorySearch represents the model behind the search form about `app\packages\category\models\Category`.
 */
class CategorySearch extends Category
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['_id', 'root', 'lft', 'rgt', 'depth', 'title', 'title_extra', 'slug', 'image', 'classes', 'skin', 'description', 'content', 'meta_title', 'meta_keyword', 'meta_description', 'is_active', 'is_promotion', 'language', 'key', 'source_id'], 'safe'],
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
    public function search($params)
    {
        $query = Category::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere(['like', '_id', $this->_id])
            ->andFilterWhere(['like', 'key', $this->key])
            ->andFilterWhere(['like', 'root', $this->root])
            ->andFilterWhere(['like', 'lft', $this->lft])
            ->andFilterWhere(['like', 'rgt', $this->rgt])
            ->andFilterWhere(['like', 'depth', $this->depth])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'title_extra', $this->title_extra])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'classes', $this->classes])
            ->andFilterWhere(['like', 'skin', $this->skin])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'meta_title', $this->meta_title])
            ->andFilterWhere(['like', 'meta_keyword', $this->meta_keyword])
            ->andFilterWhere(['like', 'meta_description', $this->meta_description])
            ->andFilterWhere(['like', 'is_active', $this->is_active])
            ->andFilterWhere(['like', 'is_promotion', $this->is_promotion])
            ->andFilterWhere(['like', 'language', $this->language])
            ->andFilterWhere(['like', 'source_id', $this->source_id]);

        return $dataProvider;
    }
}
