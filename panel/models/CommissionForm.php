<?php

namespace panel\models;

use Yii;
use yii\base\Model;

/**
 * CommissionForm is the model behind the login form.
 */
class CommissionForm extends Model
{
    public $groupProfit;
    public $dateUpdated;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idCommission'], 'integer'],
            [['groupProfit', 'paymentMethod'], 'required'],
            [['groupProfit'], 'number'],
            [['paymentMethod'], 'string'],
            [['dateUpdated'], 'datetime', 'format' => 'php:Y-m-d H:i:s'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idCommission' => 'Comissão',
            'groupProfit' => 'Comissão Total (BTC)',
            'dateUpdated' => 'Data de Atualização',
        ];
    }

}
