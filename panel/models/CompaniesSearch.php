<?php

namespace panel\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use panel\models\Companies;

/**
 * CompaniesSearch represents the model behind the search form about `panel\models\Companies`.
 */
class CompaniesSearch extends Companies
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
      return [
          [['idCompany', 'active'], 'integer'],
          [['name', 'site'], 'string'],
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
        $query = Companies::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'idCompany' => $this->idCompany,
            'name' => $this->name,
            'site' => $this->site,
            'dateCreated' => $this->dateCreated,
            'active' => $this->active,
        ]);

        return $dataProvider;
    }
}
