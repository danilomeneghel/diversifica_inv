<?php

namespace panel\models;

use Yii;
use common\models\Login;

/**
 * This is the model class for table "rs_logins".
 *
 * @property integer $idWithdrawal
 * @property integer $idLogin
 * @property string $amount
 * @property string $paymentMethod
 * @property string $address
 * @property string $dateCreated
 * @property string $active
 */
class Withdrawals extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rs_withdrawals';
    }

    /**
     * @inheritdoc
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogin()
    {
        return $this->hasOne(Login::className(), ['idLogin' => 'idLogin']);
    }

}
