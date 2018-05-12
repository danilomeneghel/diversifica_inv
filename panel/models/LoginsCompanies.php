<?php

namespace panel\models;

use Yii;
use panel\models\Companies;

/**
 * This is the model class for table "rs_logins_companies".
 *
 * @property integer $idSector
 * @property integer $nro_Sectors
 * @property integer $active
 */
class LoginsCompanies extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rs_logins_companies';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idLoginCompany', 'idLogin', 'idCompany'], 'integer'],
            [['idCompany'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
      return [
          'idCompany' => 'Empresa',
      ];
    }

    public function getCompanies() {
       return $this->hasOne(Companies::className(), ['idCompany' => 'idCompany']);
    }

}
