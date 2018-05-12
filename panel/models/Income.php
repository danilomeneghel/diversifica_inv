<?php

namespace panel\models;

use Yii;

/**
 * This is the model class for table "rs_income".
 *
 * @property integer $idIncome
 * @property string $date
 * @property string $profit
 */
class Income extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rs_income';
    }

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
