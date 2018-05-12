<?php

namespace panel\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use panel\models\UsersPhone;

/**
 * UsersPhoneSearch represents the model behind the search form about `panel\models\UsersPhone`.
 */
class UsersPhoneSearch extends UsersPhone
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idUser', 'phone'], 'safe'],
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
        $query = UsersPhone::find();
        $query->joinWith('users');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'phone', $this->phone])
              ->andFilterWhere(['like', 'users.name', $this->idUser]);

        return $dataProvider;
    }
}
