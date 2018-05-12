<?php

namespace panel\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use panel\models\Wallets;
use common\models\Login;

/**
 * WalletsSearch represents the model behind the search form about `panel\models\Wallets`.
 */
class WalletsSearch extends Wallets
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
      return [
          [['idWallet', 'idLogin'], 'integer'],
          [['idLogin', 'bitcoin'], 'required'],
          [['bitcoin', 'litecoin', 'dogecoin'], 'string'],
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
        $query = Wallets::find();
        $query->joinWith('login');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'idWallet' => $this->idWallet,
            'idLogin' => $this->idLogin,
            'bitcoin' => $this->bitcoin,
            'litecoin' => $this->litecoin,
            'dogecoin' => $this->dogecoin,
            'dateCreated' => $this->dateCreated,
        ])
        ->andFilterWhere(['like', 'login.idLogin', $this->idLogin]);

        return $dataProvider;
    }
}
