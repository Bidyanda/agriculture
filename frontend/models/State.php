<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "state".
 *
 * @property int $id
 * @property string $name
 *
 * @property Regis[] $regis
 * @property Regis[] $regis0
 */
class State extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'state';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[Regis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegis()
    {
        return $this->hasMany(Regis::className(), ['present_state_id' => 'id']);
    }

    /**
     * Gets query for [[Regis0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegis0()
    {
        return $this->hasMany(Regis::className(), ['permanent_state_id' => 'id']);
    }
}
