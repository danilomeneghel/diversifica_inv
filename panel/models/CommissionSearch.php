<?php

namespace panel\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use panel\models\Commission;

/**
 * CommissionSearch represents the model behind the search form about `panel\models\Commission`.
 */
class CommissionSearch extends Commission
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idCommission'], 'integer'],
            [['groupProfit'], 'number'],
            [['paymentMethod'], 'string'],
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
        $query = Commission::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'idCommission' => $this->idCommission,
            'groupProfit' => $this->groupProfit,
            'paymentMethod' => $this->paymentMethod,
            'dateUpdated' => $this->dateUpdated,
        ]);

        return $dataProvider;
    }
}
