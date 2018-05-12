<?php

namespace panel\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use panel\models\UsersExtract;

/**
 * UsersExtractSearch represents the model behind the search form about `panel\models\UsersExtract`.
 */
class UsersExtractSearch extends UsersExtract
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idUser', 'totalTime'], 'integer'],
            [['totalInvested', 'totalAverageIncome', 'totalProfit', 'balance', 'withdraw'], 'number'],
            [['lastDate'], 'date', 'format' => 'php:Y-m-d H:i:s'],
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
        $query = UsersExtract::find();
        $query->joinWith('users');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'users.name', $this->idUser])
              ->andFilterWhere(['like', 'totalInvested', $this->totalInvested])
              ->andFilterWhere(['like', 'totalAverageIncome', $this->totalAverageIncome])
              ->andFilterWhere(['like', 'totalProfit', $this->totalProfit])
              ->andFilterWhere(['like', 'totalTime', $this->totalTime])
              ->andFilterWhere(['like', 'balance', $this->balance])
              ->andFilterWhere(['like', 'withdraw', $this->withdraw]);

        return $dataProvider;
    }
}
