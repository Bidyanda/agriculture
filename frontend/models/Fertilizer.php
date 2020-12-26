<?php

namespace frontend\models;
use yii\web\UploadedFile;
use Yii;

/**
 * This is the model class for table "fertilizer".
 *
 * @property int $id
 * @property int $user_id
 * @property int $address_of_sale
 * @property int $address_of_storage
 * @property string $manufacture
 * @property string $importer
 * @property string $pool_handling_agency
 * @property string $wholesale_dealer
 * @property string $retail_dealer
 * @property string $application_date
 * @property string|null $status
 * @property string $created_date
 * @property int $created_by
 * @property int $record_status
 * @property string|null $district_officer_verified
 * @property string|null $directorate_officer_verified
 * @property string|null $payment_status
 * @property string|null $application_fee_date
 * @property float $application_fee_amount
 *
 * @property FertilizerItem[] $fertilizerItems
 */
class Fertilizer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fertilizer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'address_of_sale','address_of_storage', 'manufacture', 'importer','is_renew','pool_handling_agency', 'wholesale_dealer', 'retail_dealer', 'application_date', 'created_by'], 'required'],
            [['user_id', 'created_by', 'record_status'], 'integer'],
            [['manufacture', 'importer', 'pool_handling_agency', 'wholesale_dealer', 'retail_dealer'], 'string'],
            [['application_date', 'address_of_sale','address_of_storage', 'created_date','licence','licence_grant_date','licence_file','application_fee_date','terms_and_condition','form_o','verification_data'], 'safe'],
            [['application_fee_amount'], 'number'],
            [['status', 'district_officer_verified', 'directorate_officer_verified', 'payment_status'], 'string', 'max' => 1],
            [['licence_file','verification_data','form_o'], 'image', 'skipOnEmpty' => true, 'extensions' => 'jpg, jpeg', 'minWidth'=>200, 'minHeight'=>250, 'maxSize' => 512000, 'tooBig' => 'Alert! Maximum file size allowed is 500KB'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'address_of_sale' => 'Address Of Sale',
            'address_of_storage' => 'Address Of Storage',
            'manufacture' => 'Manufacture',
            'importer' => 'Importer',
            'pool_handling_agency' => 'Pool Handling Agency',
            'wholesale_dealer' => 'Wholesale Dealer',
            'retail_dealer' => 'Retail Dealer',
            'application_date' => 'Application Date',
            'status' => 'Status',
            'form_o'=>'Form O',
            'verification_data'=>'Verification Data',
            'terms_and_condition'=>'Terms and Condition',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
            'record_status' => 'Record Status',
            'district_officer_verified' => 'District Officer Verified',
            'directorate_officer_verified' => 'Directorate Officer Verified',
            'payment_status' => 'Payment Status',
            'application_fee_date' => 'Application Fee Date',
            'application_fee_amount' => 'Application Fee Amount',
        ];
    }

    /**
     * Gets query for [[FertilizerItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFertilizerItems()
    {
        return $this->hasMany(FertilizerItem::className(), ['f_id' => 'id']);
    }

    public function upload($attr) {
        if($this->$attr = UploadedFile::getInstance($this, $attr)) {
            $filename = 'uploads/'.Yii::$app->security->generateRandomString(8)."_".strtotime(date('Y-m-d')).'.'.$this->$attr->extension;
            $this->$attr->saveAs($filename);
            $filename =  '/'.$filename;
            $this->$attr = $filename;
            return true;
        }
        return false;
    }
}
