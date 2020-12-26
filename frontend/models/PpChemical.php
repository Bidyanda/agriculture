<?php

namespace frontend\models;
use yii\web\UploadedFile;
use Yii;

/**
 * This is the model class for table "pp_chemical".
 *
 * @property int $id
 * @property string $address_of_registered
 * @property string $address_of_premises
 * @property string $approval_of_technical_expertise
 * @property int $if_yes_ref_no
 * @property string $if_yes_date_validity
 * @property string $name_of_restricted_insecticides
 * @property string $name_of_resp_tech_persion
 * @property string $restricted_insecticide_possession_date
 * @property string $if_yes_particulars_respective_quantity_possession
 * @property string $details_of_safety_equipment_antidotes
 * @property string $insecticide_store_address
 * @property string $insecticide_store_land
 * @property int $insecticide_store_pin_code
 * @property string $insecticide_store_disctrict
 * @property string $insecticide_stored_or_stocked
 * @property string $sold_exhibited_for_sale_issued
 * @property string $above_premises_residential_area
 * @property string $above_premises_food_articles_stored
 * @property string $if_issued_of_applicant_licence
 * @property string $if_renewal_licence_no
 * @property string $if_renewal_date_of_grant
 * @property float $particular_application_fee
 * @property string $application_challan_or_draft_pay_order
 * @property string $application_fee_date
 * @property float $application_fee_amount
 * @property string $sub_treasury_in_treasury_challan
 * @property string $any_other_info
 * @property string $application_date
 * @property string $created_date
 * @property int $created_by
 * @property string $record_status
 */
class PpChemical extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pp_chemical';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['address_of_registered', 'address_of_premises','is_renew','approval_of_technical_expertise','user_id', 'name_of_restricted_insecticides', 'name_of_resp_tech_persion', 'restricted_insecticide_possession_date', 'if_yes_particulars_respective_quantity_possession', 'details_of_safety_equipment_antidotes', 'insecticide_store_address', 'insecticide_store_land', 'insecticide_store_pin_code', 'insecticide_store_disctrict', 'insecticide_stored_or_stocked', 'sold_exhibited_for_sale_issued', 'above_premises_residential_area', 'above_premises_food_articles_stored', 'licence', 'if_renewal_date_of_grant', 'particular_application_fee', 'application_challan_or_draft_pay_order', 'application_fee_date', 'sub_treasury_in_treasury_challan', 'application_date', 'created_by'], 'required'],
            [['address_of_registered', 'address_of_premises', 'insecticide_store_address', 'any_other_info'], 'string'],
            [['if_yes_ref_no', 'insecticide_store_pin_code', 'created_by'], 'integer'],
            [['if_yes_date_validity', 'restricted_insecticide_possession_date','if_yes_ref_no','district_officer_verified','directorate_officer_verified','if_renewal_date_of_grant', 'application_fee_date', 'application_date', 'if_issued_of_applicant_licence',  'any_other_info','created_date'], 'safe'],
            [['particular_application_fee', 'application_fee_amount'], 'number'],
            [['approval_of_technical_expertise', 'name_of_restricted_insecticides', 'name_of_resp_tech_persion','if_yes_approved_date','if_yes_validity', 'if_yes_particulars_respective_quantity_possession', 'insecticide_store_land', 'insecticide_store_disctrict', 'insecticide_stored_or_stocked', 'sold_exhibited_for_sale_issued', 'above_premises_residential_area', 'above_premises_food_articles_stored', 'sub_treasury_in_treasury_challan'], 'string', 'max' => 255],
            [['if_issued_of_applicant_licence', 'licence', 'application_challan_or_draft_pay_order'], 'string', 'max' => 100],
            [['record_status'], 'string', 'max' => 1],
            [['insecticide_store_pin_code'], 'match', 'pattern'=>"/^795\d{3}$/", 'message' => 'Please enter a valid PIN Code'],
            [['details_of_safety_equipment_antidotes'], 'image', 'skipOnEmpty' => true, 'extensions' => 'jpg, jpeg', 'minWidth'=>200, 'minHeight'=>250, 'maxSize' => 512000, 'tooBig' => 'Alert! Maximum file size allowed is 500KB'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'address_of_registered' => 'Address Of Registered',
            'address_of_premises' => 'Address Of Premises',
            'approval_of_technical_expertise' => 'Approval Of Technical Expertise',
            'if_yes_ref_no' => 'If Yes Ref No',
            'if_yes_approved_date' => 'Date of approved',
            'if_yes_validity' => 'validity Date',
            'name_of_restricted_insecticides' => 'Name Of Restricted Insecticides',
            'name_of_resp_tech_persion' => 'Name Of Resp Tech Persion',
            'restricted_insecticide_possession_date' => 'Restricted Insecticide Possession Date',
            'if_yes_particulars_respective_quantity_possession' => 'If Yes Particulars Respective Quantity Possession',
            'details_of_safety_equipment_antidotes' => 'Details Of Safety Equipment Antidotes',
            'insecticide_store_address' => 'Insecticide Store Address',
            'insecticide_store_land' => 'Insecticide Store Land',
            'insecticide_store_pin_code' => 'Insecticide Store Pin Code',
            'insecticide_store_disctrict' => 'Insecticide Store Disctrict',
            'insecticide_stored_or_stocked' => 'Insecticide Stored Or Stocked',
            'sold_exhibited_for_sale_issued' => 'Sold Exhibited For Sale Issued',
            'above_premises_residential_area' => 'Above Premises Residential Area',
            'above_premises_food_articles_stored' => 'Above Premises Food Articles Stored',
            'if_issued_of_applicant_licence' => 'If Issued Of Applicant Licence',
            'if_renewal_date_of_grant' => 'Renewal Date Of Grant',
            'particular_application_fee' => 'Particular Application Fee',
            'application_challan_or_draft_pay_order' => 'Application Challan Or Draft Pay Order',
            'application_fee_date' => 'Application Fee Date',
            'application_fee_amount' => 'Application Fee Amount',
            'sub_treasury_in_treasury_challan' => 'Sub Treasury In Treasury Challan',
            'any_other_info' => 'Any Other Info',
            'application_date' => 'Application Date',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
            'record_status' => 'Record Status',
        ];
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
