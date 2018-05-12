<?php

namespace panel\models;

use Yii;
use common\models\Login;

/**
 * This is the model class for table "rs_wallets".
 *
 * @property integer $idWallet
 * @property integer $idLogin
 * @property string $bitcoin
 * @property string $litecoin
 * @property string $dogecoin
 */
class Wallets extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rs_wallets';
    }

    /**
     * @inheritdoc
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogin()
    {
        return $this->hasOne(Login::className(), ['idLogin' => 'idLogin']);
    }

    public function getLoginsCompanies() {
       return $this->hasMany(LoginsCompanies::className(), ['idLogin' => 'idLogin']);
    }

}
