<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\PpChemical;

/**
 * PpChemicalSearch represents the model behind the search form of `frontend\models\PpChemical`.
 */
class PpChemicalSearch extends PpChemical
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'if_yes_ref_no', 'insecticide_store_pin_code', 'created_by'], 'integer'],
            [['address_of_registered', 'address_of_premises', 'approval_of_technical_expertise', 'if_yes_date_validity', 'name_of_restricted_insecticides', 'name_of_resp_tech_persion', 'restricted_insecticide_possession_date', 'if_yes_particulars_respective_quantity_possession', 'details_of_safety_equipment_antidotes', 'insecticide_store_address', 'insecticide_store_land', 'insecticide_store_disctrict', 'insecticide_stored_or_stocked', 'sold_exhibited_for_sale_issued', 'above_premises_residential_area', 'above_premises_food_articles_stored', 'if_issued_of_applicant_licence', 'if_renewal_licence_no', 'if_renewal_date_of_grant', 'application_challan_or_draft_pay_order', 'application_fee_date', 'sub_treasury_in_treasury_challan', 'any_other_info', 'application_date', 'created_date', 'record_status'], 'safe'],
            [['particular_application_fee', 'application_fee_amount'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = PpChemical::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'if_yes_ref_no' => $this->if_yes_ref_no,
            'if_yes_date_validity' => $this->if_yes_date_validity,
            'restricted_insecticide_possession_date' => $this->restricted_insecticide_possession_date,
            'insecticide_store_pin_code' => $this->insecticide_store_pin_code,
            'if_renewal_date_of_grant' => $this->if_renewal_date_of_grant,
            'particular_application_fee' => $this->particular_application_fee,
            'application_fee_date' => $this->application_fee_date,
            'application_fee_amount' => $this->application_fee_amount,
            'application_date' => $this->application_date,
            'created_date' => $this->created_date,
            'created_by' => $this->created_by,
        ]);

        $query->andFilterWhere(['like', 'address_of_registered', $this->address_of_registered])
            ->andFilterWhere(['like', 'address_of_premises', $this->address_of_premises])
            ->andFilterWhere(['like', 'approval_of_technical_expertise', $this->approval_of_technical_expertise])
            ->andFilterWhere(['like', 'name_of_restricted_insecticides', $this->name_of_restricted_insecticides])
            ->andFilterWhere(['like', 'name_of_resp_tech_persion', $this->name_of_resp_tech_persion])
            ->andFilterWhere(['like', 'if_yes_particulars_respective_quantity_possession', $this->if_yes_particulars_respective_quantity_possession])
            ->andFilterWhere(['like', 'details_of_safety_equipment_antidotes', $this->details_of_safety_equipment_antidotes])
            ->andFilterWhere(['like', 'insecticide_store_address', $this->insecticide_store_address])
            ->andFilterWhere(['like', 'insecticide_store_land', $this->insecticide_store_land])
            ->andFilterWhere(['like', 'insecticide_store_disctrict', $this->insecticide_store_disctrict])
            ->andFilterWhere(['like', 'insecticide_stored_or_stocked', $this->insecticide_stored_or_stocked])
            ->andFilterWhere(['like', 'sold_exhibited_for_sale_issued', $this->sold_exhibited_for_sale_issued])
            ->andFilterWhere(['like', 'above_premises_residential_area', $this->above_premises_residential_area])
            ->andFilterWhere(['like', 'above_premises_food_articles_stored', $this->above_premises_food_articles_stored])
            ->andFilterWhere(['like', 'if_issued_of_applicant_licence', $this->if_issued_of_applicant_licence])
            ->andFilterWhere(['like', 'if_renewal_licence_no', $this->if_renewal_licence_no])
            ->andFilterWhere(['like', 'application_challan_or_draft_pay_order', $this->application_challan_or_draft_pay_order])
            ->andFilterWhere(['like', 'sub_treasury_in_treasury_challan', $this->sub_treasury_in_treasury_challan])
            ->andFilterWhere(['like', 'any_other_info', $this->any_other_info])
            ->andFilterWhere(['like', 'record_status', $this->record_status]);

        return $dataProvider;
    }
}
