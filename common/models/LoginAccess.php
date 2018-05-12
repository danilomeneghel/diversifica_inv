<?php

namespace common\models;

use Yii;
use common\models\Login;

/**
 * This is the model class for table "rs_login_access".
 *
 * @property integer $idLoginAccess
 * @property integer $idLogin
 * @property integer $ip
 * @property string $date
 */
class LoginAccess extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rs_login_access';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idLogin'], 'required'],
            [['idLogin'], 'integer'],
            [['ip', 'date'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idLoginAccess' => 'Id Login Acesso',
            'idLogin' => 'Id Login',
            'ip' => 'IP',
            'date' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdLogin0()
    {
        return $this->hasOne(Login::className(), ['idLogin' => 'idLogin']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdLogin1()
    {
        return $this->hasOne(Login::className(), ['idLogin' => 'idLogin']);
    }

}
