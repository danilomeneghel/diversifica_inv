<?php

namespace panel\models;

use Yii;
use yii\base\Model;

/**
 * IncomesForm is the model behind the login form.
 */
class IncomesForm extends Model
{
    public $date;
    public $profit;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['idIncome', 'idCompany'], 'integer'],
            [['idSetor', 'profit'], 'required'],
            [['date'], 'date', 'format' => 'php:Y-m-d']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'date' => 'Data',
            'profit' => 'Lucro',
        ];
    }

}
