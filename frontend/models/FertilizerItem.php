<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "fertilizer_item".
 *
 * @property int $id
 * @property int $f_id
 * @property string $fertilizer_name
 * @property string $whether_cert_form_o_attach
 *
 * @property Fertilizer $f
 */
class FertilizerItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fertilizer_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['f_id', 'fertilizer_name', 'whether_cert_form_o_attach'], 'required'],
            [['f_id'], 'integer'],
            [['whether_cert_form_o_attach'], 'string'],
            [['fertilizer_name'], 'string', 'max' => 255],
            [['f_id'], 'exist', 'skipOnError' => true, 'targetClass' => Fertilizer::className(), 'targetAttribute' => ['f_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'f_id' => 'F ID',
            'fertilizer_name' => 'Fertilizer Name',
            'whether_cert_form_o_attach' => 'Whether Cert Form O Attach',
        ];
    }

    /**
     * Gets query for [[F]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getF()
    {
        return $this->hasOne(Fertilizer::className(), ['id' => 'f_id']);
    }
}
