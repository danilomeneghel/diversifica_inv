<?php

namespace panel\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use panel\models\UsersAddress;

/**
 * UsersPhoneSearch represents the model behind the search form about `panel\models\UsersPhone`.
 */
class UsersAddressSearch extends UsersAddress
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idUser', 'street', 'city', 'state', 'country'], 'safe'],
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
        $query = UsersAddress::find();
        $query->joinWith('users');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'street', $this->street])
              ->andFilterWhere(['like', 'city', $this->city])
              ->andFilterWhere(['like', 'state', $this->state])
              ->andFilterWhere(['like', 'country', $this->country])
              ->andFilterWhere(['like', 'users.name', $this->idUser]);

        return $dataProvider;
    }
}
