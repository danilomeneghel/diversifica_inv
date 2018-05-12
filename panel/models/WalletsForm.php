<?php

namespace panel\models;

use Yii;
use yii\base\Model;

/**
 * WalletsForm is the model behind the login form.
 */
class WalletsForm extends Model
{
    public $dateUpdated;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
      return [
          [['idWallet', 'idLogin'], 'integer'],
          [['idLogin', 'bitcoin'], 'required'],
          [['bitcoin', 'litecoin', 'dogecoin'], 'string'],
          [['dateCreated'], 'datetime', 'format' => 'php:Y-m-d H:i:s'],
      ];
    }

    /**
     * @inheritdoc
     */
     public function attributeLabels()
     {
       return [
           'idWallet' => 'Carteira',
           'idLogin' => 'Usuário',
           'bitcoin' => 'Carteira Bitcoin (BTC)',
           'litecoin' => 'Carteira Litecoin (LTC)',
           'dogecoin' => 'Carteira Dogecoin (DOGE)',
           'dateCreated' => 'Data de Criação',
       ];
     }

}
