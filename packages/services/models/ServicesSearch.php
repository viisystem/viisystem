<?php

namespace app\packages\services\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\packages\services\models\Services;

/**
 * ServicesSearch represents the model behind the search form about `app\packages\services\models\Services`.
 */
class ServicesSearch extends Services
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'type', 'bank', 'rate', 'rate_special', 'created_at', 'created_by', 'updated_at', 'language', 'status'], 'safe']
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
        $query = Services::find();

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
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'bank', $this->bank])
            ->andFilterWhere(['like', 'rate', $this->rate])
            ->andFilterWhere(['like', 'rate_special', $this->rate_special])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'created_at', $this->created_at])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_at', $this->updated_at])
            ->andFilterWhere(['like', 'language', $this->language]);

        return $dataProvider;
    }
}
