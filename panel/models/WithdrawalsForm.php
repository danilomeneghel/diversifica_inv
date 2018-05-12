<?php

namespace panel\models;

use Yii;
use yii\base\Model;

/**
 * WithdrawalsForm is the model behind the login form.
 */
class WithdrawalsForm extends Model
{
    public $address;
    public $amount;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['idWithdrawal', 'idLogin', 'status'], 'integer'],
            [['idLogin'], 'required'],
            [['amount'], 'number'],
            [['paymentMethod', 'address'], 'string'],
            [['dateCreated'], 'datetime', 'format' => 'php:Y-m-d H:i:s'],
        ];
    }

    /**
     * @inheritdoc
     */
     public function attributeLabels()
     {
         return [
             'idWithdrawal' => 'Saque',
             'idLogin' => 'Login',
             'amount' => 'Valor',
             'paymentMethod' => 'Método de Pagamento',
             'address' => 'Endereço',
             'dateCreated' => 'Data da Criação',
             'status' => 'Status',
         ];
     }

}
