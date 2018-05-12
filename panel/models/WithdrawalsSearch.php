<?php

namespace panel\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use panel\models\Withdrawals;

/**
 * WithdrawalsBusca represents the model behind the search form about `panel\models\Withdrawals`.
 */
class WithdrawalsSearch extends Withdrawals
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idWithdrawal', 'idLogin', 'status'], 'integer'],
            [['idLogin'], 'safe'],
            [['amount'], 'number'],
            [['paymentMethod', 'address'], 'string'],
            [['dateCreated'], 'datetime', 'format' => 'php:Y-m-d H:i:s'],
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
        $query = Withdrawals::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'idWithdrawal' => $this->idWithdrawal,
            'amount' => $this->amount,
            'paymentMethod' => $this->paymentMethod,
            'address' => $this->address,
            'dateCreated' => $this->dateCreated,
        ])
        ->andFilterWhere(['like', 'login.idLogin', $this->idLogin]);

        return $dataProvider;
    }
}
