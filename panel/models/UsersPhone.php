<?php

namespace panel\models;

use Yii;

/**
 * This is the model class for table "user_phone".
 *
 * @property integer $idUserPhone
 * @property integer $idUser
 * @property string $phone
 *
 * @property Users $idUser0
 */
class UsersPhone extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rs_users_phone';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idUser'], 'integer'],
            [['idUser', 'phone'], 'required'],
            [['phone'], 'string'],
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
            'phone' => 'Phone',
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
