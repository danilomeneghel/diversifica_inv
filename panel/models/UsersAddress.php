<?php

namespace panel\models;

use Yii;

/**
 * This is the model class for table "user_phone".
 *
 * @property integer $idUserAddress
 * @property integer $idUser
 * @property string $street
 * @property string $city
 * @property string $state
 * @property string $country
 *
 * @property Users $idUser0
 */
class UsersAddress extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rs_users_address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idUser'], 'integer'],
            [['idUser', 'city', 'state', 'country'], 'required'],
            [['street', 'city', 'state', 'country'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idUserPhone' => 'User Phone',
            'idUser' => 'User',
            'street' => 'Street',
            'city' => 'City',
            'state' => 'State',
            'country' => 'Country',
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
