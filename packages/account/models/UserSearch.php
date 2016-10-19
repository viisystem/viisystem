<?php

namespace app\packages\account\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\packages\account\models\User;

/**
 * UserSearch represents the model behind the search form about `app\modules\user\models\User`.
 */
class UserSearch extends User
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['_id', 'username', 'password', 'name', 'birth_date', 'gender', 'emails', 'addresses', 'description', 'auth_key', 'token', 'created_date', 'updated_date', 'last_login_datetime', 'data'], 'safe'],
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
        $query = User::find();

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
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'birth_date', $this->birth_date])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'emails', $this->emails])
            ->andFilterWhere(['like', 'addresses', $this->addresses])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'token', $this->token])
            ->andFilterWhere(['like', 'created_date', $this->created_date])
            ->andFilterWhere(['like', 'updated_date', $this->updated_date])
            ->andFilterWhere(['like', 'last_login_datetime', $this->last_login_datetime])
            ->andFilterWhere(['like', 'data', $this->data]);

        return $dataProvider;
    }
}
