<?php

namespace panel\models;

use Yii;

/**
 * This is the model class for table "rs_countries".
 *
 * @property integer $idSector
 * @property integer $nro_Sectors
 * @property integer $active
 */
class Countries extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rs_countries';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idCountry'], 'integer'],
            [['code', 'name'], 'required'],
            [['name'], 'string', 'max' => 40]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idCountry' => 'Country',
            'code' => 'Code',
            'name' => 'Country',
        ];
    }

}
