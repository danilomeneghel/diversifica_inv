<?php

namespace panel\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use panel\models\Income;

/**
 * IncomeSearch represents the model behind the search form about `panel\models\Income`.
 */
class IncomeSearch extends Income
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idIncome'], 'integer'],
            [['groupProfit'], 'number'],
            [['dateUpdated'], 'datetime', 'format' => 'php:Y-m-d H:i:s'],
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
     * Creates date provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Income::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'idIncome' => $this->idIncome,
            'groupProfit' => $this->groupProfit,
            'dateUpdated' => $this->dateUpdated,
        ]);

        return $dataProvider;
    }
}
