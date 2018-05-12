<?php

namespace panel\models;

use Yii;

/**
 * This is the model class for table "rs_logins".
 *
 * @property integer $idIncome
 * @property integer $idCompany
 * @property string $date
 * @property string $profit
 */
class Incomes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rs_incomes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idIncome', 'idCompany'], 'integer'],
            [['idCompany', 'profit'], 'required'],
            [['fixed', 'profit'], 'string'],
            [['date'], 'date', 'format' => 'php:Y-m-d'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idIncome' => 'Rendimento',
            'idCompany' => 'Empresa',
            'fixed' => 'Lucro Fixo',
            'date' => 'Data',
            'profit' => 'Lucro %',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanies()
    {
        return $this->hasOne(Companies::className(), ['idCompany' => 'idCompany']);
    }
}
