<?php

namespace panel\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use panel\models\Users;

/**
 * UsersSearch represents the model behind the search form about `panel\models\Users`.
 */
class UsersSearch extends Users
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idUser', 'referral'], 'integer'],
            [['name', 'profession'], 'string', 'max' => 45],
            [['dateBirth'], 'date', 'format' => 'php:Y-m-d'],
            [['dateCreated'], 'date', 'format' => 'php:Y-m-d H:i:s'],
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
        $query = Users::find();
        $query->joinWith('logins');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'name', $this->name])
              ->andFilterWhere(['like', 'gender', $this->gender])
              ->andFilterWhere(['like', 'profession', $this->profession])
              ->andFilterWhere(['like', 'logins.level', $this->idUser])
              ->andFilterWhere(['like', 'logins.active', $this->idUser])
              ->andFilterWhere(['like', 'logins.username', $this->idUser])
              ->andFilterWhere(['like', 'referrals.username', $this->referral])
              ->andFilterWhere(['like', 'dateCreated', $this->dateCreated]);

        return $dataProvider;
    }
}
