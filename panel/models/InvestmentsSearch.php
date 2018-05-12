<?php

namespace panel\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use panel\models\Investments;
use common\models\Login;

/**
 * InvestmentsSearch represents the model behind the search form about `panel\models\Investments`.
 */
class InvestmentsSearch extends Investments
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
       return [
           [['idInvestment', 'idLogin', 'active'], 'integer'],
           [['investedBTC', 'investedReal', 'totalProfit', 'bitcoinTeamProfit', 'realTeamProfit'], 'number'],
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
        $query = Investments::find();
        $query->joinWith('login');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'idInvestment' => $this->idInvestment,
            'idLogin' => $this->idLogin,
            'investedBTC' => $this->investedBTC,
            'investedReal' => $this->investedReal,
            'bitcoinTeamProfit' => $this->bitcoinTeamProfit,
            'realTeamProfit' => $this->realTeamProfit,
            'dateUpdated' => $this->dateUpdated,
        ])
        ->andFilterWhere(['like', 'login.idLogin', $this->idLogin]);

        return $dataProvider;
    }
}
