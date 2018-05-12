<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Login;

/**
 * LoginSearch represents the model behind the search form about `panel\models\Logins`.
 */
class LoginSearch extends Login
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idLogin', 'level', 'active'], 'integer'],
            [['username', 'password', 'email'], 'safe'],
            [['name', 'username', 'password'], 'string', 'max' => 60],
            ['email', 'email'],
            [['dateCreated'], 'datetime', 'format' => 'php:Y-m-d H:i:s'],
            [['level'], 'integer'],
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
        $query = Login::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'idLogin' => $this->idLogin,
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'level' => $this->level,
            'active' => $this->active,
        ]);

        return $dataProvider;
    }
}
