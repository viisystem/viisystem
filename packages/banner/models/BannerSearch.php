<?php

namespace app\packages\banner\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\packages\banner\models\Banner;

/**
 * BannerSearch represents the model behind the search form about `app\packages\banner\models\Banner`.
 */
class BannerSearch extends Banner
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'link', 'target', 'image', 'started_date', 'ended_date', 'created_at', 'created_by', 'updated_at', 'language', 'status', 'sort'], 'safe']
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
        $query = Banner::find();

        // add conditions that should always apply here
        $query->where(['language' => Yii::$app->params['languageDefault']]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20
            ],
            'sort' => [
                'defaultOrder' => [
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
            ->andFilterWhere(['like', 'link', $this->link])
            ->andFilterWhere(['like', 'target', $this->target])
            ->andFilterWhere(['like', 'started_date', $this->started_date])
            ->andFilterWhere(['like', 'sort', $this->sort])
            ->andFilterWhere(['like', 'ended_date', $this->ended_date])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'created_at', $this->created_at])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_at', $this->updated_at])
            ->andFilterWhere(['like', 'language', $this->language]);

        return $dataProvider;
    }
}
