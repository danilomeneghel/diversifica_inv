<?php

namespace panel\models;

use Yii;
use common\models\Login;

/**
 * This is the model class for table "rs_investments".
 *
 * @property integer $idInvestment
 * @property integer $idLogin
 * @property string $date
 * @property string $profit
 */
class Investments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rs_investments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idInvestment', 'idLogin', 'active'], 'integer'],
            [['idLogin', 'investedReal'], 'required'],
            [['investedBTC', 'totalProfit', 'bitcoinTeamProfit', 'realTeamProfit'], 'number'],
            [['dateUpdated'], 'datetime', 'format' => 'php:Y-m-d H:i:s'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
      return [
          'idInvestment' => 'Investimento',
          'idLogin' => 'Usuário',
          'investedBTC' => 'Total Investido (BTC)',
          'investedReal' => 'Total Investido (R$)',
          'totalProfit' => 'Total Ganho (BTC)',
          'bitcoinTeamProfit' => 'Bônus (BTC)',
          'realTeamProfit' => 'Bônus (R$)',
          'dateUpdated' => 'Data de Atualização',
          'active' => 'Ativo',
      ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogin()
    {
        return $this->hasOne(Login::className(), ['idLogin' => 'idLogin']);
    }

    public function getLoginsCompanies() {
       return $this->hasMany(LoginsCompanies::className(), ['idLogin' => 'idLogin']);
    }

}
