<?php

namespace panel\models;

use Yii;

/**
 * This is the model class for table "user_email".
 *
 * @property integer $idUserEmail
 * @property integer $idUser
 * @property string $email
 *
 * @property Users $idUser0
 */
class UsersEmail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rs_users_email';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idUser'], 'integer'],
            [['idUser', 'email'], 'required'],
            [['email'], 'email'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idUserEmail' => 'User Email',
            'idUser' => 'User',
            'email' => 'Email',
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
