<?php

namespace panel\models;

use Yii;
use yii\base\Model;

/**
 * IncomeForm is the model behind the login form.
 */
class IncomeForm extends Model
{
    public $groupProfit;
    public $dateUpdated;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idIncome'], 'integer'],
            [['groupProfit'], 'required'],
            [['groupProfit'], 'number'],
            [['dateUpdated'], 'datetime', 'format' => 'php:Y-m-d H:i:s'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idIncome' => 'Rendimento',
            'groupProfit' => 'Comissão Total (BTC)',
            'dateUpdated' => 'Data de Atualização',
        ];
    }

}
