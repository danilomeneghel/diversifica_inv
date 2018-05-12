<?php

namespace panel\models;

use Yii;

/**
 * This is the model class for table "user_email".
 *
 * @property integer $idUserExtract
 * @property integer $idUser
 * @property float $totalInvested
 * @property float $balance
 * @property float $width
 *
 * @property Users $idUser
 */
class UsersExtract extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rs_users_extract';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idUser', 'totalTime'], 'integer'],
            [['totalInvested', 'totalAverageIncome', 'totalProfit', 'balance', 'withdraw'], 'number'],
            [['lastDate'], 'date', 'format' => 'php:Y-m-d H:i:s'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idUserExtract' => 'User Extract',
            'idUser' => 'User',
            'totalInvested' => 'Total Invested ($)',
            'totalAverageIncome' => 'Porcentage Income (%)',
            'totalProfit' => 'Total Income ($)',
            'totalTime' => 'Total Time (days)',
            'balance' => 'Balance ($)',
            'withdraw' => 'Withdraw ($)',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasOne(Users::className(), ['idUser' => 'idUser']);
    }
}
