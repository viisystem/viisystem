<?php

namespace app\packages\setting\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\packages\setting\models\Setting;

/**
 * SettingSearch represents the model behind the search form about `app\packages\setting\models\Setting`.
 */
class SettingSearch extends Setting
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['_id', 'tab_id', 'module', 'key', 'type', 'title', 'description', 'sort', 'value', 'items'], 'safe'],
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
        $query = Setting::find();

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
            ->andFilterWhere(['like', 'tab_id', $this->tab_id])
            ->andFilterWhere(['like', 'module', $this->module])
            ->andFilterWhere(['like', 'key', $this->key])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'sort', $this->sort])
            ->andFilterWhere(['like', 'value', $this->value])
            ->andFilterWhere(['like', 'items', $this->items]);

        return $dataProvider;
    }
}
