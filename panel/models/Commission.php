<?php

namespace panel\models;

use Yii;

/**
 * This is the model class for table "rs_commission".
 *
 * @property integer $idCommission
 * @property string $date
 * @property string $profit
 */
class Commission extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rs_commission';
    }

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
            'paymentMethod' => 'Método de Pagamento',
            'dateUpdated' => 'Data de Atualização',
        ];
    }

}
