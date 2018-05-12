<?php

namespace panel\models;

use Yii;

/**
 * This is the model class for table "rs_companies".
 *
 * @property integer $idCompany
 * @property string $name
 * @property string $site
 * @property integer $active
 */
class Companies extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rs_companies';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idCompany', 'active'], 'integer'],
            [['name', 'site'], 'required'],
            [['dateCreated'], 'datetime', 'format' => 'php:Y-m-d H:i:s'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
      return [
          'idCompany' => 'Empresa',
          'name' => 'Nome',
          'site' => 'Site',
          'dateCreated' => 'Data da Criação',
          'active' => 'Ativo',
      ];
    }

}
