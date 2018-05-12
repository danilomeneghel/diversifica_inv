<?php

namespace panel\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use panel\models\Incomes;

/**
 * IncomesSearch represents the model behind the search form about `panel\models\Incomes`.
 */
class IncomesSearch extends Incomes
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idIncome', 'idCompany'], 'integer'],
            [['fixed', 'profit'], 'string'],
            [['idCompany'], 'safe'],
            [['date'], 'date', 'format' => 'php:Y-m-d'],
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
        $query = Incomes::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'idIncome' => $this->idIncome,
            'date' => $this->date,
            'profit' => $this->profit,
        ])
        ->andFilterWhere(['like', 'sectors.name', $this->idCompany]);

        return $dataProvider;
    }
}
