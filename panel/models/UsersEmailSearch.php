<?php

namespace panel\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use panel\models\UsersEmail;

/**
 * UsersEmailSearch represents the model behind the search form about `panel\models\UsersEmail`.
 */
class UsersEmailSearch extends UsersEmail
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idUser', 'email'], 'safe'],
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
        $query = UsersEmail::find();
        $query->joinWith('users');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'email', $this->email])
              ->andFilterWhere(['like', 'users.name', $this->idUser]);

        return $dataProvider;
    }
}
