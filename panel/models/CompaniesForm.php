<?php

namespace panel\models;

use Yii;
use yii\base\Model;

/**
 * CompaniesForm is the model behind the companies form.
 */
class CompaniesForm extends Model
{
    public $dateUpdated;

    /**
     * @return array the validation rules.
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
