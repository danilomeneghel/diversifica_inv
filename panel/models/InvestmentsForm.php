<?php

namespace panel\models;

use Yii;
use yii\base\Model;

/**
 * InvestmentsForm is the model behind the login form.
 */
class InvestmentsForm extends Model
{
    public $dateUpdated;

    /**
     * @return array the validation rules.
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

}
