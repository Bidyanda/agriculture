<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "insecticide".
 *
 * @property int $id
 * @property int $pp_id
 * @property int $sl_no
 * @property string $particular_of_insecticide
 * @property string $name_of_the manufacturer
 * @property string $registration_no
 * @property string $principal_certificate_no
 * @property string $principal_certificate_date_of_issue
 * @property string $principal_certificate_validity
 */
class Insecticide extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'insecticide';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pp_id','sl_no','particular_of_insecticide', 'name_of_manufacturer', 'registration_no', 'principal_certificate_no', 'principal_certificate_date_of_issue', 'principal_certificate_validity'], 'required'],
            [['pp_id', 'sl_no'], 'integer'],
            [['particular_of_insecticide'], 'string'],
            [['principal_certificate_date_of_issue', 'principal_certificate_validity'], 'safe'],
            [['name_of_manufacturer'], 'string', 'max' => 255],
            [['registration_no', 'principal_certificate_no'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pp_id' => 'Pp ID',
            'is_renew' => 'Registration Type',
            'sl_no' => 'Sl No',
            'particular_of_insecticide' => 'Particular Of Insecticide',
            'name_of_manufacturer' => 'Name Of The Manufacturer',
            'registration_no' => 'Registration No',
            'principal_certificate_no' => 'Principal Certificate No',
            'principal_certificate_date_of_issue' => 'Principal Certificate Date Of Issue',
            'principal_certificate_validity' => 'Principal Certificate Validity',
        ];
    }
}
