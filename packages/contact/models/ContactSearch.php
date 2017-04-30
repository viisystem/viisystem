<?php

namespace app\packages\contact\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\packages\contact\models\Contact;

/**
 * ContactSearch represents the model behind the search form about `app\packages\contact\models\Contact`.
 */
class ContactSearch extends Contact
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['_id', 'fullname', 'email', 'phone', 'content', 'created_at', 'updated_at'], 'safe'],
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
            ->andFilterWhere(['like', 'fullname', $this->fullname])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'created_at', $this->created_at])
            ->andFilterWhere(['like', 'updated_at', $this->updated_at])
            ->andFilterWhere(['like', 'language', $this->language]);

        return $dataProvider;
    }
}
